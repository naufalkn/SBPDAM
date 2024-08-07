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
                                @if ($pelanggan->status == 0)
                                    <button type="submit" name="status" value="1"
                                        class="px-4 py-2 bg-green-500 text-white rounded-lg">Verifikasi</button>
                                @elseif($pelanggan->status == 4)
                                    <button type="submit" name="status" value="0"
                                        class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700">Non
                                        Aktifakan</button>
                                @elseif($pelanggan->status == 5)
                                    <button type="submit" name="status" value="6"
                                        class="px-4 py-2 bg-red-600 text-white rounded-lg">Terima Ajuan</button>
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
                                @if ($pelanggan->status == 1)
                                    <button type="submit" name="status" value="2"
                                        class="px-4 py-2 w-36 bg-green-600 text-white rounded-lg">Mulai</button>
                                @elseif($pelanggan->status == 2 && $pelanggan->bukti != null)
                                    <button type="submit" name="status" value="3"
                                        class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                                        Selesai</button>
                                @endif
                            </form>
                            <form action="{{ url('/mulai-copot', ['id' => $pelanggan->id]) }}" method="POST">
                                @csrf
                                @if ($pelanggan->status == 6)
                                    <button type="submit" name="status" value="7"
                                        class="px-4 py-2 w-36 bg-green-600 text-white rounded-lg">Mulai</button>
                                @elseif($pelanggan->status == 7)
                                    <button type="submit" name="status" value="8"
                                        class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                                        Selesai Pencopotan</button>
                                @endif
                            </form>
                        @endcan
                    </div>
                    <div
                        class="h-full w-full space-y-3  max-w-xs p-5 shadow-xl rounded-xl bg-white dark:bg-green-50 dark:text-gray-800">
                        <div class="flex items-center space-x-3 w-full">
                            @cannot('pegawai')
                                <div class="flex justify-center items-center bg-gray-400 w-9 h-9 rounded-lg">
                                    <i class="fa-solid fa-person text-white text-xl"></i>
                                </div>
                                <p>
                                    @if ($pelanggan->status == '0')
                                        <span>
                                            Belum diverifikasi
                                        </span>
                                    @elseif ($pelanggan->status == '1')
                                        <span>
                                            Sudah diverifikasi
                                        </span>
                                    @elseif($pelanggan->status == '2')
                                        <span>
                                            Proses Pemasangan
                                        </span>
                                    @elseif($pelanggan->status == '3')
                                        <span>
                                            Pemasangan Selesai
                                        </span>
                                    @elseif($pelanggan->status == '4')
                                        <span>
                                            Aktif
                                        </span>
                                    @elseif($pelanggan->status == '5')
                                        <span>
                                            Menunggu Disetujui
                                        </span>
                                    @elseif($pelanggan->status == '6')
                                        <span>
                                            Pengajuan Disetujui
                                        </span>
                                    @elseif($pelanggan->status == '7')
                                        <span>
                                            Proses Pencopotan
                                        </span>
                                    @elseif($pelanggan->status == '8')
                                        <span>
                                            Pencopotan Selesai
                                        </span>
                                    @elseif($pelanggan->status == '9')
                                        <span>
                                            Sambungan Disegel
                                        </span>
                                    @endif
                                </p>
                            @endcannot
                        </div>
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
                            <p class="font-bold text-2xl text-blue-800">Data Diri Pelanggan</p>
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
                    @if ($pelanggan->status != 0 )
                        <div class="space-y-5 mt-10">
                            <p class="font-bold text-2xl text-blue-800">Pemasangan</p>
                            <div class="flex w-full">
                                <div class="flex w-full flex-col pb-3 ">
                                    <label class="block text-lg font-medium text-gray-700 mb-2" for="bukti_pemasangan">Bukti Pemasangan</label>
                                    @if ($pelanggan->status == 2 && $pelanggan->is_pelanggan == 1)
                                        @can('pegawai')
                                            <form action="{{ route('bukti.pemasangan', $pelanggan->id) }}" method="POST"
                                                enctype="multipart/form-data">
                                                @csrf
                                                <div class="">
                                                    <input type="file" name="bukti_pemasangan" class="block w-72 text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 focus:outline-none focus:border-blue-500" required>
                                                    <p class="mt-1 text-sm text-gray-500" id="file_input_help">PNG, JPG, atau JPEG </p>
                                                </div>
                                                <button type="submit" class="mt-5 px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50">
                                                    Upload
                                                </button>
                                            </form>
                                        @endcan
                                    @elseif ($pelanggan->bukti != null && $pelanggan->bukti->isNotEmpty() && ($pelanggan->is_pelanggan == 2 || $pelanggan->is_pelanggan == 3 || $pelanggan->is_pelanggan == 4 || $pelanggan->is_pelanggan == 5))
                                        <p>
                                            <img src="{{ asset('buktiPasang/' . $pelanggan->bukti->first()->bukti_pemasangan) }}" alt="" class="w-40 h-20 mt-5">
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
                                            @if ($pelanggan->status == 1)
                                                <span
                                                    class="text-xs font-semibold inline-block py-1 px-2  rounded-full text-red-600 bg-red-200  last:mr-0 mr-1">Belum
                                                    Dikerjakan</span>
                                            @elseif ($pelanggan->status == 2)
                                                <span
                                                    class="text-xs font-semibold inline-block py-1 px-2  rounded-full text-yellow-600 bg-yellow-200  last:mr-0 mr-1">Proses
                                                    Pemasangan</span>
                                            @elseif($pelanggan->status == 3)
                                                <span
                                                    class="text-xs font-semibold inline-block py-1 px-2  rounded-full text-green-600 bg-green-200  last:mr-0 mr-1">Pemasangan
                                                    Selesai</span>
                                            @elseif($pelanggan->status == 4)
                                                <span
                                                    class="text-xs font-semibold inline-block py-1 px-2  rounded-full text-blue-600 bg-blue-200  last:mr-0 mr-1">Sudah
                                                    Aktif</span>
                                            @elseif($pelanggan->status == 5 || $pelanggan->status == 6 || $pelanggan->status == 7 || $pelanggan->status == 8 || $pelanggan->status == 9)
                                                <span>
                                                    <p class="text-gray-500 text-sm">Dipasang Pada</p>
                                                    <p>{{ \Carbon\Carbon::parse($bukti->tgl_pemasangan)->format('d-m-Y') ?? '-' }}</p>
                                                </span>
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
                                                @if ($pelanggan->status == 3)
                                                    <button type="submit" name="status" value="4"
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
                    @if ($pelanggan->status == 7 || $pelanggan->status == 8 || $pelanggan->status == 9)
                        <div class="space-y-5 mt-10">
                            <p class="font-bold text-2xl text-blue-800">Penyegelan</p>
                            <div class="flex w-full">
                                <div class="flex w-full flex-col pb-3 ">
                                    <p class="mb-1 text-gray-500 md:text-lg dark:text-gray-400">Bukti Pencopotan</p>
                                    @if ($pelanggan->status == 7 && $pelanggan->is_pelanggan == 3) 
                                        @can('pegawai')
                                            <form action="{{ route('bukti.pencopotan', $pelanggan->id) }}" method="POST"
                                                enctype="multipart/form-data">
                                                @csrf
                                                <div class="">
                                                    <input type="file" name="bukti_pencabutan" class="block w-72 text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 focus:outline-none focus:border-blue-500" required>
                                                    <p class="mt-1 text-sm text-gray-500" id="file_input_help">PNG, JPG, atau JPEG </p>
                                                </div>
                                                <button type="submit" class="mt-5 px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50">
                                                    Upload
                                                </button>
                                            </form>
                                        @endcan
                                        @elseif ($pelanggan->bukti != null && $pelanggan->bukti->isNotEmpty())
                                        <p>
                                            <img src="{{ asset('buktiCopot/' . $pelanggan->bukti->first()->bukti_pencabutan) }}"
                                                alt="" class="w-40 h-20 mt-5">
                                        </p>
                                    @endif
                                </div>
                                <div class="w-full">
                                    <div class="flex flex-col pb-3 w-1/2">
                                        <p class="mb-1 text-gray-500 md:text-lg dark:text-gray-400">Status Pengerjaan
                                        </p>
                                        <p class="text-lg font-semibold">
                                            @if ($pelanggan->status == 6)
                                                <span
                                                    class="text-xs font-semibold inline-block py-1 px-2  rounded-full text-blue-600 bg-blue-200  last:mr-0 mr-1">Sudah Disetujui</span>
                                            @elseif($pelanggan->status == 7)
                                                <span
                                                    class="text-xs font-semibold inline-block py-1 px-2  rounded-full text-yellow-500 bg-yellow-200  last:mr-0 mr-1">Proses Pencopotan</span>
                                            @elseif($pelanggan->status == 8)
                                                <span
                                                    class="text-xs font-semibold inline-block py-1 px-2  rounded-full text-green-600 bg-green-200  last:mr-0 mr-1">Pencopotan Selesai </span>
                                            @elseif($pelanggan->status == 9)
                                                <span
                                                    class="text-xs font-semibold inline-block py-1 px-2  rounded-full text-red-600 bg-red-200  last:mr-0 mr-1">Sudah Disegel</span>
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
                                                @if ($pelanggan->status == 8)
                                                    <button type="submit" name="status" value="9"
                                                        class="px-4 py-2 bg-red-600 text-white rounded-lg">Segel
                                                        Sambungan</button>
                                                @endif
                                            </form>
                                        </div>
                                    @endcan
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
