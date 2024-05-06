<?php

namespace App\Http\Controllers;

use App\Charts\YearUsersChart;
use App\Models\Pelanggan;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class UnitController extends Controller
{
public function index(Request $kd_unit, YearUsersChart $yearUsersChart)
{
    // $total_pelanggan = Pelanggan::where("kd_unit", Auth::user()->kd_unit)->count();
    // $bulan = date('F');
    $jmlh_pelanggan = Pelanggan::where("kd_unit", Auth::user()->kd_unit)->count();
    $nama = auth()->user()->username;
    $pelanggan = Pelanggan::where("kd_unit", Auth::user()->kd_unit)->get();
    
    // Mengambil data jumlah pelanggan per bulan
    // $jumlah_pelanggan_per_bulan = Pelanggan::where("kd_unit", Auth::user()->kd_unit)
    // ->select(DB::raw('MONTH(created_at) as bulan'), DB::raw('COUNT(*) as total'))
    // ->groupBy('bulan')
    // ->get();
    
    // dd($yearUsersChart);
    return view('unit.dashboard', [
        'pelanggan' => $pelanggan,
        'jmlh_pelanggan' => $jmlh_pelanggan,
        'nama' => $nama,
        // 'total_pelanggan' => $total_pelanggan,
        // 'bulan' => $bulan,
        // 'jumlah_pelanggan_per_bulan' => $jumlah_pelanggan_per_bulan, // Mengirimkan data ke view
        'chart' => $yearUsersChart->build()
    ]);
}

}
