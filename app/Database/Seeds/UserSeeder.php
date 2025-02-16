<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run()
    {
        $data = [
            'username' => 'admin',
            'password' => password_hash('admin123', PASSWORD_BCRYPT),
            'role'     => 'Super Administrador',
        ];

        $this->db->table('users')->insert($data);
    }
}
