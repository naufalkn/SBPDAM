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
            <div class="w-1/3">
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
            <div class="w-1/3">
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
            <div class="w-1/3">
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
        </div>
    </div>
    <div class="w-[1500px] ">
        <div class=" h-full ml-72 rounded-xl bg-gray-200">
            {!! $chart->container() !!}
        </div>
    </div>
    <script src="{{ $chart->cdn() }}"></script>

    {{ $chart->script() }}
@endsection
