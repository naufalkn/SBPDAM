@extends('layouts.app')
@section('container')
    <form class="msform" id="prosesDaftar" action="{{ url('/prosesDaftar') }}" method="POST">
        @csrf
        <label class="">Nama Lengkap*</label>
        <input type="text" placeholder="Masukkan Nama Lengkap Anda" name="nama" />

        <label class="">Pekerjaan*</label>
        <input type="text" name="pekerjaan" placeholder="Masukkan Pekerjaan Anda" />

        <label class="">No KTP / No SIM*</label>
        <input type="number" name="no_identitas" placeholder="Masukkan No KTP / No SIM Anda" />

        <label class="">Nomor Telepon *</label>
        <input type="number" name="no_telepon" placeholder="Masukkan Nomor Telepon Anda" />
        <label class="">Dukuh / Kampung*</label>
        <input type="text" placeholder="Masukkan Dukuh / Kampung Anda" name="dukuh" class="form-control" />
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label class="">RT</label>
                    <input type="number" class="form-control" placeholder="Masukkan No RT Anda" name="rt">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label class="">RW</label>
                    <input type="number" class="form-control" placeholder="Masukkan No RW Anda" name="rw">
                </div>
            </div>
        </div>
        <label class="">Desa / Kelurahan*</label>
        <input type="text" placeholder="Masukkan Desa / Kelurahan Anda" name="kelurahan" class="form-control" />
        <label class="">Kecamatan*</label>
        <input type="text" placeholder="Masukkan Kecamatan Anda" name="kecamatan" class="form-control" />
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label class="">Kode Pos</label>
                    <input type="number" class="form-control" placeholder="Masukkan No Kode Pos Anda" name="kode_pos">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label class="">Jumlah Penghuni</label>
                    <input type="number" class="form-control" placeholder="Masukkan Jumlah Penghuni " name="jmlh_penghuni">
                </div>
            </div>
        </div>
        <label class="">Nama Perumahan / Jalan*</label>
        <input type="text" placeholder="Masukkan Nama Perumahan / Jalan Anda" name="nama_jalan" class="form-control" />
        <button type="submit" name="next" class="next action-button" value="submit" />yuk</button>

    </form>
@endsection
