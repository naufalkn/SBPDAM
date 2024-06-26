<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Role::create([
            'nama' => 'superadmin',
        ]);
        Role::create([
            'nama' => 'unit',
        ]);
        Role::create([
            'nama' => 'pegawai',
        ]);

        Role::create([
            'nama' => 'pelanggan',
        ]);
        
        Role::create([
            'nama' => 'user',
        ]);

    }
}
