@extends('layouts.app')
@section('container')
    @include('layouts.navbar-admin')
    <!-- SIDE -->
    @include('layouts.sidebar')
    <div class="px-5 py-8 lg:py-12 lg:px-8 lg:ml-60 mt-16 text-neutral-300 relative">
        <p class="text-2xl lg:text-4xl mb-2 font-semibold z-40">Halo, Selamat Datang </p>
        <p class="">Website Sambungan Baru PDAM Kabupaten Sragen Unit {{ $nama }}</p>

        <div class="overflow-hidden bg-gradient-to-r from-blue-900 to-blue-600 -z-10 h-56 absolute top-0 left-0 w-full">

        </div>

        <div class="flex w-full mt-12">
            <div class="w-1/3">
                <div
                    class="flex  flex-col h-28 l w-80 items-center justify-center bg-white rounded-lg shadow md:flex-row   dark:border-gray-700 dark:bg-gray-800 ">
                    <div class="flex w-full justify-between items-center p-5">
                        <div class="bg-red-800 w-16 h-16 rounded-lg flex justify-center items-center">
                            <i class="fa-solid fa-users text-white text-2xl"></i>
                        </div>
                        <div class="flex flex-col justify-between leading-normal">
                            <h5 class="mb-2 text-base font-bold tracking-tight text-red-700 dark:text-white"> Jumlah Calon Pelanggan
                            </h5>
                            <p class="mb-3 text-2xl text-red-700 dark:text-gray-400 font-bold">{{ $jmlh_selesaiSegel }}</p>
                        </div>
                    </div>
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
                            Nama
                        </th>
                        <th scope="col" class="px-6 py-3">
                            No Telp
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Alamat
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Status
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Tanggal
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
                            <td class="px-6 py-4">
                                {{ $item->dukuh }}, Rt. {{ $item->rt }}, Rw. {{ $item->rw }}, Desa {{ $item->desa }}, Kecamatan {{ $item->kecamatan }}
                            </td>
                            </td>
                            <td class="px-6 py-4">
                                    <span
                                        class="bg-blue-600 text-white px-2 py-1 rounded-full text-xs font-semibold">Sudah Disegel</span>
                            </td>
                            
                            <td class="px-6 py-4">
                                {{ \Carbon\Carbon::parse($item->tgl_nonaktif)->format('d-m-Y') ?? '-' }}
                            </td>
                            
                            <td class="px-6 py-4 ">
                                <a href="{{ url('/detail-user/'.$item->id) }}" type="button"
                                    class="text-white bg-yellow-400 hover:bg-yellow-500 focus:outline-none focus:ring-4 focus:ring-yellow-300 font-medium rounded-full text-sm px-5 py-2.5 text-center me-2 mb-2 dark:focus:ring-yellow-900">
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

    
@endsection
