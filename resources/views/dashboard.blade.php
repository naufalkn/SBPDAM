@extends('layouts.app')
@section('container')
ini dashboard admin
<a href="/logout" class="text-blue-500">logout</a>
<div class="">
    <div class="">
        <h4>List Pelanggan</h4>
    </div>

    <div class="">
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>No telp</th>
                    <th>Kelurahan</th>
                    <th>Kecamatan</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($pelanggan as $item)
                <tr>
                    <td>{{ $item->id }}</td>
                    <td>{{ $item->nama }}</td>
                    <td>{{ $item->no_telepon }}</td>
                    <td>{{ $item->kelurahan }}</td>
                    <td>{{ $item->kecamatan }}</td>
                </tr>
                @empty
                    <tr>
                        <td>Belum ada Pelanggan</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

</div>
@endsection