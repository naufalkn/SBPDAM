@extends('layouts.app')
@section('container')
    @include('layouts.navbar')
    <div class="p-8">
        <div class="">
            <p class="font-semibold text-xl text-blue-600 mb-6">Data Diri Pelanggan</p>
            <div class="grid gap-4 mb-4 grid-cols-2">
                <div class="col-span-1">
                    <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama
                        Lengkap</label>
                    <input type="text" name="nama" id="nama"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5"
                        placeholder="Masukkan Nama Lengkap" value="{{ $pelanggan->nama }} "readonly>
                </div>
                <div class="col-span-2 sm:col-span-1">
                    <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Alamat</label>
                    <input type="text" name="pekerjaan" id="pekerjaan"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5"
                        placeholder="Masukkan Pekerjaan"
                        value="{{ $pelanggan->dukuh }}, {{ $pelanggan->rt }}, {{ $pelanggan->rw }} , {{ $pelanggan->kelurahan }},  {{ $pelanggan->kecamatan }}"readonly>
                </div>
            </div>
            <div class="grid gap-4 mb-4 grid-cols-2">
                <div class="col-span-1">
                    <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nomor
                        Telepon</label>
                    <input type="number" name="no_telepon" id="no_telepon"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5"
                        placeholder="Masukkan Nama Lengkap" value="{{ $pelanggan->no_telepon }}" readonly>
                </div>
                <div class="col-span-2 sm:col-span-1">
                    <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Unit</label>
                    <input type="text" name="unit" id="unit"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5"
                        placeholder="Masukkan Nama Lengkap" value="{{ $pelanggan->no_identitas }}" readonly>
                </div>
            </div>
            <div class="grid gap-4 mb-4 grid-cols-2">
                <div class="col-span-1">
                    <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nomor
                        Telepon</label>
                    <input type="text" name="no_telepon" id="no_telepon"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5"
                        placeholder="Masukkan Nama Lengkap" value="{{ $pelanggan->email }}" readonly>
                </div>
                <div class="col-span-2 sm:col-span-1">
                    <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Unit</label>
                    <input type="text" name="unit" id="unit"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5"
                        placeholder="Masukkan Nama Lengkap" value="{{ $pelanggan->nm_unit }}" readonly>
                </div>
            </div>
        </div>
        <div class="">
            <p class="font-semibold text-xl text-blue-600 mb-6">Tagihan</p>
            <div class="grid gap-4 mb-4 grid-cols-2">
                <div class="col-span-1">
                    <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Jenis
                        Tagihan</label>
                    <input type="text" name="nama" id="nama"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5"
                        placeholder="Biaya Pendaftaran" readonly>
                </div>
            </div>
            <div class="grid gap-4 mb-4 grid-cols-2">
                <div class="col-span-1">
                    <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Total
                        Biaya</label>
                    <input type="text" name="desa" id="desa"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5"
                        placeholder="Rp. 23,000" readonly>
                </div>
            </div>
        </div>
        <div class="w-full flex">
          <div class="flex justify-center items-center bg-blue-500 rounded-md p-3">
              {{-- <a href="/bayar" class="bg-blue-500 py-2 px-4  text-white">Bayar!</a> --}}
              <button class="text-white" id="pay-button">Bayar Sekarang</button>
          </div>
      </div>
    </div>
    <!-- TODO: Remove ".sandbox" from script src URL for production environment. Also input your client key in "data-client-key" -->
    <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="SB-Mid-client-BXLEEZ72SVd8NAkL"></script>
    <script type="text/javascript">
      document.getElementById('pay-button').onclick = function(){
        // SnapToken acquired from previous step
        snap.pay('{{ $bayar->snap_token }}', {
          // Optional
          // onSuccess: function(result){
          //   alert('success')
          //   /* You may add your own js here, this is just example */ document.getElementById('result-json').innerHTML += JSON.stringify(result, null, 2);
          // },
          // // Optional
          // onPending: function(result){
          //   /* You may add your own js here, this is just example */ document.getElementById('result-json').innerHTML += JSON.stringify(result, null, 2);
          // },
          // // Optional
          // onError: function(result){
          //   /* You may add your own js here, this is just example */ document.getElementById('result-json').innerHTML += JSON.stringify(result, null, 2);
          // }
        });
      };
    </script>




{{-- Backup --}}

    {{-- <div class="flex-col justify-center items-center w-full">
    <button id="pay-button">Pay!</button>
    <pre><div id="result-json">JSON result will appear here after payment:<br></div></pre> 

<!-- TODO: Remove ".sandbox" from script src URL for production environment. Also input your client key in "data-client-key" -->
    <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="SB-Mid-client-BXLEEZ72SVd8NAkL"></script>
    <script type="text/javascript">
      document.getElementById('pay-button').onclick = function(){
        // SnapToken acquired from previous step
        snap.pay('{{ $bayar->snap_token }}', {
          // Optional
          // onSuccess: function(result){
          //   alert('success')
          //   /* You may add your own js here, this is just example */ document.getElementById('result-json').innerHTML += JSON.stringify(result, null, 2);
          // },
          // // Optional
          // onPending: function(result){
          //   /* You may add your own js here, this is just example */ document.getElementById('result-json').innerHTML += JSON.stringify(result, null, 2);
          // },
          // // Optional
          // onError: function(result){
          //   /* You may add your own js here, this is just example */ document.getElementById('result-json').innerHTML += JSON.stringify(result, null, 2);
          // }
        });
      };
    </script>
</div> --}}
@endsection
