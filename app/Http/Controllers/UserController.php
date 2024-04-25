<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Desa;
use App\Models\Dukuh;
use App\Models\Kecamatan;
use App\Models\Pelanggan;
use Dotenv\Exception\ValidationException;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    // public function coba()
    // {
    //     return view('user.form-coba');
    // }
    // public function index()
    // {
    //     return view('user.beranda', [
    //         'nama' => auth::user()->username,
    //     ]);
    // }

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

    // public function profil()
    // {
        
    //     // try {
    //     //     // Memeriksa apakah ada relasi antara pengguna aktif dan tabel Pelanggan
    //     //     if (auth()->user()->pelanggan()->exists()) {
    //     //         // Jika ada, ambil user_id dari relasi Pelanggan
    //     //         $user_id = auth()->user()->pelanggan->user_id;

    //     //         // Mengambil data Pelanggan berdasarkan user_id
    //     //         $user = Pelanggan::where('user_id', $user_id)->get();

    //     //         // Menampilkan profil dengan data yang ditemukan
    //     //         return view('user.profil', [
    //     //             // dd($user),
    //     //             'nama' => auth()->user()->username,
    //     //             'user' => $user,
    //     //         ]);
    //     //     } else {
    //     //         // Jika tidak ada relasi, berikan respons sesuai kebutuhan Anda
    //     //         return "Tidak ada relasi antara pengguna dan pelanggan";
    //     //     }
    //     // } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
    //     //     // Tangani jika data tidak ditemukan
    //     //     return "Data tidak ditemukan";
    //     // }
    // }

    public function profil() {
        // ini lebih mudah dipahami harusnya
        $pelanggan = Pelanggan::where('user_id', auth()->user()->id)->first();

        if($pelanggan) {
            return view('user.profil', [
                'nama' => auth()->user()->username,
                'pelanggan' => $pelanggan,
            ]);
        } elseif(!$pelanggan) {
            return view('user.profil', [
                'nama' => auth()->user()->username,
            ]);

            // return back()->with('error', "Tidak ada relasi antara pengguna dan pelanggan");
        }
    }

    public function updateProfil($id, Request $request){
        try {
            $request->validate([
                'username' => 'required|string|max:255|unique:users,username,' . auth()->user()->id,
                'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);
        
            $user = Auth::user();
            $user->username = $request->username;
        
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
        } catch (ValidationException $e) {
            throw $e;
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal memperbarui profil. Silakan coba lagi.');
        }
        
    }

    public function sambungan()
    {
        $user = Auth::user();
        $dukuhList = Dukuh::all();
        $desaList = Desa::all();
        $kecamatanList = Kecamatan::all();
        // dd($dukuhList->all());
        return view('user.form-sambungan', [
            'user' => $user,
            'nama' => auth::user()->username,
            'dukuhList' => $dukuhList,
            'desaList' => $desaList,
            'kecamatanList' => $kecamatanList,
        ]);

    }

    public function prosesDaftar(Request $request)
    {
        $user = Auth::user();

        $validatedData = $request->validate([
            'nama' => 'required',
            'email' => 'required',
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

            $validatedData['foto_rumah'] = $name;
        }

        $validatedData['user_id'] = $user->id; 

        // Menambahkan data ke tabel Pelanggan
        $storePelanggan = Pelanggan::create($validatedData);

        if ($storePelanggan) {
            // Kalau berhasil, update role pengguna menjadi 'pelanggan'
            $user = User::find($user->id);

            $updateUserRole = $user->update([
                'role_id' => '4',
            ]);
        }

        return view('user.succes', [
            'nama' => auth::user()->username,
        ]);
    }

}
