@extends('layouts.app')
@section('container')
@include('layouts.navbar')
<div class">
    <h1>
        Selamat Datang {{ $nama }}
    </h1>
    <h1>Halaman beranda</h1>
    <a href="/logout" class="text-blue-500">logout</a>
</div>

@endsection