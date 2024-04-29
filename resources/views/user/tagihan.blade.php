@extends('layouts.app')
@section('container')
@include('layouts.navbar')
<div class="flex-col justify-center items-center w-full">
    <div class="flex justify-center items-center">
        <a href="/logout" class="text-blue-500">logout</a>
    </div>
    
    <div class="flex justify-center items-center">
    
        <a type="button" href="/bayar" id="pay-button" class="bg-blue-500">Pay!</a>
        
    </div>
</div>


@endsection