<?php

namespace Database\Seeders;

use App\Models\Unit;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UnitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Unit::create([
            'kode_unit' => '001', 
            'nama_unit' => 'Unit 1',
            'alamat' => 'Jl. Jendral Sudirman No. 1',
            'nomor_telepon' => '021-1234567',
            'wilayah' => 'gondang, sambungmacan, tangen'
        ]);

        Unit::create([
            'kode_unit' => '002', 
            'nama_unit' => 'Unit 2',
            'alamat' => 'Jl. Jendral Aha No. 1',
            'nomor_telepon' => '021-1234500',
            'wilayah' => 'Bulak Asri, Plumbungan'
        ]);
    }
}
