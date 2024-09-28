@extends('layouts.app')
@section('container')
    @include('layouts.navbar-admin')
    <!-- SIDE -->
    @include('layouts.sidebar')
    <div class="px-5 py-8 lg:py-8 lg:px-8 lg:ml-60 mt-16 text-neutral-300 relative">
        <p class="text-2xl lg:text-4xl mb-2 font-semibold z-40">Halo, Selamat Datang </p>
        <p class="">Website Sambungan Baru PDAM Kabupaten Sragen Unit {{ $nama }}</p>

        <div class="overflow-hidden bg-gradient-to-r from-blue-900 to-blue-600 -z-10 h-56 absolute top-0 left-0 w-full">
        </div>
        <div class="flex w-full mt-12">
            <div class="w-1/3">
                <div
                    class="flex  flex-col h-28 l w-80 items-center justify-center bg-white rounded-lg shadow md:flex-row   dark:border-gray-700 dark:bg-gray-800 ">
                    <div class="flex w-full justify-between items-center p-5">
                        <div class="bg-gray-500 w-16 h-16 rounded-lg flex justify-center items-center">
                            <i class="fa-solid fa-user-gear text-white text-2xl"></i>
                        </div>
                        <div class="flex flex-col justify-between leading-normal">
                            <h5 class="mb-2 text-base font-bold tracking-tight text-gray-600 dark:text-white">Jumlah Pegawai
                            </h5>
                            <p class="mb-3 text-2xl text-gray-600 dark:text-gray-400 font-bold">{{ $jmlh_pegawai }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="flex justify-end -mt-4 mr-5 mb-5">
        <!-- Modal toggle -->
        <button data-modal-target="crud-modal" data-modal-toggle="crud-modal"
            class="block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
            type="button">
            Tambah Pegawai
        </button>

        <!-- Main modal -->
        <div id="crud-modal" tabindex="-1" aria-hidden="true"
            class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
            <div class="relative p-4 w-full max-w-3xl max-h-md">
                <!-- Modal content -->
                <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                    <!-- Modal header -->
                    <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                            Tambah Pegawai
                        </h3>
                        <button type="button"
                            class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                            data-modal-toggle="crud-modal">
                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 14 14">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                            </svg>
                            <span class="sr-only">Tutup</span>
                        </button>
                    </div>
                    <!-- Modal body -->
                    <form class="p-4 md:p-5" action="{{ url('/tambah-pegawai') }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="grid gap-4 mb-4 grid-cols-2">
                            <div class="col-span-2 sm:col-span-1">
                                <label for="username"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Username</label>
                                <input type="text" name="username" id="username" required
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                    placeholder="Masukkan Username Pegawai">
                            </div>

                            <div class="col-span-2 sm:col-span-1">
                                <label for="email"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email</label>
                                <input type="email" name="email" id="email" required
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                    placeholder="Masukkan Email Pegawai">
                            </div>
                            <div class="col-span-2 sm:col-span-1">
                                <label for="nama"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama
                                    Pegawai</label>
                                <input type="text" name="nama" id="nama" required
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                    placeholder="Masukkan Nama Pegawai">
                            </div>
                            <div class="col-span-2 sm:col-span-1">
                                <label for="nama"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">No
                                    Identitas</label>
                                <input type="number" name="no_identitas" id="no_identitas" required
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                    placeholder="Masukkan Nomor KTP">
                            </div>
                            <div class="col-span-2 sm:col-span-1">
                                <label for="password"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Password</label>
                                <input type="password" name="password" id="password" required
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                    placeholder="Masukkan Password Pegawai">
                            </div>
                            <div class="col-span-2 sm:col-span-1">
                                <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Jenis Kelamin</label>
                                <div class="flex items-center space-x-4">
                                    <label class="inline-flex items-center">
                                        <input type="radio" class="form-radio" name="jenis_kelamin" value="L" 
                                            {{ auth()->user()->jenis_kelamin == 'L' ? 'checked' : '' }}>
                                        <span class="ml-2 text-gray-900 dark:text-white">Laki-Laki</span>
                                    </label>
                                    <label class="inline-flex items-center">
                                        <input type="radio" class="form-radio" name="jenis_kelamin" value="P" 
                                            {{ auth()->user()->jenis_kelamin == 'P' ? 'checked' : '' }}>
                                        <span class="ml-2 text-gray-900 dark:text-white">Perempuan</span>
                                    </label>
                                </div>
                            </div>                            
                            <div class="col-span-2">
                                <label for="nm_unit" class="block text-sm font-medium text-gray-900 dark:text-white">Unit</label>
                                <div class="flex gap-4">
                                    <select name="nm_unit" id="nm_unit"
                                        class="select2 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                        <option value="">Pilih Unit</option>
                                        @foreach ($unitlist as $item)
                                            <option value="{{ $item->nm_unit }}" data-kd-unit="{{ $item->kd_unit }}">{{ $item->nm_unit }}</option>
                                        @endforeach
                                    </select>
                                    <div class="flex-1">
                                        <label for="kd_unit" class="block text-sm font-medium text-gray-700 dark:text-white">Kode Unit</label>
                                        <input type="text" name="kd_unit" id="kd_unit" readonly
                                            class="bg-gray-200 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                    </div>
                                </div>
                            </div>
                            <div class="col-span-2 sm:col-span-1">
                                <label for="password"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Tanggal Lahir</label>
                                    <input type="date" name="tanggal_lahir" id="tanggal_lahir"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5"
                                    >
                            </div>
                            <div class="col-span-2 sm:col-span-1">
                                <label for=""
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Foto KTP</label>
                                <input
                                    class="block text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                                    aria-describedby="user_avatar_help" id="foto_ktp" name="foto_ktp" type="file">
                                    <p class="mt-1 text-sm text-gray-500" id="file_input_help">max: 2 MB, JPEG, JPG, PNG</p>
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
                            Tambah Pegawai
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- Tabel --}}
    <div class="px-5 lg:ml-64 mb-16">
        <div class="relative h-full overflow-x-auto shadow-md sm:rounded-lg">
            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-white uppercase bg-blue-800 dark:bg-gray-700 dark:text-gray-400 ">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            No.
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Foto
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Nama
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Email
                        </th>
                        <th scope="col" class="px-6 py-3">
                            No. Telp
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Alamat
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Status
                        </th>
                        <th scope="col" class="px-6 py-3 ">
                            Detail
                        </th>
                        {{-- <th scope="col" class="px-6 py-3 ">
                            Delete
                        </th> --}}
                    </tr>
                </thead>
                <tbody>
                    @forelse ($pegawai as $item)
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                            <th scope="row"
                                class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                {{ $item->id }}
                            </th>
                            <td class="px-6 py-4">
                                <img src="{{ asset('img/' . $item->user->foto) }}" alt="foto"
                                    class="w-11 h-10 rounded-full">
                            </td>
                            <td class="px-6 py-4">
                                {{ $item->user->nama }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $item->user->email }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $item->no_telp }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $item->alamat }}
                            </td>
                            <td class="px-6 py-4">
                                <div class="w-full">
                                    <form action="{{ url('/status-pegawai', ['id' => $item->id]) }}" method="POST">
                                        @csrf
                                        @if ($item->user->status == 'aktif')
                                            <button type="submit" name="status" value="nonaktif"
                                                class="px-4 w-full py-2 bg-green-500 text-white rounded-lg">Active</button>
                                        @elseif($item->user->status == 'nonaktif')
                                            <button type="submit" name="status" value="aktif"
                                                class="px-4 w-full py-2 bg-red-600 text-white rounded-lg hover:bg-red-700">inactive</button>
                                        @endif
                                    </form>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <a href="{{ url('/detail-pegawai/'.$item->id) }}" type="button"
                                    class="text-white bg-yellow-400 hover:bg-yellow-500 focus:outline-none focus:ring-4 focus:ring-yellow-300 font-medium rounded-full text-sm px-5 py-2.5 text-center me-2 mb-2 dark:focus:ring-yellow-900">
                                    <i class="fa-regular fa-eye"></i>
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td>Belum ada Pelanggan</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    
    <script>
        $(document).ready(function() {
            // Initialize Select2 plugin
            $('#nm_unit').select2();
    
            // Handle unit selection change
            $('#nm_unit').change(function() {
                var selectedUnit = $(this).find(':selected');
                var kodeUnit = selectedUnit.data('kd-unit');
                // Set the kd_unit input value based on the selected nm_unit
                $('#kd_unit').val(kodeUnit);
            });
        });
    </script>    
@endsection
