@extends('layouts.app')
@section('container')
    @include('layouts.navbar')
    {{-- <div class="flex-col justify-center items-center w-full">
        <div class="flex justify-center items-center">
            <a href="/logout" class="text-blue-500">Logout</a>
        </div>
        @if (!auth()->user()->pelanggan || !auth()->user()->pelanggan->id)
            <p>Belum ada tagihan</p>
        @elseif (App\Models\Transaksi::where('pelanggan_id', auth()->user()->pelanggan->id)->where('status', 'SUCCESS')->exists())
            <p>Sudah dibayar</p>
        @else
            <div class="flex justify-center items-center">
                <a href="/bayar" class="bg-blue-500 py-2 px-4 rounded-md text-white">Bayar!</a>
            </div>
        @endif
    </div> --}}
    <div class="w-full h-64">
        <div class="overflow-hidden bg-gradient-to-r from-blue-900 to-blue-600 h-56 absolute w-full flex items-center">
            <p class="text-2xl lg:text-4xl mb-2 font-semibold z-40 ml-28 text-white">Tagihan</p>
        </div>

    </div>
    <div class="md:flex ml-28">
        <ul id="myTab" data-tabs-toggle="#myTabContent" role="tablist"
            class="flex-column w-52 space-y space-y-4 font-medium text-gray-500 dark:text-gray-400 md:me-4 mb-4 md:mb-0"
            data-tabs-toggle="#myTabContent">
            <li role="presentation">
                <button id="tagihan-tab" data-tabs-target="#tagihan" type="button" role="tab" aria-controls="tagihan"
                    aria-selected="false"
                    class="inline-flex space-x-4 items-center px-4 py-3 rounded-lg hover:text-gray-900 bg-gray-100 hover:bg-gray-200  w-full dark:bg-gray-800 dark:hover:bg-gray-700 dark:hover:text-white"
                    aria-current="page">
                    <i class="fa-solid fa-user"></i>
                    <p class="font-semibold">
                        Tagihan
                    </p>
                </button>
            </li>
        </ul>
        <div class="p-6 mb-9 bg-gray-100 text-medium text-gray-500 dark:text-gray-400 dark:bg-gray-800 rounded-lg w-full h-full hidden"
            id="tagihan" role="tabpanel" aria-labelledby="tagihan-tab">
            <div class="space-y-4">
                @if (!auth()->user()->pelanggan || !auth()->user()->pelanggan->id)
                    <div class="col-span-2 h-full bg-gray-100">
                        <div class="h-full w-full p-6 shadow-xl rounded-xl sm:px-12 dark:bg-green-50 dark:text-gray-800">
                            <div class="flex w-full h-full justify-center items-center ">
                                <div class="space-y-4 h-full p-16">
                                    <img src="{{ url('img/ops.svg') }}" class="w-72" alt="">
                                    <p class="font-bold text-xl w-full text-blue-900 text-center">Belum ada tagihan
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
                @elseif (App\Models\Transaksi::where('pelanggan_id', auth()->user()->pelanggan->id)->where('status', 'SUCCESS')->exists())
                    <p>Sudah</p>
                @else
                    <div class="">
                        <p class="font-semibold text-xl text-blue-600 mb-6">Data Diri Pelanggan</p>
                        <div class="grid gap-4 mb-4 grid-cols-2">
                            <div class="col-span-1">
                                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama
                                    Lengkap</label>
                                <input type="text" name="nama" id="nama"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5"
                                    placeholder="Masukkan Nama Lengkap" value="{{ $pelanggan->nama }} "readonly>
                            </div>
                            <div class="col-span-2 sm:col-span-1">
                                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Alamat</label>
                                <input type="text" name="pekerjaan" id="pekerjaan"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5"
                                    placeholder="Masukkan Pekerjaan"
                                    value="{{ $pelanggan->dukuh }}, {{ $pelanggan->rt }}, {{ $pelanggan->rw }} , {{ $pelanggan->kelurahan }},  {{ $pelanggan->kecamatan }}"readonly>
                            </div>
                        </div>
                        <div class="grid gap-4 mb-4 grid-cols-2">
                            <div class="col-span-1">
                                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nomor
                                    Telepon</label>
                                <input type="number" name="no_telepon" id="no_telepon"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5"
                                    placeholder="Masukkan Nama Lengkap" value="{{ $pelanggan->no_identitas }}" readonly>
                            </div>
                            <div class="col-span-2 sm:col-span-1">
                                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Unit</label>
                                <input type="text" name="unit" id="unit"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5"
                                    placeholder="Masukkan Nama Lengkap" value="{{ $pelanggan->nm_unit }}" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="">
                        <p class="font-semibold text-xl text-blue-600 mb-6">Tagihan</p>
                        <div class="grid gap-4 mb-4 grid-cols-2">
                            <div class="col-span-1">
                                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Jenis
                                    Tagihan</label>
                                <input type="text" name="nama" id="nama"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5"
                                    placeholder="Biaya Pendaftaran" readonly>
                            </div>
                        </div>
                        <div class="grid gap-4 mb-4 grid-cols-2">
                            <div class="col-span-1">
                                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Desa</label>
                                <input type="text" name="desa" id="desa"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5"
                                    placeholder="Rp. 23,000" readonly>
                            </div>
                        </div>
                    </div>
            </div>
            <div class="w-full flex">
                <div class="flex justify-center items-center">
                    <a href="/bayar" class="bg-blue-500 py-2 px-4 rounded-md text-white">Bayar!</a>
                </div>
            </div>
            @endif
        </div>
    @endsection
