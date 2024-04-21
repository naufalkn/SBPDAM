@extends('layouts.app')
@section('container')
    <div class="font-sans h-svh bg-gray-200">
        @include('layouts.navbar')
        <div class="flex ">
            <!-- NAV -->
            <div class="w-full flex">
                {{-- @foreach($user as $item) --}}
                {{-- Profil User  --}}
                <div class="p-5 h-full w-1/3">
                    <div class="space-y-16">
                        <div
                            class="flex flex-col h-96 justify-center max-w-xs p-6 shadow-xl rounded-xl sm:px-12 bg-white dark:bg-green-50 dark:text-gray-800">
                            <img src="" alt=""
                                class="w-32 h-32 mx-auto rounded-full dark:bg-gray-500 aspect-square">
                            <div class="space-y-4 text-center divide-y dark:divide-gray-300">
                                <div class="my-2 space-y-1">
                                    <h2 class="text-xl font-semibold sm:text-2xl">aa</h2>
                                    <p class="px-5 text-xs sm:text-base dark:text-gray-600">Ketua DPR RI</p>
                                </div>
                            </div>
                        </div>
                        <div
                            class="flex flex-col h-28 justify-center max-w-xs p-6 shadow-xl rounded-xl sm:px-12 bg-white dark:bg-green-50 dark:text-gray-800">
                            <div class="flex justify-center pt-2 space-x-4 align-center">
                                Disini
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Informasi --}}
                <div class="p-5 h-full w-full">
                    <div
                        class="h-full w-full  p-6 shadow-xl rounded-xl sm:px-12 bg-white dark:bg-green-50 dark:text-gray-800">
                        <div class=" w-full space-y-4 text-gray-900  dark:text-white dark:divide-gray-700">
                            <div class="divide-y divide-gray-200 space-y-3">
                                <p class="font-bold text-2xl text-blue-800">Data Diri Pelanggan</p>
                                <div class="flex w-full">
                                    <div class="flex flex-col pb-3 w-1/2 ">
                                        <p class="mb-1 text-gray-500 md:text-lg dark:text-gray-400">Nama Lengkap</p>
                                        <p class="text-lg font-semibold "></p>
                                    </div>
                                    <div class="flex flex-col pb-3 w-1/2">
                                        <p class="mb-1 text-gray-500 md:text-lg dark:text-gray-400">Pekerjaan</p>
                                        <p class="text-lg font-semibold"></p>
                                    </div>
                                </div>
                                <div class="flex w-full">
                                    <div class="flex flex-col pb-3 w-1/2 ">
                                        <p class="mb-1 text-gray-500 md:text-lg dark:text-gray-400">No KTP / SIM</p>
                                        <p class="text-lg font-semibold "></p>
                                    </div>
                                    <div class="flex flex-col pb-3 w-1/2">
                                        <p class="mb-1 text-gray-500 md:text-lg dark:text-gray-400">No Telp</p>
                                        <p class="text-lg font-semibold"></p>
                                    </div>
                                </div>
                            </div>
                            <div class="divide-y divide-gray-200 space-y-3">
                                <p class="font-bold text-2xl text-blue-800">Alamat Pelanggan</p>
                                <div class="flex w-full">
                                    <div class="flex flex-col pb-3 w-1/2 ">
                                        <p class="mb-1 text-gray-500 md:text-lg dark:text-gray-400">Dukuh</p>
                                        <p class="text-lg font-semibold "></p>
                                    </div>
                                    <div class="flex flex-col pb-3 w-1/2">
                                        <p class="mb-1 text-gray-500 md:text-lg dark:text-gray-400">RT / RW</p>
                                        <p class="text-lg font-semibold"></p>
                                    </div>
                                </div>
                                <div class="flex w-full">
                                    <div class="flex flex-col pb-3 w-1/2 ">
                                        <p class="mb-1 text-gray-500 md:text-lg dark:text-gray-400">Desa / Kelurahan</p>
                                        <p class="text-lg font-semibold "></p>
                                    </div>
                                    <div class="flex flex-col pb-3 w-1/2">
                                        <p class="mb-1 text-gray-500 md:text-lg dark:text-gray-400">Kecamatan</p>
                                        <p class="text-lg font-semibold"></p>
                                    </div>
                                </div>
                                <div class="flex w-full">
                                    <div class="flex flex-col pb-3 w-1/2 ">
                                        <p class="mb-1 text-gray-500 md:text-lg dark:text-gray-400">Nama Perumahan / Jalan</p>
                                        <p class="text-lg font-semibold "></p>
                                    </div>
                                    <div class="flex flex-col pb-3 w-1/2">
                                        <p class="mb-1 text-gray-500 md:text-lg dark:text-gray-400">Kode Pos</p>
                                        <p class="text-lg font-semibold"></p>
                                    </div>
                                </div>
                                <div class="flex w-full">
                                    <div class="flex flex-col pb-3 w-1/2 ">
                                        <p class="mb-1 text-gray-500 md:text-lg dark:text-gray-400">Jumlah Penghuni</p>
                                        <p class="text-lg font-semibold "></p>
                                    </div>
                                    <div class="flex flex-col pb-3 w-1/2">
                                        <p class="mb-1 text-gray-500 md:text-lg dark:text-gray-400">Unit</p>
                                        <p class="text-lg font-semibold"></p>
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
                {{-- @endforeach --}}
            </div>
        </div>
    </div>
@endsection
