@extends('layouts.app')
@section('container')
    @include('layouts.navbar-admin')
    <!-- SIDE -->
    @include('layouts.sidebar')
    <div class="px-5 py-8 lg:py-12 lg:px-8 lg:ml-60 mt-16 text-neutral-300 relative">
        <p class="text-2xl lg:text-4xl mb-2 font-semibold z-40">Halo, Selamat Datang {{ $nama }}</p>
        <p class="">Website Sambungan Baru PDAM Kabupaten Sragen</p>

        <div class="overflow-hidden bg-gradient-to-r from-blue-900 to-blue-600 -z-10 h-56 absolute top-0 left-0 w-full">
        </div>
        <div class="flex w-full mt-12">
            <div class="w-1/4">
                <div
                    class="flex  flex-col h-24  w-72 items-center justify-center bg-white rounded-lg shadow md:flex-row   dark:border-gray-700 dark:bg-gray-800 ">
                    <div class="flex w-full gap-10 items-center p-5">
                        <div class="bg-green-700 w-16 h-16 rounded-lg flex justify-center items-center">
                            <i class="fa-solid fa-users text-white text-2xl"></i>
                        </div>
                        <div class="flex flex-col justify-between leading-normal">
                            <h5 class="mb-2 text-base font-bold tracking-tight text-green-600 dark:text-white">Jumlah User
                            </h5>
                            <p class="mb-3 text-2xl text-green-700 dark:text-gray-400 font-bold">{{ $jmlh_user }}</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="w-1/4">
                <div
                    class="flex  flex-col h-24  w-72 items-center justify-center bg-white rounded-lg shadow md:flex-row   dark:border-gray-700 dark:bg-gray-800 ">
                    <div class="flex w-full gap-10 items-center p-5">
                        <div class="bg-blue-800 w-16 h-16 rounded-lg flex justify-center items-center">
                            <i class="fa-solid fa-user-check text-2xl text-white"></i>
                        </div>
                        <div class="flex flex-col justify-between leading-normal">
                            <h5 class="mb-2 text-base font-bold tracking-tight text-blue-700 dark:text-white">Jumlah
                                Pelanggan
                            </h5>
                            <p class="mb-3 text-2xl text-blue-700 dark:text-gray-400 font-bold">{{ $jmlh_pelanggan }}</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="w-1/4">
                <div
                    class="flex  flex-col h-24  w-72 items-center justify-center bg-white rounded-lg shadow md:flex-row   dark:border-gray-700 dark:bg-gray-800 ">
                    <div class="flex w-full gap-10 items-center p-5">
                        <div class="bg-red-600 w-16 h-16 rounded-lg flex justify-center items-center">
                            <i class="fa-solid fa-user-lock text-white text-2xl"></i>
                        </div>
                        <div class="flex flex-col justify-between leading-normal">
                            <h5 class="mb-2 text-base font-bold tracking-tight text-red-600 dark:text-white">Jumlah Segel
                            </h5>
                            <p class="mb-3 text-2xl text-red-600 dark:text-gray-400 font-bold">{{ $jmlh_segel }}</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="w-1/4">
                <div
                    class="flex  flex-col h-24  w-72 items-center justify-center bg-white rounded-lg shadow md:flex-row   dark:border-gray-700 dark:bg-gray-800 ">
                    <div class="flex w-full gap-10 items-center p-5">
                        <div class="bg-yellow-400 w-16 h-16 rounded-lg flex justify-center items-center">
                            <i class="fa-solid fa-gears text-2xl text-white"></i>
                        </div>
                        <div class="flex flex-col justify-between leading-normal">
                            <h5 class="mb-2 text-base font-bold tracking-tight text-yellow-400 dark:text-white">Jumlah Unit
                            </h5>
                            <p class="mb-3 text-2xl text-yellow-400 dark:text-gray-400 font-bold">{{ $jmlh_unit }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="">
        <div class="w-[1250px] overflow-x-hidden space-y-4 px-5 shadow-md lg:ml-64 mb-16">
            <div class="mt-4">
                <form id="unitForm" method="GET" action="{{ route('select.chart') }}">
                    <div class="flex space-x-4">
                        <select
                            class="w-56 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                            name="year" onchange="document.getElementById('unitForm').submit()">
                            @for ($i = 2020; $i <= date('Y'); $i++)
                                <option value="{{ $i }}" {{ $i == $selectedYear ? 'selected' : '' }}>
                                    {{ $i }}
                                </option>
                            @endfor
                        </select>
                        <select name="kd_unit" id="unitDropdown"
                            class="w-56 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                            onchange="document.getElementById('unitForm').submit()">
                            <option value="all">Semua</option>
                            @foreach ($unitlist as $item)
                                <option value="{{ $item->kd_unit }}"
                                    {{ request('kd_unit') == $item->kd_unit ? 'selected' : '' }}>
                                    {{ $item->nm_unit }}
                                </option>
                            @endforeach
                        </select>
                        <select name="month" class="w-56 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" onchange="document.getElementById('unitForm').submit()">
                            <option value="">Pilih Bulan</option>
                            @foreach (range(1, 12) as $month)
                                <option value="{{ $month }}" {{ $month == request('month') ? 'selected' : '' }}>
                                    {{ \Carbon\Carbon::create()->month($month)->format('F') }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </form>
            </div>
            <div class="flex space-x-4">
                <div class="">
                    {!! $Yearchart->container() !!}
                </div>
                <div class="">
                {!! $Statuschart->container() !!}

                </div>
            </div>
            {{-- <div class="w-1/2"> --}}
            {{-- </div> --}}
        </div>
    </div>
    <div class="flex space-x-6  justify-between px-5 lg:ml-64 mb-16">
        <div class="w-full space-y-16">
            <div class="">
                <p class="font-semibold mb-5 text-gray-600">Riwayat</p>
                <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-white uppercase bg-blue-800 dark:bg-gray-700 dark:text-gray-400 ">
                            <tr>
                                <th scope="col" class="px-6 py-3">
                                    Nama
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Unit
                                </th>
                                <th scope="col" class="px-6 py-3 ">
                                    Jenis
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Tanggal
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Status
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($riwayat as $item)
                                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">

                                    <td class="px-6 py-4">
                                        {{ $item->nama }}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ $item->nm_unit }}
                                    </td>
                                    <td class="px-6 py-4">
                                        @if ($item->jenis == 'pendaftaran')
                                            <span
                                                class="text-xs font-semibold inline-block py-1 px-2  rounded-full text-green-600 bg-green-200  last:mr-0 mr-1">
                                                Pendaftaran
                                            </span>
                                        @elseif($item->jenis == 'pengajuan')
                                            <span
                                                class="text-xs font-semibold inline-block py-1 px-2  rounded-full text-red-600 bg-red-200  last:mr-0 mr-1">
                                                Pengajuan
                                            </span>
                                        @endif
                                    </td>

                                    <td class="px-6 py-4">
                                        {{ \Carbon\Carbon::parse($item->tgl_daftar)->format('d-m-Y') ?? '-' }}
                                    </td>
                                    <td scope="row"
                                        class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        @if ($item->status_id == 1)
                                            <span
                                                class="text-xs font-semibold inline-block py-1 px-2  rounded-full text-red-600 bg-red-200  last:mr-0 mr-1">
                                                Belum Diverifikasi
                                            </span>
                                        @elseif($item->status_id == 2 || $item->status_id == 3 || $item->status_id == 4 || $item->status_id == 5)
                                            <span
                                                class="text-xs font-semibold inline-block py-1 px-2  rounded-full text-yellow-600 bg-yellow-200  last:mr-0 mr-1">
                                                Sedang Diproses
                                            </span>
                                        @elseif($item->status_id == 6)
                                            <span
                                                class="text-xs font-semibold inline-block py-1 px-2  rounded-full text-blue-600 bg-blue-200  last:mr-0 mr-1">
                                                Berlangganan
                                            </span>
                                        @elseif($item->status_id == 7)
                                            <span
                                                class="text-xs font-semibold inline-block py-1 px-2  rounded-full text-green-600 bg-green-200  last:mr-0 mr-1">
                                                Belum Disetujui
                                            </span>
                                        @elseif($item->status_id == 8 || $item->status_id == 9 || $item->status_id == 10 || $item->status_id == 11)
                                            <span
                                                class="text-xs font-semibold inline-block py-1 px-2  rounded-full text-yellow-600 bg-yellow-200  last:mr-0 mr-1">
                                                Sedang Diproses
                                            </span>
                                        @elseif($item->status_id == 12)
                                            <span
                                                class="text-xs font-semibold inline-block py-1 px-2  rounded-full text-red-600 bg-red-200  last:mr-0 mr-1">
                                                Pelanggan Disegel
                                            </span>
                                        @endif
                                    </td>
                                    {{-- <td class="px-6 py-4 ">
                                        <a href="{{ url('/detail-user/' . $item->id) }}" type="button"
                                            class="text-white bg-yellow-400 hover:bg-yellow-500 focus:outline-none focus:ring-4 focus:ring-yellow-300 font-medium rounded-full text-sm px-5 py-2.5 text-center me-2 mb-2 dark:focus:ring-yellow-900">
                                            <i class="fa-regular fa-eye"></i>
                                        </a>
                                    </td> --}}
                                </tr>
                            @empty
                                <tr>
                                    <td>Belum ada Pendaftar</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        {{-- <div class="mb-4">
            <label for="unitDropdown" class="block text-sm font-medium text-gray-900 dark:text-white">Pilih Unit</label>
            <select id="unitDropdown" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white">
                @foreach ($unitlist as $item)
                    <option value="{{ $item->kd_unit }}">{{ $item->nm_unit }}</option>
                @endforeach
            </select>
        </div> --}}
    </div>
    {{-- Year --}}
    <script src="{{ $Yearchart->cdn() }}"></script>
    {{ $Yearchart->script() }}
    {{-- Status --}}
    <script src="{{ $Statuschart->cdn() }}"></script>
    {{ $Statuschart->script() }}
@endsection
