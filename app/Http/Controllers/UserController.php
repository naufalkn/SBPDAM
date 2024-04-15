<?php

namespace App\Http\Controllers;

use App\Models\Desa;
use App\Models\Dukuh;
use App\Models\Kecamatan;
use App\Models\Pelanggan;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    // public function coba()
    // {
    //     return view('user.form-coba');
    // }
    public function index()
    {
        return view('user.beranda', [
            'nama' => auth::user()->username,
        ]);
    }

    public function riwayat()
    {
        return view('user.riwayat', [
            'nama' => auth::user()->username,
        ]);
    }

    public function bantuan()
    {
        return view('user.bantuan', [
            'nama' => auth::user()->username,
        ]);
    }

    public function sambungan()
    {
        $dukuhList = Dukuh::all();
        $desaList = Desa::all();
        $kecamatanList = Kecamatan::all();
        // dd($desaList->first()->nmdesa);
        return view('user.form-sambungan', [
            'nama' => auth::user()->username,
            'dukuhList' => $dukuhList,
            'desaList' => $desaList,
            'kecamatanList' => $kecamatanList,
        ]);

    }

    public function prosesDaftar(Request $request)
    {

        $validatedData = $request->validate([
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
            'foto_rumah' => 'required',
            // 'unit' => 'nullable'
        ]);

        if ($request->hasFile('foto_rumah')) { // Periksa apakah file telah diunggah
            // $fotoPath = $request->file('foto_rumah')->store('public/foto');
            $file = $request->file('foto_rumah');
            $name = $file->getClientOriginalName();
            $file->move('foto/', $name);

            Pelanggan::create([
                'nama' => $validatedData['nama'],
                'pekerjaan' => $validatedData['pekerjaan'],
                'no_identitas' => $validatedData['no_identitas'],
                'no_telepon' => $validatedData['no_telepon'],
                'dukuh' => $validatedData['dukuh'],
                'rt' => $validatedData['rt'],
                'rw' => $validatedData['rw'],
                'kelurahan' => $validatedData['kelurahan'],
                'kecamatan' => $validatedData['kecamatan'],
                'kode_pos' => $validatedData['kode_pos'],
                'nama_jalan' => $validatedData['nama_jalan'],
                'jmlh_penghuni' => $validatedData['jmlh_penghuni'],
                // 'unit' => $validatedData['unit'],
                'foto_rumah' => $name,
            ]);

            // dd($request->all());

            return redirect()->back()->with('succes', 'Data berhasil disimpan');
        }
    }

}
