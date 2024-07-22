@extends('layouts.app')
@section('container')
    @include('layouts.navbar')
    <div class="p-8">
        <div class="">
            <p class="font-semibold text-xl text-blue-600 mb-6">Data Diri Pelanggan</p>
            <div class="ml-5">
                <div class="grid gap-4 mb-4 grid-cols-2">
                    <div class="col-span-1">
                        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama
                            Lengkap</label>
                       <p class="ml-2 font-semibold">{{ $pelanggan->nama }}</p>
                    </div>
                    <div class="col-span-2 sm:col-span-1">
                        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">No KTP / SIM</label>
                        <p class="ml-2 font-semibold">{{ $pelanggan->no_identitas }}</p>
                        
                    </div>
                </div>
                <div class="grid gap-4 mb-4 grid-cols-2">
                    <div class="col-span-1">
                        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nomor
                            Telepon</label>
                            <p class="ml-2 font-semibold">{{ $pelanggan->no_telepon }}</p>
                    </div>
                    <div class="col-span-2 sm:col-span-1">
                        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Unit</label>
                        <p class="ml-2 font-semibold">{{ $pelanggan->nm_unit }}</p>
                    </div>
                </div>
                <div class="grid gap-4 mb-4 grid-cols-2">
                    <div class="col-span-1">
                        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Alamat</label>
                        <p class="ml-2 font-semibold">{{ $pelanggan->dukuh }}, {{ $pelanggan->rt }}, {{ $pelanggan->rw }} , {{ $pelanggan->kelurahan }},  {{ $pelanggan->kecamatan }}</p>
                    </div>
                    <div class="col-span-2 sm:col-span-1">
                        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Tanggal Daftar</label>
                        <p class="ml-2 font-semibold">{{ $pelanggan->tgl_daftar }}</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="">
            <p class="font-semibold text-xl text-blue-600 mb-6">Tagihan</p>
            <div class="ml-5">
                <div class="grid gap-4 mb-4 grid-cols-2">
                    <div class="col-span-1">
                        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Jenis
                            Tagihan</label>
                        <p class="ml-2 font-semibold">Biaya Pendaftaran</p>
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
            onSuccess: function(result){
            // Redirect to the profile page after successful payment
            window.location.href = "{{ url('beranda') }}";
        },
        onPending: function(result){
            // Optional: Handle the pending status
            document.getElementById('result-json').innerHTML += JSON.stringify(result, null, 2);
        },
        onError: function(result){
            // Optional: Handle the error status
            document.getElementById('result-json').innerHTML += JSON.stringify(result, null, 2);
        }
        //   Optional
        //   onSuccess: function(result){
        //     alert('success')
        //     /* You may add your own js here, this is just example */ document.getElementById('result-json').innerHTML += JSON.stringify(result, null, 2);
        //   },
        //   // Optional
        //   onPending: function(result){
        //     /* You may add your own js here, this is just example */ document.getElementById('result-json').innerHTML += JSON.stringify(result, null, 2);
        //   },
        //   // Optional
        //   onError: function(result){
        //     /* You may add your own js here, this is just example */ document.getElementById('result-json').innerHTML += JSON.stringify(result, null, 2);
        //   }
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
