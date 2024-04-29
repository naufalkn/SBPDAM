@extends('layouts.app')
@section('container')
    <div class="flex w-full h-full p-10 items-center justify-center">
        <div
            class="max-w-xl p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700 space-y-5">
            <div class="flex justify-center">
                <img src="{{ url('img/succes.svg') }}" class="w-52" alt="">
            </div>
            <h5 class="mb-2 text-2xl text-center font-semibold tracking-tight text-gray-900 dark:text-white">Pendaftaran
                Berhasil</h5>
            <h5 class="mb-2 text-xl text-center  tracking-tight text-gray-900 dark:text-white">Calon Pelanggan dikenakan biaya sebesar <span class="font-semibold">Rp. 23.000</span>
                </h5>
                <div class="flex w-full items-center justify-center">
                    <a type="button" href="{{ url('/profil/{id}') }}"
                    class="flex h-12 space-x-3 justify-center items-center rounded-xl w-56 bg-green-500 text-white">
                    <p>Profil Saya</p>
                </a>
                </div>
        </div>
    </div>
@endsection
