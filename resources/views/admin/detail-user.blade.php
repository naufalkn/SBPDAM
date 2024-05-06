@extends('layouts.app')
@section('container')
{{-- Navbar --}}
@include('layouts.navbar-admin')
{{-- Sidebar --}}
@include('layouts.sidebar')
<div class="lg:py-12 h-svh  lg:px-8 lg:ml-60">
    @foreach($pelanggan as $item)
    <div class="w-full flex">
        {{-- Profil User  --}}
        <div class="p-6 w-[500px]">
            <div class="space-y-16">
                <div
                    class="flex flex-col justify-center h-96 items-center max-w-xs p-6 shadow-xl rounded-xl sm:px-12 bg-white dark:bg-green-50 dark:text-gray-800">
                    <div class="h-2/3">
                        <img src="{{ asset('img/'. $item->user->foto) }}" alt=""
                            class="w-40 h-36 mx-auto rounded-full dark:bg-gray-500 aspect-square">
                    </div>
                    <div class="text-center divide-y dark:divide-gray-300">
                        <div class="my-2 space-y-1">
                            <h2 class="text-lg">{{ $item->nama }}</h2>
                        </div>
                    </div>
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
                                <p class="mb-1 text-gray-500 md:text-lg dark:text-gray-400">Nama Perumahan / Jalan</p>
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
                                <p class="text-lg font-semibold">{{ $item->nm_unit ?? '-'}}</p>
                            </div>
                        </div>
                        <div class="flex w-full">
                            <div class="flex flex-col pb-3 w-1/2 ">
                                <p class="mb-1 text-gray-500 md:text-lg dark:text-gray-400">Foto Rumah</p>
                                <img src="{{ asset('/foto/' . $item->foto_rumah) }}" class="w-40 h-20" alt="">
                            </div>
                            <div class="flex flex-col pb-3 w-1/2">
                                <p class="mb-1 text-gray-500 md:text-lg dark:text-gray-400">Keterangan Sambungan</p>
                                <p class="text-lg font-semibold">{{ $item->keterangan ?? '-'}}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endforeach 
</div>
@endsection
