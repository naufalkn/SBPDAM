@extends('layouts.app')
@section('container')
    @include('layouts.navbar-admin')
    <!-- SIDE -->
    @include('layouts.sidebar')
    <div class="px-5 py-8 lg:py-12 lg:px-8 lg:ml-60 mt-16 text-neutral-300 relative">
        <p class="text-2xl lg:text-4xl mb-2 font-semibold z-40">Riwayat Pelanggan </p>
        <p class="capitalize font-semibold">Unit {{ $nama }}</p>
        <div class="overflow-hidden bg-gradient-to-r from-blue-900 to-blue-600 -z-10 h-40 absolute top-0 left-0 w-full">
        </div>
    </div>

    <div class="lg:ml-64 mb-4 flex space-x-4">
        <form class="flex w-[400px]" action="{{ url('/unit/pencarian') }}" method="POST">
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
            <form action="{{ url('/unit/riwayat') }}" method="GET">
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
                            Jenis
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
                            <td class="px-6 py-4">
                                <img src="{{ asset('img/' . $item->user->foto) }}" alt="foto"
                                    class="w-11 h-10 rounded-full">
                            </td>
                            <td class="px-6 py-4">
                                {{ $item->nama }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $item->no_telepon }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $item->dukuh }} , Rt.{{ $item->rt }}, Rw.{{ $item->rw }},
                                {{ $item->kelurahan }}, {{ $item->kecamatan }}
                            </td>
                            </td>
                            <td class="px-6 py-4">
                                @if ($item->jenis == 'pendaftaran')
                                    <span class="bg-green-500 text-white px-2 py-1 rounded-full">Pendaftaran</span>
                                @elseif($item->jenis == 'pengajuan')
                                    <span class="bg-red-500 text-white px-2 py-1 rounded-full">Pengajuan</span>
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                @if ($item->status == 4)
                                    {{ $item->tgl_aktif ? \Carbon\Carbon::parse($item->tgl_aktif)->format('d-m-Y') : '-' }}
                                @elseif($item->status == 9)
                                    {{ $item->tgl_nonaktif ? \Carbon\Carbon::parse($item->tgl_nonaktif)->format('d-m-Y') : '-' }}
                                @endif
                            </td>
                            <td class="px-6 py-4 ">
                                <a href="{{ url('/detail-user/' . $item->id) }}" type="button"
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
