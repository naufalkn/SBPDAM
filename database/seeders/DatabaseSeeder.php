<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(RoleSeeder::class);
        $this->call(UnitSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(AdminUnitSeeder::class);
        $this->call(PegawaiSeeder::class);
        $this->call(StatusSeeder::class);
        $this->call(IndoRegionSeeder::class);
        $this->call(IndoRegionVillageSeeder::class);
        $this->call(IndoRegionDistrictSeeder::class);
        $this->call(IndoRegionProvinceSeeder::class);
        $this->call(IndoRegionRegencySeeder::class);
    }
}
