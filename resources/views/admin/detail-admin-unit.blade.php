@extends('layouts.app')
@section('container')
    {{-- Navbar --}}
    @include('layouts.navbar-admin')
    {{-- Sidebar --}}
    @include('layouts.sidebar')
    <div class="flex justify-center adminUnits-center lg:py-12 h-svh lg:px-8 lg:ml-60">
        <div class="w-full flex">
            {{-- Profil User  --}}
            <div class="p-6 w-[500px]">
                <div class="space-y-16">
                    <div
                        class="flex flex-col justify-center h-96 adminUnits-center max-w-xs p-6 shadow-xl rounded-xl sm:px-12 bg-white dark:bg-green-50 dark:text-gray-800">
                        <div class="h-3/4 w-full flex adminUnits-center">
                            <img src="{{ asset('img/' . $adminUnit->user->foto) }}" alt=""
                                class="w-52 h-48 mx-auto rounded-full dark:bg-gray-500 aspect-square">
                        </div>
                        <div class="text-center divide-y dark:divide-gray-300">
                            <div class="my-2 space-y-1">
                                <h2 class="text-lg uppercase font-bold">{{ $adminUnit->user->nama }}</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Informasi --}}
            <div class="p-5  w-full">
                <div class="h-full w-full  p-6 shadow-xl rounded-xl sm:px-12 bg-white dark:bg-green-50 dark:text-gray-800">
                    <div class=" w-full space-y-4 text-gray-900  dark:text-white dark:divide-gray-700">
                        <div class="divide-y divide-gray-200 space-y-3">
                            <p class="font-bold text-2xl text-blue-800">Detail Unit</p>
                            <div class="flex w-full">
                                <div class="flex flex-col pb-3 w-1/2 ">
                                    <p class="mb-1 text-gray-500 md:text-lg dark:text-gray-400">Nama Unit</p>
                                    <p class="font-semibold ">{{ $adminUnit->nm_unit }}</p>
                                </div>
                                <div class="flex flex-col pb-3 w-1/2 ">
                                    <p class="mb-1 text-gray-500 md:text-lg dark:text-gray-400">Kode Unit</p>
                                    <p class="font-semibold ">{{ $adminUnit->kd_unit }}</p>
                                </div>

                            </div>
                            <div class="flex w-full">
                                <div class="flex flex-col pb-3 w-1/2 ">
                                    <p class="mb-1 text-gray-500 md:text-lg dark:text-gray-400">Email</p>
                                    <p class="font-semibold ">{{ $adminUnit->user->email }}</p>
                                </div>
                                <div class="flex flex-col pb-3 w-1/2">
                                    <p class="mb-1 text-gray-500 md:text-lg dark:text-gray-400">No Telp</p>
                                    <p class="font-semibold">{{ $adminUnit->no_telp }}</p>
                                </div>
                            </div>
                            <div class="flex w-full">
                                <div class="flex flex-col pb-3 w-1/2 ">
                                    <p class="mb-1 text-gray-500 md:text-lg dark:text-gray-400">Alamat</p>
                                    <p class="font-semibold ">{{ $adminUnit->alamat }}</p>
                                </div>
                                <div class="flex flex-col pb-3 w-1/2">
                                    <p class="mb-1 text-gray-500 md:text-lg dark:text-gray-400">Tanggal Dibuat</p>
                                    <p class="font-semibold">{{ $adminUnit->created_at->format('d-m-Y') }}</p>
                                </div>
                            </div>
                            <div class="flex w-full">
                                <div class="flex flex-col pb-3 w-1/2 ">
                                    <p class="mb-1 text-gray-500 md:text-lg dark:text-gray-400">Status</p>
                                    <p class="font-semibold ">
                                        @if ($adminUnit->status == 'aktif')
                                            <span
                                                class="text-xs font-semibold inline-block py-1 px-2  rounded-full text-green-600 bg-green-200  last:mr-0 mr-1">
                                                Aktif
                                            </span>
                                        @elseif($adminUnit->status == 'nonaktif')
                                            <span
                                                class="text-xs font-semibold inline-block py-1 px-2  rounded-full text-red-600 bg-red-200  last:mr-0 mr-1">
                                                Tidak Aktif
                                            </span>
                                        @endif
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
