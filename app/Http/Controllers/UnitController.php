<?php

namespace App\Http\Controllers;

use App\Charts\YearUsersChart;
use App\Models\AdminUnit;
use App\Models\Pegawai;
use App\Models\Pelanggan;
use App\Models\Transaksi;
use App\Models\Units;
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

    public function profil()
    {
        $unit = AdminUnit::where('user_id', auth()->user()->id)->first();
        return view('unit.profil', [
            'unit' => $unit
        ]);
    }

    public function updateProfil($id, Request $request)
    {
        try {
            $user = Auth::user();

            // Pastikan user terkait dengan model Pegawai
            $unit = $user->adminUnit;

            $rules = [
                'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
                'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'alamat' => 'nullable|string|max:255', // Ubah menjadi nullable
                'no_telp' => 'nullable|string|max:13', // Ubah menjadi nullable
                'username' => 'required|string|max:255|unique:users,username,' . $user->id,
            ];

            // Perbarui aturan validasi jika password baru dimasukkan
            if ($request->filled('new_password')) {
                $rules['current_password'] = 'required|string';
                $rules['new_password'] = 'required|confirmed'; //min:8
            }

            $validatedData = $request->validate($rules);

            // Periksa apakah kata sandi saat ini sesuai dengan yang ada di database
            if ($request->filled('current_password')) {
                if (!\Hash::check($request->current_password, $user->password)) {
                    return redirect()->back()->with('error', 'Kata sandi saat ini tidak sesuai.');
                }
            }

            $user->email = $request->email;
            $user->username = $request->username;

            // Perbarui kata sandi jika ada
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

            // Update alamat dan no_telp di tabel pegawai jika ada dalam validatedData
            if (isset($validatedData['alamat'])) {
                $unit->alamat = $validatedData['alamat'];
            }
            if (isset($validatedData['no_telp'])) {
                $unit->no_telp = $validatedData['no_telp'];
            }
            $unit->save();

            return redirect()->back()->with('success', 'Profil berhasil diperbarui.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal memperbarui profil. Silakan coba lagi.');
        }
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

    public function riwayatPendaftar()
    {
        $nama = Auth::user()->username;
        $pelanggan = Pelanggan::where('kd_unit', Auth::user()->adminUnit->kd_unit)
            ->where('status', 4) // Menambahkan kondisi untuk status 0
            ->with('transaksi') // Eager loading transaksi
            ->orderBy('id', 'desc') // Mengurutkan berdasarkan ID terbesar
            ->get();
        // dd($pelanggan);
        return view('unit.riwayatPendaftar', [
            'nama' => $nama,
            'pelanggan' => $pelanggan
        ]);

    }

    public function pegawai()
    {
        $jmlh_pegawai = Pegawai::where('kd_unit', Auth::user()->adminUnit->kd_unit)->count();
        $pegawai = Pegawai::where('kd_unit', Auth::user()->adminUnit->kd_unit)->get();
        $nama = Auth::user()->username;
        $unitlist = Units::all();

        return view('unit.pegawai', [
            'jmlh_pegawai' => $jmlh_pegawai,
            'nama' => $nama,
            'pegawai' => $pegawai,
            'unitlist' => $unitlist
        ]);
    }

    public function tambahPegawai(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'username' => 'required|unique:users,username',
            'email' => 'required|email|unique:users,email',
            'password' => 'required',
            'kd_unit' => 'required',
            'nm_unit' => 'required',
            'no_identitas' => 'required',
            'foto_ktp' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'jenis_kelamin' => 'required',
            'tenggal_lahir' => 'required',
        ]);

        try {
            // Buat user baru
            $user = new User;
            $user->username = $request->username;
            $user->nama = $request->nama;
            $user->email = $request->email;
            $user->jenis_kelamin = $request->jenis_kelamin;
            $user->tanggal_lahir = $request->tanggal_lahir;
            $user->role_id = 3;
            $user->password = bcrypt($request->password);
            $user->save();

            // Handle file upload
            $foto_ktp = 'foto_ktp'; // Default foto_ktp in case no file is uploaded
            if ($request->hasFile('foto_ktp')) {
                $file = $request->file('foto_ktp');
                $name = $file->getClientOriginalName(); // Ensure a unique filename
                $file->move(public_path('KTP_Pegawai'), $name); // Move the file to the correct directory
                $foto_ktp = 'KTP_Pegawai/' . $name; // Set the correct path for the foto_ktp attribute
            }

            // Buat pegawai baru
            Pegawai::create([
                'user_id' => $user->id,
                'kd_unit' => $request->kd_unit,
                'nm_unit' => $request->nm_unit,
                'no_identitas' => $request->no_identitas,
                'foto_ktp' => $foto_ktp,
                'role_id' => 3,
            ]);

            return redirect()->back()->with('success', 'Data berhasil ditambahkan.');
        } catch (\Exception $exception) {
            // Tangkap dan tangani kesalahan yang terjadi selama proses
            return redirect()->back()->with('error', 'Gagal menambahkan data. Silakan coba lagi.')->withErrors($exception->getMessage());
        }
    }



    public function statusPegawai(Request $request)
    {
        $pegawai = Pegawai::find($request->id);
        $pegawai->status = $request->status;
        $pegawai->save();
        return redirect()->back()->with('success', 'Data berhasil diubah.');
    }

    public function detailPegawai($id)
    {
        $pegawai = Pegawai::all()->where('id', $id);
        // dd($pegawai);
        return view('unit.detailPegawai', [
            'pegawai' => $pegawai
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
}
