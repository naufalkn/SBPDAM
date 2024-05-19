<?php

namespace App\Http\Controllers;

use App\Charts\YearUsersChart;
use App\Models\AdminUnit;
use App\Models\Desa;
use App\Models\Dukuh;
use App\Models\Kecamatan;
use App\Models\Units;
use App\Models\User;
use App\Models\Pelanggan;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function dashboard(YearUsersChart $yearUsersChart)
    {
        $jmlh_user = User::where('role_id', 5)->count();
        $jmlh_pelanggan = Pelanggan::all()->count();
        $jmlh_unit = Units::all()->count();
        $nama = Auth::user()->username;
        $pelanggan = Pelanggan::all();

        // dd($jmlh_unit);
        return view('admin.dashboard', [
            'nama' => $nama,
            'jmlh_pelanggan' => $jmlh_pelanggan,
            'pelanggan' => $pelanggan,
            'jmlh_unit' => $jmlh_unit,
            'jmlh_user' => $jmlh_user,
            'chart' => $yearUsersChart->build()

        ]);
    }

    public function unit()
    {
        $unitList = Units::all();
        return view('admin.unit', [
            'unitList' => $unitList,
        ]);
    }

    public function tambahUnit(Request $request)
    {
        $validatedData = $request->validate([
            'kd_unit' => 'required',
            'nm_unit' => 'required',
        ]);

        // Menggunakan metode insert() untuk menghindari pembuatan kolom updated_at
        Units::insert($validatedData);

        return redirect()->back()->with('success', 'Data berhasil ditambahkan.');
    }

    public function hapusUnit($kd_unit){
        Units::destroy($kd_unit);
        return redirect()->back()->with('success', 'Data berhasil dihapus.');
    }
    
    public function editUnit(Request $request, $kd_unit)
{
    // Mencari unit berdasarkan kd_unit
    $unit = Units::where('kd_unit', $kd_unit)->first();
    
    // Jika unit tidak ditemukan, kembalikan dengan pesan error
    if (!$unit) {
        return redirect()->back()->with('error', 'Unit tidak ditemukan.');
    }
    
    // Melakukan pengisian data dari request ke model
    $unit->nama_unit = $request->nm_unit;
    
    // Menyimpan perubahan
    try {
        $unit->save();
        return redirect()->back()->with('success', 'Data berhasil diperbarui.');
    } catch (\Exception $e) {
        return redirect()->back()->withInput()->withErrors('Gagal menyimpan data. Silakan coba lagi.');
    }
}

    
    

    public function adminUnit()
    {
        $adminUnit = AdminUnit::all();
        $unitlist = Units::all();
        // dd($adminUnit);
        return view('admin.admin-unit', [
            'adminUnit' => $adminUnit,
            'unitlist' => $unitlist,
        ]);
    }

    public function tambahAdminUnit(Request $request)
{
    $request->validate([
        'nama' => 'required',
        'username' => 'required',
        'email' => 'required|email|unique:users,email',
        'password' => 'required',
        'kd_unit' => 'required',
        'nm_unit' => 'required',
    ]);

    

    try {
        // Membuat entri baru dalam tabel users
        $user = new User;
        $user->username = $request->username;
        $user->nama = $request->nama;
        $user->role_id = 2;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->save();

        // Membuat entri baru dalam tabel adminunits
        AdminUnit::create([
            'user_id' => $user->id, // Gunakan id pengguna baru yang dibuat
            'username' => $request->username, // Ini mungkin tidak diperlukan jika Anda sudah memiliki kolom 'username' di tabel 'adminunits'
            'role_id' => 2,
            'kd_unit' => $request->kd_unit,
            'nm_unit' => $request->nm_unit,
        ]);
        
        return redirect()->back()->with('success', 'Data berhasil ditambahkan.');
    } catch (\Exception $exception) {
        // Tangkap dan tangani kesalahan yang terjadi selama proses
        return redirect()->back()->with('error', 'Gagal menambahkan data. Silakan coba lagi.');
    }
}

    public function daftarManual()
    {
        $nama = User::all()->first()->username;
        $dukuhList = Dukuh::all();
        $desaList = Desa::all();
        $kecamatanList = Kecamatan::all();
        // $unitList = UnitCoba::all();
        return view('admin.form-daftar', [
            'nama' => $nama,
            'dukuhList' => $dukuhList,
            'desaList' => $desaList,
            'kecamatanList' => $kecamatanList,
            // 'unitList' => $unitList,
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
        $user = auth::user();

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

        $validatedData['user_id'] = $user->id;

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
            // 'foto_rumah' => $fotoPath,
            'user_id' => $user->id,
        ]);

        return back()->with('succes', 'Data berhasil disimpan');
    }

    public function detailUser($id)
    {
        $pelanggan = Pelanggan::all()->where('id', $id);
        // dd($pelanggan);
        return view('admin.detail-user', [
            // 'user' => $user,
            'pelanggan' => $pelanggan,
        ]);
    }


    public function logout()
    {
        auth()->logout();
        return redirect()->route('login');
    }
}
