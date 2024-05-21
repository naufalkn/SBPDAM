@extends('layouts.app')
@section('container')
    <div class="font-sans bg-gray-200">
        @include('layouts.navbar')
        <div class="w-full h-svh absolute bg-blue-700">
            <div class="h-56 p-16">
                <div class=" w-full h-44">
                    <div
                        class="w-full h-full max-w-md bg-white bg-opacity-90 border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                        <div class="h-full w-full flex justify-center items-center p-4">
                            <div class="w-1/3 p-2">
                                <img class="w-24 h-24 mb-3 rounded-full shadow-lg"
                                    src="{{ asset('img/' . auth()->user()->foto) }}" alt="" />
                            </div>
                            <div class="w-2/3 p-2">
                                <h5 class="mb-1 text-2xl font-semibold text-gray-900 dark:text-white">
                                    {{ auth()->user()->nama }}</h5>
                                <p class="text-sm text-gray-500 dark:text-gray-400">
                                    @if (auth()->user()->pelanggan)
                                        <p class="text-sm font-medium">Berlangganan</p>
                                    @else
                                        <p class="text-sm">Belum Berlangganan</p>
                                    @endif
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="absolut -mt-12 lg:-mt-24 w-full">
                <svg viewBox="0 0 1428 174" version="1.1" xmlns="http://www.w3.org/2000/svg"
                    xmlns:xlink="http://www.w3.org/1999/xlink">
                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                        <g transform="translate(-2.000000, 44.000000)" fill="#FFFFFF" fill-rule="nonzero">
                            <path
                                d="M0,0 C90.7283404,0.927527913 147.912752,27.187927 291.910178,59.9119003 C387.908462,81.7278826 543.605069,89.334785 759,82.7326078 C469.336065,156.254352 216.336065,153.6679 0,74.9732496"
                                opacity="0.100000001"></path>
                            <path
                                d="M100,104.708498 C277.413333,72.2345949 426.147877,52.5246657 546.203633,45.5787101 C666.259389,38.6327546 810.524845,41.7979068 979,55.0741668 C931.069965,56.122511 810.303266,74.8455141 616.699903,111.243176 C423.096539,147.640838 250.863238,145.462612 100,104.708498 Z"
                                opacity="0.100000001"></path>
                            <path
                                d="M1046,51.6521276 C1130.83045,29.328812 1279.08318,17.607883 1439,40.1656806 L1439,120 C1271.17211,77.9435312 1140.17211,55.1609071 1046,51.6521276 Z"
                                id="Path-4" opacity="0.200000003"></path>
                        </g>
                        <g transform="translate(-4.000000, 76.000000)" fill="#FFFFFF" fill-rule="nonzero">
                            <path
                                d="M0.457,34.035 C57.086,53.198 98.208,65.809 123.822,71.865 C181.454,85.495 234.295,90.29 272.033,93.459 C311.355,96.759 396.635,95.801 461.025,91.663 C486.76,90.01 518.727,86.372 556.926,80.752 C595.747,74.596 622.372,70.008 636.799,66.991 C663.913,61.324 712.501,49.503 727.605,46.128 C780.47,34.317 818.839,22.532 856.324,15.904 C922.689,4.169 955.676,2.522 1011.185,0.432 C1060.705,1.477 1097.39,3.129 1121.236,5.387 C1161.703,9.219 1208.621,17.821 1235.4,22.304 C1285.855,30.748 1354.351,47.432 1440.886,72.354 L1441.191,104.352 L1.121,104.031 L0.457,34.035 Z">
                            </path>
                        </g>
                    </g>
                </svg>
            </div>
            <div class="bg-white h-full w-full p-16">
                <div class="md:flex">
                    <ul id="myTab" data-tabs-toggle="#myTabContent" role="tablist"
                        class="flex-column w-52 space-y space-y-4 font-medium text-gray-500 dark:text-gray-400 md:me-4 mb-4 md:mb-0"
                        data-tabs-toggle="#myTabContent">
                        <li role="presentation">
                            <button id="profile-tab" data-tabs-target="#profile" type="button" role="tab"
                                aria-controls="profile" aria-selected="false"
                                class="inline-flex space-x-4 items-center px-4 py-3 rounded-lg hover:text-gray-900 bg-gray-100 hover:bg-gray-200  w-full dark:bg-gray-800 dark:hover:bg-gray-700 dark:hover:text-white"
                                aria-current="page">
                                <i class="fa-solid fa-user"></i>
                                <p class="font-semibold">
                                    Profile Saya
                                </p>
                            </button>
                        </li>
                        <li role="presentation">
                            <button id="dashboard-tab" data-tabs-target="#dashboard" type="button" role="tab"
                                aria-controls="dashboard" aria-selected="false"
                                class="inline-flex space-x-4 items-center px-4 py-3 rounded-lg hover:text-gray-900 bg-gray-100 hover:bg-gray-200  w-full dark:bg-gray-800 dark:hover:bg-gray-700 dark:hover:text-white"
                                aria-current="page">
                                <i class="fa-solid fa-water"></i>
                                <p class="font-semibold">
                                    Langganan
                                </p>
                            </button>
                        </li>
                    </ul>
                    <div id="myTabContent" class="w-full h-full">
                        {{-- Profil --}}
                        <form action="{{ url('/updateProfil', auth()->user()->id) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="p-6 mb-9 bg-gray-100 text-medium text-gray-500 dark:text-gray-400 dark:bg-gray-800 rounded-lg w-full hidden"
                                id="profile" role="tabpanel" aria-labelledby="profile-tab">
                                <div class="space-y-4">
                                    <div class="">

                                        <img class="w-24 h-24 mb-3 rounded-full shadow-lg"
                                            src="{{ asset('img/' . auth()->user()->foto) }}" alt="" />
                                        <input
                                            class="block text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                                            aria-describedby="user_avatar_help" id="foto" name="foto"
                                            type="file">
                                    </div>
                                    <div class="grid gap-4 mb-4 grid-cols-2">
                                        <div class="col-span-1">
                                            <label
                                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email</label>
                                            <input type="text" name="email" id="email"
                                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5"
                                                placeholder="Masukkan Username" value="{{ auth()->user()->email }}">
                                        </div>
                                        <div class="col-span-1">
                                            <label
                                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Username</label>
                                            <input type="text" name="username" id="username"
                                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5"
                                                placeholder="Masukkan Username" value="{{ auth()->user()->username }}">
                                        </div>
                                        <div class="col-span-1 sm:col-span-1">
                                            <label
                                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama
                                                Lengkap</label>
                                            <input type="text" name="nama" id="nama"
                                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5"
                                                placeholder="Masukkan Nama Lengkap" value="{{ auth()->user()->nama }}">
                                        </div>
                                        <div class="col-span-1">
                                            <label
                                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Tanggal
                                                Lahir</label>
                                            <input type="date" name="tanggal_lahir" id="tanggal_lahir"
                                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5"
                                                placeholder="Masukkan Nama Lengkap"
                                                value="{{ auth()->user()->tanggal_lahir }}">
                                        </div>
                                        <div class="col-span-2 sm:col-span-1">
                                            <label
                                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Jenis
                                                Kelamin</label>
                                            <select
                                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5"
                                                name="jenis_kelamin" id="jenis_kelamin">
                                                <option value="L"
                                                    {{ auth()->user()->jenis_kelamin == 'L' ? 'selected' : '' }}>Laki-Laki
                                                </option>
                                                <option value="P"
                                                    {{ auth()->user()->jenis_kelamin == 'P' ? 'selected' : '' }}>Perempuan
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="grid gap-4 mb-4 grid-cols-2">
                                        <div class="col-span-1">
                                            <label
                                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Sandi
                                                Lama</label>
                                            <input type="password" name="current_password" id="current_password"
                                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5"
                                                placeholder="Masukkan Kata Sandi Lama">
                                        </div>
                                        <div class="col-span-2 sm:col-span-1">
                                            <label
                                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Sandi
                                                Baru</label>
                                            <input type="password" name="new_password" id="new_password"
                                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5"
                                                placeholder="Masukkan Kata Sandi baru">
                                        </div>
                                        <div class="col-span-1">
                                            <label
                                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Konfirmasi
                                                Sandi Baru</label>
                                            <input type="password" name="new_password_confirmation"
                                                id="new_password_confirmation"
                                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5"
                                                placeholder="Masukkan Konfirmasi Kata Sandi baru">
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
                        </form>

                        {{-- Langganan --}}
                        <div class="p-6 h-full bg-gray-50 text-medium text-gray-500 dark:text-gray-400 dark:bg-gray-800 rounded-lg w-full hidden"
                            id="dashboard" role="tabpanel" aria-labelledby="dashboard-tab">
                            @if (auth()->user()->pelanggan)
                            <form action="{{ url('/updateLangganan', ['id' => auth()->user()->pelanggan->id]) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="">
                                    <p class="font-semibold text-xl text-blue-600 mb-6">Data Diri</p>
                                    <div class="grid gap-4 mb-4 grid-cols-2">
                                        <div class="col-span-1">
                                            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama Lengkap</label>
                                            <input type="text" name="nama" id="nama" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5" placeholder="Masukkan Nama Lengkap" value="{{ $pelanggan->nama }}">
                                        </div>
                                        <div class="col-span-2 sm:col-span-1">
                                            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Pekerjaan</label>
                                            <input type="text" name="pekerjaan" id="pekerjaan" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5" placeholder="Masukkan Pekerjaan" value="{{ $pelanggan->pekerjaan }}">
                                        </div>
                                    </div>
                                    <div class="grid gap-4 mb-4 grid-cols-2">
                                        <div class="col-span-1">
                                            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nomor Telepon</label>
                                            <input type="number" name="no_telepon" id="no_telepon" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5" placeholder="Masukkan Nama Lengkap" value="{{ $pelanggan->no_telepon }}">
                                        </div>
                                        <div class="col-span-2 sm:col-span-1">
                                            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">No KTP / SIM</label>
                                            <input type="number" name="no_identitas" id="no_identitas" class="bg-gray-200 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5" placeholder="Masukkan Pekerjaan" value="{{ $pelanggan->no_identitas }}" readonly>
                                        </div>
                                    </div>
                                </div>
                                <div class="">
                                    <p class="font-semibold text-xl text-blue-600 mb-6">Alamat</p>
                                    <div class="grid gap-4 mb-4 grid-cols-2">
                                        <div class="col-span-1">
                                            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Dukuh</label>
                                            <input type="text" name="nama" id="nama" class="bg-gray-200 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5" placeholder="Masukkan Nama Lengkap" value="{{ $pelanggan->dukuh }}" readonly>
                                        </div>
                                        <div class="flex space-x-4 col-span-2 sm:col-span-1">
                                            <div class="">
                                                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">RT </label>
                                                <input type="text" name="rt" id="rt" class="bg-gray-200 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5" placeholder="Masukkan Pekerjaan" value="{{ $pelanggan->rt }}" readonly>
                                            </div>
                                            <div class="">
                                                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">RW</label>
                                                <input type="text" name="rw" id="rw" class="bg-gray-200 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5" placeholder="Masukkan Pekerjaan" value="{{ $pelanggan->rw }}" readonly>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="grid gap-4 mb-4 grid-cols-2">
                                        <div class="col-span-1">
                                            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Desa</label>
                                            <input type="text" name="desa" id="desa" class="bg-gray-200 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5" placeholder="Masukkan Nama Lengkap" value="{{ $pelanggan->kelurahan }}" readonly>
                                        </div>
                                        <div class="col-span-2 sm:col-span-1">
                                            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Kecamatan</label>
                                            <input type="text" name="kecamatan" id="kecamatan" class="bg-gray-200 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5" placeholder="Masukkan Pekerjaan" value="{{ $pelanggan->kecamatan }}" readonly>
                                        </div>
                                    </div>
                                    <div class="grid gap-4 mb-4 grid-cols-2">
                                        <div class="col-span-1">
                                            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama Jalan</label>
                                            <input type="text" name="nama_jalan" id="nama_jalan" class="bg-gray-200 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5" placeholder="Masukkan Nama Lengkap" value="{{ $pelanggan->nama_jalan }}" readonly>
                                        </div>
                                        <div class="flex space-x-4 col-span-2 sm:col-span-1">
                                            <div class="">
                                                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Jumlah Penghuni </label>
                                                <input type="number" name="jmlh_penghuni" id="jmlh_penghuni" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5" placeholder="Masukkan Pekerjaan" value="{{ $pelanggan->jmlh_penghuni }}">
                                            </div>
                                            <div class="">
                                                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Kode Pos</label>
                                                <input type="number" name="kode_pos" id="kode_pos" class="bg-gray-200 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5" placeholder="Masukkan Pekerjaan" value="{{ $pelanggan->kode_pos }}" readonly>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="grid gap-4 mb-4 grid-cols-2">
                                        <div class="col-span-1">
                                            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Unit</label>
                                            <input type="text" name="unit" id="unit" class="bg-gray-200 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5" placeholder="Masukkan Nama Lengkap" value="{{ $pelanggan->nm_unit }}" readonly>
                                        </div>
                                        <div class="col-span-2 sm:col-span-1">
                                            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Keterangan</label>
                                            <input type="text" name="keterangan" id="keterangan" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5" placeholder="Masukkan Pekerjaan" value="{{ $pelanggan->keterangan }}">
                                        </div>
                                    </div>
                                    <div class="grid gap-4 mb-4 grid-cols-2">
                                        <div class="col-span-1 space-y-2">
                                            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Foto Rumah</label>
                                            <img src="{{ asset('/foto/' . $pelanggan->foto_rumah) }}" class="w-40 h-20" alt="">
                                            <input
                                            class="block text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                                            aria-describedby="user_avatar_help" id="foto_rumah" name="foto_rumah"
                                            type="file">
                                        </div>
                                    </div>
                                </div>
                                <div class="w-full justify-end flex">
                                    <button type="submit" class="text-white inline-flex items-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                        Simpan
                                    </button>
                                </div>
                            </form>                            
                            @else
                                <div class="col-span-2 h-full bg-gray-100">
                                    <div
                                        class="h-full w-full p-6 shadow-xl rounded-xl sm:px-12 dark:bg-green-50 dark:text-gray-800">
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
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
