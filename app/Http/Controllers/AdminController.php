<?php

namespace App\Http\Controllers;

use App\Charts\StatusUsersChart;
use App\Charts\YearUsersChart;
use App\Exports\pelangganExport;
use App\Models\AdminUnit;
use App\Models\Desa;
use App\Models\Dukuh;
use App\Models\Kecamatan;
use App\Models\Pegawai;
use App\Models\riwayat;
use App\Models\Units;
use App\Models\User;
use App\Models\Pelanggan;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class AdminController extends Controller
{
    public function dashboard(YearUsersChart $yearUsersChart, StatusUsersChart $statusUsersChart, Request $request)
    {
        $jmlh_user = User::where('role_id', 5)->count();
        $jmlh_pelanggan = Pelanggan::where('status_id', 6)->count();
        $jmlh_segel = Pelanggan::where('status_id', 12)->count();
        $jmlh_unit = Units::all()->count();
        $nama = Auth::user()->username;
        $riwayat = Pelanggan::orderBy('id', 'desc')->take(4)->get();
        // dd($riwayat);
        $unitlist = Units::all();

        $kd_unit = $request->get('kd_unit', 'all');
        $year = $request->get('year', date('Y'));
        $month = $request->get('month', null);

        return view('admin.dashboard', [
            'nama' => $nama,
            'jmlh_segel' => $jmlh_segel,
            'jmlh_pelanggan' => $jmlh_pelanggan,
            'riwayat' => $riwayat,
            'jmlh_unit' => $jmlh_unit,
            'jmlh_user' => $jmlh_user,
            'unitlist' => $unitlist,
            'selectedYear' => $year,
            'Yearchart' => $yearUsersChart->build($kd_unit, $year),
            'Statuschart' => $statusUsersChart->build($kd_unit, $year, $month),
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

    public function statusAdminUnit(Request $request)
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
        try {
            // Validasi data yang dikirim oleh request
            $validatedData = $request->validate([
                'kd_unit' => 'required',
                'nm_unit' => 'required',
            ]);

            // Menggunakan metode insert() untuk menghindari pembuatan kolom updated_at
            $unit = Units::insert($validatedData);

            if (!$unit) {
                return redirect()->back()->with('error', 'Gagal menambahkan data. Silakan coba lagi.');
            }

            return redirect()->back()->with('success', 'Data berhasil ditambahkan.');
        } catch (\Illuminate\Database\QueryException $e) {
            // Tangkap kesalahan terkait query database
            return redirect()->back()->with('error', 'Mohon maaf, kode unit sudah ada.');
        } catch (\Exception $e) {
            // Tangkap kesalahan lainnya
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }

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
        // $desaList = Desa::all();
        // $kecamatanList = Kecamatan::all();
        // $unitList = UnitCoba::all();
        return view('admin.form-daftar', [
            'nama' => $nama,
            'dukuhList' => $dukuhList,
            // 'desaList' => $desaList,
            // 'kecamatanList' => $kecamatanList,
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
        $logriwayat = riwayat::where('pelanggan_id', $id)
            ->with(['user', 'status', 'pelanggan'])
            ->get();
        // dd($logriwayat);
        $pelanggan = Pelanggan::find($id);
        if (Auth::user()->role_id == 2) {
            $adminUnit = Auth::user()->adminUnit->kd_unit;
            $pegawai = User::where('role_id', 3)
                ->whereHas('pegawai', function ($query) use ($adminUnit) {
                    $query->where('kd_unit', $adminUnit);
                })
                ->with('pegawai')
                ->get();
        } elseif (Auth::user()->role_id == 3) {
            $user = Auth::user()->pegawai->kd_unit;
            $pegawai = User::where('role_id', 3)
                ->whereHas('pegawai', function ($query) use ($user) {
                    $query->where('kd_unit', $user);
                })
                ->with('pegawai')
                ->get();
        }
        // dd($pegawai);
        // $riwayat = riwayat::where('pelanggan_id', $pelanggan->id)->get();
        $riwayat = $pelanggan->riwayat()->orderBy('created_at', 'desc')->first();
        // dd($riwayat);
        // dd($riwayat);

        return view('admin.detail-user', [
            'pelanggan' => $pelanggan,
            'riwayat' => $riwayat,
            'pegawai' => $pegawai,
            'logriwayat' => $logriwayat,
        ]);
    }

    public function pelanggan()
    {
        $user = auth::user();
        $pelanggan = Pelanggan::where('status_id', 6)->get();
        return view('admin.pelanggan', [
            'pelanggan' => $pelanggan,
            'nama' => $user->username,
        ]);
    }

    public function pendaftar()
    {
        $user = auth::user();
        $pendaftar = Pelanggan::whereIn('status_id', [1, 2, 3, 4, 5])->get();
        // dd($pendaftar);
        return view('admin.pendaftar', [
            'pendaftar' => $pendaftar,
            'nama' => $user->username,
        ]);
    }

    public function pengajuan()
    {
        $user = auth::user();
        $pengajuan = Pelanggan::whereIn('status_id', [7, 8, 9, 10, 11])->get();
        // dd($pengajuan);
        return view('admin.pengajuan', [
            'pengajuan' => $pengajuan,
            'nama' => $user->username,
        ]);
    }

    public function segel()
    {
        $user = auth::user();
        $segel = Pelanggan::where('status_id', 12)->get();
        // dd($segel);
        return view('admin.segel', [
            'segel' => $segel,
            'nama' => $user->username,
        ]);
    }

    public function pegawai()
    {
        $user = auth::user();
        $pegawai = Pegawai::all();
        // dd($pegawai);
        return view('admin.pegawai', [
            'pegawai' => $pegawai,
            'nama' => $user->username,
        ]);
    }

    public function hapusPegawai($id)
    {
        $pegawai = Pegawai::find($id);
        $pegawai->delete();
        $user = User::find($pegawai->user_id);
        $user->delete();
        return redirect()->back()->with('success', 'Data berhasil dihapus.');
    }

    public function detailPegawai($id)
    {
        $pegawai = Pegawai::find($id);
        // dd($pegawai);
        return view('admin.info-pegawai', [
            'pegawai' => $pegawai,
        ]);
    }
    public function user()
    {
        $admin = auth::user();
        $user = User::where('role_id', 5)->get();
        // dd($pegawai);
        return view('admin.list-user', [
            'user' => $user,
            'nama' => $admin->username,
        ]);
    }

    public function hapusUser($id)
    {
        $user = User::find($id);
        $user->delete();
        return redirect()->back()->with('success', 'Data berhasil dihapus.');
    }

    public function logout()
    {
        auth()->logout();
        return redirect()->route('login');
    }

    public function exportPelanggan()
    {
        return Excel::download(new pelangganExport, 'pelanggan.xlsx');
    }
}
