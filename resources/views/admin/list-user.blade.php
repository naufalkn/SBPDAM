@extends('layouts.app')
@section('container')
    @include('layouts.navbar-admin')
    <!-- SIDE -->
    @include('layouts.sidebar')
    <div class="px-5 py-8 lg:py-12 lg:px-8 lg:ml-60 mt-16 text-neutral-300 relative">
        <p class="text-2xl lg:text-4xl mb-2 font-semibold z-40">Halo, Selamat Datang {{ $nama }}</p>
        <p class="">Website Sambungan Baru PDAM Kabupaten Sragen</p>

        <div class="overflow-hidden bg-gradient-to-r from-blue-900 to-blue-600 -z-10 h-40 absolute top-0 left-0 w-full">

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
                            
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Nama
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Email
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Jenis Kelamin
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Tanggal Buat
                        </th>
                        <th scope="col" class="px-6 py-3 ">
                            Delete
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($user as $item)
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                            <th scope="row"
                                class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                {{ $item->id }}
                            </th>
                            <td class="px-6 py-4">
                                <img src="{{ asset('img/' . $item->foto) }}" alt="foto"
                                    class="w-11 h-10 rounded-full">
                            </td>
                            <td class="px-6 py-4">
                                {{ $item->nama }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $item->email }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $item->jenis_kelamin }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $item->created_at->format('d-m-Y') }}
                            </td>
                            <td class="px-6 py-4">
                                <a href="{{ url('/hapus-user/' . $item->id) }}" type="button"
                                    class="text-white bg-red-600 hover:bg-red-800 focus:outline-none focus:ring-4 focus:ring-red-300 font-medium rounded-full text-sm px-5 py-2.5 text-center me-2 mb-2 dark:focus:ring-red-900">
                                    <i class="fa-solid fa-trash"></i>
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
@endsection
