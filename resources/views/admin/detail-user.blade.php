@extends('layouts.app')
@section('container')
    {{-- Navbar --}}
    @include('layouts.navbar-admin')
    {{-- Sidebar --}}
    @include('layouts.sidebar')
    <div class="lg:py-12 h-svh  lg:px-8 lg:ml-60">
        @foreach ($pelanggan as $item)
            <div class="w-full flex">
                {{-- Profil User  --}}
                <div class="p-6 w-[500px]">
                    <div class="space-y-16">
                        <div
                            class="flex flex-col justify-center h-96 items-center max-w-xs p-6 shadow-xl rounded-xl sm:px-12 bg-white dark:bg-green-50 dark:text-gray-800">
                            <div class="h-3/4 w-full flex items-center">
                                <img src="{{ asset('img/' . $item->user->foto) }}" alt=""
                                    class="w-52 h-48 mx-auto rounded-full dark:bg-gray-500 aspect-square">
                            </div>
                            <div class="text-center divide-y dark:divide-gray-300">
                                <div class="my-2 space-y-1">
                                    <h2 class="text-lg">{{ $item->nama }}</h2>
                                </div>
                            </div>
                            @can('unit')
                                <form action="{{ url('/verif-pelanggan', ['id' => $item->id]) }}" method="POST">
                                    @csrf
                                    @if ($item->status == 0)
                                        <button type="submit" name="status" value="1"
                                            class="px-4 py-2 bg-green-500 text-white rounded-lg">Verifikasi</button>
                                    @elseif($item->status == 1 || $item->status == 2 || $item->status == 3 || $item->status == 4)
                                        <button type="submit" name="status" value="0"
                                            class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700">Non
                                            Aktifakan</button>
                                    @endif
                                </form>
                            @endcan
                            @can('pegawai')
                                <form action="{{ url('/mulai-pasang', ['id' => $item->id]) }}" method="POST">
                                    @csrf
                                    @if ($item->status == 1)
                                        <button type="submit" name="status" value="2"
                                            class="px-4 py-2 w-36 bg-green-600 text-white rounded-lg">Mulai</button>
                                    @elseif($item->status == 2)
                                        <button type="submit" name="status" value="3"
                                            class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                                            Selesai</button>
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
                                <p> {{ $item->email }}</p>
                            </div>
                            <div class="flex  items-center space-x-3 w-full">
                                <div class="flex justify-center items-center bg-green-600 w-9 h-9 rounded-lg">
                                    <i class="fa-solid fa-phone text-white"></i>
                                </div>
                                <p> {{ $item->no_telepon }}</p>
                            </div>
                            <div class="flex  items-center space-x-3 w-full">
                                <div class="flex justify-center items-center bg-blue-600 w-9 h-9 rounded-lg">
                                    <i class="fa-solid fa-user-pen text-white"></i>
                                </div>
                                <p> {{ $item->created_at->format('d-m-Y') }}</p>
                            </div>
                            <div class="flex  items-center space-x-3 w-full">
                                <div class="flex justify-center items-center bg-red-600 w-9 h-9 rounded-lg">
                                    <i class="fa-solid fa-money-bill-1-wave text-white"></i>
                                </div>
                                <p>Pending</p>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Informasi --}}
                <div class="p-5  w-full">
                    <div
                        class="h-full w-full  p-6 shadow-xl rounded-xl sm:px-12 bg-white dark:bg-green-50 dark:text-gray-800">
                        <div class=" w-full space-y-4 text-gray-900  dark:text-white dark:divide-gray-700">
                            <div class="divide-y divide-gray-200 space-y-3">
                                <p class="font-bold text-2xl text-blue-800">Data Diri Pelanggan</p>
                                <div class="flex w-full">
                                    <div class="flex flex-col pb-3 w-1/2 ">
                                        <p class="mb-1 text-gray-500 md:text-lg dark:text-gray-400">Nama Lengkap</p>
                                        <p class="text-lg font-semibold ">{{ $item->nama }}</p>
                                    </div>
                                    <div class="flex flex-col pb-3 w-1/2">
                                        <p class="mb-1 text-gray-500 md:text-lg dark:text-gray-400">Pekerjaan</p>
                                        <p class="text-lg font-semibold">{{ $item->pekerjaan }}</p>
                                    </div>
                                </div>
                                <div class="flex w-full">
                                    <div class="flex flex-col pb-3 w-1/2 ">
                                        <p class="mb-1 text-gray-500 md:text-lg dark:text-gray-400">No KTP / SIM</p>
                                        <p class="text-lg font-semibold ">{{ $item->no_identitas }}</p>
                                    </div>
                                    <div class="flex flex-col pb-3 w-1/2">
                                        <p class="mb-1 text-gray-500 md:text-lg dark:text-gray-400">No Telp</p>
                                        <p class="text-lg font-semibold">{{ $item->no_telepon }}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="divide-y divide-gray-200 space-y-3">
                                <p class="font-bold text-2xl text-blue-800">Alamat Pelanggan</p>
                                <div class="flex w-full">
                                    <div class="flex flex-col pb-3 w-1/2 ">
                                        <p class="mb-1 text-gray-500 md:text-lg dark:text-gray-400">Dukuh</p>
                                        <p class="text-lg font-semibold ">{{ $item->dukuh }}</p>
                                    </div>
                                    <div class="flex flex-col pb-3 w-1/2">
                                        <p class="mb-1 text-gray-500 md:text-lg dark:text-gray-400">RT / RW</p>
                                        <p class="text-lg font-semibold">{{ $item->rt }} / {{ $item->rw }}</p>
                                    </div>
                                </div>
                                <div class="flex w-full">
                                    <div class="flex flex-col pb-3 w-1/2 ">
                                        <p class="mb-1 text-gray-500 md:text-lg dark:text-gray-400">Desa / Kelurahan</p>
                                        <p class="text-lg font-semibold ">{{ $item->kelurahan }}</p>
                                    </div>
                                    <div class="flex flex-col pb-3 w-1/2">
                                        <p class="mb-1 text-gray-500 md:text-lg dark:text-gray-400">Kecamatan</p>
                                        <p class="text-lg font-semibold">{{ $item->kecamatan }}</p>
                                    </div>
                                </div>
                                <div class="flex w-full">
                                    <div class="flex flex-col pb-3 w-1/2 ">
                                        <p class="mb-1 text-gray-500 md:text-lg dark:text-gray-400">Nama Perumahan / Jalan
                                        </p>
                                        <p class="text-lg font-semibold ">{{ $item->nama_jalan }}</p>
                                    </div>
                                    <div class="flex flex-col pb-3 w-1/2">
                                        <p class="mb-1 text-gray-500 md:text-lg dark:text-gray-400">Kode Pos</p>
                                        <p class="text-lg font-semibold">{{ $item->kode_pos }}</p>
                                    </div>
                                </div>
                                <div class="flex w-full">
                                    <div class="flex flex-col pb-3 w-1/2 ">
                                        <p class="mb-1 text-gray-500 md:text-lg dark:text-gray-400">Jumlah Penghuni</p>
                                        <p class="text-lg font-semibold ">{{ $item->jmlh_penghuni }}</p>
                                    </div>
                                    <div class="flex flex-col pb-3 w-1/2">
                                        <p class="mb-1 text-gray-500 md:text-lg dark:text-gray-400">Unit</p>
                                        <p class="text-lg font-semibold">{{ $item->nm_unit ?? '-' }}</p>
                                    </div>
                                </div>
                                <div class="flex w-full">
                                    <div class="flex flex-col pb-3 w-1/2 ">
                                        <p class="mb-1 text-gray-500 md:text-lg dark:text-gray-400">Foto Rumah</p>
                                        <img src="{{ asset('/foto/' . $item->foto_rumah) }}" class="w-40 h-20"
                                            alt="">
                                    </div>
                                    <div class="flex flex-col pb-3 w-1/2">
                                        <p class="mb-1 text-gray-500 md:text-lg dark:text-gray-400">Keterangan Sambungan
                                        </p>
                                        <p class="text-lg font-semibold">{{ $item->keterangan ?? '-' }}</p>
                                    </div>
                                </div>
                            </div>

                        </div>
                        {{-- Pemasangan --}}
                        @if ($item->status == 2 || $item->status == 3 || $item->status == 4)
                            <div class="space-y-5 mt-10">
                                <p class="font-bold text-2xl text-blue-800">Pemasangan</p>
                                <div class="flex w-full">
                                    <div class="flex w-full flex-col pb-3 ">
                                        <p class="mb-1 text-gray-500 md:text-lg dark:text-gray-400">Bukti Pemasangan</p>
                                        {{-- <img src="" class="w-40 h-20 mb-5" alt=""> --}}
                                        {{-- @can('pegawai')
                                            @if (auth()->user()->pelanggan)
                                                <form action="{{ url('/bukti-pasang/' . auth()->user()->pelanggan->id) }}"
                                                    method="POST" enctype="multipart/form-data">
                                                    @csrf
                                                    <label for="bukti_pemasangan"
                                                        class="block text-sm font-medium text-gray-700">Upload Bukti
                                                        Pemasangan</label>
                                                    <input
                                                        class="mt-1 block w-72 text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 focus:outline-none dark:text-gray-400 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                                                        id="bukti_pemasangan" name="bukti" type="file"
                                                        aria-describedby="bukti_pemasangan_help">
                                                    <p class="mt-2 text-sm text-gray-500" id="bukti_pemasangan_help">PNG, JPG,
                                                        atau JPEG (maksimal 2MB).</p>
                                                    <button type="submit"
                                                        class="mt-4 inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                                        Upload
                                                    </button>
                                                </form>
                                            @else
                                                <p>Pelanggan tidak ditemukan atau Anda tidak memiliki akses untuk mengupload
                                                    bukti pemasangan.</p>
                                            @endif
                                        @endcan --}}
                                    </div>
                                    <div class="w-full">
                                        <div class="flex flex-col pb-3 w-1/2">
                                            <p class="mb-1 text-gray-500 md:text-lg dark:text-gray-400">Status Pengerjaan
                                            </p>
                                            <p class="text-lg font-semibold">
                                                @if ($item->status == 2)
                                                    <span class="text-red-500">Proses Pemasangan</span>
                                                @elseif($item->status == 3)
                                                    <span class="text-green-500">Selesai Pemasangan</span>
                                                @elseif($item->status == 4)
                                                    <span class="text-blue-500">Aktif</span>
                                                @else
                                                    <span class="text-gray-500">Status Tidak Diketahui</span>
                                                @endif
                                            </p>
                                        </div>
                                        @can('unit')
                                            <div class="">
                                                <form action="{{ url('/verif-pelanggan', ['id' => $item->id]) }}"
                                                    method="POST">
                                                    @csrf
                                                    @if ($item->status == 3)
                                                        <button type="submit" name="status" value="4"
                                                            class="px-4 py-2 bg-green-500 text-white rounded-lg">Aktifkan
                                                            Pelanggan</button>
                                                    @elseif($item->status == 4)
                                                        <button type="submit" name="status" value="0"
                                                            class="px-4 py-2 bg-red-600 text-white rounded-lg">Non
                                                            Aktifkan</button>
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
        @endforeach
    </div>
@endsection
