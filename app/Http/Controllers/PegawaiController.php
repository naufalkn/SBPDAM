<?php

namespace App\Http\Controllers;

use App\Models\Bukti;
use App\Models\Pegawai;
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
            ->whereIn('status', [1, 6])
            ->get();
        $listPasang = Pelanggan::where('kd_unit', Auth::user()->pegawai->kd_unit)
            ->whereIn('status', [1])
            ->count();
        $listPengajuan = Pelanggan::where('kd_unit', Auth::user()->pegawai->kd_unit)
            ->whereIn('status', [6])
            ->count();
        $listSelesai = Pelanggan::where('kd_unit', Auth::user()->pegawai->kd_unit)
            ->whereIn('status', [3, 4, 8, 9])
            ->count();
        return view('pegawai.dashboard', [
            'title' => 'Dashboard Pegawai',
            'nama' => $nama,
            'pelanggan' => $pelanggan,
            'listPasang' => $listPasang,
            'listPengajuan' => $listPengajuan,
            'listSelesai' => $listSelesai
        ]);
    }

    public function profil()
    {
        $pegawai = Pegawai::where('user_id', auth()->user()->id)->first();

        return view('pegawai.profil', [
            'pegawai' => $pegawai
        ]);
    }

    public function updateProfil($id, Request $request)
    {
        try {
            $user = Auth::user();

            // Pastikan user terkait dengan model Pegawai
            $pegawai = $user->pegawai;

            $rules = [
                'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
                'username' => 'required|string|max:255|unique:users,username,' . $user->id,
                'nama' => 'required|string|max:255',
                'tanggal_lahir' => 'nullable|date',
                'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'alamat' => 'nullable|string|max:255', // Ubah menjadi nullable
                'no_telp' => 'nullable|string|max:13', // Ubah menjadi nullable
            ];

            // Perbarui aturan validasi jika password baru dimasukkan
            if ($request->filled('new_password')) {
                $rules['current_password'] = 'required|string';
                $rules['new_password'] = 'required|confirmed';
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
            $user->tanggal_lahir = $request->tanggal_lahir;

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
                $pegawai->alamat = $validatedData['alamat'];
            }
            if (isset($validatedData['no_telp'])) {
                $pegawai->no_telp = $validatedData['no_telp'];
            }
            $pegawai->save();

            return redirect()->back()->with('success', 'Profil berhasil diperbarui.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal memperbarui profil. Silakan coba lagi.');
        }
    }



    public function mulaiPasang(Request $request, $id)
    {
        $pelanggan = Pelanggan::find($id);
        $pelanggan->status = $request->status;
        $pelanggan->save();
        return redirect()->back()->with('success', 'Data berhasil diverifikasi.');
    }

    public function mulaiCopot(Request $request, $id)
    {
        $pelanggan = Pelanggan::find($id);
        $pelanggan->status = $request->status;
        $bukti = $pelanggan->bukti->first();
        $bukti->tgl_pencabutan = now();
        $pelanggan->save();
        $bukti->save();

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

    public function listSelesaiPemasangan()
    {
        $nama = Auth::user()->username;
        $pelanggan = Pelanggan::where('kd_unit', Auth::user()->pegawai->kd_unit)
            ->whereIn('status', [3]) // Menambahkan kondisi untuk status 0
            ->get();
        $listSelesai = Pelanggan::where('kd_unit', Auth::user()->pegawai->kd_unit)
            ->whereIn('status', [3]) // Menambahkan kondisi untuk status 0
            ->count();
        return view('pegawai.selesai-pasang', [
            'nama' => $nama,
            'pelanggan' => $pelanggan,
            'listSelesai' => $listSelesai
        ]);
    }

    public function riwayatPemasangan()
    {
        $nama = Auth::user()->username;
        $pelanggan = Pelanggan::where('kd_unit', Auth::user()->pegawai->kd_unit)
            ->whereIn('status', [4])
            ->get();
        $riwayat = Pelanggan::where('kd_unit', Auth::user()->pegawai->kd_unit)
            ->whereIn('status', [4])
            ->count();
        return view('pegawai.riwayat-pasang', [
            'nama' => $nama,
            'pelanggan' => $pelanggan,
            'riwayat' => $riwayat
        ]);

    }

    public function buktiPemasangan(Request $request, $id)
    {
        $user = Auth::user()->pegawai;
        // dd($user); 
        $pelanggan = Pelanggan::find($id);
        // Validasi file yang diupload
        $validatedData = $request->validate([
            // 'pelanggan_id' => 'required|exists:pelanggans,id', // Validasi pelanggan_id
            // 'kd_unit' => 'required|exists:munit,kd_unit', // Validasi kd_unit
            'bukti_pemasangan' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($request->hasFile('bukti_pemasangan')) {
            $file = $request->file('bukti_pemasangan');
            $name = $file->getClientOriginalName();
            $file->move('buktiPasang/', $name);
            $validatedData['bukti_pemasangan'] = $name;
        }

        $validatedData['pegawai_id'] = $user->id;
        $validatedData['pelanggan_id'] = $pelanggan->id;


        $storeBukti = Bukti::create($validatedData);

        // Cari bukti yang terkait dengan pelanggan ini
        $bukti = Bukti::where('pelanggan_id', $id)->latest()->first();

        // Jika bukti ditemukan, perbarui tgl_pemasangan
        if ($bukti) {
            $bukti->tgl_pemasangan = now();
            $bukti->save();
        }

        // Merubah is_pelanggan menjadi 2
        $pelanggan->is_pelanggan = 2;
        $pelanggan->save();

        if ($storeBukti) {
            return redirect()->back()->with('success', 'Bukti pemasangan berhasil diunggah.');
        }

        return redirect()->back()->with('error', 'Gagal mengunggah bukti pemasangan.');
    }

    public function listCopot()
    {
        $nama = Auth::user()->username;
        $pelanggan = Pelanggan::where('kd_unit', Auth::user()->pegawai->kd_unit)
            ->where('status', 6)
            ->get();
        $listCopot = Pelanggan::where('kd_unit', Auth::user()->pegawai->kd_unit)
            ->where('status', 6)
            ->count();
        return view('pegawai.list-copot', [
            'nama' => $nama,
            'pelanggan' => $pelanggan,
            'listCopot' => $listCopot
        ]);
    }

    public function buktiPencopotan(Request $request, $id)
    {
        $bukti = Bukti::where('pelanggan_id', $id)->latest()->first();
        $user = Auth::user()->pegawai;
        $pelanggan = Pelanggan::find($id);
        // Validasi file yang diupload
        $validatedData = $request->validate([
            'bukti_pencabutan' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        if ($request->hasFile('bukti_pencabutan')) {
            $file = $request->file('bukti_pencabutan');
            $name = $file->getClientOriginalName();
            $file->move('buktiCopot/', $name);
            $validatedData['bukti_pencabutan'] = $name;
        }
        if ($bukti) {
            $bukti->tgl_pencabutan = now();
            $bukti->save();
        }
        Bukti::where('pelanggan_id', $id)->update([
            'bukti_pencabutan' => $validatedData['bukti_pencabutan'],
        ]);

        $pelanggan->is_pelanggan = 4;
        $pelanggan->save();

        return redirect()->back()->with('success', 'Bukti pencopotan berhasil diunggah.');
    }

    public function prosesPencopotan()
    {
        $nama = Auth::user()->username;
        $pelanggan = Pelanggan::where('kd_unit', Auth::user()->pegawai->kd_unit)
            ->whereIn('status', [7])
            ->get();
        $listCopot = Pelanggan::where('kd_unit', Auth::user()->pegawai->kd_unit)
            ->whereIn('status', [7])
            ->count();

        return view('pegawai.proses-pencopotan', [
            'nama' => $nama,
            'pelanggan' => $pelanggan,
            'listCopot' => $listCopot
        ]);
    }

    public function listSelesaiPencopotan()
    {
        $nama = Auth::user()->username;
        $pelanggan = Pelanggan::where('kd_unit', Auth::user()->pegawai->kd_unit)
            ->whereIn('status', [8]) // Menambahkan kondisi untuk status 0
            ->get();
        $listCopot = Pelanggan::where('kd_unit', Auth::user()->pegawai->kd_unit)
            ->whereIn('status', [8]) // Menambahkan kondisi untuk status 0
            ->count();
        return view('pegawai.selesai-copot', [
            'nama' => $nama,
            'pelanggan' => $pelanggan,
            'listCopot' => $listCopot
        ]);
    }

    public function riwayatPengerjaan(Request $request)
    {
        $nama = Auth::user()->username;
        $sortby = $request->input('sortby', 'semua'); // Default sortby is 'semua'

        $query = Pelanggan::where('kd_unit', Auth::user()->pegawai->kd_unit)
            ->whereIn('status', [3, 4, 8, 9]);

        if ($sortby == 'pendaftaran') {
            $query->where('jenis', 'pendaftaran');
        } elseif ($sortby == 'pengajuan') {
            $query->where('jenis', 'pengajuan');
        }

        $pelanggan = $query->get();
        $riwayat = Pelanggan::where('kd_unit', Auth::user()->pegawai->kd_unit)
            ->whereIn('status', [3, 4, 8, 9])
            ->count();
        return view('pegawai.riwayat-pengerjaan', [
            'nama' => $nama,
            'pelanggan' => $pelanggan,
            'riwayat' => $riwayat,
            'sortby' => $sortby
        ]);
    }

    public function pencarian(Request $request)
    {
        $nama = Auth::user()->username;
        $request->validate([
            'nama' => 'required|max:50',
        ]);

        $sortby = $request->input('sortby', 'semua'); // Default sortby is 'semua'

        $pelanggan = Pelanggan::where('nama', 'like', '%' . $request->nama . '%')
            ->orWhere('no_identitas', 'like', '%' . $request->nama . '%')
            ->get();
        $riwayat = Pelanggan::where('kd_unit', Auth::user()->pegawai->kd_unit)
            ->whereIn('status', [3, 4, 8, 9])
            ->count();

        return view('pegawai.riwayat-pengerjaan', [
            'nama' => $nama,
            'riwayat' => $riwayat,
            'pelanggan' => $pelanggan,
            'sortby' => $sortby
        ]);
    }
}
