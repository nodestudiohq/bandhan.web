<?php

namespace App\Models;

use CodeIgniter\Model;

class AttendanceModel extends Model
{
    protected $table = 'attendance';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = [
        'staff_id',
        'date',
        'first_in',
        'last_out',
        'work_minutes',
        'status',
        'is_manual',
        'manual_status',
        'note',
    ];

    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';

    // ──────────────────────────────────────────────────────────────────
    // Thresholds
    // ──────────────────────────────────────────────────────────────────

    const MINUTES_FULL_DAY = 480; // 8 hours = present
    const MINUTES_HALF_DAY = 240; // 4 hours = half day
    // < 240 min with a punch = short
    // no punch at all       = absent

    // ──────────────────────────────────────────────────────────────────
    // Compute from logs
    // ──────────────────────────────────────────────────────────────────

    /**
     * Compute / recompute attendance for a single staff on a single date.
     * Reads attendance_logs, calculates work_minutes, derives status.
     * Does NOT overwrite is_manual=1 records unless $forceOverride=true.
     */
    public function computeForStaffDate(int $staffId, string $date, bool $forceOverride = false): void
    {
        // Check for existing manual override
        $existing = $this->where('staff_id', $staffId)->where('date', $date)->first();
        if ($existing && $existing['is_manual'] && !$forceOverride) {
            return;
        }

        // Check if this date is the staff's weekly off day
        $staff = (new \App\Models\StaffModel())->find($staffId);
        $weekOffIso = self::dayNameToIso($staff['weekly_off'] ?? 'Sunday');
        $dateIso = (int) date('N', strtotime($date));

        $logModel = new AttendanceLogModel();
        $punches = $logModel->getForDate($staffId, $date);

        // No punches on their week-off day → mark WO
        if (empty($punches) && $dateIso === $weekOffIso) {
            $payload = [
                'staff_id' => $staffId,
                'date' => $date,
                'first_in' => null,
                'last_out' => null,
                'work_minutes' => 0,
                'status' => 'week_off',
                'is_manual' => 0,
            ];
            $existing ? $this->update($existing['id'], $payload) : $this->insert($payload);
            return;
        }

        if (empty($punches)) {
            if ($existing) {
                $this->update($existing['id'], [
                    'first_in' => null,
                    'last_out' => null,
                    'work_minutes' => 0,
                    'status' => 'absent',
                    'is_manual' => 0,
                ]);
            }
            return;
        }

        // Find first IN and last OUT
        $firstIn = null;
        $lastOut = null;
        foreach ($punches as $punch) {
            if ($punch['punch_type'] === 'in' && $firstIn === null) {
                $firstIn = $punch['punched_at'];
            }
            if ($punch['punch_type'] === 'out') {
                $lastOut = $punch['punched_at'];
            }
        }

        // Calculate work minutes
        $workMinutes = 0;
        if ($firstIn && $lastOut) {
            $diff = strtotime($lastOut) - strtotime($firstIn);
            if ($diff > 0)
                $workMinutes = (int) ($diff / 60);
        } elseif ($firstIn && !$lastOut && $date === date('Y-m-d')) {
            $workMinutes = (int) ((time() - strtotime($firstIn)) / 60);
        }

        $status = $this->deriveStatus($workMinutes, $firstIn !== null);
        $payload = [
            'staff_id' => $staffId,
            'date' => $date,
            'first_in' => $firstIn,
            'last_out' => $lastOut,
            'work_minutes' => $workMinutes,
            'status' => $status,
            'is_manual' => 0,
        ];

        $existing ? $this->update($existing['id'], $payload) : $this->insert($payload);
    }

    /**
     * Recompute all attendance for a month from logs.
     * Runs on all staff who have any punch in that month.
     */
    public function recomputeMonth(int $month, int $year, bool $forceOverride = false): int
    {
        $logModel = new AttendanceLogModel();
        $allPunches = $logModel->getForMonth($month, $year);

        // Group by staff_id → date
        $grouped = [];
        foreach ($allPunches as $punch) {
            $date = date('Y-m-d', strtotime($punch['punched_at']));
            // Night shift: if punch is after midnight but before noon,
            // it belongs to the PREVIOUS day
            $hour = (int) date('H', strtotime($punch['punched_at']));
            if ($punch['punch_type'] === 'out' && $hour < 12) {
                $date = date('Y-m-d', strtotime($punch['punched_at'] . ' -1 day'));
            }
            // Only process dates in the requested month
            if (date('n', strtotime($date)) != $month || date('Y', strtotime($date)) != $year) {
                continue;
            }
            $grouped[$punch['staff_id']][$date] = true;
        }

        $count = 0;
        foreach ($grouped as $staffId => $dates) {
            foreach (array_keys($dates) as $date) {
                $this->computeForStaffDate($staffId, $date, $forceOverride);
                $count++;
            }
        }
        return $count;
    }

    // ──────────────────────────────────────────────────────────────────
    // Manual override
    // ──────────────────────────────────────────────────────────────────

    /**
     * HR manually sets status for a staff on a date.
     * Sets is_manual=1 so auto-compute won't overwrite it.
     */
    public function manualSet(int $staffId, string $date, string $status, string $note = ''): void
    {
        $existing = $this->where('staff_id', $staffId)->where('date', $date)->first();

        $payload = [
            'staff_id' => $staffId,
            'date' => $date,
            'status' => $status,
            'manual_status' => $status,
            'is_manual' => 1,
            'note' => $note ?: null,
        ];

        if ($existing) {
            $this->update($existing['id'], $payload);
        } else {
            $this->insert($payload);
        }
    }

    /**
     * Bulk save a full day's attendance (manual mark-all form).
     */
    public function saveForDate(string $date, array $records): void
    {
        foreach ($records as $staffId => $data) {
            $this->manualSet(
                $staffId,
                $date,
                $data['status'] ?? 'absent',
                $data['note'] ?? ''
            );
        }
    }

    // ──────────────────────────────────────────────────────────────────
    // Queries
    // ──────────────────────────────────────────────────────────────────

    /**
     * Get attendance for a specific date keyed by staff_id.
     */
    public function getByDate(string $date): array
    {
        $rows = $this->where('date', $date)->findAll();
        $keyed = [];
        foreach ($rows as $row) {
            $keyed[$row['staff_id']] = $row;
        }
        return $keyed;
    }

    /**
     * Full month grid for ALL active staff.
     * Returns: [ staff_id => [ 'Y-m-d' => attendance_row, ... ], ... ]
     */
    public function getMonthGrid(int $month, int $year): array
    {
        $start = "$year-" . str_pad($month, 2, '0', STR_PAD_LEFT) . '-01';
        $end = date('Y-m-t', strtotime($start));

        $rows = $this->where('date >=', $start)
            ->where('date <=', $end)
            ->findAll();

        $grid = [];
        foreach ($rows as $row) {
            $grid[$row['staff_id']][$row['date']] = $row;
        }
        return $grid;
    }

    /**
     * Map day name to PHP date('N') ISO number (1=Mon … 7=Sun).
     */
    public static function dayNameToIso(string $dayName): int
    {
        return match (strtolower(trim($dayName))) {
            'monday' => 1,
            'tuesday' => 2,
            'wednesday' => 3,
            'thursday' => 4,
            'friday' => 5,
            'saturday' => 6,
            'sunday' => 7,
            default => 7, // fallback Sunday
        };
    }

    /**
     * Monthly summary for salary computation.
     * Returns ['present'=>N, 'absent'=>N, 'half_day'=>N, 'leave'=>N, 'short'=>N]
     */
    public function monthlySummary(int $staffId, int $month, int $year): array
    {
        $start = "$year-" . str_pad($month, 2, '0', STR_PAD_LEFT) . '-01';
        $end = date('Y-m-t', strtotime($start));

        $rows = $this->where('staff_id', $staffId)
            ->where('date >=', $start)
            ->where('date <=', $end)
            ->findAll();

        $summary = ['present' => 0, 'absent' => 0, 'half_day' => 0, 'leave' => 0, 'short' => 0, 'week_off' => 0, 'holiday' => 0];
        foreach ($rows as $r) {
            $key = $r['status'] ?? 'absent';
            if (isset($summary[$key]))
                $summary[$key]++;
        }
        return $summary;
    }

    /**
     * Count present staff for a given date (for dashboard).
     */
    public function countPresent(string $date): int
    {
        return $this->whereIn('status', ['present', 'half_day', 'short'])
            ->where('date', $date)
            ->countAllResults();
    }

    // ──────────────────────────────────────────────────────────────────
    // Helpers
    // ──────────────────────────────────────────────────────────────────

    /**
     * Derive status from work minutes.
     */
    public function deriveStatus(int $workMinutes, bool $hasPunch): string
    {
        if (!$hasPunch)
            return 'absent';
        if ($workMinutes >= self::MINUTES_FULL_DAY)
            return 'present';
        if ($workMinutes >= self::MINUTES_HALF_DAY)
            return 'half_day';
        if ($workMinutes > 0)
            return 'short';
        return 'present'; // has IN punch but no OUT yet — assume present
    }

    /**
     * Format minutes as h:mm string.
     */
    public static function formatMinutes(int $minutes): string
    {
        if ($minutes <= 0)
            return '—';
        $h = intdiv($minutes, 60);
        $m = $minutes % 60;
        return $h . 'h ' . str_pad($m, 2, '0', STR_PAD_LEFT) . 'm';
    }
}