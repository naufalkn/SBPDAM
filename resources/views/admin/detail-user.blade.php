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
                        <img src="" alt=""
                            class="w-32 h-32 mx-auto rounded-full dark:bg-gray-500 aspect-square">
                    </div>
                    <div class="text-center divide-y dark:divide-gray-300">
                        <div class="my-2 space-y-1">
                            <h2 class="text-lg">{{ $item->nama }}</h2>
                        </div>
                    </div>
                </div>
                <div
                    class="h-28 w-full space-y-3  max-w-xs p-5 shadow-xl rounded-xl bg-white dark:bg-green-50 dark:text-gray-800">
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
                                <p class="text-lg font-semibold">{{ $item->unit ?? '-'}}</p>
                            </div>
                        </div>
                    </div>
                    {{-- <div class="flex flex-col py-3">
                        <dt class="mb-1 text-gray-500 md:text-lg dark:text-gray-400">Home address</dt>
                        <dd class="text-lg font-semibold">92 Miles Drive, Newark, NJ 07103, California, USA</dd>
                    </div>
                    <div class="flex flex-col pt-3">
                        <dt class="mb-1 text-gray-500 md:text-lg dark:text-gray-400">Phone number</dt>
                        <dd class="text-lg font-semibold">+00 123 456 789 / +12 345 678</dd>
                    </div> --}}
                </div>
            </div>
        </div>
    </div>
    @endforeach 
</div>
@endsection
