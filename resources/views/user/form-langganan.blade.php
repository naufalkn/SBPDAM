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
                        <h2 id="heading" class="title">Sambungan Baru PERUMDA AIR MINUM TIRTO NEGORO</h2>
                        <h2 id="heading" class="title">Kabupaten Sragen </h2>
                    </div>
                    <form class="msform" id="prosesLangganan" action="{{ url('/prosesLangganan/' . $pelanggan->id) }}" method="POST"
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
                                <p>1. Calon Pelanggan Menginputkan data diri sesuai dengan KTP atau KK</p>
                                <p>2. Calon Pelanggan Menginputkan Alamat tempat yang akan dipasang alat dengan Jelas</p>
                                <p>3. Calon Pelanggan Memilih Unit terdekat dengan tempat yang akan dipasang alat</p>
                                <p>4. Calon Pelanggan Melakukan pengecekan data yang telah diinputkan apakah sudah sesuai atau belum</p>
                                <p>5. Setelah Melakukan Pendaftaran, Calon Pelanggan akan dikenakan biaya sebesar Rp. 23,000.00</p>
                                <p>6. Petugas akan melakukan pengecekan data dan akan melakukan pemasangan, Calon Pelanggan dapat memonitoring memelalui website ini.</p>
                                <p>7. Setelah petugas selesai memasang alat, Calon pelanggan menunggu layanan diaktifkan oleh Unit.</p>
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
                                <input type="text" placeholder="Masukkan Nama Lengkap Anda" name="nama"
                                    value="{{ $pelanggan->nama }}" />

                                <label class="fieldlabels">Email Anda*</label>
                                <input type="email" placeholder="Masukkan Email Anda" name="email"
                                    value="{{ auth()->user()->email }}" readonly />

                                <label class="fieldlabels">Pekerjaan*</label>
                                <input type="text" name="pekerjaan" placeholder="Masukkan Pekerjaan Anda"
                                    value="{{ $pelanggan->pekerjaan }}" />

                                <label class="fieldlabels">No KTP / No SIM*</label>
                                <input type="number" name="no_identitas" placeholder="Masukkan No KTP / No SIM Anda"
                                    value="{{ $pelanggan->no_identitas }}" readonly />

                                <label class="fieldlabels">Nomor Telepon *</label>
                                <input type="number" name="no_telepon" placeholder="Masukkan Nomor Telepon Anda"
                                    value="{{ $pelanggan->no_telepon }}" />
                                <label class="fieldlabels">Foto KTP / KK</label>
                                <input type="file" name="foto_identitas" />

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
                                                name="rt" value="{{ $pelanggan->rt }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="fieldlabels">RW</label>
                                            <input type="number" class="form-control"
                                                placeholder="Masukkan No RW Anda" name="rw"
                                                value="{{ $pelanggan->rw }}">
                                        </div>
                                    </div>
                                </div>
                                <label class="fieldlabels">Desa / Kelurahan*</label>
                                <select name="kelurahan" id="desa" onchange="updateKecamatan(this.value)">
                                    @foreach ($deskec as $item)
                                        <option value="{{ $item->nmdesa }}">{{ $item->nmdesa }}</option>
                                    @endforeach
                                </select>

                                <label class="fieldlabels">Kecamatan*</label>
                                <select name="kecamatan" id="kecamatan" readonly>
                                    @foreach ($deskec as $item)
                                        <option value="{{ $item->nmkec }}">{{ $item->nmkec }}</option>
                                    @endforeach
                                </select>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="fieldlabels">Kode Pos</label>
                                            <input type="number" class="form-control"
                                                placeholder="Masukkan No Kode Pos Anda" name="kode_pos"
                                                value="{{ $pelanggan->kode_pos }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="fieldlabels">Jumlah Penghuni</label>
                                            <input type="number" class="form-control"
                                                placeholder="Masukkan Jumlah Penghuni " name="jmlh_penghuni"
                                                value="{{ $pelanggan->jmlh_penghuni }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label class="fieldlabels">Nama Perumahan / Jalan*</label>
                                        <input type="text" name="nama_jalan"
                                            placeholder="Masukkan Nama Perumahan / Jalan Anda" name="nama_jalan"
                                            class="form-control" value="{{ $pelanggan->nama_jalan }}" />
                                    </div>
                                    <div class="col-md-6 d-flex">
                                        <!-- Isi dengan input fields atau elemen form lainnya -->
                                        <div class="form-group">
                                            <div class="multi-form">
                                                <div class="w-50">
                                                    <label class="fieldlabels">Unit</label>
                                                    <select name="nm_unit" id="nm_unit"
                                                        class="form-control select2">
                                                        @foreach ($unitList as $item)
                                                            <option value="{{ $item->nm_unit }}"
                                                                data-kd-unit="{{ $item->kd_unit }}">
                                                                {{ $item->nm_unit }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="w-50">
                                                    <label class="fieldlabels">Kode Unit</label>
                                                    <select name="kd_unit" id="kd_unit"
                                                        class="form-control select2" readonly>
                                                        @foreach ($unitList as $item)
                                                            <option value="{{ $item->kd_unit }}">{{ $item->kd_unit }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <label class="fieldlabels">Apakah Di dekat Anda ada yang sudah berlangganan ?</label>
                                <div class="checkbox-team">
                                    <div class="checkbox-group">
                                        <input type="radio" id="iya" name="choice" value="true"
                                            onchange="toggleFormFields()">
                                        <label for="iya">Iya</label>
                                    </div>
                                    <div class="checkbox-group">
                                        <input type="radio" id="tidak" name="choice" value="false"
                                            onchange="toggleFormFields()">
                                        <label for="tidak">Tidak</label>
                                    </div>
                                </div>
                                <div id="additional-fields" style="display: none; margin-bottom:0%;">
                                    <div class="row">
                                        <div class="col-md">
                                            <div class="">
                                                <label class="fieldlabels" for="nomor_sambungan">Nomor
                                                    Sambungan</label>
                                                <input type="number" id="no_sambungan" name="no_sambungan"
                                                    placeholder="Masukkan Nomor Sambungan Terdekat"
                                                    value="{{ $pelanggan->no_sambungan }}">
                                                @error('no_sambungan')
                                                    <div>{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md">
                                            <div class="">
                                                <label class="fieldlabels" for="nama">Nama</label>
                                                <input type="text" id="nm_sambungan" name="nm_sambungan"
                                                    placeholder="Masukkkan Nama Sambungan"
                                                    value="{{ $pelanggan->nm_sambungan }}">
                                                @error('nm_sambungan')
                                                    <div>{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <label class="fieldlabels">Foto Rumah</label>
                                <input type="file" name="foto_rumah" />
                            </div>
                            <input type="button" name="next" class="next action-button" value="Next" />
                            <input type="button" name="previous" class="previous action-button-previous"
                                value="Previous" />
                        </fieldset>

                        {{-- Step 4  --}}
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
                                        <div class="col-md-6">
                                            <label class="label">Unit</label>
                                            <div class="double-detail">
                                                <p class="text" id="unitPelanggan"></p>
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
                                        <div class="col-md-6">
                                            <label class="label">Nomor Sambungan / Nama Sambungan sekitar</label>
                                            <div class="double-detail">
                                                <p class="text" id="keteranganPelanggan"></p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label class="label">Foto Identitas</label>
                                            <div class="double-detail">
                                                <img id="uploadedIdentitas" src="" alt="Uploaded Logo"
                                                    width="200px">
                                            </div>
                                        </div>
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
    <script>
        function updateKecamatan(selectedDesa) {
            var kecamatanSelect = document.getElementById('kecamatan');
            var deskec = @json($deskec);

            // Loop through deskec to find the matching kecamatan for the selected desa
            for (var i = 0; i < deskec.length; i++) {
                if (deskec[i].nmdesa === selectedDesa) {
                    // Update the value of kecamatan select with the matching kecamatan
                    kecamatanSelect.value = deskec[i].nmkec;
                    break;
                }
            }
        }
    </script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            // Saat pemilihan unit berubah
            $('#nm_unit').change(function() {
                var selectedUnit = $(this).find(':selected');
                var kodeUnit = selectedUnit.data('kd-unit');
                // Set nilai kode unit sesuai dengan data yang tersimpan pada atribut data-kd-unit
                $('#kd_unit').val(kodeUnit);
            });

            // Inisialisasi plugin Select2
            $('.select2').select2();
        });
    </script>

    <script>
        function toggleFormFields() {
            var iyaChecked = document.getElementById('iya').checked;
            var additionalFields = document.getElementById('additional-fields');

            if (iyaChecked) {
                additionalFields.style.display = 'block';
            } else {
                additionalFields.style.display = 'none';
            }
        }

        window.onload = function() {
            toggleFormFields(); // Initialize the form fields visibility on page load
        }
    </script>
</body>

</html>
