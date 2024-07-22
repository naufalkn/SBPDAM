@extends('layouts.app')
@section('container')
    @include('layouts.navbar')
    <div class="">
        <div class="sm:flex items-center max-w-screen-xl">
            <div class="sm:w-1/2 p-10">
                <div class="flex items-center justify-center object-center text-center rounded-sm">
                    <img src="{{ url('/img/pdam.png') }}" class="w-52">
                </div>
            </div>
            <div class="sm:w-1/2 p-5">
                <div class="text">
                    <span class="text-gray-500 border-b-2 border-blue-600 uppercase">About us</span>
                    <h2 class="my-4 font-bold text-3xl  sm:text-4xl ">About <span class="text-blue-600">PEREUMDA AIR MINUM
                            TIRTO NEGORO</span>
                    </h2>
                    <p class="text-gray-700">
                        Perumda Air Minum Tirto Negoro Kabupaten Sragen bisa dikatakan berkembang cukup pesat, dari tahun
                        1985 sampai tahun 2021 telah memiliki pelanggan aktif sebanyak ± 68.000. Setelah diadakan
                        reklasifikasi pelanggan pada Januari 2013 maka sebagian besar pelanggan adalah pelanggan rumah
                        tangga III (R3). Walaupun demikian masih banyak hambatan dan tantangan yang harus dihadapi, baik
                        dari faktor internal maupun eksternal perusahaan yang antara lain meliputi Manajemen Keuangan,
                        Teknik, Sumber Daya Manusia, Kebijakan – kebijakan Pemerintah serta tingginya biaya operasional
                        khususnya biaya listrik. Meskipun demikian Perumda Air Minum Tirto Negoro Kabupaten Sragen terus
                        beroperasi secara optimal.
                    </p>
                </div>
            </div>
        </div>

        <div class="sm:flex items-center max-w-screen-xl">
            <div class="sm:w-1/2 flex justify-end p-10">
                <div class="text  w-full">
                    <div class="space-y-2">
                        <div class="flex items-center space-x-3 justify-end w-full">
                            <p>08112631515</p>
                            <i class="fa-solid fa-square-phone-flip text-2xl text-blue-600"></i>
                        </div>
                        <div class="flex items-center space-x-3 justify-end w-full">
                            <p>perumdamsragen@gmail.com</p>
                            <p>pdamkabsrg@yahoo.com</p>
                            <i class="fa-regular fa-envelope text-2xl text-yellow-400"></i>
                        </div>
                        <div class="flex items-center space-x-3 justify-end w-full">
                            <p> 0271 890027</p>
                            <i class="fa-solid fa-fax text-2xl text-red-600"></i>
                        </div>
                        <div class="flex items-center space-x-3 justify-end w-full">
                            <p>http://www.pdamsragen.com</p>
                            <i class="fa-solid fa-computer text-2xl text-gray-500"></i>
                        </div>
                        <div class="flex items-center space-x-3 justify-end w-full">
                            <p>Jl. Ronggowarsito No. 18
                                Kabupaten Sragen
                                Jawa Tengah
                                57214
                                Indonesia</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="sm:w-1/2 p-10">
                <div class="flex items-center justify-center object-center text-center rounded-sm">
                    <img src="{{ url('/img/foto_pdam.jpg') }}">
                </div>
            </div>

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
    </div>
@endsection
