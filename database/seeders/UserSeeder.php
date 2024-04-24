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
            'email' => 'superadmin@gmail.com',
            'password' => bcrypt('123'),
            'role_id' => 1,
        ]);
        // Admin Unit
        User::create([
            'username' => 'unit1',
            'email' => 'unit1@gmail.com',
            'password' => bcrypt('123'),
            'role_id' => 2,
            'unit_id' => 1,
        ]);
        // Pegawai Unit
        User::create([
            'username' => 'Asep',
            'email' => 'asep@gmail.com',
            'password' => bcrypt('123'),
            'role_id' => 3,
            'unit_id' => 1,
        ]);
        // Pelanggan
        User::create([
            'username' => 'Budi',
            'email' => 'budi@gmail.com',
            'password' => bcrypt('123'),
            'role_id' => 5,
        ]);
    }
}
