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
use Illuminate\Support\Facades\DB;

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

    public function profil()
    {
        $admin = Auth::user();
        return view('admin.profil', [
            'admin' => $admin,
        ]);
        
    }

    public function updateProfil(Request $request, $id)
    {
        try {
            $user = Auth::user();

            $rules = [
                'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
                'username' => 'required|string|max:255|unique:users,username,' . $user->id,
                'nama' => 'required|string|max:255',
                'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ];

            if ($request->filled('new_password')) {
                $rules['current_password'] = 'required|string';
                $rules['new_password'] = 'required|confirmed';
            }

            $request->validate($rules);

            if ($request->filled('current_password')) {
                if (!\Hash::check($request->current_password, $user->password)) {
                    return redirect()->back()->with('error', 'Kata sandi saat ini tidak sesuai.');
                }
            }

            $user->email = $request->email;
            $user->username = $request->username;
            $user->nama = $request->nama;

            if ($request->filled('new_password')) {
                $user->password = \Hash::make($request->new_password);
            }

           // Perbarui foto pengguna jika ada
           if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            // Pastikan file foto telah berhasil diunggah
            if ($file->isValid()) {
                // Pindahkan file ke direktori yang diinginkan
                $fileName = $file->getClientOriginalName();
                $file->move(public_path('img'), $fileName);
                // Simpan nama file foto ke atribut $foto pada model pengguna
                $user->foto = $fileName;
            } else {
                // Jika file foto tidak valid, kembalikan dengan pesan error
                return redirect()->back()->with('error', 'File foto tidak valid.');
            }
        }

        $user->save();

            return redirect()->back()->with('success', 'Profil berhasil diperbarui.');
        } catch (\Exception $exception) {
            return redirect()->back()->with('error', 'Gagal memperbarui profil. Silakan coba lagi.');
        

    }
}

    public function detailAdminUnit($id)
    {
        $adminUnit = AdminUnit::find($id);
        // dd($adminUnit);
        return view('admin.detail-admin-unit', [
            'adminUnit' => $adminUnit,
        ]);
    }

    public function statusAdminUnit (Request $request)
    {
        $adminUnit = AdminUnit::find($request->id);
        $adminUnit->status = $request->status;
        $adminUnit->save();
        return redirect()->back()->with('success', 'Status berhasil diperbarui.');
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

    public function hapusUnit($kd_unit)
    {
        Units::destroy($kd_unit);
        return redirect()->back()->with('success', 'Data berhasil dihapus.');
    }

    public function editUnit(Request $request, $kd_unit)
    {
        $request->validate([
            'nm_unit' => 'required|string|max:255',
        ]);

        // Lakukan update data
        DB::table('munit')->where('kd_unit', $kd_unit)->update([
            'nm_unit' => $request->nm_unit,
        ]);

        return redirect()->back()->with('success', 'Data berhasil diperbarui.');
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

    public function hapusAdminUnit($id)
    {
        // Temukan AdminUnit berdasarkan ID
        $adminUnit = AdminUnit::find($id);

        if ($adminUnit) {
            // Hapus AdminUnit terlebih dahulu
            $adminUnit->delete();

            // Hapus pengguna terkait jika ada
            $user = $adminUnit->user;
            if ($user) {
                // Hapus pengguna
                $user->delete();
            }

            return redirect()->back()->with('success', 'Data Admin Unit dan pengguna terkait berhasil dihapus.');
        } else {
            return redirect()->back()->with('error', 'Admin Unit tidak ditemukan.');
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
        $pelanggan = Pelanggan::find($id);
        // dd($pelanggan);
        return view('admin.detail-user', [
            // 'user' => $user,
            'pelanggan' => $pelanggan,
        ]);
    }

    public function pelanggan()
    {
        $user = auth::user();
        $pelanggan = Pelanggan::where('status', 4)->get();
        return view('admin.pelanggan', [
            'pelanggan' => $pelanggan,
            'nama' => $user->username,
        ]);
    }

    public function pendaftar()
    {
        $user = auth::user();
        $pendaftar = Pelanggan::whereIn('status', [0, 1, 2, 3])->get();
        // dd($pendaftar);
        return view('admin.pendaftar', [
            'pendaftar' => $pendaftar,
            'nama' => $user->username,
        ]);
    }

    public function logout()
    {
        auth()->logout();
        return redirect()->route('login');
    }
}
