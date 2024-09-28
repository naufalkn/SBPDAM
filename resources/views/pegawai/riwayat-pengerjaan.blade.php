@extends('layouts.app')
@section('container')
    @include('layouts.navbar-admin')
    <!-- SIDE -->
    @include('layouts.sidebar')
    <div class="px-5 py-8 lg:py-10 lg:px-8 lg:ml-60 mt-9 text-neutral-300 relative">
        <p class="text-2xl lg:text-4xl mb-2 font-semibold z-40">Halo, {{ $nama }} </p>
        <p class="">Website Sambungan Baru PDAM Kabupaten Sragen </p>

        <div class="overflow-hidden bg-gradient-to-r from-blue-900 to-blue-600 -z-10 h-36 absolute top-0 left-0 w-full">
        </div>
        <div class="flex w-full mt-12">
            <div class="w-1/3">
                <div
                    class="flex  flex-col h-24 l w-72 items-center justify-center bg-white rounded-lg shadow md:flex-row   dark:border-gray-700 dark:bg-gray-800 ">
                    <div class="flex w-full gap-10 items-center p-5">
                        <div class="bg-blue-700 w-16 h-16 rounded-lg flex justify-center items-center">
                            <i class="fa-solid fa-users text-white text-2xl"></i>
                        </div>
                        <div class="flex flex-col justify-between leading-normal">
                            <h5 class="mb-2 text-base font-bold tracking-tight text-blue-600 dark:text-white">Riwayat Pengerjaan
                            </h5>
                            <p class=" text-2xl text-blue-600 dark:text-gray-400 font-bold">
                                {{ $riwayat }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="lg:ml-72 mb-4 flex space-x-4">
        <form class="flex w-[400px]" action="{{ url('/pegawai/pencarian') }}" method="POST">
            @csrf
            <div class="w-96">
                <input type="text" id="voice-search" name="nama"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    placeholder="Cari nama " required />
                <input type="hidden" name="sortby" value="{{ $sortby }}">
            </div>
            <button type="submit"
                class="inline-flex items-center py-2.5 px-3 ms-2 text-sm font-medium text-white bg-blue-700 rounded-lg border border-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                <svg class="w-4 h-4 me-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 20 20">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                </svg>Cari
            </button>
        </form>
        
        <div class="flex items-center">
            <form action="{{ url('/riwayat-pengerjaan') }}" method="GET">
                <select name="sortby" onchange="this.form.submit()" class="w-full h-full inline-flex items-center text-gray-500 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-100 font-medium rounded-lg text-sm px-3 py-1.5 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700">
                    <option value="semua" {{ $sortby == 'semua' ? 'selected' : '' }}>Semua</option>
                    <option value="pendaftaran" {{ $sortby == 'pendaftaran' ? 'selected' : '' }}>Pendaftaran</option>
                    <option value="pengajuan" {{ $sortby == 'pengajuan' ? 'selected' : '' }}>Pengajuan</option>
                </select>
            </form>
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
                            Status Pengerejaan
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Tanggal
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
                                {{-- @if ($item->village)
                                    {{ $item->village->name }}
                                @else
                                -
                                @endif --}}
                            </td>
                            
                            <td class="px-6 py-4">
                                @if($item->status_id == '5' || $item->status_id == '11')
                                    <span
                                        class="text-xs font-semibold inline-block py-1 px-2  rounded-full text-green-600 bg-green-200  last:mr-0 mr-1">
                                        Selesai
                                    </span>
                                @elseif($item->status_id == '6' || $item->status_id == '12')
                                    <span
                                        class="text-xs font-semibold inline-block py-1 px-2  rounded-full text-blue-600 bg-blue-200  last:mr-0 mr-1">
                                        Sudah Disejutui Admin
                                    </span>
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                {{ \Carbon\Carbon::parse($item->tgl_nonaktif)->format('d-m-Y') ?? '-' }}
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
