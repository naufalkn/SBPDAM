<?php

namespace Database\Seeders;

use App\Models\Status;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Status::create([
            'status' => 'Daftar',
        ]);

        Status::create([
            'status' => 'Diverifikasi',
        ]);

        Status::create([
            'status' => 'Dipasang',
        ]);

        Status::create([
            'status' => 'Mulai Pemasangan',
        ]);

        Status::create([
            'status' => 'Pemasangan Selesai',
        ]);

        Status::create([
            'status' => 'Aktif',
        ]);

        Status::create([
            'status' => 'Berhenti Langganan',
        ]);

        Status::create([
            'status' => 'Ajuan Diterima',
        ]);

        Status::create([
            'status' => 'Dicopot',
        ]);

        Status::create([
            'status' => 'Mulai Pencopotan',
        ]);

        Status::create([
            'status' => 'Pencopotan Selesai',
        ]);

        Status::create([
            'status' => 'Segel',
        ]);

        Status::create([
            'status' => 'Ditolak',
        ]);

    }
}
