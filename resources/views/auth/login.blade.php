@extends('layouts.app')
@section('container')
    <!-- component -->
    <div class="h-screen flex">
        <div class="flex w-1/2 bg-gradient-to-tr from-blue-800 to-purple-700 i justify-around items-center">
            <div>
                <h1 class="text-white font-bold text-4xl font-sans">PERUMDA AIR MINUM TIRTO NEGORO</h1>
                <p class="text-white mt-1"> KABUPATEN SRAGEN </p>
            </div>
        </div>
        <div class="flex w-1/2 justify-center items-center bg-white">
            <div class="w-1/2 ">
                <form action="/login" method="POST">
                    @csrf
                    <h1 class="text-gray-800 font-bold text-4xl mb-1 text-center py-14">Login</h1>
                    <div class="flex items-center border-2 py-2 px-3 rounded-2xl mb-4 ">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207" />
                        </svg>
                        <input class="pl-2 outline-none border-none w-full focus:ring-0 " id="login_field" type="text"
                            placeholder="Email atau Username" name="login_field" value="{{ old('login_field') }}" required
                            autofocus>
                    </div>
                    <div class="flex items-center border-2 py-2 px-3 rounded-2xl">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" viewBox="0 0 20 20"
                            fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z"
                                clip-rule="evenodd" />
                        </svg>
                        <input class="pl-2 outline-none border-none w-full focus:ring-0" type="password" name="password"
                            id="password" placeholder="Password" />
                    </div>
                    <button type="submit"
                        class="block w-full bg-indigo-600 mt-4 py-2 rounded-2xl text-white font-semibold mb-2">Login</button>
                        <div class="flex">
                            <p class="">Belum Punya Akun ?</p>
                            <a href="/daftar" class="ml-2 hover:text-blue-500 cursor-pointer">Daftar Sekarang</a>
                        </div>
                </form>
            </div>
        </div>
    </div>

    @if (session('error'))
        <script>
            Swal.fire({
                title: "Maaf, Login Gagal",
                icon: "error",
                text: "{{ session('error') }}",
                timer: 3000,
            });
        </script>
    @endif
@endsection
