@extends('layouts.app')
@section('container')
    @include('layouts.navbar')
    <div class="w-full h-64">
        <div class="overflow-hidden bg-gradient-to-r from-blue-900 to-blue-600 h-56 absolute w-full flex items-center">
            <p class="text-2xl lg:text-4xl mb-2 font-semibold z-40 ml-28 text-white">Berlangganan</p>
        </div>
    </div>
    <div class="">
        @if (auth()->user()->pelanggan)
            <div class="p-6 h-full space-y-4  text-medium  dark:text-gray-400 dark:bg-gray-800 rounded-lg w-full"
                id="detail" role="tabpanel" aria-labelledby="detail-tab">
                <div class="flex h-full w-full p-4 items-center justify-between rounded-lg border-[1px] border-gray-300">
                    <div class="flex space-x-6 items-center">
                        <div class="">
                            <img class="w-24 h-24 mb-3 rounded-full shadow-lg"
                                src="{{ asset('img/' . auth()->user()->foto) }}" alt="" />
                        </div>
                        <div class="">
                            <p class="font-semibold text-black">{{ $pelanggan->nama }}</p>
                            <p> Unit {{ $pelanggan->nm_unit }}</p>
                            @if ($pelanggan->status == 0 || $pelanggan->status == 1 || $pelanggan->status == 2 || $pelanggan->status == 3)
                                <p> Tanggal Daftar :
                                    <span class="ml-3">
                                        {{ \Carbon\Carbon::parse($pelanggan->tgl_daftar)->format('d-m-Y') ?? '-' }}
                                    </span>
                                </p>
                            @elseif($pelanggan->status == 4)
                                <p> Tanggal Aktif :
                                    <span class="ml-3">
                                        {{ \Carbon\Carbon::parse($pelanggan->tgl_aktif)->format('d-m-Y') ?? '-' }}
                                    </span>
                                </p>
                            @elseif($pelanggan->status == 5 || $pelanggan->status == 6 || $pelanggan->status == 7 || $pelanggan->status == 8)
                                <p> Tanggal Pengajuan :
                                    <span class="ml-3">
                                        {{ \Carbon\Carbon::parse($pelanggan->tgl_aktif)->format('d-m-Y') ?? '-' }}
                                    </span>
                                </p>
                            @elseif($pelanggan->status == 9)
                                <p> Tanggal Segel :
                                    <span class="ml-3">
                                        {{ \Carbon\Carbon::parse($pelanggan->tgl_aktif)->format('d-m-Y') ?? '-' }}
                                    </span>
                                </p>
                            @endif
                        </div>
                    </div>
                    <div class="mr-4">
                        <div class="font-semibold text-lg">
                            @if ($pelanggan->status == 0 || $pelanggan->status == 1 || $pelanggan->status == 2 || $pelanggan->status == 3)
                                <span
                                    class="text-xs font-semibold inline-block py-1 px-2  rounded-full text-yellow-600 bg-yellow-200  last:mr-0 mr-1">Belum
                                    Berlangganan</span>
                            @elseif($pelanggan->status == 4)
                                <span
                                    class="text-xs font-semibold inline-block py-1 px-2  rounded-full text-green-600 bg-green-200  last:mr-0 mr-1">Berlangganan</span>
                            @elseif($pelanggan->status == 5 || $pelanggan->status == 6 || $pelanggan->status == 7 || $pelanggan->status == 8)
                                <span
                                    class="text-xs font-semibold inline-block py-1 px-2  rounded-full text-yellow-600 bg-yellow-200  last:mr-0 mr-1">Pengajuan
                                    Berlangganan</span>
                            @elseif($pelanggan->status == 9)
                                <span
                                    class="text-xs font-semibold inline-block py-1 px-2  rounded-full text-red-600 bg-red-200  last:mr-0 mr-1">Segel
                                    Berlangganan</span>
                            @endif
                        </div>
                    </div>
                </div>
                <form action="{{ url('/updateLangganan', ['id' => auth()->user()->pelanggan->id]) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="">
                        <p class="font-semibold text-xl text-blue-600 mb-6">Data Diri</p>
                        <div class="grid gap-4 mb-4 grid-cols-2">
                            <div class="col-span-1">
                                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama
                                    Lengkap</label>
                                <input type="text" name="nama" id="nama"
                                    class="bg-gray-200 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5"
                                    placeholder="Masukkan Nama Lengkap" value="{{ $pelanggan->nama }}" readonly>
                            </div>
                            <div class="col-span-2 sm:col-span-1">
                                <label
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Pekerjaan</label>
                                <input type="text" name="pekerjaan" id="pekerjaan"
                                    class="bg-gray-200 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5"
                                    placeholder="Masukkan Pekerjaan" value="{{ $pelanggan->pekerjaan }}"readonly>
                            </div>
                        </div>
                        <div class="grid gap-4 mb-4 grid-cols-2">
                            <div class="col-span-1">
                                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nomor
                                    Telepon</label>
                                <input type="number" name="no_telepon" id="no_telepon"
                                    class="bg-gray-200 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5"
                                    placeholder="Masukkan Nama Lengkap" value="{{ $pelanggan->no_telepon }}" readonly>
                            </div>
                            <div class="col-span-2 sm:col-span-1">
                                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">No
                                    KTP / SIM</label>
                                <input type="number" name="no_identitas" id="no_identitas"
                                    class="bg-gray-200 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5"
                                    placeholder="Masukkan Pekerjaan" value="{{ $pelanggan->no_identitas }}" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="">
                        <p class="font-semibold text-xl text-blue-600 mb-6">Alamat</p>
                        <div class="grid gap-4 mb-4 grid-cols-2">
                            <div class="col-span-1">
                                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Dukuh</label>
                                <input type="text" name="nama" id="nama"
                                    class="bg-gray-200 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5"
                                    placeholder="Masukkan Nama Lengkap" value="{{ $pelanggan->dukuh }}" readonly>
                            </div>
                            <div class="flex space-x-4 col-span-2 sm:col-span-1">
                                <div class="">
                                    <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">RT
                                    </label>
                                    <input type="text" name="rt" id="rt"
                                        class="bg-gray-200 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5"
                                        placeholder="Masukkan Pekerjaan" value="{{ $pelanggan->rt }}" readonly>
                                </div>
                                <div class="">
                                    <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">RW</label>
                                    <input type="text" name="rw" id="rw"
                                        class="bg-gray-200 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5"
                                        placeholder="Masukkan Pekerjaan" value="{{ $pelanggan->rw }}" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="grid gap-4 mb-4 grid-cols-2">
                            <div class="col-span-1">
                                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Desa</label>
                                <input type="text" name="desa" id="desa"
                                    class="bg-gray-200 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5"
                                    placeholder="Masukkan Nama Lengkap" value="{{ $pelanggan->kelurahan }}" readonly>
                            </div>
                            <div class="col-span-2 sm:col-span-1">
                                <label
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Kecamatan</label>
                                <input type="text" name="kecamatan" id="kecamatan"
                                    class="bg-gray-200 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5"
                                    placeholder="Masukkan Pekerjaan" value="{{ $pelanggan->kecamatan }}" readonly>
                            </div>
                        </div>
                        <div class="grid gap-4 mb-4 grid-cols-2">
                            <div class="col-span-1">
                                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama
                                    Jalan</label>
                                <input type="text" name="nama_jalan" id="nama_jalan"
                                    class="bg-gray-200 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5"
                                    placeholder="Masukkan Nama Lengkap" value="{{ $pelanggan->nama_jalan }}" readonly>
                            </div>
                            <div class="flex space-x-4 col-span-2 sm:col-span-1">
                                <div class="">
                                    <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Jumlah
                                        Penghuni </label>
                                    <input type="number" name="jmlh_penghuni" id="jmlh_penghuni"
                                        class="bg-gray-200 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5"
                                        placeholder="Masukkan Pekerjaan" value="{{ $pelanggan->jmlh_penghuni }}"
                                        readonly>
                                </div>
                                <div class="">
                                    <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Kode
                                        Pos</label>
                                    <input type="number" name="kode_pos" id="kode_pos"
                                        class="bg-gray-200 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5"
                                        placeholder="Masukkan Pekerjaan" value="{{ $pelanggan->kode_pos }}" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="grid gap-4 mb-4 grid-cols-2">
                            <div class="col-span-1">
                                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Unit</label>
                                <input type="text" name="unit" id="unit"
                                    class="bg-gray-200 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5"
                                    placeholder="Masukkan Nama Lengkap" value="{{ $pelanggan->nm_unit }}" readonly>
                            </div>
                        </div>
                        <div class="grid gap-4 mb-4 grid-cols-2">
                            <div class="col-span-1 space-y-2">
                                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Foto
                                    Rumah</label>
                                <img src="{{ asset('/foto/' . $pelanggan->foto_rumah) }}" class="w-40 h-20"
                                    alt="">

                            </div>
                            <div class="col-span-1 space-y-2">
                                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Foto
                                    KTP</label>
                                <img src="{{ asset('/foto_identitas/' . $pelanggan->foto_identitas) }}" class="w-40 h-20"
                                    alt="">

                            </div>
                        </div>
                    </div>
                    {{-- <div class="w-full justify-end flex">
                        <button type="submit"
                            class="text-white inline-flex items-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                            Simpan
                        </button>
                    </div> --}}
                </form>
            </div>
        @else
            <div class="col-span-2 h-full bg-gray-100">
                <div class="h-full w-full p-6 shadow-xl rounded-xl sm:px-12 dark:bg-green-50 dark:text-gray-800">
                    <div class="flex w-full h-full justify-center items-center ">
                        <div class="space-y-4 h-full p-16">
                            <img src="{{ url('img/ops.svg') }}" class="w-72" alt="">
                            <p class="font-bold text-xl w-full text-blue-900">Kamu belum
                                berlangganan
                                nih : (
                            </p>
                            <div class="">
                                <a href="{{ url('/daftar-sambungan') }}"
                                    class="flex h-10 space-x-3 justify-center items-center rounded-xl w-full bg-blue-900 text-white">Mulai
                                    Berlangganan</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
@endsection
