<?php

namespace App\Models;

use CodeIgniter\Model;

/**
 * Raw punch log — written by Android QR scanner or manual entry.
 * Never deleted; provides full audit trail.
 */
class AttendanceLogModel extends Model
{
    protected $table = 'attendance_logs';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $useSoftDeletes = false;
    protected $useTimestamps = false; // has only created_at, no updated_at

    protected $allowedFields = [
        'staff_id',
        'punched_at',
        'punch_type',
        'source',
        'device_id',
        'note',
    ];

    // ──────────────────────────────────────────────────────────────────
    // Android / QR API endpoint
    // ──────────────────────────────────────────────────────────────────

    /**
     * Record a punch from the Android app.
     * Automatically determines IN or OUT:
     *   - If the last punch for this staff today was IN  → this is OUT
     *   - Otherwise → this is IN
     *
     * @return array ['punch_type' => 'in'|'out', 'punched_at' => datetime, 'id' => int]
     */
    public function recordQrPunch(int $staffId, string $deviceId = null, string $source = 'qr_scan'): array
    {
        $punchedAt = date('Y-m-d H:i:s');

        // Look back up to 24 hours to find the last punch.
        // This handles night shift: a 6PM IN on the 29th must be seen
        // when the staff punches at 3AM on the 30th.
        $lookbackFrom = date('Y-m-d H:i:s', strtotime('-24 hours'));

        $last = $this->where('staff_id', $staffId)
            ->where('punched_at >=', $lookbackFrom)
            ->where('punched_at <=', $punchedAt)
            ->orderBy('punched_at', 'DESC')
            ->first();

        // Toggle: if the last punch in the window was IN → this is OUT, else IN
        $punchType = (!$last || $last['punch_type'] === 'out') ? 'in' : 'out';

        $id = $this->insert([
            'staff_id' => $staffId,
            'punched_at' => $punchedAt,
            'punch_type' => $punchType,
            'source' => $source,
            'device_id' => $deviceId,
            'created_at' => $punchedAt,
        ], true);

        // Recompute attendance for the date the IN punch belongs to.
        // If punch_type is OUT and it's past midnight, the attendance date
        // is yesterday (the night shift date).
        $attendanceDate = $punchedAt;
        if ($punchType === 'out' && $last) {
            // The shift started on the date of the IN punch
            $attendanceDate = date('Y-m-d', strtotime($last['punched_at']));
        } else {
            $attendanceDate = date('Y-m-d', strtotime($punchedAt));
        }

        (new AttendanceModel())->computeForStaffDate($staffId, $attendanceDate);

        return [
            'id' => $id,
            'punch_type' => $punchType,
            'punched_at' => $punchedAt,
        ];
    }

    /**
     * All punches for a staff member on a specific date (handles night shift:
     * includes punches up to noon of the next day).
     */
    public function getForDate(int $staffId, string $date): array
    {
        $start = $date . ' 00:00:00';
        $end = date('Y-m-d', strtotime($date . ' +1 day')) . ' 11:59:59';

        return $this->where('staff_id', $staffId)
            ->where('punched_at >=', $start)
            ->where('punched_at <=', $end)
            ->orderBy('punched_at', 'ASC')
            ->findAll();
    }

    /**
     * All punches for a month (for bulk recompute).
     */
    public function getForMonth(int $month, int $year): array
    {
        $start = "$year-" . str_pad($month, 2, '0', STR_PAD_LEFT) . '-01 00:00:00';
        // Include up to noon on 1st of next month to catch night-shift out punches
        $nextMonth = $month == 12 ? 1 : $month + 1;
        $nextYear = $month == 12 ? $year + 1 : $year;
        $end = "$nextYear-" . str_pad($nextMonth, 2, '0', STR_PAD_LEFT) . '-01 11:59:59';

        return $this->where('punched_at >=', $start)
            ->where('punched_at <=', $end)
            ->orderBy('staff_id')
            ->orderBy('punched_at')
            ->findAll();
    }
}