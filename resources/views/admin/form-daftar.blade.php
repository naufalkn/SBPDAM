@extends('layouts.app')
@section('container')
<div class="font-sans">
    @include('layouts.navbar-admin')
    <div class="flex relative">
        <!-- NAV -->
        @include('layouts.sidebar')
        <div class="w-full space-y-4">
            <div class="w-full h-56 flex items-center">
                <div class="p-7">
                    <p class="text-neutral-200 text-2xl lg:text-4xl mb-2 font-semibold z-40">Daftar Sambungan Baru</p>
                    <p class="text-neutral-200">Perusahaan Daerah Air Minum Sabupaten Sragen </p>
                </div>
                <div class="overflow-hidden bg-blue-600 -z-10 h-56 absolute top-0 left-0 w-full">
                    <div class="w-[2400px] h-[2400px] rounded-full bg-blue-500 absolute -left-96 -top-40"
                        style="box-shadow: 24px 32px 184px 24px rgba(6, 8, 89, 0.75) inset;">
                    </div>
                    <div class="w-[1600px] h-[1600px] rounded-full bg-blue-500 absolute -left-48 top-8"
                        style="box-shadow: 24px 32px 184px 24px rgba(6, 8, 89, 0.75) inset;">
                    </div>
                    <div class="w-[800px] h-[800px] rounded-full bg-blue-500 absolute left-48 top-40"
                        style="box-shadow: 24px 32px 184px 24px rgba(6, 8, 89, 0.75) inset;">
                    </div>
                </div>
                
            </div>
            <div class="w-full space-y-5">
                {{-- Form --}}
                <div class="">
                    <form id="prosesManual" action="{{ url('/prosesManual') }}" method="POST" class="space-y-4">
                        @csrf
                        <div class="w-11/12">
                            <div class="space-y-4">
                                <p class="font-bold text-xl text-green-600" >Data Diri Pelanggan</p>
                                <div class="flex space-x-4">
                                    <div class="w-1/2">
                                        <label for="base-input" class="block mb-2 font-medium text-gray-900 dark:text-white">Nama Lengkap</label>
                                        <input type="text" name="nama" id="base-input" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                    </div>
                                    <div class="w-1/2">
                                        <label for="base-input" class="block mb-2 font-medium text-gray-900 dark:text-white">Pekerjaan</label>
                                        <input type="text" name="pekerjaan" id="base-input" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                    </div>
                                </div>
                                <div class="flex space-x-4">
                                    <div class="w-1/2">
                                        <label for="base-input" class="block mb-2 font-medium text-gray-900 dark:text-white">No. KTP / SIM</label>
                                        <input type="number" name="no_identitas" id="base-input" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                    </div>
                                    <div class="w-1/2">
                                        <label for="base-input" class="block mb-2 font-medium text-gray-900 dark:text-white">No. Telepon</label>
                                        <input type="number" name="no_telepon" id="base-input" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                    </div>
                                </div>
                                <p class="font-bold text-xl text-green-600">Alamat Pelanggan</p>
                                <div class="flex space-x-4">
                                    <div class="w-3/5">
                                        <label for="base-input" class="block mb-2 font-medium text-gray-900 dark:text-white">Dukuh / Kampung</label>
                                        {{-- <input type="text" id="base-input" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"> --}}
                                        <select name="dukuh" id="dukuh" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                            @foreach($dukuhList as $item)
                                                <option value="{{ $item->nmdukuh }}">{{ $item->nmdukuh }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="w-1/5">
                                        <label for="base-input" class="block mb-2 font-medium text-gray-900 dark:text-white">RT</label>
                                        <input type="number" name="rt" id="base-input" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                    </div>
                                    <div class="w-1/5">
                                        <label for="base-input" class="block mb-2 font-medium text-gray-900 dark:text-white">RW</label>
                                        <input type="number" name="rw" id="base-input" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                    </div>
                                </div>
                                <div class="flex space-x-4">
                                    <div class="w-1/2">
                                        <label for="base-input" class="block mb-2 font-medium text-gray-900 dark:text-white">Desa / Kelurahan</label>
                                        {{-- <input type="text" id="base-input" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"> --}}
                                        <select name="kelurahan" id="desa">
                                            @foreach($desaList as $item)
                                                <option value="{{ $item->nmdesa }}">{{ $item->nmdesa }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="w-1/2">
                                        <label for="base-input" class="block mb-2 font-medium text-gray-900 dark:text-white">Kode Pos</label>
                                        <input type="number" name="kode_pos" id="base-input" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                    </div>
                                </div>
                                <div class="flex space-x-4">
                                    <div class="w-1/2">
                                        <label for="base-input" class="block mb-2 font-medium text-gray-900 dark:text-white">Kecamatan</label>
                                        {{-- <input type="text" id="base-input" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"> --}}
                                        <select name="kecamatan" id="kecamatan">
                                            @foreach($kecamatanList as $item)
                                                <option value="{{ $item->nmkec }}">{{ $item->nmkec }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="w-1/2">
                                        <label for="base-input" class="block mb-2 font-medium text-gray-900 dark:text-white">Unit</label>
                                        <select name="unit" id="unit" class="w-full rounded-xl bg-gray-50 border border-gray-300">
                                            @foreach($unitList as $item)
                                                <option value="{{ $item->nm_unit }}">{{ $item->nm_unit }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="flex space-x-4">
                                    <div class="w-1/2">
                                        <label for="base-input" class="block mb-2 font-medium text-gray-900 dark:text-white">Nama Perusahaan / Jalan</label>
                                        <input type="text" name="nama_jalan" id="base-input" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                    </div>
                                    <div class="w-1/2">
                                        <label for="base-input" class="block mb-2 font-medium text-gray-900 dark:text-white">Jumlah Penghuni</label>
                                        <input type="number" name="jmlh_penghuni" id="base-input" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="flex items-end justify-end w-11/12 pt-10">
                            <button type="submit" value="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Daftar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>