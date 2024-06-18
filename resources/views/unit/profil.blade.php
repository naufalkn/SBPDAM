@extends('layouts.app')
@section('container')
    {{-- Navbar --}}
    @include('layouts.navbar-admin')
    {{-- Sidebar --}}
    @include('layouts.sidebar')
    <form action="{{ url('/updateProfilUnit', auth()->user()->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="flex justify-center items-center lg:py-12 h-svh lg:px-8 lg:ml-60">
            <div class="w-full flex mt-16">
                {{-- Profil User  --}}
                <div class="p-6 w-[500px]">
                    <div class="space-y-16">
                        <div
                            class="flex flex-col justify-center gap-y-2 h-96 units-center max-w-xs p-6 shadow-xl rounded-xl sm:px-12 bg-white dark:bg-green-50 dark:text-gray-800">
                            <div class="h-3/4 w-full flex units-center">
                                <img src="{{ asset('img/' . $unit->user->foto) }}" alt=""
                                    class="w-52 h-48 mx-auto rounded-full dark:bg-gray-500 aspect-square">
                            </div>
                            <div class="text-center divide-y dark:divide-gray-300">
                                <div class="my-2 space-y-1">
                                    <h2 class="text-lg uppercase font-bold">{{ $unit->user->nama }}</h2>
                                </div>
                            </div>
                            <input
                                class="block text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                                aria-describedby="user_avatar_help" id="foto" name="foto" type="file">
                        </div>
                    </div>
                </div>

                {{-- Informasi --}}
                <div class="p-5  w-full">
                    <div
                        class="h-full w-full  p-6 shadow-xl rounded-xl sm:px-12 bg-white dark:bg-green-50 dark:text-gray-800">
                        <div class=" w-full space-y-4 text-gray-900  dark:text-white dark:divide-gray-700">
                            <div class="divide-y divide-gray-200 space-y-3">
                                <p class="font-bold text-2xl text-blue-800">Data Diri unit</p>
                                <div class="flex w-full">
                                    <div class="flex flex-col pb-3 w-1/2 ">
                                        <p class="mb-1 text-gray-500 md:text-lg dark:text-gray-400">Nama Unit</p>
                                        <p class="font-semibold ">{{ $unit->nm_unit }}</p>
                                    </div>
                                    <div class="flex flex-col pb-3 w-1/2 ">
                                        <p class="mb-1 text-gray-500 md:text-lg dark:text-gray-400">Kode Unit</p>
                                        <p class="font-semibold ">{{ $unit->kd_unit }}</p>
                                    </div>
                                </div>
                                <div class="flex w-full">
                                    <div class="flex flex-col pb-3 w-1/2 ">
                                        <p class="mb-1 text-gray-500 md:text-lg dark:text-gray-400">Email</p>
                                        <input type="email" name="email" id="email"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-3/4 p-2.5"
                                            placeholder="Masukkan Alamat Email Anda" value="{{ auth()->user()->email }}">
                                    </div>
                                    <div class="flex flex-col pb-3 w-1/2">
                                        <p class="mb-1 text-gray-500 md:text-lg dark:text-gray-400">Username</p>
                                        <input type="text" name="username" id="username"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-3/4 p-2.5"
                                            placeholder="Masukkan No Telp" value="{{ $unit->user->username }}">
                                    </div>
                                </div>
                                <div class="flex w-full">
                                    <div class="flex flex-col pb-3 w-1/2 ">
                                        <p class="mb-1 text-gray-500 md:text-lg dark:text-gray-400">Alamat</p>
                                        <input type="text" name="alamat" id="alamat"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-3/4 p-2.5"
                                            placeholder="Masukkan Alamat Anda" value="{{ $unit->alamat }}">
                                    </div>
                                    <div class="flex flex-col pb-3 w-1/2">
                                        <p class="mb-1 text-gray-500 md:text-lg dark:text-gray-400">No Telp</p>
                                        <input type="number" name="no_telp" id="no_telp"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-3/4 p-2.5"
                                            placeholder="Masukkan No Telp" value="{{ $unit->no_telp ?? '-' }}">
                                    </div>
                                </div>
                                <div class="flex w-full">
                                    <div class="flex flex-col pb-3 w-1/2 ">
                                        <p class="mb-1 text-gray-500 md:text-lg dark:text-gray-400">Status</p>
                                        <p class="font-semibold ">
                                            @if ($unit->status == 'aktif')
                                                <span
                                                    class="text-xs font-semibold inline-block py-1 px-2  rounded-full text-green-600 bg-green-200  last:mr-0 mr-1">
                                                    Aktif
                                                </span>
                                            @elseif($unit->status == 'nonaktif')
                                                <span
                                                    class="text-xs font-semibold inline-block py-1 px-2  rounded-full text-red-600 bg-red-200  last:mr-0 mr-1">
                                                    Tidak Aktif
                                                </span>
                                            @endif
                                        </p>
                                    </div>
                                </div>
                                <div class="flex w-full">
                                    <div class="flex flex-col pb-3 w-1/2 ">
                                        <p class="mb-1 text-gray-500 md:text-lg dark:text-gray-400">Password Lama</p>
                                        <input type="password" name="current_password" id="current_password"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-3/4 p-2.5"
                                            placeholder="Masukkan Kata Sandi Lama">
                                    </div>
                                </div>
                                <div class="flex w-full">
                                    <div class="flex flex-col pb-3 w-1/2 ">
                                        <p class="mb-1 text-gray-500 md:text-lg dark:text-gray-400">Password Baru</p>
                                        <input type="password" name="new_password" id="new_password"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-3/4 p-2.5"
                                            placeholder="Masukkan Kata Sandi baru">
                                    </div>
                                    <div class="flex flex-col pb-3 w-1/2">
                                        <p class="mb-1 text-gray-500 md:text-lg dark:text-gray-400">Konfirmasi Password
                                        </p>
                                        <input type="password" name="new_password_confirmation"
                                            id="new_password_confirmation"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-3/4 p-2.5"
                                            placeholder="Masukkan Konfirmasi Kata Sandi baru">
                                    </div>
                                </div>
                            </div>
                            <div class="w-full justify-end flex">
                                <button type="submit"
                                    class="text-white inline-flex items-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                    Simpan
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </form>
@endsection
