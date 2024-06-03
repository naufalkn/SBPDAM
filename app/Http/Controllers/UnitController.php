<?php

namespace App\Http\Controllers;

use App\Charts\YearUsersChart;
use App\Models\AdminUnit;
use App\Models\Pegawai;
use App\Models\Pelanggan;
use App\Models\Transaksi;
use App\Models\User;
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
        $pelanggan = Pelanggan::where('kd_unit', Auth::user()->adminUnit->kd_unit)
            ->where('status', 0) // Menambahkan kondisi untuk status 0
            ->with('transaksi') // Eager loading transaksi
            ->get();

        $jmlh_pelanggan_aktif = Pelanggan::where('kd_unit', Auth::user()->adminUnit->kd_unit)
            ->where('status', 4)
            ->count();
        $jmlh_pelanggan_nonVerif = Pelanggan::where('kd_unit', Auth::user()->adminUnit->kd_unit)
            ->where('status', 0)
            ->count();
        $jmlh_pelanggan_proses = Pelanggan::where('kd_unit', Auth::user()->adminUnit->kd_unit)
            ->whereIn('status', [1, 2, 3])
            ->count();

        // dd($pelanggan);

        // Mengembalikan view dengan data pelanggan dan chart
        return view('unit.dashboard', [
            'pelanggan' => $pelanggan,
            'jmlh_pelanggan_aktif' => $jmlh_pelanggan_aktif,
            'jmlh_pelanggan_nonVerif' => $jmlh_pelanggan_nonVerif,
            'jmlh_pelanggan_proses' => $jmlh_pelanggan_proses,
            'nama' => $nama,
            'chart' => $yearUsersChart->build()
        ]);
    }

    public function verifPelanggan(Request $request, $id)
    {
        $pelanggan = Pelanggan::find($id);
        $pelanggan->status = $request->status;
        $pelanggan->save();
        return redirect()->back()->with('success', 'Data berhasil diverifikasi.');
    }

    public function pendaftar()
    {
        $pelanggan = Pelanggan::where('kd_unit', Auth::user()->adminUnit->kd_unit)
            ->where('status', 0) // Menambahkan kondisi untuk status 0
            ->with('transaksi') // Eager loading transaksi
            ->get();
        $nama = Auth::user()->username;
        $jmlh_pelanggan_nonVerif = Pelanggan::where('kd_unit', Auth::user()->adminUnit->kd_unit)
            ->where('status', 0)
            ->count();


        return view('unit.pendaftar', [
            'pelanggan' => $pelanggan,
            'nama' => $nama,
            'jmlh_pelanggan_nonVerif' => $jmlh_pelanggan_nonVerif
        ]);
    }
    public function calonPelanggan()
    {
        $pelanggan = Pelanggan::where('kd_unit', Auth::user()->adminUnit->kd_unit)
            ->whereIn('status', [1, 2, 3]) // Menambahkan kondisi untuk status 0
            ->with('transaksi') // Eager loading transaksi
            ->get();
        $nama = Auth::user()->username;
        $jmlh_pelanggan_proses = Pelanggan::where('kd_unit', Auth::user()->adminUnit->kd_unit)
            ->whereIn('status', [1, 2, 3])
            ->count();


        return view('unit.calonPelanggan', [
            'pelanggan' => $pelanggan,
            'nama' => $nama,
            'jmlh_pelanggan_proses' => $jmlh_pelanggan_proses
        ]);
    }

    public function pelanggan()
    {
        $nama = Auth::user()->username;
        $jmlh_pelanggan_aktif = Pelanggan::where('kd_unit', Auth::user()->adminUnit->kd_unit)
            ->where('status', 4)
            ->count();
        $pelanggan = Pelanggan::where('kd_unit', Auth::user()->adminUnit->kd_unit)
            ->where('status', 4) // Menambahkan kondisi untuk status 0
            ->with('transaksi') // Eager loading transaksi
            ->get();

        return view('unit.pelanggan', [
            'jmlh_pelanggan_aktif' => $jmlh_pelanggan_aktif,
            'nama' => $nama,
            'pelanggan' => $pelanggan
        ]);
    }

    public function pegawai()
    {
        $jmlh_pegawai = Pegawai::where('kd_unit', Auth::user()->adminUnit->kd_unit)->count();
        $pegawai = Pegawai::where('kd_unit', Auth::user()->adminUnit->kd_unit)->get();
        $nama = Auth::user()->username;

        // dd($pegawai);

        return view('unit.pegawai', [
            'jmlh_pegawai' => $jmlh_pegawai,
            'nama' => $nama,
            'pegawai' => $pegawai
        ]);
    }


}
