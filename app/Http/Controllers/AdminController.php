<?php

namespace App\Http\Controllers;

use App\Models\Desa;
use App\Models\Dukuh;
use App\Models\Kecamatan;
use App\Models\UnitCoba;
use App\Models\User;
use App\Models\Pelanggan;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class AdminController extends Controller
{
    public function dashboard()
    {
        $jlmh_pelanggan = Pelanggan::all()->count();
        $nama = User::all()->first()->username;
        $pelanggan = Pelanggan::all();
        // dd($nama);
        return view('admin.dashboard', [
            'nama' => $nama,
            'jlmh_pelanggan' => $jlmh_pelanggan,
            'pelanggan' => $pelanggan,
        ]);
    }

    public function daftarManual()
    {
        $nama = User::all()->first()->username;
        $dukuhList = Dukuh::all();
        $desaList = Desa::all();
        $kecamatanList = Kecamatan::all();
        $unitList = UnitCoba::all();
        return view('admin.form-daftar', [
            'nama' => $nama,
            'dukuhList' => $dukuhList,
            'desaList' => $desaList,
            'kecamatanList' => $kecamatanList,
            'unitList' => $unitList,
        ]);
    }

    public function hapusPelanggan($id)
    {
        $pelanggan = Pelanggan::find($id);
        $pelanggan->delete();
        return redirect()->back()->with('success', 'Data berhasil dihapus.');
    }

    public function prosesManual(Request $request)
    {
        $validatedData = ([
            'nama' => 'required',
            'pekerjaan' => 'required',
            'no_identitas' => 'required',
            'no_telepon' => 'required',

            'dukuh' => 'required',
            'rt' => 'required',
            'rw' => 'required',
            'kelurahan' => 'required',
            'kecamatan' => 'required',
            'kode_pos' => 'required',
            'nama_jalan' => 'required',
            'jmlh_penghuni' => 'required',
            'unit' => 'required',
            // 'foto_rumah' => 'required',
        ]); 

        // if ($request->hasFile('foto_rumah')) { // Periksa apakah file telah diunggah
        //     // $fotoPath = $request->file('foto_rumah')->store('public/foto');
        //     $file =$request->file('foto_rumah');
        //     $name = $file->getClientOriginalName();
        //     $file->move('foto/', $name);

        // dd($validatedData);

        Pelanggan::create([
            'nama' => $request->nama,
        'pekerjaan' => $request->pekerjaan,
        'no_identitas' => $request->no_identitas,
        'no_telepon' => $request->no_telepon,
        'dukuh' => $request->dukuh,
        'rt' => $request->rt,
        'rw' => $request->rw,
        'kelurahan' => $request->kelurahan,
        'kecamatan' => $request->kecamatan,
        'kode_pos' => $request->kode_pos,
        'nama_jalan' => $request->nama_jalan,
        'jmlh_penghuni' => $request->jmlh_penghuni,
        'unit' => $request->unit,
        // 'foto_rumah' => $name,
            // 'foto_rumah' => $name,
        ]);
        // dd($request->all());

        return redirect()->back()->with('succes', 'Data berhasil disimpan');
    }

    public function detailUser($id)
    {
        $nama = User::all()->first()->username;
        $pelanggan = Pelanggan::all()->where('id', $id);
        return view('admin.detail-user', [
            'nama' => $nama,
            'pelanggan' => $pelanggan,
        ]);
    }


    public function logout()
    {
        auth()->logout();
        return redirect()->route('login');
    }
}
