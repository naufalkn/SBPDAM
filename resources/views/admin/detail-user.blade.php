@extends('layouts.app')
@section('container')
    {{-- Navbar --}}
    @include('layouts.navbar-admin')
    {{-- Sidebar --}}
    @include('layouts.sidebar')
    <div class="lg:py-12 h-svh  lg:px-8 lg:ml-60">
        <div class="w-full flex">
            {{-- Profil User  --}}
            <div class="p-6 w-[500px]">
                <div class="space-y-16">
                    <div
                        class="flex flex-col justify-center h-96 items-center max-w-xs p-6 shadow-xl rounded-xl sm:px-12 bg-white dark:bg-green-50 dark:text-gray-800">
                        <div class="h-3/4 w-full flex items-center">
                            <img src="{{ asset('img/' . $pelanggan->user->foto) }}" alt=""
                                class="w-52 h-48 mx-auto rounded-full dark:bg-gray-500 aspect-square">
                        </div>
                        <div class="text-center divide-y dark:divide-gray-300">
                            <div class="my-2 space-y-1">
                                <h2 class="text-lg">{{ $pelanggan->nama }}</h2>
                            </div>
                        </div>
                        @can('unit')
                            <form action="{{ url('/verif-pelanggan', ['id' => $pelanggan->id]) }}" method="POST">
                                @csrf
                                @if ($pelanggan->status_id == 1)
                                <button data-modal-target="tolak-modal" data-modal-toggle="tolak-modal" class=" text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" type="button">
                                    Tolak
                                </button>
                                    <button type="submit" name="status" value="2"
                                        class="px-4 py-2 bg-green-500 text-white rounded-lg">Terima</button>
                                @elseif($pelanggan->status_id == 2)
                                    <div class="space-y-2">
                                        <select name="pegawai" id="pegawai" class="rounded-sm">
                                            @foreach ($pegawai as $pegawai)
                                                <option class="class="rounded-sm" value="{{ $pegawai->id }}"> {{ $pegawai->nama }} </option>
                                            @endforeach
                                        </select>
                                        <button type="submit" name="status" value="3"
                                            class="px-4 py-2 bg-blue-500 text-white rounded-lg">Tugaskan</button>
                                    </div>
                                @elseif($pelanggan->status_id == 7)
                                    <button type="submit" name="status" value="8"
                                        class="px-4 py-2 bg-red-500 text-white rounded-lg">Terima</button>
                                @elseif($pelanggan->status_id == 8)
                                    <div class="">
                                        <select name="pegawai" id="pegawai">
                                            @foreach ($pegawai as $pegawai)
                                                <option value="{{ $pegawai->id }}"> {{ $pegawai->nama }} </option>
                                            @endforeach
                                        </select>
                                        <button type="submit" name="status" value="9"
                                            class="px-4 py-2 bg-blue-500 text-white rounded-lg">Tugaskan</button>
                                    </div>
                                @else
                                    -
                                    {{-- @elseif($pelanggan->status == 4)
                                    <button type="submit" name="status" value="0"
                                        class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700">Non
                                        Aktifakan</button>
                                @elseif($pelanggan->status == 5)
                                    <button type="submit" name="status" value="6"
                                        class="px-4 py-2 bg-red-600 text-white rounded-lg">Terima Ajuan</button> --}}
                                @endif
                            </form>
                            <form action="{{ url('/verif-pelanggan', ['id' => $pelanggan->id]) }}" method="POST">
                                @csrf
                                @if ($pelanggan->status_id == 5)
                                    <button type="submit" name="status" value="6"
                                        class="px-4 py-2 bg-green-500 text-white rounded-lg">Aktifkan
                                        Pelanggan</button>
                                @elseif ($pelanggan->status_id == 11)
                                    <button type="submit" name="status" value="12"
                                        class="px-4 py-2 bg-red-600 text-white rounded-lg">Segel
                                        Sambungan</button>
                                @endif

                            </form>
                            {{-- <form action="{{ url('/verif-pelanggan', ['id' => $pelanggan->id]) }}" method="POST">
                                    @csrf
                                    @if ($pelanggan->status == 5)
                                        <button type="submit" name="status" value="6"
                                            class="px-4 py-2 bg-blue-500 text-white rounded-lg">Verifikasi</button>
                                    @elseif($pelanggan->status == 8)
                                        <button type="submit" name="status" value="9"
                                            class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700">Segel</button>
                                    @endif
                                </form> --}}
                        @endcan
                        @can('pegawai')
                            <form action="{{ url('/mulai-pasang', ['id' => $pelanggan->id]) }}" method="POST">
                                @csrf
                                @if ($pelanggan->status_id == 3)
                                    <button type="submit" name="status" value="4"
                                        class="px-4 py-2 w-36 bg-green-600 text-white rounded-lg">Mulai</button>
                                @elseif($pelanggan->status_id == 4 && $riwayat->foto_pemasangan != null)
                                    <button type="submit" name="status" value="5"
                                        class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                                        Selesai</button>
                                @endif
                            </form>
                            <form action="{{ url('/mulai-copot', ['id' => $pelanggan->id]) }}" method="POST">
                                @csrf
                                @if ($pelanggan->status_id == 9)
                                    <button type="submit" name="status" value="10"
                                        class="px-4 py-2 w-36 bg-green-600 text-white rounded-lg">Mulai</button>
                                @elseif($pelanggan->status_id == 10 && $riwayat->foto_pencabutan != null)
                                    <button type="submit" name="status" value="11"
                                        class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                                        Selesai Pencopotan</button>
                                @endif
                            </form>
                        @endcan
                    </div>
                    <div
                        class="h-full w-full space-y-3  max-w-xs p-5 shadow-xl rounded-xl bg-white dark:bg-green-50 dark:text-gray-800">
                        <div class="flex items-center space-x-3 w-full">
                            <div class="flex justify-center items-center bg-yellow-400 w-9 h-9 rounded-lg">
                                <i class="fa-solid fa-envelope text-white"></i>
                            </div>
                            <p> {{ $pelanggan->email }}</p>
                        </div>
                        <div class="flex  items-center space-x-3 w-full">
                            <div class="flex justify-center items-center bg-green-600 w-9 h-9 rounded-lg">
                                <i class="fa-solid fa-phone text-white"></i>
                            </div>
                            <p> {{ $pelanggan->no_telepon }}</p>
                        </div>
                        <div class="flex  items-center space-x-3 w-full">
                            <div class="flex justify-center items-center bg-blue-600 w-9 h-9 rounded-lg">
                                <i class="fa-solid fa-user-pen text-white"></i>
                            </div>
                            <p>{{ \Carbon\Carbon::parse($pelanggan->tgl_daftar)->format('d-m-Y') ?? '-' }}</p>
                        </div>
                        <div class="flex  items-center space-x-3 w-full">
                            <div class="flex justify-center items-center bg-red-600 w-9 h-9 rounded-lg">
                                <i class="fa-solid fa-money-bill-1-wave text-white"></i>
                            </div>
                            @foreach ($pelanggan->transaksi as $transaksi)
                                @if ($transaksi->status == 'SUCCESS')
                                    <p>Lunas</p>
                                @elseif($transaksi->status == 'PENDING')
                                    <p>Pending</p>
                                @elseif($transaksi->status == 'FAILED')
                                    <p>Gagal</p>
                                @endif
                            @endforeach
                        </div>
                    </div>
                    
                </div>
            </div>

            {{-- Informasi --}}
            <div class="p-5  w-full">
                <div class="h-full w-full  p-6 shadow-xl rounded-xl sm:px-12 bg-white dark:bg-green-50 dark:text-gray-800">
                    <div class=" w-full space-y-4 text-gray-900  dark:text-white dark:divide-gray-700">
                        <div class="divide-y divide-gray-200 space-y-3">
                            <div class="flex justify-between">
                                <p class="font-bold text-2xl text-blue-800">Data Diri Pelanggan</p>
                                <!-- Modal Riwayat -->
                                <button data-modal-target="default-modal" data-modal-toggle="default-modal" class="block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" type="button">
                                    Riwayat
                                </button>
                            </div>
                            <div class="flex w-full">
                                <div class="flex flex-col pb-3 w-1/2 ">
                                    <p class="mb-1 text-gray-500 md:text-lg dark:text-gray-400">Nama Lengkap</p>
                                    <p class="text-lg font-semibold ">{{ $pelanggan->nama ?? '-' }}</p>
                                </div>
                                <div class="flex flex-col pb-3 w-1/2">
                                    <p class="mb-1 text-gray-500 md:text-lg dark:text-gray-400">Pekerjaan</p>
                                    <p class="text-lg font-semibold">{{ $pelanggan->pekerjaan ?? '-' }}</p>
                                </div>
                            </div>
                            <div class="flex w-full">
                                <div class="flex flex-col pb-3 w-1/2 ">
                                    <p class="mb-1 text-gray-500 md:text-lg dark:text-gray-400">No KTP / SIM</p>
                                    <p class="text-lg font-semibold ">{{ $pelanggan->no_identitas ?? '-' }}</p>
                                </div>
                                <div class="flex flex-col pb-3 w-1/2">
                                    <p class="mb-1 text-gray-500 md:text-lg dark:text-gray-400">No Telp</p>
                                    <p class="text-lg font-semibold">{{ $pelanggan->no_telepon ?? '-' }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="divide-y divide-gray-200 space-y-3">
                            <p class="font-bold text-2xl text-blue-800">Alamat Pelanggan</p>
                            <div class="flex w-full">
                                <div class="flex flex-col pb-3 w-1/2 ">
                                    <p class="mb-1 text-gray-500 md:text-lg dark:text-gray-400">Dukuh</p>
                                    <p class="text-lg font-semibold ">{{ $pelanggan->dukuh ?? '-' }}</p>
                                </div>
                                <div class="flex flex-col pb-3 w-1/2">
                                    <p class="mb-1 text-gray-500 md:text-lg dark:text-gray-400">RT / RW</p>
                                    <p class="text-lg font-semibold">{{ $pelanggan->rt ?? '-' }} /
                                        {{ $pelanggan->rw ?? '-' }}
                                    </p>
                                </div>
                            </div>
                            <div class="flex w-full">
                                <div class="flex flex-col pb-3 w-1/2 ">
                                    <p class="mb-1 text-gray-500 md:text-lg dark:text-gray-400">Desa / Kelurahan</p>
                                    <p class="text-lg font-semibold ">{{ $pelanggan->kelurahan ?? '-' }}</p>
                                </div>
                                <div class="flex flex-col pb-3 w-1/2">
                                    <p class="mb-1 text-gray-500 md:text-lg dark:text-gray-400">Kecamatan</p>
                                    <p class="text-lg font-semibold">{{ $pelanggan->kecamatan ?? '-' }}</p>
                                </div>
                            </div>
                            <div class="flex w-full">
                                <div class="flex flex-col pb-3 w-1/2 ">
                                    <p class="mb-1 text-gray-500 md:text-lg dark:text-gray-400">Nama Perumahan / Jalan
                                    </p>
                                    <p class="text-lg font-semibold ">{{ $pelanggan->nama_jalan ?? '-' }}</p>
                                </div>
                                <div class="flex flex-col pb-3 w-1/2">
                                    <p class="mb-1 text-gray-500 md:text-lg dark:text-gray-400">Kode Pos</p>
                                    <p class="text-lg font-semibold">{{ $pelanggan->kode_pos ?? '-' }}</p>
                                </div>
                            </div>
                            <div class="flex w-full">
                                <div class="flex flex-col pb-3 w-1/2 ">
                                    <p class="mb-1 text-gray-500 md:text-lg dark:text-gray-400">Jumlah Penghuni</p>
                                    <p class="text-lg font-semibold ">{{ $pelanggan->jmlh_penghuni ?? '-' }}</p>
                                </div>
                                <div class="flex flex-col pb-3 w-1/2">
                                    <p class="mb-1 text-gray-500 md:text-lg dark:text-gray-400">Unit</p>
                                    <p class="text-lg font-semibold">{{ $pelanggan->nm_unit ?? '-' }}</p>
                                </div>
                            </div>
                            <div class="flex w-full">
                                <div class="flex flex-col pb-3 w-1/2 ">
                                    <p class="mb-1 text-gray-500 md:text-lg dark:text-gray-400">No Sambungan Terdekat
                                    </p>
                                    <p class="text-lg font-semibold ">{{ $pelanggan->no_sambungan ?? '-' }}</p>
                                </div>
                                <div class="flex flex-col pb-3 w-1/2">
                                    <p class="mb-1 text-gray-500 md:text-lg dark:text-gray-400">Nama Sambungan Terdekat
                                    </p>
                                    <p class="text-lg font-semibold">{{ $pelanggan->nm_sambungan ?? '-' }}</p>
                                </div>
                            </div>
                            <div class="flex w-full">
                                <div class="flex flex-col pb-3 w-1/2 ">
                                    <p class="mb-1 text-gray-500 md:text-lg dark:text-gray-400">Foto Identitas</p>
                                    <img src="{{ asset('/foto_Identitas/' . $pelanggan->foto_identitas) }}"
                                        class="w-40 h-20" alt="">
                                </div>
                                <div class="flex flex-col pb-3 w-1/2 ">
                                    <p class="mb-1 text-gray-500 md:text-lg dark:text-gray-400">Foto Rumah</p>
                                    <img src="{{ asset('/foto/' . $pelanggan->foto_rumah) }}" class="w-40 h-20"
                                        alt="">
                                </div>
                            </div>
                        </div>

                    </div>
                    {{-- Pemasangan --}}
                    @if (in_array($pelanggan->status_id, [3, 4]))
                        <div class="space-y-5 mt-10">
                            <p class="font-bold text-2xl text-blue-800">Pemasangan</p>
                            <div class="flex w-full">
                                <div class="flex w-full flex-col pb-3 ">
                                    <label class="block text-lg font-medium text-gray-700 mb-2"
                                        for="bukti_pemasangan">Bukti Pemasangan</label>
                                    @if ($pelanggan->status_id == 4 && $pelanggan->pegawai_id != null && $riwayat->foto_pemasangan == null)
                                        @can('pegawai')
                                            <form action="{{ route('bukti.pemasangan', $pelanggan->id) }}" method="POST"
                                                enctype="multipart/form-data">
                                                @csrf
                                                <div class="">
                                                    <input type="file" name="foto_pemasangan"
                                                        class="block w-72 text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 focus:outline-none focus:border-blue-500"
                                                        required>
                                                    <p class="mt-1 text-sm text-gray-500" id="file_input_help">PNG, JPG, atau
                                                        JPEG </p>
                                                </div>
                                                <button type="submit"
                                                    class="mt-5 px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50">
                                                    Upload
                                                </button>
                                            </form>
                                        @endcan
                                    @elseif (in_array($pelanggan->status_id, [4, 5, 6, 7, 8, 9, 10, 11, 12]))
                                        <p>
                                            <img src="{{ asset('buktiPasang/' . $riwayat->foto_pemasangan) }}"
                                                alt="" class="w-40 h-20 mt-5">
                                        </p>
                                    @else
                                        <p class="text-gray-500">-</p>
                                    @endif
                                </div>
                                <div class="w-full">
                                    <div class="flex flex-col pb-3 w-1/2">
                                        <p class="mb-1 text-gray-500 md:text-lg dark:text-gray-400">Status Pengerjaan
                                        </p>
                                        <p class="text-lg font-semibold">
                                            @if (in_array($pelanggan->status_id, [2, 3]))
                                                <span
                                                    class="text-xs font-semibold inline-block py-1 px-2  rounded-full text-red-600 bg-red-200  last:mr-0 mr-1">Belum
                                                    Dikerjakan</span>
                                            @elseif (in_array($pelanggan->status_id, [4]))
                                                <span
                                                    class="text-xs font-semibold inline-block py-1 px-2  rounded-full text-yellow-600 bg-yellow-200  last:mr-0 mr-1">Proses
                                                    Pemasangan</span>
                                            @elseif($pelanggan->status_id == 5)
                                                <span
                                                    class="text-xs font-semibold inline-block py-1 px-2  rounded-full text-green-600 bg-green-200  last:mr-0 mr-1">Pemasangan
                                                    Selesai</span>
                                            @elseif($pelanggan->status_id == 6)
                                                <span
                                                    class="text-xs font-semibold inline-block py-1 px-2  rounded-full text-blue-600 bg-blue-200  last:mr-0 mr-1">Sudah
                                                    Aktif</span>
                                            @else
                                                <span class="text-gray-500">Status Tidak Diketahui</span>
                                            @endif
                                        </p>
                                    </div>
                                    @can('unit')
                                        <div class="">
                                            <form action="{{ url('/verif-pelanggan', ['id' => $pelanggan->id]) }}"
                                                method="POST">
                                                @csrf
                                                @if ($pelanggan->status_id == 5)
                                                    <button type="submit" name="status" value="6"
                                                        class="px-4 py-2 bg-green-500 text-white rounded-lg">Aktifkan
                                                        Pelanggan</button>
                                                @endif
                                            </form>
                                        </div>
                                    @endcan
                                </div>
                            </div>
                        </div>
                    @endif
                    {{-- Penyegelan --}}
                    @if (in_array($pelanggan->status_id, [9, 10]))
                        <div class="space-y-5 mt-10">
                            <p class="font-bold text-2xl text-blue-800">Penyegelan</p>
                            <div class="flex w-full">
                                <div class="flex w-full flex-col pb-3 ">
                                    <p class="mb-1 text-gray-500 md:text-lg dark:text-gray-400">Bukti Pencopotan</p>
                                    @if ($pelanggan->status_id == 10 && $pelanggan->pegawai_id != null && $riwayat->foto_pencabutan == null)
                                        @can('pegawai')
                                            <form action="{{ route('bukti.pencopotan', $pelanggan->id) }}" method="POST"
                                                enctype="multipart/form-data">
                                                @csrf
                                                <div class="">
                                                    <input type="file" name="foto_pencabutan"
                                                        class="block w-72 text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 focus:outline-none focus:border-blue-500"
                                                        required>
                                                    <p class="mt-1 text-sm text-gray-500" id="file_input_help">PNG, JPG, atau
                                                        JPEG </p>
                                                </div>
                                                <button type="submit"
                                                    class="mt-5 px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50">
                                                    Upload
                                                </button>
                                            </form>
                                        @endcan
                                    @elseif (in_array($pelanggan->status_id, [10, 11, 12]))
                                        <p>
                                            <img src="{{ asset('buktiCopot/' . $riwayat->foto_pencabutan) }}"
                                                alt="" class="w-40 h-20 mt-5">
                                        </p>
                                    @endif
                                </div>
                                <div class="w-full">
                                    <div class="flex flex-col pb-3 w-1/2">
                                        <p class="mb-1 text-gray-500 md:text-lg dark:text-gray-400">Status Pengerjaan
                                        </p>
                                        <p class="text-lg font-semibold">
                                            @if (in_array($pelanggan->status_id, [8, 9]))
                                                <span
                                                    class="text-xs font-semibold inline-block py-1 px-2  rounded-full text-red-600 bg-red-200  last:mr-0 mr-1">Belum
                                                    Dikerjakan</span>
                                            @elseif (in_array($pelanggan->status_id, [10]))
                                                <span
                                                    class="text-xs font-semibold inline-block py-1 px-2  rounded-full text-yellow-600 bg-yellow-200  last:mr-0 mr-1">Proses
                                                    Pencabutan</span>
                                            @elseif($pelanggan->status_id == 11)
                                                <span
                                                    class="text-xs font-semibold inline-block py-1 px-2  rounded-full text-green-600 bg-green-200  last:mr-0 mr-1">Pencabutan
                                                    Selesai</span>
                                            @elseif($pelanggan->status_id == 12)
                                                <span
                                                    class="text-xs font-semibold inline-block py-1 px-2  rounded-full text-blue-600 bg-blue-200  last:mr-0 mr-1">Sudah
                                                    Aktif</span>
                                            @else
                                                <span class="text-gray-500">Status Tidak Diketahui</span>
                                            @endif
                                        </p>
                                    </div>

                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <!-- Main Riwayat -->
    <div id="default-modal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="mt-36 w-full flex justify-center">
            <!-- Modal content -->
            <div class="relative w-full bg-white rounded-lg shadow dark:bg-gray-700">
                <table>
                    <thead>
                        <tr>
                            <th class="py-2 px-2">Aktor</th>
                            <th class="py-2 px-2">Pelanggan</th>
                            <th class="py-2 px-2">Status</th>
                            <th class="py-2 px-2">Tanggal</th>
                            <th class="py-2 px-2 text-left">Keterangan</th>
                            <th class="py-2 px-2">Foto</th>
                        </tr>
                    </thead>
                    <tbody>
                            @foreach ($logriwayat as $item)
                            <tr>
                                <td class="py-2 px-2">{{ $item->user->nama }}</td>
                                <td class="py-2 px-2">{{ $item->pelanggan->nama }}</td>
                                <td class="py-2 px-2">{{ $item->status->status }}</td>
                                <td class="py-2 px-2">{{ $item->tanggal }}</td>
                                <td class="py-2 px-2">{{ $item->keterangan }}</td>
                                <td class="py-2 px-2">
                                    @if($item->foto_pemasangan)
                                        <img src="{{ asset('buktiPasang/' . $item->foto_pemasangan) }}" alt="Foto Pemasangan" class="w-10 h-10">
                                    @endif
                                    @if($item->foto_pencabutan)
                                        <img src="{{ asset('buktiCopot/' . $item->foto_pencabutan) }}" alt="Foto Pencopotan" class="w-10 h-10">
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Main Tolak -->
<div id="tolak-modal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-md max-h-full">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <!-- Modal header -->
            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                    Create New Product
                </h3>
                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="crud-modal">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <!-- Modal body -->
            <form class="p-4 md:p-5" action="{{ url('/verif-pelanggan', ['id' => $pelanggan->id]) }}" method="POST">
                @csrf
                <div class="grid gap-4 mb-4 grid-cols-2">
                    <div class="col-span-2">
                        <label for="description" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Alasan</label>
                        <textarea id="description" name="alasan" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Write product description here"></textarea>                    
                    </div>
                </div>
                <button type="submit" name="status" value="13"
                                        class="px-4 py-2 bg-red-500 text-white rounded-lg">Tolak</button>
            </form>
        </div>
    </div>
</div> 
@endsection
