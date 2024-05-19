<?php

namespace App\Http\Controllers;

use App\Charts\YearUsersChart;
use App\Models\AdminUnit;
use App\Models\Pelanggan;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class UnitController extends Controller
{
    public function index(Request $request, YearUsersChart $yearUsersChart)
{
    // Mendapatkan id dari user yang sedang login  
    $nama = Auth::user()->username;
    // if(auth::user()->adminUnit->kd_unit != null){
    //     $pelanggan = Pelanggan::where('kd_unit', Auth::user()->adminUnit->kd_unit)->get();
    // }else{
    //     $pelanggan = null;
    // }
    $pelanggan = Pelanggan::where('kd_unit', Auth::user()->adminUnit->kd_unit)->get();

    $jmlh_pelanggan = Pelanggan::where("kd_unit", Auth::user()->adminUnit->kd_unit)->count();


    // dd($pelanggan);

    // Mengembalikan view dengan data pelanggan dan chart
    return view('unit.dashboard', [
        'pelanggan' => $pelanggan,
        'jmlh_pelanggan' => $jmlh_pelanggan,
        'nama' => $nama,
        'chart' => $yearUsersChart->build()
    ]);
}


}
