@extends('layouts.app')
@section('container')
    @include('layouts.navbar')
    <div class="w-full h-svh  absolute bg-blue-700">
        {{-- Card --}}
        <div class=" w-full p-14">
            <div
                class="w-[450px] p-6 bg-white border border-gray-200 rounded-lg dark:bg-gray-800 dark:border-gray-700 space-y-3 shadow-md">
                <div class="">
                    <div href=" type="" class="w-full h-12 border-gray-800 rounded flex items-center">
                        <div class="flex items-center space-x-6 w-full">
                            <img src="{{ asset('img/' . auth()->user()->foto) }}" class="w-10 h-10 rounded-full"
                                alt="Profile">
                            <div class="">
                                <h1 class="text-gray-500 font-bold">Halo, Selamat datang </h1>
                                <h1 class="text-black font-semibold text-xl">{{ auth()->user()->nama }}</h1>
                            </div>
                        </div>
                    </div>
                </div>
                @if (auth()->user()->pelanggan && auth()->user()->pelanggan->tgl_pengajuan != null)
                <p class="p-2 w-full text-2xl dark:text-gray-400">Sambungan Anda Telah Tersegel</p>
            @elseif (auth()->user()->pelanggan && auth()->user()->pelanggan->tgl_daftar != null)
                <p class="p-2 w-full text-2xl dark:text-gray-400">Anda sudah Berlangganan Air Bersih di PDAM Sragen</p>
            @else
                <p class="p-2 w-full text-2xl dark:text-gray-400">Mari Mulai Berlangganan dan Nikmati Layanan Air Bersih</p>
                <div class="">
                    <a href="/daftar-sambungan" type="submit"
                        class="text-white bg-blue-600 hover:bg-blue-800 w-full h-12 border-gray-800 rounded flex items-center justify-between p-2">
                        <div class="flex items-center justify-between space-x-2 w-full">
                            <p class="text-center w-full">Berlangganan</p>
                        </div>
                    </a>
                </div>
            @endif
            

            </div>
        </div>

        <div class="relative absolut -mt-12 lg:-mt-24 w-full">
            <svg viewBox="0 0 1428 174" version="1.1" xmlns="http://www.w3.org/2000/svg"
                xmlns:xlink="http://www.w3.org/1999/xlink">
                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                    <g transform="translate(-2.000000, 44.000000)" fill="#FFFFFF" fill-rule="nonzero">
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
                    <g transform="translate(-4.000000, 76.000000)" fill="#FFFFFF" fill-rule="nonzero">
                        <path
                            d="M0.457,34.035 C57.086,53.198 98.208,65.809 123.822,71.865 C181.454,85.495 234.295,90.29 272.033,93.459 C311.355,96.759 396.635,95.801 461.025,91.663 C486.76,90.01 518.727,86.372 556.926,80.752 C595.747,74.596 622.372,70.008 636.799,66.991 C663.913,61.324 712.501,49.503 727.605,46.128 C780.47,34.317 818.839,22.532 856.324,15.904 C922.689,4.169 955.676,2.522 1011.185,0.432 C1060.705,1.477 1097.39,3.129 1121.236,5.387 C1161.703,9.219 1208.621,17.821 1235.4,22.304 C1285.855,30.748 1354.351,47.432 1440.886,72.354 L1441.191,104.352 L1.121,104.031 L0.457,34.035 Z">
                        </path>
                    </g>
                </g>
            </svg>
        </div>
        <div class="w-full h-screen bg-white space-y-10 p-10">
            <p class="w-full text-center text-3xl font-extrabold text-blue-500">Profil</p>
            <div class="w-full flex justify-center">
                <div class="w-2/3 flex ">
                    <div class="w-1/2 p-4 space-y-3">
                        <p class="font-semibold text-xl">Perusahaan Daerah Air Minum Sragen</p>
                        <p class="text-base">PDAM (Perusahaan Daerah Air Minum) Sragen adalah perusahaan yang bertanggung
                            jawab atas penyediaan layanan air bersih di Kabupaten Sragen, Jawa Tengah, Indonesia. Sebagai
                            lembaga yang dijalankan oleh pemerintah daerah, PDAM Sragen berperan penting dalam memenuhi
                            kebutuhan air bersih bagi penduduk, industri, dan sektor lainnya di wilayah tersebut.</p>
                    </div>
                    <div class="w-1/2 flex justify-center">
                        <img src="{{ url('img/wash.svg') }}" class="w-56" alt="">
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
