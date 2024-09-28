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
            'status' => 'aktif',
        ]);
        // Admin Unit
        User::create([
            'username' => 'sragen',
            'nama' => 'sragen',
            'email' => 'sragen@gmail.com',
            'password' => bcrypt('123'),
            'role_id' => 2,
            'status' => 'aktif',
        ]);

        // Pegawai Unit
        User::create([
            'username' => 'Asep',
            'nama' => 'Asep Sutisna',
            'email' => 'asep@gmail.com',
            'password' => bcrypt('123'),
            'role_id' => 3,
            'status' => 'aktif',
        ]);
        // Pelanggan
        User::create([
            'username' => 'Budi',
            'nama' => 'Budi Santoso',
            'email' => 'budi@gmail.com',
            'password' => bcrypt('123'),
            'role_id' => 5,
            'status' => 'aktif',
        ]);
    }
}
