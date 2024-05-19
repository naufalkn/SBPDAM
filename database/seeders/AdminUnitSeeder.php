<?php

namespace Database\Seeders;

use App\Models\AdminUnit;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminUnitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        AdminUnit::create([
            'user_id' => 2,
            'username' => 'sragen',
            'kd_unit' => '00',
            'nm_unit' => 'sragen',
            'alamat' => 'Jl. Raya Sragen - Sukoharjo KM 3'
        ]);
    }
}
