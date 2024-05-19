@extends('layouts.app')
@section('container')
@include('layouts.navbar')
<div class="flex-col justify-center items-center w-full">
    <div class="flex justify-center items-center">
        <a href="/logout" class="text-blue-500">Logout</a>
    </div>
    @if (!auth()->user()->pelanggan || !auth()->user()->pelanggan->id)
    <p>Belum ada tagihan</p>
@elseif (App\Models\Transaksi::where('pelanggan_id', auth()->user()->pelanggan->id)->exists())
    <p>Sudah dibayar</p>
@else
    <div class="flex justify-center items-center">
        <a href="/bayar" class="bg-blue-500 py-2 px-4 rounded-md text-white">Bayar!</a>
    </div>
@endif


</div>

@endsection