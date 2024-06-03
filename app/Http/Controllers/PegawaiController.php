<?php

namespace App\Http\Controllers;

use App\Models\Bukti;
use App\Models\Pelanggan;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class PegawaiController extends Controller
{
    public function index()
    {
        $nama = Auth::user()->username;
        $pelanggan = Pelanggan::where('kd_unit', Auth::user()->pegawai->kd_unit)
            ->whereIn('status', [1, 2, 3]) // Menambahkan kondisi untuk status 0
            ->get();
        $listPasang = Pelanggan::where('kd_unit', Auth::user()->pegawai->kd_unit)
            ->whereIn('status', [1]) // Menambahkan kondisi untuk status 0
            ->count();
        $listProses = Pelanggan::where('kd_unit', Auth::user()->pegawai->kd_unit)
            ->whereIn('status', [2]) // Menambahkan kondisi untuk status 0
            ->count();
        $listSelesai = Pelanggan::where('kd_unit', Auth::user()->pegawai->kd_unit)
            ->whereIn('status', [3]) // Menambahkan kondisi untuk status 0
            ->count();
        return view('pegawai.dashboard', [
            'title' => 'Dashboard Pegawai',
            'nama' => $nama,
            'pelanggan' => $pelanggan,
            'listPasang' => $listPasang,
            'listProses' => $listProses,
            'listSelesai' => $listSelesai
        ]);
    }

    public function mulaiPasang(Request $request, $id)
    {
        $pelanggan = Pelanggan::find($id);
        $pelanggan->status = $request->status;
        $pelanggan->save();
        return redirect()->back()->with('success', 'Data berhasil diverifikasi.');
    }

    public function listPasang()
    {
        $nama = Auth::user()->username;
        $pelanggan = Pelanggan::where('kd_unit', Auth::user()->pegawai->kd_unit)
            ->whereIn('status', [1]) // Menambahkan kondisi untuk status 0
            ->get();
        $listPasang = Pelanggan::where('kd_unit', Auth::user()->pegawai->kd_unit)
            ->whereIn('status', [1]) // Menambahkan kondisi untuk status 0
            ->count();
        return view('pegawai.list-pasang', [
            'nama' => $nama,
            'pelanggan' => $pelanggan,
            'listPasang' => $listPasang
        ]);
    }

    public function prosesPemasangan()
    {
        $nama = Auth::user()->username;
        $pelanggan = Pelanggan::where('kd_unit', Auth::user()->pegawai->kd_unit)
            ->whereIn('status', [2]) // Menambahkan kondisi untuk status 0
            ->get();
        $listProses = Pelanggan::where('kd_unit', Auth::user()->pegawai->kd_unit)
            ->whereIn('status', [2]) // Menambahkan kondisi untuk status 0
            ->count();

        return view('pegawai.proses-pemasangan', [
            'nama' => $nama,
            'pelanggan' => $pelanggan,
            'listProses' => $listProses
        ]);
    }

    public function listSelesai()
    {
        $nama = Auth::user()->username;
        $pelanggan = Pelanggan::where('kd_unit', Auth::user()->pegawai->kd_unit)
            ->whereIn('status', [3]) // Menambahkan kondisi untuk status 0
            ->get();
        $listSelesai = Pelanggan::where('kd_unit', Auth::user()->pegawai->kd_unit)
            ->whereIn('status', [3]) // Menambahkan kondisi untuk status 0
            ->count();
        return view('pegawai.selesai', [
            'nama' => $nama,
            'pelanggan' => $pelanggan,
            'listSelesai' => $listSelesai
        ]);
    }

    public function riwayatPemasangan()
    {
        $nama = Auth::user()->username;
        $pelanggan = Pelanggan::where('kd_unit', Auth::user()->pegawai->kd_unit)
            ->whereIn('status', [4]) // Menambahkan kondisi untuk status 0
            ->get();
        $riwayat = Pelanggan::where('kd_unit', Auth::user()->pegawai->kd_unit)
            ->whereIn('status', [4]) // Menambahkan kondisi untuk status 0
            ->count();
        return view('pegawai.riwayat', [
            'nama' => $nama,
            'pelanggan' => $pelanggan,
            'riwayat' => $riwayat
        ]);

    }

    public function buktiPemasangan(Request $request, $id)
{
    // Validasi file yang diupload
    $request->validate([
        'bukti' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
    ]);

    // Menggunakan nama unik untuk file yang diupload
    $imageName = time() . '_' . $request->bukti->getClientOriginalName();
    $request->bukti->move(public_path('bukti'), $imageName);

    // Temukan pelanggan berdasarkan ID
    $pelanggan = Pelanggan::find($id);
    if ($pelanggan) {
        // Simpan nama file bukti ke model Bukti
        $bukti = new Bukti();
        $bukti->pelanggan_id = $pelanggan->id;
        $bukti->foto_pemasangan = $imageName;
        $bukti->save();

        return redirect()->back()->with('success', 'Bukti berhasil diupload.');
    } else {
        return redirect()->back()->with('error', 'Pelanggan tidak ditemukan.');
    }
}



}
