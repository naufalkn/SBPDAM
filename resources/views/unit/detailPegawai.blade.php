@extends('layouts.app')
@section('container')
    {{-- Navbar --}}
    @include('layouts.navbar-admin')
    {{-- Sidebar --}}
    @include('layouts.sidebar')
    <div class="flex justify-center items-center lg:py-12 h-svh lg:px-8 lg:ml-60">
        @foreach ($pegawai as $item)
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
                                    <h2 class="text-lg uppercase font-bold">{{ $item->user->nama }}</h2>
                                </div>
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
                                <p class="font-bold text-2xl text-blue-800">Data Diri Pegawai</p>
                                <div class="flex w-full">
                                    <div class="flex flex-col pb-3 w-1/2 ">
                                        <p class="mb-1 text-gray-500 md:text-lg dark:text-gray-400">Nama Lengkap</p>
                                        <p class="font-semibold ">{{ $item->user->nama }}</p>
                                    </div>
                                    <div class="flex flex-col pb-3 w-1/2">
                                        <p class="mb-1 text-gray-500 md:text-lg dark:text-gray-400">Jenis Kelamin</p>
                                        <p class="font-semibold">
                                            @if ($item->user->jenis_kelamin == 'L')
                                                Laki-laki
                                            @elseif($item->user->jenis_kelamin == 'P')
                                                Perempuan
                                            @endif
                                        </p>
                                    </div>
                                </div>
                                <div class="flex w-full">
                                    <div class="flex flex-col pb-3 w-1/2 ">
                                        <p class="mb-1 text-gray-500 md:text-lg dark:text-gray-400">No KTP / SIM</p>
                                        <p class="font-semibold "></p>
                                    </div>
                                    <div class="flex flex-col pb-3 w-1/2">
                                        <p class="mb-1 text-gray-500 md:text-lg dark:text-gray-400">No Telp</p>
                                        <p class="font-semibold">{{ $item->no_telp }}</p>
                                    </div>
                                </div>
                                <div class="flex w-full">
                                    <div class="flex flex-col pb-3 w-1/2 ">
                                        <p class="mb-1 text-gray-500 md:text-lg dark:text-gray-400">Email</p>
                                        <p class="font-semibold ">{{ $item->user->email }}</p>
                                    </div>
                                    <div class="flex flex-col pb-3 w-1/2">
                                        <p class="mb-1 text-gray-500 md:text-lg dark:text-gray-400">Tanggal Lahir</p>
                                        <p class="font-semibold">{{ $item->tanggal_lahir ?? 'Belum ada' }}</p>
                                    </div>
                                </div>
                                <div class="flex w-full">
                                    <div class="flex flex-col pb-3 w-1/2 ">
                                        <p class="mb-1 text-gray-500 md:text-lg dark:text-gray-400">Alamat</p>
                                        <p class="font-semibold ">{{ $item->alamat }}</p>
                                    </div>
                                    <div class="flex flex-col pb-3 w-1/2">
                                        <p class="mb-1 text-gray-500 md:text-lg dark:text-gray-400">Nama Unit / Kode Unit
                                        </p>
                                        <p class="font-semibold">{{ $item->nm_unit }} / {{ $item->kd_unit }}</p>
                                    </div>
                                </div>
                                <div class="flex w-full">
                                    <div class="flex flex-col pb-3 w-1/2 ">
                                        <p class="mb-1 text-gray-500 md:text-lg dark:text-gray-400">Status</p>
                                        <p class="font-semibold ">
                                            @if($item->status == 'aktif')
                                            <span
                                                class="text-xs font-semibold inline-block py-1 px-2  rounded-full text-green-600 bg-green-200  last:mr-0 mr-1">
                                                Aktif
                                            </span>
                                            @elseif($item->status == 'nonaktif')
                                            <span
                                                class="text-xs font-semibold inline-block py-1 px-2  rounded-full text-red-600 bg-red-200  last:mr-0 mr-1">
                                                Tidak Aktif
                                            </span>
                                            @endif
                                        </p>
                                    </div>
                                    <div class="flex flex-col pb-3 w-1/2">
                                        <p class="mb-1 text-gray-500 md:text-lg dark:text-gray-400">Tanggal Buat</p>
                                        <p class="font-semibold">{{ $item->created_at->format('d-m-Y') }}</p>
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
