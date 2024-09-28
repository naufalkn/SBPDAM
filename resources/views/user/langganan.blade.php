@extends('layouts.app')
@section('container')
    @include('layouts.navbar')
    <div class="w-full h-56">
        <div class="overflow-hidden bg-gradient-to-r from-blue-900 to-blue-600 h-56 absolute w-full flex items-center">
            <p class="text-2xl lg:text-4xl mb-2 font-semibold z-40 ml-28 text-white">Langganan</p>
        </div>
    </div>
    <div class="bg-gray-50">
        @if (auth()->user()->pelanggan)
            <div class="p-6 h-full space-y-4  text-medium  dark:text-gray-400 dark:bg-gray-800 rounded-lg w-full"
                id="detail" role="tabpanel" aria-labelledby="detail-tab">
                <div class="flex space-x-2">
                    @if ($pelanggan->jenis == 'pendaftaran')
                        <p>Hallo <b>{{ $pelanggan->nama }} </b> , Pelanggan PERUMDA AIR MINUM TIRTO NEGORO Kabupaten Sragen.
                            @if($pelanggan->status_id == 6)
                            Terimakasih telah menjadi pelanggan kami sejak
                            <b>{{ \Carbon\Carbon::parse($pelanggan->tgl_aktif)->format('d-m-Y') }}</b></p>
                            @endif
                    @elseif($pelanggan->jenis == 'pengajuan')
                        <p>Hallo <b>{{ $pelanggan->nama }} </b> , Pelanggan PERUMDA AIR MINUM TIRTO NEGORO Kabupaten Sragen.
                           @if($pelanggan->status_id == 12)
                           Mohon maaf, Langganan Anda telah disegel mulai
                           <b>{{ \Carbon\Carbon::parse($pelanggan->tgl_nonaktif)->format('d-m-Y') }}</b></p>
                           @endif
                    @endif
                </div>
                <div class="flex h-full w-[700px] p-4 items-center justify-between rounded-lg border-[1px] border-gray-300">
                    <div class="flex space-x-6 items-center">
                        <div class="">
                            <img class="w-24 h-24 mb-3 rounded-full shadow-lg"
                                src="{{ asset('img/' . auth()->user()->foto) }}" alt="" />
                        </div>
                        <div class="">
                            <p class="font-semibold text-black">{{ $pelanggan->nama }}</p>
                            <p> Unit {{ $pelanggan->nm_unit }}</p>
                            @if (in_array($pelanggan->status_id, [1, 2, 3, 4, 5]))
                                <p> Tanggal Daftar :
                                    <span class="ml-3">
                                        {{ \Carbon\Carbon::parse($pelanggan->tgl_daftar)->format('d-m-Y') ?? '-' }}
                                    </span>
                                </p>
                            @elseif($pelanggan->status_id == 6)
                                <p> Tanggal Aktif :
                                    <span class="ml-3">
                                        {{ \Carbon\Carbon::parse($pelanggan->tgl_aktif)->format('d-m-Y') ?? '-' }}
                                    </span>
                                </p>
                            @elseif(in_array($pelanggan->status_id, [7, 8, 9, 10, 11]))
                                <p> Tanggal Pengajuan :
                                    <span class="ml-3">
                                        {{ \Carbon\Carbon::parse($pelanggan->tgl_aktif)->format('d-m-Y') ?? '-' }}
                                    </span>
                                </p>
                            @elseif($pelanggan->status_id == 12)
                                <p> Tanggal Segel :
                                    <span class="ml-3">
                                        {{ \Carbon\Carbon::parse($pelanggan->tgl_aktif)->format('d-m-Y') ?? '-' }}
                                    </span>
                                </p>
                            @endif
                        </div>
                    </div>
                    <div class="mr-4">
                        <div class="font-semibold text-lg">
                            @if (in_array($pelanggan->status_id, [1, 2, 3, 4, 5]))
                                <span
                                    class="text-xs font-semibold inline-block py-1 px-2  rounded-full text-yellow-600 bg-yellow-200  last:mr-0 mr-1">Belum
                                    Berlangganan</span>
                            @elseif($pelanggan->status_id == 6)
                                <span
                                    class="text-xs font-semibold inline-block py-1 px-2  rounded-full text-green-600 bg-green-200  last:mr-0 mr-1">Berlangganan</span>
                            @elseif(in_array($pelanggan->status_id, [7, 8, 10, 11]))
                                <span
                                    class="text-xs font-semibold inline-block py-1 px-2  rounded-full text-yellow-600 bg-yellow-200  last:mr-0 mr-1">Pengajuan
                                    Berlangganan</span>
                            @elseif($pelanggan->status_id == 12)
                                <span
                                    class="text-xs font-semibold inline-block py-1 px-2  rounded-full text-red-600 bg-red-200  last:mr-0 mr-1">Segel
                                    Berlangganan</span>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="p-4 border rounded-xl">
                    <p class="font-semibold text-xl text-blue-600 mb-6">Data Diri Pelanggan</p>
                    <div class="grid gap-4 mb-4 grid-cols-2">
                        <div class="">
                            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama
                                Lengkap</label>
                            <p class="font-semibold ml-2">{{ $pelanggan->nama }}</p>
                        </div>
                        <div class="col-span-2 sm:col-span-1">
                            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">No. KTP /
                                SIM</label>
                            <p class="font-semibold ml-2">{{ $pelanggan->no_identitas }}</p>
                        </div>
                    </div>
                    <div class="grid gap-4 mb-4 grid-cols-2">
                        <div class="col-span-1">
                            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nomor
                                Telepon</label>
                            <p class="font-semibold ml-2">{{ $pelanggan->no_telepon }}</p>
                        </div>
                        <div class="col-span-2 sm:col-span-1">
                            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Pekerjaan</label>
                            <p class="font-semibold ml-2">{{ $pelanggan->pekerjaan }}</p>
                        </div>
                    </div>
                    <p class="font-semibold text-xl text-blue-600 mb-6">Alamat Pelanggan</p>
                    <div class="grid gap-4 mb-4 grid-cols-2">
                        <div class="col-span-1">
                            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama
                                Jalan</label>
                            <p class="font-semibold ml-2">{{ $pelanggan->nama_jalan }}</p>
                        </div>
                        <div class="space-x-4 col-span-2 sm:col-span-1">
                            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Alamat
                                Lengkap</label>
                            <p class="font-semibold ml-2">{{ $pelanggan->dukuh }}, {{ $pelanggan->rt }},
                                {{ $pelanggan->rw }}, {{ $pelanggan->kelurahan }}, {{ $pelanggan->kecamatan }}</p>
                        </div>
                    </div>
                    <div class="grid gap-4 mb-4 grid-cols-2">
                        <div class=" col-span-1">
                            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Jumlah
                                Penghuni </label>
                            <p class="font-semibold ml-2">{{ $pelanggan->jmlh_penghuni }}</p>

                        </div>
                        <div class="space-x-4 col-span-2 sm:col-span-1">
                            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Kode
                                Pos</label>
                            <p class="font-semibold ml-2">{{ $pelanggan->kode_pos }}</p>
                        </div>
                    </div>
                </div>
            </div>
        @else
            <div class="col-span-2 h-full bg-gray-100">
                <div class="h-full w-full p-6 shadow-xl rounded-xl sm:px-12 dark:bg-green-50 dark:text-gray-800">
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
    <div class="relative absolut -mt-12 lg:-mt-24 w-full">
        <svg viewBox="0 0 1428 174" version="1.1" xmlns="http://www.w3.org/2000/svg"
            xmlns:xlink="http://www.w3.org/1999/xlink">
            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                <g transform="translate(-2.000000, 44.000000)" fill="#3f83f8" fill-rule="nonzero">
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
                <g transform="translate(-4.000000, 76.000000)" fill="#3f83f8" fill-rule="nonzero">
                    <path
                        d="M0.457,34.035 C57.086,53.198 98.208,65.809 123.822,71.865 C181.454,85.495 234.295,90.29 272.033,93.459 C311.355,96.759 396.635,95.801 461.025,91.663 C486.76,90.01 518.727,86.372 556.926,80.752 C595.747,74.596 622.372,70.008 636.799,66.991 C663.913,61.324 712.501,49.503 727.605,46.128 C780.47,34.317 818.839,22.532 856.324,15.904 C922.689,4.169 955.676,2.522 1011.185,0.432 C1060.705,1.477 1097.39,3.129 1121.236,5.387 C1161.703,9.219 1208.621,17.821 1235.4,22.304 C1285.855,30.748 1354.351,47.432 1440.886,72.354 L1441.191,104.352 L1.121,104.031 L0.457,34.035 Z">
                    </path>
                </g>
            </g>
        </svg>
    </div>
@endsection
