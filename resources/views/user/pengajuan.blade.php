@extends('layouts.app')
@section('container')
    <div class="bg-gray-100 w-full h-screen">
        <form action="{{ url('/mulai-pengajuan', ['id' => $user->id]) }}" method="POST">
            @csrf
            <div class="p-6 mb-9 text-medium text-gray-500 dark:text-gray-400 dark:bg-gray-800 rounded-lg w-full "
                id="profile" role="tabpanel" aria-labelledby="profile-tab">
                <div class="space-y-4">
                    <div class="flex ">
                        <img class="w-36 h-32 mb-3 rounded-full shadow-lg" src="{{ asset('img/' . auth()->user()->foto) }}"
                            alt="" />
                        <div class="p-2 flex-col items-center">
                            <p class="font-semibold text-black">{{ $user->pelanggan->nama }}</p>
                            <p>Berlangganan</p>
                        </div>
                    </div>
                    <div class="grid gap-4 mb-4 grid-cols-2">
                        <div class="">
                            <label class="block mb-2 text-sm font-medium dark:text-white">Nama Lengkap</label>
                            <p class="text-xl text-black ">{{ $user->pelanggan->nama }}</p>
                        </div>
                        <div class="">
                            <label class="block mb-2 text-sm font-medium dark:text-white">No Identitas</label>
                            <p class="text-xl text-black ">{{ $user->pelanggan->no_identitas }}</p>
                        </div>
                        <div class="">
                            <label class="block mb-2 text-sm font-medium dark:text-white">Unit</label>
                            <p class="text-xl text-black ">{{ $user->pelanggan->nm_unit }}</p>
                        </div>
                        <div class="">
                            <label class="block mb-2 text-sm font-medium dark:text-white">Alamat</label>
                            <p class="text-xl text-black ">{{ $user->pelanggan->dukuh }}, Rt.{{ $user->pelanggan->rt }},
                                Rw.{{ $user->pelanggan->rw }}, {{ $user->pelanggan->kecamatan }},
                                {{ $user->pelanggan->kelurahan }}</p>
                        </div>
                        <div class="">
                            <label class="block mb-2 text-sm font-medium dark:text-white">Tanggal Daftar</label>
                            <p class="text-xl text-black ">{{ $user->pelanggan->tgl_daftar }}</p>
                        </div>
                        <div class="">
                            <label class="block mb-2 text-sm font-medium dark:text-white">Berlangganan Sejak</label>
                            <p class="text-xl text-black ">{{ $user->pelanggan->tgl_aktif }}</p>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="alasan">Pilih Alasan:</label><br>
                        <input type="radio" id="alasan1" name="alasan" value="Harga terlalu mahal">
                        <label for="alasan1">Harga terlalu mahal</label><br>

                        <input type="radio" id="alasan2" name="alasan" value="Layanan tidak memuaskan">
                        <label for="alasan2">Layanan tidak memuaskan</label><br>

                        <input type="radio" id="alasan3" name="alasan" value="Pindah ke layanan lain">
                        <label for="alasan3">Pindah ke layanan lain</label><br>

                        <input type="radio" id="alasan4" name="alasan" value="lainnya">
                        <label for="alasan4">Lainnya</label><br>
                    </div>

                    {{-- <div class="form-group" id="alasan_lainnya" style="display: none;">
                        <label for="alasan_text">Tuliskan alasan Anda:</label>
                        <input type="text" id="alasan_text" name="alasan_text" class="form-control">
                    </div> --}}
                    <div class="w-full" id="alasan_lainnya" style="display: none;">
                        <label for="alasan_text" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Masukkan Alasan Pengajuan</label>
                        <textarea type="text" id="alasan_text" name="alasan_text" rows="4"
                            class="block p-2.5 w-[500px] text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            placeholder="Leave a comment..."></textarea>
                    </div>
                    <div class="w-full justify-end flex">
                        <button type="submit"
                            class="text-white inline-flex items-center bg-red-600 hover:bg-red-700 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                            Ajukan
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var alasanRadios = document.querySelectorAll('input[name="alasan"]');
            var alasanLainnyaDiv = document.getElementById('alasan_lainnya');
            alasanRadios.forEach(function(radio) {
                radio.addEventListener('change', function() {
                    if (radio.value === 'lainnya') {
                        alasanLainnyaDiv.style.display = 'block';
                        document.getElementById('alasan_text').name = 'alasan';
                    } else {
                        alasanLainnyaDiv.style.display = 'none';
                        document.getElementById('alasan_text').name = 'alasan_text';
                    }
                });
            });
        });
    </script>
@endsection
