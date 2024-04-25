<!DOCTYPE html>
<html>

<head>
    <title>Judul</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/css/bootstrap.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>

<body class="container">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-11 col-sm-10 col-md-10 col-lg-12 text-center p-0 mt-3 mb-2">
                <div class="card p-4 mt-3 mb-3">
                    <div class="img">
                        <img src="{{ url('img/pdam.png') }}" alt="Logo" width="75px" height="100px" />
                        <h2 id="heading">Sambungan Baru PDAM Sragen</h2>
                    </div>
                    <form class="msform" id="prosesDaftar" action="{{ url('/prosesDaftar') }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        <!-- progressbar -->
                        <div class="d-flex justify-content-center">
                            <ul id="progressbar" class="">
                                <li class="active" id="account">
                                    <strong>Informasi</strong>
                                </li>
                                <li id="personal">
                                    <strong>Data diri (Pribadi)</strong>
                                </li>
                                <li id="payment">
                                    <strong>Alamat</strong>
                                </li>
                                <li id="confirm"><strong>Final</strong></li>
                            </ul>
                        </div>
                        <div class="progress">
                            <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar"
                                aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <br />
                        <!-- fieldsets -->
                        <fieldset>
                            <div class="form-card">
                                <div class="row">
                                    <div class="col-7">
                                        <h2 class="fs-title">
                                            Informasi Dan Persyaratan
                                        </h2>
                                    </div>
                                </div>
                            </div>
                            <input type="button" name="next" class="next action-button" value="Next" />
                        </fieldset>
                        <fieldset>
                            <div class="form-card">
                                <div class="row">
                                    <div class="col-7">
                                        <h2 class="fs-title">
                                            Data Diri
                                        </h2>
                                    </div>
                                </div>
                                <label class="fieldlabels">Nama Lengkap*</label>
                                <input type="text" placeholder="Masukkan Nama Lengkap Anda" name="nama" />

                                <label class="fieldlabels">Email Anda*</label>
                                <input type="email" placeholder="Masukkan Email Anda" name="email"
                                    value="{{ auth()->user()->email }}" />

                                <label class="fieldlabels">Pekerjaan*</label>
                                <input type="text" name="pekerjaan" placeholder="Masukkan Pekerjaan Anda" />

                                <label class="fieldlabels">No KTP / No SIM*</label>
                                <input type="number" name="no_identitas" placeholder="Masukkan No KTP / No SIM Anda" />

                                <label class="fieldlabels">Nomor Telepon *</label>
                                <input type="number" name="no_telepon" placeholder="Masukkan Nomor Telepon Anda" />
                            </div>
                            <input type="button" name="next" class="next action-button" value="Next" />
                            <input type="button" name="previous" class="previous action-button-previous"
                                value="Previous" />
                        </fieldset>
                        <fieldset>
                            <div class="form-card">
                                <div class="row">
                                    <div class="col-7">
                                        <h2 class="fs-title">
                                            Detail Alamat
                                        </h2>
                                    </div>
                                </div>
                                <label class="fieldlabels" for="dukuh">Dukuh / Kampung*</label>
                                {{-- <input type="text" placeholder="Masukkan Dukuh / Kampung Anda" name="dukuh" class="form-control" /> --}}
                                <select name="dukuh" id="dukuh">
                                    @foreach ($dukuhList as $item)
                                        <option value="{{ $item->nmdukuh }}">{{ $item->nmdukuh }}</option>
                                    @endforeach
                                </select>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="fieldlabels">RT</label>
                                            <input type="number" class="form-control" placeholder="Masukkan No RT Anda"
                                                name="rt">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="fieldlabels">RW</label>
                                            <input type="number" class="form-control" placeholder="Masukkan No RW Anda"
                                                name="rw">
                                        </div>
                                    </div>
                                </div>
                                <label class="fieldlabels">Desa / Kelurahan*</label>
                                <select name="kelurahan" id="desa">
                                    @foreach ($desaList as $item)
                                        <option value="{{ $item->nmdesa }}">{{ $item->nmdesa }}</option>
                                    @endforeach
                                </select>
                                <label class="fieldlabels">Kecamatan*</label>
                                {{-- <input type="text" placeholder="Masukkan Kecamatan Anda" name="kecamatan" class="form-control" /> --}}
                                <select name="kecamatan" id="kecamatan">
                                    @foreach ($kecamatanList as $item)
                                        <option value="{{ $item->nmkec }}">{{ $item->nmkec }}</option>
                                    @endforeach
                                </select>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="fieldlabels">Kode Pos</label>
                                            <input type="number" class="form-control"
                                                placeholder="Masukkan No Kode Pos Anda" name="kode_pos">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="fieldlabels">Jumlah Penghuni</label>
                                            <input type="number" class="form-control"
                                                placeholder="Masukkan Jumlah Penghuni " name="jmlh_penghuni">
                                        </div>
                                    </div>
                                </div>
                                <label class="fieldlabels">Nama Perumahan / Jalan*</label>
                                <input type="text" placeholder="Masukkan Nama Perumahan / Jalan Anda"
                                    name="nama_jalan" class="form-control" />
                                <label class="fieldlabels">Foto Rumah</label>
                                <input type="file" name="foto_rumah" />
                            </div>
                            <input type="button" name="next" class="next action-button" value="Next" />
                            {{-- <input type="submit" name="next" class="next action-button" value="submit" /> --}}
                            <input type="button" name="previous" class="previous action-button-previous"
                                value="Previous" />
                        </fieldset>
                        <fieldset>
                            <div class="form-card">
                                <div class="row">
                                    <div class="col-7">
                                        <h2 class="fs-title">Validasi</h2>
                                    </div>
                                </div>
                                <div class="">
                                    <p class="fs-subtitle"> Data Diri</p>
                                    <div class="row ">
                                        <div class="col-md-6">
                                            <label class="label">Nama Lengkap</label>
                                            <p class="text" id="namaLengkap"></p>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="label">Email</label>
                                            <p class="text" id="emailPelanggan"></p>
                                        </div>
                                    </div>
                                    <div class="row ">
                                        <div class="col-md-6">
                                            <label class="label">Pekerjaan</label>
                                            <p class="text" id="pekerjaanPelanggan"></p>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="label">No KTP / SIM</label>
                                            <p class="text" id="no_identitasPelanggan"></p>
                                        </div>
                                    </div>
                                    <div class="row ">
                                        <div class="col-md-6">
                                            <label class="label">Nomor Telepon</label>
                                            <p class="text" id="no_teleponPelanggan"></p>
                                        </div>
                                        <div class="col-md-6">
                                        </div>
                                    </div>
                                </div>
                                <div class="">
                                    <p class="fs-subtitle"> Alamat </p>
                                    <div class="row ">
                                        <div class="col-md-6">
                                            <label class="label">Dukuh / Kampung</label>
                                            <p class="text" id="dukuhPelanggan"></p>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="label">RT / RW</label>
                                            <div class="double-detail">
                                                <p class="text" id="rtPelanggan"></p>
                                                <p>/</p>
                                                <p class="text" id="rwPelanggan"></p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row ">
                                        <div class="col-md-6">
                                            <label class="label">Desa / Kelurahan</label>
                                            <p class="text" id="desaPelanggan"></p>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="label">Kecamatan</label>
                                            <div class="double-detail">
                                                <p class="text" id="kecamatanPelanggan"></p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row ">
                                        <div class="col-md-6">
                                            <label class="label">Nama Perumahan / Jalan</label>
                                            <p class="text" id="jalanPelanggan"></p>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="label">Jumlah Penghuni</label>
                                            <div class="double-detail">
                                                <p class="text" id="jumlahPenghuni"></p>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="label">Kode Pos</label>
                                            <div class="double-detail">
                                                <p class="text" id="posPelanggan"></p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label class="label">Foto Rumah</label>
                                            <div class="double-detail">
                                                <img id="uploadedRumah" src="" alt="Uploaded Logo"
                                                    width="200px">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <input type="submit" name="submit" class="next action-button" value="Submit" />
                            <input type="button" name="previous" class="previous action-button-previous"
                                value="Previous" />
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('js/script.js') }}"></script>
</body>

</html>
