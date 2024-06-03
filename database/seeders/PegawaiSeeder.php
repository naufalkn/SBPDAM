<?php

namespace Database\Seeders;

use App\Models\Pegawai;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PegawaiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Pegawai::create([
            'user_id' => 3,
            'username' => 'asep',
            'nama' => 'Asep Saepudin',
            'alamat' => 'Jl. Raya Sragen - Karanganyar Km. 5 Sragen',
            'no_telp' => '081234567890',
            'kd_unit' => '00',
            'nm_unit' => 'sragen',
        ]);
    }
}
