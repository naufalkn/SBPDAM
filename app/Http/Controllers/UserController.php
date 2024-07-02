<?php

namespace App\Http\Controllers;

use App\Models\DesKec;
use App\Models\User;
use App\Models\Desa;
use App\Models\Dukuh;
use App\Models\Kecamatan;
use App\Models\Units;
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

    public function profil()
    {
        // ini lebih mudah dipahami harusnya
        $pelanggan = Pelanggan::where('user_id', auth()->user()->id)->first();

        if ($pelanggan) {
            return view('user.profil', [
                'nama' => auth()->user()->username,
                'pelanggan' => $pelanggan,
            ]);
        } elseif (!$pelanggan) {
            return view('user.profil', [
                'nama' => auth()->user()->username,
            ]);

            // return back()->with('error', "Tidak ada relasi antara pengguna dan pelanggan");
        }
    }

    public function langganan()
    {
        $pelanggan = Pelanggan::where('user_id', auth()->id())->with('transaksi')->first();
        // dd($pelanggan);
        // $transaksi = $pelanggan->transaksi()->first();
        return view('user.langganan', [
            // 'transaksi' => $transaksi,
            'pelanggan' => $pelanggan,
        ]);
    }

    public function updateProfil($id, Request $request)
    {
        try {
            $user = Auth::user();

            $rules = [
                'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
                'username' => 'required|string|max:255|unique:users,username,' . $user->id,
                'nama' => 'required|string|max:255',
                'tanggal_lahir' => 'nullable|date',
                'jenis_kelamin' => 'nullable|in:L,P',
                'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ];

            // Perbarui aturan validasi jika password baru dimasukkan
            if ($request->filled('new_password')) {
                $rules['current_password'] = 'required|string';
                $rules['new_password'] = 'min:8|confirmed';
            }

            $request->validate($rules);

            // Periksa apakah kata sandi saat ini sesuai dengan yang ada di database
            if ($request->filled('current_password')) {
                if (!\Hash::check($request->current_password, $user->password)) {
                    return redirect()->back()->with('error', 'Kata sandi saat ini tidak sesuai.');
                }
            }

            $user->email = $request->email;
            $user->username = $request->username;
            $user->tanggal_lahir = $request->tanggal_lahir;
            $user->jenis_kelamin = $request->jenis_kelamin;
            $user->nama = $request->nama;

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

            return redirect()->back()->with('success', 'Profil berhasil diperbarui.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal memperbarui profil. Silakan coba lagi.');
        }
    }


    public function sambungan()
    {
        $user = Auth::user();
        $dukuhList = Dukuh::all();
        $unitList = Units::all();
        // $desaList = Desa::all();
        // $kecamatanList = Kecamatan::all();
        $deskec = DesKec::all();
        // dd($deskec->all());
        return view('user.form-sambungan', [
            'user' => $user,
            'nama' => auth::user()->username,
            'dukuhList' => $dukuhList,
            'deskec' => $deskec,
            'unitList' => $unitList,
            // 'desaList' => $desaList,
            // 'kecamatanList' => $kecamatanList,
        ]);

    }

    public function prosesDaftar(Request $request)
    {
        $user = Auth::user();

        $validatedData = $request->validate([
            'nama' => 'required',
            'email' => 'required|email|unique:pelanggans,email',
            'pekerjaan' => 'required',
            'no_identitas' => 'required|unique:pelanggans,no_identitas',
            'no_telepon' => 'required|string|max:15',
            'foto_identitas' => 'required',

            'dukuh' => 'required',
            'rt' => 'required',
            'rw' => 'required',
            'kelurahan' => 'required',
            'kecamatan' => 'required',
            'kode_pos' => 'required',
            'nama_jalan' => 'required',
            'jmlh_penghuni' => 'required',
            'foto_rumah' => 'required',
            'nm_sambungan' => 'nullable',
            'no_sambungan' => 'nullable',
            'nm_unit' => 'required',
            'kd_unit' => 'required|exists:munit,kd_unit',
        ]);

        $validatedData['tgl_daftar'] = now();

        if ($request->hasFile('foto_identitas')) { // Periksa apakah file telah diunggah
            // $fotoPath = $request->file('foto_rumah')->store('public/foto');
            $file = $request->file('foto_identitas');
            $name = $file->getClientOriginalName();
            $file->move('foto_Identitas/', $name);

            $validatedData['foto_identitas'] = $name;
        }
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

        // dd($storePelanggan);
        return view('user.succes', [
            'nama' => auth::user()->username,
        ]);
    }

    public function updateLangganan($id, Request $request)
    {
        try {
            // Menggunakan $id yang diterima dari rute untuk menemukan dan memperbarui pelanggan
            $pelanggan = Pelanggan::findOrFail($id);

            $rules = [
                'nama' => 'required|string|max:255',
                'pekerjaan' => 'required|string|max:255',
                'no_telepon' => 'required|string|max:15',
                'jmlh_penghuni' => 'required|integer',
                'keterangan' => 'required|string',
                'foto_rumah' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ];

            $validatedData = $request->validate($rules);

            // Jika ada file foto yang diunggah
            if ($request->hasFile('foto_rumah')) {
                $file = $request->file('foto_rumah');
                // Pastikan file foto telah berhasil diunggah
                if ($file->isValid()) {
                    // Pindahkan file ke direktori yang diinginkan
                    $fileName = $file->getClientOriginalName();
                    $file->move(public_path('foto'), $fileName);
                    // Simpan nama file foto ke atribut $foto pada model pengguna
                    $pelanggan->foto_rumah = $fileName;
                } else {
                    // Jika file foto tidak valid, kembalikan dengan pesan error
                    return redirect()->back()->with('error', 'File foto tidak valid.');
                }
            }
            // Memperbarui atribut pelanggan dengan data yang valid
            $pelanggan->save($validatedData);

            return redirect()->back()->with('success', 'Profil berhasil diperbarui.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal memperbarui profil. Silakan coba lagi.');
        }
    }

    public function pengajuan()
    {
        $user = Auth::user();
        return view('user.pengajuan', [
            'user' => $user,
        ]);
    }

    public function mulaiPengajuan(Request $request, $id )
    {
        $user = Auth::user();
        $pelanggan = $user->pelanggan;
        $bukti = $pelanggan->bukti;
        $pelanggan->tgl_pengajuan = now(); 
        $pelanggan->status = '5';
        $bukti->alasan = $request->alasan;
        $pelanggan->save();
        $bukti->save();

        return redirect()->route('profil', $user->id);
    }

}
