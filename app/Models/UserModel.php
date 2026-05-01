<?php
namespace App\Models;
use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'users';
    protected $primaryKey = 'id';
    protected $returnType = 'array';
    protected $useSoftDeletes = false;
    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';

    protected $allowedFields = [
        'name',
        'username',
        'password',
        'is_active',
    ];

    protected $validationRules = [
        'name' => 'required|min_length[2]',
        'username' => 'required|min_length[3]|alpha_numeric_punct',
    ];

    protected $beforeInsert = ['hashPassword'];
    protected $beforeUpdate = ['hashPassword'];

    protected function hashPassword(array $data): array
    {
        if (!empty($data['data']['password'])) {
            $data['data']['password'] = password_hash(
                $data['data']['password'],
                PASSWORD_BCRYPT
            );
        } else {
            // Don't update password field if blank (edit without changing pw)
            unset($data['data']['password']);
        }
        return $data;
    }

    /** Verify credentials, return user array or null. */
    public function authenticate(string $username, string $password): ?array
    {
        $user = $this->where('username', $username)
            ->where('is_active', 1)
            ->first();

        if (!$user || !password_verify($password, $user['password'])) {
            return null;
        }

        unset($user['password']);
        return $user;
    }
}