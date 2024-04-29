<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // super Admin
        User::create([
            'username' => 'superadmin',
            'nama' => 'Super Admin',
            'email' => 'superadmin@gmail.com',
            'password' => bcrypt('123'),
            'role_id' => 1,
        ]);
        // Admin Unit
        User::create([
            'username' => 'sragen',
            'nama' => 'sragen',
            'email' => 'sragen@gmail.com',
            'password' => bcrypt('123'),
            'role_id' => 2,
            'kd_unit' => 00,
        ]);
        // Pegawai Unit
        User::create([
            'username' => 'Asep',
            'nama' => 'Asep Sutisna',
            'email' => 'asep@gmail.com',
            'password' => bcrypt('123'),
            'role_id' => 3,
            'kd_unit' => 00,
        ]);
        // Pelanggan
        User::create([
            'username' => 'Budi',
            'nama' => 'Budi Santoso',
            'email' => 'budi@gmail.com',
            'password' => bcrypt('123'),
            'role_id' => 5,
        ]);
    }
}
