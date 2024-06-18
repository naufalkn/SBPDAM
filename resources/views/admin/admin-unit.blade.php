@extends('layouts.app')
@section('container')
    @include('layouts.navbar-admin')
    <!-- SIDE -->
    @include('layouts.sidebar')
    <div class="items-center flex-col px-5 py-8 lg:py-12 lg:px-8 lg:ml-60 mt-16 text-neutral-300 relative">
        <p class="text-xl lg:text-2xl font-semibold z-40 ">Admin Unit PERUMDA Air Minum Tirto Negoro</p>
        <p>Kabupaten Sragen</p>
        <div class="overflow-hidden bg-gradient-to-r from-blue-900 to-blue-600 -z-10 h-full absolute top-0 left-0 w-full">
        </div>
    </div>

    <div class="flex items-end justify-end p-5">
        <!-- Modal toggle -->
        <button data-modal-target="crud-modal" data-modal-toggle="crud-modal"
            class="block h-11 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
            type="button">
            Tambah Admin Unit
        </button>

        <!-- Main modal -->
        <div id="crud-modal" tabindex="-1" aria-hidden="true"
            class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
            <div class="relative p-4 w-full max-w-md max-h-full">
                <!-- Modal content -->
                <div class="relative w-full bg-white rounded-lg shadow dark:bg-gray-700">
                    <!-- Modal header -->
                    <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                            Tambah Admin Unit
                        </h3>
                        <button type="button"
                            class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                            data-modal-toggle="crud-modal">
                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 14 14">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                            </svg>
                        </button>
                    </div>
                    <!-- Modal body -->
                    <form class="p-4 md:p-5" action="{{ url('/tambah-admin-unit') }}" method="POST">
                        @csrf
                        <div class="grid gap-4 mb-4 grid-cols-2">
                            <div class="col-span-2">
                                <label for="kd_unit"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama</label>
                                <input type="text" name="nama" id="nama"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                    placeholder="Masukkan Kode Unit">
                            </div>
                            <div class="col-span-2">
                                <label for="nm_unit"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Username</label>
                                <input type="text" name="username" id="username"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                    placeholder="Masukkan Nama Unit">
                            </div>
                            <div class="col-span-2">
                                <label for="nm_unit"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email</label>
                                <input type="email" name="email" id="email"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                    placeholder="Masukkan Nama Unit">
                            </div>
                            <div class="col-span-2">
                                <label for="nm_unit"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Password</label>
                                <input type="password" name="password" id="password"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                    placeholder="Masukkan Nama Unit">
                            </div>
                            <div class="col-span-2 flex w-full gap-5 justify-between">
                                <div class="multi-form">
                                    <label class="fieldlabels">Unit</label>
                                    <select name="nm_unit" id="nm_unit"
                                        class="form-control select2">
                                        @foreach ($unitlist as $item)
                                            <option value="{{ $item->nm_unit }}"
                                                data-kd-unit="{{ $item->kd_unit }}">
                                                {{ $item->nm_unit }}</option>
                                        @endforeach
                                    </select>
                                    <label class="fieldlabels">Kode Unit</label>
                                    <select name="kd_unit" id="kd_unit"
                                        class="form-control select2">
                                        @foreach ($unitlist as $item)
                                            <option value="{{ $item->kd_unit }}">{{ $item->kd_unit }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
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
                            Tambah
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- table --}}
    <div class="mt-6">
        <div class="px-5 lg:ml-64 mb-16">
            <div class="relative h-full overflow-x-auto shadow-md sm:rounded-lg">
                <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-white uppercase bg-blue-800 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-6 py-3">
                                No
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Nama
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Email
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Nama/Kode Unit
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
                            <th scope="col" class="px-6 py-3 ">
                                Delete
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($adminUnit as $item)
                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                <th scope="row"
                                    class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    {{ $loop->index + 1 }}
                                </th>
                                <td class="px-6 py-4">
                                    {{ $item->user->nama }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $item->user->email }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $item->nm_unit }} / {{ $item->kd_unit }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $item->alamat }}
                                </td>
                                <td class="px-6 py-4">
                                    <div class="w-full">
                                        <form action="{{ url('/status-adminUnit', ['id' => $item->id]) }}" method="POST">
                                            @csrf
                                            @if ($item->status == "nonaktif")
                                                <button type="submit" name="status" value="aktif"
                                                    class="px-4 w-full py-2 bg-green-500 text-white rounded-lg">Aktifkan</button>
                                            @elseif($item->status == "aktif")
                                                <button type="submit" name="status" value="nonaktif"
                                                    class="px-4 w-full py-2 bg-red-600 text-white rounded-lg hover:bg-red-700">NonAktif</button>
                                            @endif
                                        </form>
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <a href="{{ url('/detail-adminUnit/  ' . $item->id) }}" type="button"
                                        class="text-white bg-yellow-400 hover:bg-yellow-500 focus:outline-none focus:ring-4 focus:ring-yellow-300 font-medium rounded-full text-sm px-5 py-2.5 text-center me-2 mb-2 dark:focus:ring-yellow-900">
                                        <i class="fa-regular fa-eye"></i>
                                    </a>
                                </td>
                                <td class="px-6 py-4">
                                    <a href="{{ url('/hapus-admin-unit/' . $item->id) }}" type="button"
                                        class="text-white bg-red-600 hover:bg-red-800 focus:outline-none focus:ring-4 focus:ring-red-300 font-medium rounded-full text-sm px-5 py-2.5 text-center me-2 mb-2 dark:focus:ring-red-900">
                                        <i class="fa-solid fa-trash"></i>
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td>Belum ada Data Admin Unit</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            // Saat pemilihan unit berubah
            $('#nm_unit').change(function() {
                var selectedUnit = $(this).find(':selected');
                var kodeUnit = selectedUnit.data('kd-unit');
                // Set nilai kode unit sesuai dengan data yang tersimpan pada atribut data-kd-unit
                $('#kd_unit').val(kodeUnit);
            });

            // Inisialisasi plugin Select2
            $('.select2').select2();
        });
    </script>
@endsection


