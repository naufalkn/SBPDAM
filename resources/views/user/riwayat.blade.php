@extends('layouts.app')
@section('container')
@include('layouts.navbar')
<div class=""></div>
<h1>
    Selamat Datang {{ $nama }}
</h1>
<h1>Halaman riwayat</h1>
<a href="/logout" class="text-blue-500">logout</a>
@endsection