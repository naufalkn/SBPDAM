@extends('layouts.app')
@section('container')
    <div class="font-sans h-full bg-gray-200">
        @include('layouts.navbar')
        <div class="flex ">
            <!-- NAV -->
            <div class="w-full flex">
                {{-- Profil User  --}}
                <div class="p-6 w-[500px]">
                    <div class="space-y-4">
                        {{-- Photo Profil --}}
                        <div
                            class="flex space-y-10 flex-col justify-center h-96 items-center max-w-xs p-3 shadow-xl rounded-xl sm:px-12 bg-white dark:bg-green-50 dark:text-gray-800">
                            <div class=" items-center h-5/6">
                                <div class="w-full h-full">
                                    <img src="{{ asset('img/' . auth()->user()->foto) }}" alt="" class="h-full w-full mx-auto rounded-2xl dark:bg-gray-500 aspect-square">
                                </div>
                            </div>
                            <div class="flex items-center justify-center h-1/6  divide-y dark:divide-gray-300">
                                <h2 class="text-lg font-semibold">{{ auth()->user()->username }}</h2>
                                {{-- <div class="my-2 space-y-1">
                                </div> --}}
                            </div>

                        </div>
                        {{-- Informasi --}}
                        <div
                            class="w-full space-y-3  max-w-xs p-5 shadow-xl rounded-xl bg-white dark:bg-green-50 dark:text-gray-800">
                            <div class="flex items-center space-x-3 w-full">
                                <div class="flex justify-center items-center bg-yellow-400 w-9 h-9 rounded-lg">
                                    <i class="fa-solid fa-envelope text-white"></i>
                                </div>
                                <p> {{ auth()->user()->email }}</p>
                            </div>
                            <div class="flex  items-center space-x-3 w-full">
                                <div class="flex justify-center items-center bg-green-600 w-9 h-9 rounded-lg">
                                    <i class="fa-solid fa-phone text-white"></i>
                                </div>
                                <p> {{ $pelanggan->no_telepon ?? '-' }}</p>
                            </div>
                            <div class="flex  items-center space-x-3 w-full">
                                <p class="text-lg ">Status : </p>
                                @if (auth()->user()->pelanggan)
                                    <p class="text-lg font-semibold">Berlangganan</p>
                                @else
                                    <p>Belum Berlangganan</p>
                                @endif
                            </div>
                        </div>
                        {{-- Previous dan Edit --}}
                        <div class="flex w-full justify-start items-end">
                            <div class="flex h-12 w-60 space-x-5">
                                <a type="button" href="{{ url('/beranda') }}"
                                    class="flex space-x-3 justify-center items-center rounded-xl w-full bg-green-500 text-white">
                                    <i class="fa-solid fa-arrow-left"></i>
                                    <p>Kembali</p>
                                </a>
                                <button data-modal-target="crud-modal" data-modal-toggle="crud-modal"
                                    class="flex space-x-3 justify-center items-center rounded-xl w-full bg-yellow-400 text-white"
                                    type="button">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                    <p>Edit Profil</p>
                                </button>
                            </div>
                        </div>
                        {{-- Modal dan View Edit --}}
                        <div id="crud-modal" tabindex="1" aria-hidden="true"
                            class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-full ">
                            <div class="relative bg-opacity-10 p-11 w-full h-full">
                                <!-- Modal content -->
                                <div class="h-full w-full bg-white rounded-lg shadow dark:bg-gray-700">
                                    <!-- Modal header -->
                                    <div
                                        class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                                            Edit Profile
                                        </h3>
                                        <button type="button"
                                            class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                                            data-modal-toggle="crud-modal">
                                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                                fill="none" viewBox="0 0 14 14">
                                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                                    stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                            </svg>
                                            <span class="sr-only">Tutup</span>
                                        </button>
                                    </div>
                                    <!-- Modal body -->
                                    <form class="p-4 md:p-5" action="{{ url('/updateProfil' , auth()->user()->id) }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT')
                                        <div class="grid gap-4 mb-4 grid-cols-2">
                                            <div class="col-span-1">
                                                <label for="email"
                                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email</label>
                                                <input type="text" name="email" id="email"
                                                    class="bg-gray-300 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5"
                                                    placeholder="Type product name" value="{{ auth()->user()->email }}"
                                                    disabled>
                                            </div>
                                            <div class="col-span-2 sm:col-span-1">
                                                <label for="price"
                                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Photo
                                                    Profil</label>
                                                <input
                                                    class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                                                    aria-describedby="user_avatar_help" id="foto" name="foto" type="file">
                                                    
                                            </div>
                                            <div class="col-span-2 sm:col-span-1">
                                                <label for="category"
                                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Username</label>
                                                    <input type="text" name="username" id="username"
                                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5"
                                                    placeholder="Masukkan Username" value="{{ auth()->user()->username }}">
                                            </div>
                                            <div class="col-span-2 sm:col-span-1">
                                                <label for="category"
                                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Password</label>
                                                    <input type="text" name="password" id="password"
                                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5"
                                                    placeholder="Masukkan Sandi Baru"">
                                            </div>
                                        </div>
                                        <button type="submit"
                                            class="text-white inline-flex items-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                            <svg class="me-1 -ms-1 w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd"
                                                    d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z"
                                                    clip-rule="evenodd"></path>
                                            </svg>
                                            Add new product
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Informasi --}}
                <div class="p-5 h-full w-full">
                    @if (auth()->user()->pelanggan)
                        <div
                            class="h-full w-full  p-6 shadow-xl rounded-xl sm:px-12 bg-white dark:bg-green-50 dark:text-gray-800">
                            <div class="flex w-full justify-end items-end">
                                <div class="flex bg-white h-12 w-32 space-x-6">
                                    <button data-modal-target="crud-modal" data-modal-toggle="crud-modal"
                                        class="flex space-x-3 justify-center items-center rounded-xl w-full bg-yellow-400 text-white"
                                        type="button">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                        <p>Edit</p>
                                    </button>
                                </div>
                            </div>
                            <div id="crud-modal" tabindex="-1" aria-hidden="true"
                                class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-full ">
                                <div class="relative bg-opacity-10 p-11 w-full h-full">
                                    <!-- Modal content -->
                                    <div class="h-full w-full bg-white rounded-lg shadow dark:bg-gray-700">
                                        <!-- Modal header -->
                                        <div
                                            class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                                            <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                                                Edit Profile
                                            </h3>
                                            <button type="button"
                                                class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                                                data-modal-toggle="crud-modal">
                                                <svg class="w-3 h-3" aria-hidden="true"
                                                    xmlns="http://www.w3.org/2000/svg" fill="none"
                                                    viewBox="0 0 14 14">
                                                    <path stroke="currentColor" stroke-linecap="round"
                                                        stroke-linejoin="round" stroke-width="2"
                                                        d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                                </svg>
                                                <span class="sr-only">Tutup</span>
                                            </button>
                                        </div>
                                        <!-- Modal body -->
                                        <form class="p-4 md:p-5">
                                            <div class="grid gap-4 mb-4 grid-cols-2">
                                                <div class="col-span-2">
                                                    <label for="name"
                                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Name</label>
                                                    <input type="text" name="name" id="name"
                                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                                        placeholder="Type product name" required="">
                                                </div>
                                                <div class="col-span-2 sm:col-span-1">
                                                    <label for="price"
                                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Price</label>
                                                    <input type="number" name="price" id="price"
                                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                                        placeholder="$2999" required="">
                                                </div>
                                                <div class="col-span-2 sm:col-span-1">
                                                    <label for="category"
                                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Category</label>
                                                    <select id="category"
                                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                                        <option selected="">Select category</option>
                                                        <option value="TV">TV/Monitors</option>
                                                        <option value="PC">PC</option>
                                                        <option value="GA">Gaming/Console</option>
                                                        <option value="PH">Phones</option>
                                                    </select>
                                                </div>
                                                <div class="col-span-2">
                                                    <label for="description"
                                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Product
                                                        Description</label>
                                                    <textarea id="description" rows="4"
                                                        class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                                        placeholder="Write product description here"></textarea>
                                                </div>
                                            </div>
                                            <button type="submit"
                                                class="text-white inline-flex items-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                                <svg class="me-1 -ms-1 w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path fill-rule="evenodd"
                                                        d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z"
                                                        clip-rule="evenodd"></path>
                                                </svg>
                                                Add new product
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class=" w-full space-y-4 text-gray-900  dark:text-white dark:divide-gray-700">
                                <div class="divide-y divide-gray-200 space-y-3">
                                    <p class="font-bold text-2xl text-blue-800">Data Diri Pelanggan</p>
                                    <div class="flex w-full">
                                        <div class="flex flex-col pb-3 w-1/2 ">
                                            <p class="mb-1 text-gray-500 md:text-lg dark:text-gray-400">Nama Lengkap</p>
                                            <p class="text-lg font-semibold ">{{ $pelanggan->nama }}</p>
                                        </div>
                                        <div class="flex flex-col pb-3 w-1/2">
                                            <p class="mb-1 text-gray-500 md:text-lg dark:text-gray-400">Pekerjaan</p>
                                            <p class="text-lg font-semibold">{{ $pelanggan->pekerjaan }}</p>
                                        </div>
                                    </div>
                                    <div class="flex w-full">
                                        <div class="flex flex-col pb-3 w-1/2 ">
                                            <p class="mb-1 text-gray-500 md:text-lg dark:text-gray-400">No KTP / SIM</p>
                                            <p class="text-lg font-semibold ">{{ $pelanggan->no_identitas }}</p>
                                        </div>
                                        <div class="flex flex-col pb-3 w-1/2">
                                            <p class="mb-1 text-gray-500 md:text-lg dark:text-gray-400">No Telp</p>
                                            <p class="text-lg font-semibold">{{ $pelanggan->no_telepon }}</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="divide-y divide-gray-200 space-y-3">
                                    <p class="font-bold text-2xl text-blue-800">Alamat Pelanggan</p>
                                    <div class="flex w-full">
                                        <div class="flex flex-col pb-3 w-1/2 ">
                                            <p class="mb-1 text-gray-500 md:text-lg dark:text-gray-400">Dukuh</p>
                                            <p class="text-lg font-semibold ">{{ $pelanggan->dukuh }}</p>
                                        </div>
                                        <div class="flex flex-col pb-3 w-1/2">
                                            <p class="mb-1 text-gray-500 md:text-lg dark:text-gray-400">RT / RW</p>
                                            <p class="text-lg font-semibold">{{ $pelanggan->rt }} /
                                                {{ $pelanggan->rw }}</p>
                                        </div>
                                    </div>
                                    <div class="flex w-full">
                                        <div class="flex flex-col pb-3 w-1/2 ">
                                            <p class="mb-1 text-gray-500 md:text-lg dark:text-gray-400">Desa / Kelurahan
                                            </p>
                                            <p class="text-lg font-semibold ">{{ $pelanggan->kelurahan }}</p>
                                        </div>
                                        <div class="flex flex-col pb-3 w-1/2">
                                            <p class="mb-1 text-gray-500 md:text-lg dark:text-gray-400">Kecamatan</p>
                                            <p class="text-lg font-semibold">{{ $pelanggan->kecamatan }}</p>
                                        </div>
                                    </div>
                                    <div class="flex w-full">
                                        <div class="flex flex-col pb-3 w-1/2 ">
                                            <p class="mb-1 text-gray-500 md:text-lg dark:text-gray-400">Nama Perumahan /
                                                Jalan
                                            </p>
                                            <p class="text-lg font-semibold ">{{ $pelanggan->nama_jalan }}</p>
                                        </div>
                                        <div class="flex flex-col pb-3 w-1/2">
                                            <p class="mb-1 text-gray-500 md:text-lg dark:text-gray-400">Kode Pos</p>
                                            <p class="text-lg font-semibold">{{ $pelanggan->kode_pos }}</p>
                                        </div>
                                    </div>
                                    <div class="flex w-full">
                                        <div class="flex flex-col pb-3 w-1/2 ">
                                            <p class="mb-1 text-gray-500 md:text-lg dark:text-gray-400">Jumlah Penghuni</p>
                                            <p class="text-lg font-semibold ">{{ $pelanggan->jmlh_penghuni }}</p>
                                        </div>
                                        <div class="flex flex-col pb-3 w-1/2">
                                            <p class="mb-1 text-gray-500 md:text-lg dark:text-gray-400">Unit</p>
                                            <p class="text-lg font-semibold">{{ $pelanggan->unit }}</p>
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
                    @else
                        <div
                            class="h-full w-full  p-6 shadow-xl rounded-xl sm:px-12 bg-white dark:bg-green-50 dark:text-gray-800">

                            <div class="flex w-full h-full justify-center items-center ">
                                <div class="space-y-4">
                                    <img src="{{ url('img/ops.svg') }}" class="w-56" alt="">
                                    <p class="font-bold text-xl w-full text-blue-900">Kamu belum berlangganan nih : (</p>
                                    <div class="">
                                        <a href="{{ url('/daftar-sambungan') }}"
                                            class="flex h-10 space-x-3 justify-center items-center rounded-xl w-full bg-blue-900 text-white">Mulai
                                            Berlangganan</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
