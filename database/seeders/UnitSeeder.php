<?php

namespace Database\Seeders;

use App\Models\Units;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UnitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Units::insert(['kd_unit' => 00 , 'nm_unit' => 'Sragen']);  
        Units::insert(['kd_unit' => 01 , 'nm_unit' => 'Sukodono']);  
        Units::insert(['kd_unit' => 02 , 'nm_unit' => 'Gemolong']); 
        Units::insert(['kd_unit' => 03 , 'nm_unit' => 'Masaran']); 
        Units::insert(['kd_unit' => 04 , 'nm_unit' => 'Tanon']);  
        Units::insert(['kd_unit' => 05 , 'nm_unit' => 'Sidoharjo']);  
        Units::insert(['kd_unit' => 06 , 'nm_unit' => 'Sumberlawang']); 
        Units::insert(['kd_unit' => 07 , 'nm_unit' => 'Mojokerto']); 
        // Units::insert(['kd_unit' => 08 , 'nm_unit' => 'Sambirejo']);
        Units::insert(['kd_unit' => '08' , 'nm_unit' => 'Sambirejo']);
 
        Units::insert(['kd_unit' => '09' , 'nm_unit' => 'Gondang']);
        Units::insert(['kd_unit' => 10 , 'nm_unit' => 'Pengkok']);  
        Units::insert(['kd_unit' => 11 , 'nm_unit' => 'Sambungmacan']);  
        Units::insert(['kd_unit' => 12 , 'nm_unit' => 'Kalijambe']); 
        Units::insert(['kd_unit' => 99 , 'nm_unit' => 'Gabungan']); 
        Units::insert(['kd_unit' => 13 , 'nm_unit' => 'Ngrampal']); 
        Units::insert(['kd_unit' => 14 , 'nm_unit' => 'Plupuh']); 
        Units::insert(['kd_unit' => 15 , 'nm_unit' => 'Jirapan']); 
        Units::insert(['kd_unit' => 88 , 'nm_unit' => 'AirTangki']); 
        Units::insert(['kd_unit' => 16 , 'nm_unit' => 'Mondokan']); 
        Units::insert(['kd_unit' => 17 , 'nm_unit' => 'Jenar']);  
    }
}
