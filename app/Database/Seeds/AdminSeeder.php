<?php
namespace App\Database\Seeds;
use CodeIgniter\Database\Seeder;

/**
 * php spark db:seed AdminSeeder
 * Root user: username=admin  password=Admin@1234
 */
class AdminSeeder extends Seeder
{
    public function run(): void
    {
        $now = date('Y-m-d H:i:s');

        // Clear any existing root user then re-insert
        $this->db->table('users')->where('username', 'admin')->delete();

        $this->db->table('users')->insert([
            'name' => 'Administrator',
            'username' => 'admin',
            'password' => password_hash('Admin@1234', PASSWORD_BCRYPT),
            'is_active' => 1,
            'created_at' => $now,
            'updated_at' => $now,
        ]);
    }
}