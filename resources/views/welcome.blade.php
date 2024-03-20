@extends('layouts.app')
@section('container')
<h1>
    Selamat Datang {{ $nama }}
</h1>
<a href="/logout" class="text-blue-500">logout</a>
@endsection