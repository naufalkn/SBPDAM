@extends('layouts.app')
@section('container')
    <div class="font-sans">
        @include('layouts.navbar-admin')

        <div class="flex relative">
            <!-- NAV -->
            @include('layouts.sidebar')
            <div class="w-full">
                <div class="w-full p-7">
                    <div class="">
                        <p class="text-neutral-200 text-2xl lg:text-4xl mb-2 font-semibold z-40">Halo, Selamat Datang</p>
                        <p class="text-neutral-200">Website Sambungan Baru Perusahaan Daerah Air Minum Sragen</p>
                    </div>

                    <div class="overflow-hidden bg-blue-600 -z-10 h-56 absolute top-0 left-0 w-full">
                        <div class="w-[2400px] h-[2400px] rounded-full bg-blue-500 absolute -left-96 -top-40"
                            style="box-shadow: 24px 32px 184px 24px rgba(6, 8, 89, 0.75) inset;">
                        </div>
                        <div class="w-[1600px] h-[1600px] rounded-full bg-blue-500 absolute -left-48 top-8"
                            style="box-shadow: 24px 32px 184px 24px rgba(6, 8, 89, 0.75) inset;">
                        </div>
                        <div class="w-[800px] h-[800px] rounded-full bg-blue-500 absolute left-48 top-40"
                            style="box-shadow: 24px 32px 184px 24px rgba(6, 8, 89, 0.75) inset;">
                        </div>
                    </div>
                    
                </div>
                {{-- <div class="flex p-4 justify-between items-center border-b bg-blue-800 border-gray-300 mb-5 rounded-xl">
                    <h1 class="text-2xl font-bold pt-2 pb-6 cap text-white">Selamat Datang, {{ $nama }}</h1>
                </div> --}}
                {{-- card statistik --}}
                {{-- <div class="w-1/5">
                    <div class="bg-white shadow rounded-sm flex justify-between items-center py-3.5 px-3.5">
                        <div class="space-y-2">
                            <p class="text-xs text-gray-400 uppercase">Jumlah Pelanggan</p>
                            <div class="flex items-center space-x-2">
                                <h1 class="text-xl font-semibold">{{ $jlmh_pelanggan }}</h1>
                            </div>
                        </div>
                    </div>
                </div> --}}
<div class="space-y-5 mt-10">
    <div
        class="flex  flex-col h-24 w-64 items-center justify-center bg-white border border-gray-200 rounded-lg shadow md:flex-row  hover:bg-gray-100 dark:border-gray-700 dark:bg-gray-800 dark:hover:bg-gray-700">
        <div class="w-10 mr-4">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" class="text-green-700 "
                fill="currentColor">
                <path
                    d="M224 256A128 128 0 1 0 224 0a128 128 0 1 0 0 256zm-45.7 48C79.8 304 0 383.8 0 482.3C0 498.7 13.3 512 29.7 512H418.3c16.4 0 29.7-13.3 29.7-29.7C448 383.8 368.2 304 269.7 304H178.3z" />
            </svg>
        </div>
        <div class="flex flex-col justify-between leading-normal">
            <h5 class="mb-2 text-lg font-bold tracking-tight text-green-700 dark:text-white">Jumlah Pelanggan
            </h5>
            <p class="mb-3 text-xl text-green-700 dark:text-gray-400 font-bold">{{ $jlmh_pelanggan }}</p>
        </div>
    </div>


    {{-- table --}}
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-white uppercase bg-blue-800 dark:bg-gray-700 dark:text-gray-400 ">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        No.
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Nama
                    </th>
                    <th scope="col" class="px-6 py-3">
                        No Telp
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Kecamatan
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Kelurahan
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
                @forelse ($pelanggan as $item)
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                        <th scope="row"
                            class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{ $item->id }}
                        </th>
                        <td class="px-6 py-4">
                            {{ $item->nama }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $item->no_telepon }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $item->kecamatan }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $item->kelurahan }}
                        </td>
                        <td class="px-6 py-4 ">
                            <a href="" type="button"
                                class="text-white bg-green-600 hover:bg-green-800 focus:outline-none focus:ring-4 focus:ring-green-300 font-medium rounded-full text-sm px-5 py-2.5 text-center me-2 mb-2 dark:focus:ring-green-900">
                                <i class="fa-regular fa-eye"></i>
                            </a>
                        </td>
                        <td class="px-6 py-4">
                            <a href="{{ url('/hapus-pelanggan/' . $item->id) }}" type="button"
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

            </div>
        </div>
    </div>
@endsection
