<!DOCTYPE html>
<html>

<head>
    <title>Judul</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/css/bootstrap.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <link rel="stylesheet" href="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.css" />
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
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
                                <p>1. Calon Pelanggan Menginputkan data diri sesuai dengan KTP atau KK</p>
                                <p>2. Calon Pelanggan Menginputkan Alamat tempat yang akan dipasang alat dengan Jelas
                                </p>
                                <p>3. Calon Pelanggan Memilih Unit terdekat dengan tempat yang akan dipasang alat</p>
                                <p>4. Calon Pelanggan Melakukan pengecekan data yang telah diinputkan apakah sudah
                                    sesuai atau belum</p>
                                <p>5. Setelah Melakukan Pendaftaran, Calon Pelanggan akan dikenakan biaya sebesar Rp.
                                    23,000.00</p>
                                <p>6. Petugas akan melakukan pengecekan data dan akan melakukan pemasangan, Calon
                                    Pelanggan dapat memonitoring memelalui website ini.</p>
                                <p>7. Setelah petugas selesai memasang alat, Calon pelanggan menunggu layanan diaktifkan
                                    oleh Unit.</p>
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
                                    value="{{ auth()->user()->nama }}" readonly />

                                <label class="fieldlabels">Email Anda*</label>
                                <input type="email" placeholder="Masukkan Email Anda" name="email"
                                    value="{{ auth()->user()->email }}" readonly />

                                <label class="fieldlabels">Pekerjaan*</label>
                                <input type="text" name="pekerjaan" placeholder="Masukkan Pekerjaan Anda" />

                                <label class="fieldlabels">No KTP / No SIM*</label>
                                <input type="number" name="no_identitas" placeholder="Masukkan No KTP / No SIM Anda" />

                                <label class="fieldlabels">Nomor Telepon *</label>
                                <input type="number" name="no_telepon" placeholder="Masukkan Nomor Telepon Anda" />
                                <label class="fieldlabels">Foto KTP / KK*</label>
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
                                <div>
                                    <label class="fieldlabels" for="kecamatan">Kecamatan</label>
                                    <select name="kecamatan" id="kecamatan">
                                        <option value="">Pilih Kecamatan</option>
                                        @foreach($kecamatan as $item)
                                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div>
                                    <label class="fieldlabels" for="desa">Desa</label>
                                    <select name="desa" id="desa">
                                        <option value="">Pilih Desa</option>
                                    </select>
                                </div>
                                
                                <div class="form-group">
                                    <label class="fieldlabels" for="dukuh">Dukuh / Kampung*</label>
                                    <select id="state" name="dukuh" class="js-example-basic-single" name="state" style=" width: 100%; height: 100%;">
                                        @foreach ($dukuhList as $item)
                                        <option value="{{ $item->id }}">{{ $item->nmdukuh }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="fieldlabels">RT*</label>
                                            <input type="number" class="form-control"
                                                placeholder="Masukkan No RT Anda" name="rt">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="fieldlabels">RW*</label>
                                            <input type="number" class="form-control"
                                                placeholder="Masukkan No RW Anda" name="rw">
                                        </div>
                                    </div>
                                </div>
                                               
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="fieldlabels">Kode Pos*</label>
                                            <input type="number" class="form-control"
                                                placeholder="Masukkan No Kode Pos Anda" name="kode_pos">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="fieldlabels">Jumlah Penghuni*</label>
                                            <input type="number" class="form-control"
                                                placeholder="Masukkan Jumlah Penghuni " name="jmlh_penghuni">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label class="fieldlabels">Nama Perumahan / Jalan*</label>
                                        <input type="text" name="nama_jalan"
                                            placeholder="Masukkan Nama Perumahan / Jalan Anda" name="nama_jalan"
                                            class="form-control" />
                                    </div>
                                    <div class="col-md-6 d-flex">
                                        <!-- Isi dengan input fields atau elemen form lainnya -->
                                        <div class="form-group">
                                            <div class="multi-form">
                                                <div class="w-50">
                                                    <label class="fieldlabels">Unit*</label>
                                                    <select name="nm_unit" id="nm_unit"
                                                        onchange="updateUnit(this.value)"
                                                        class="form-control select2">
                                                        <option value="">Pilih Unit Terdekat</option>
                                                        @foreach ($unitList as $item)
                                                            <option value="{{ $item->nm_unit }}"
                                                                data-kd-unit="{{ $item->kd_unit }}">
                                                                {{ $item->nm_unit }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="w-50">
                                                    <label class="fieldlabels">Kode Unit*</label>
                                                    <input type="text" name="kd_unit" id="kd_unit" readonly>
                                                    {{-- <select name="kd_unit" id="kd_unit"
                                                        class="form-control select2" readonly>
                                                        @foreach ($unitList as $item)
                                                            <option value="{{ $item->kd_unit }}">{{ $item->kd_unit }}
                                                            </option>
                                                        @endforeach
                                                    </select> --}}
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
                                                    placeholder="Masukkan Nomor Sambungan Terdekat">
                                                @error('no_sambungan')
                                                    <div>{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md">
                                            <div class="">
                                                <label class="fieldlabels" for="nama">Nama</label>
                                                <input type="text" id="nm_sambungan" name="nm_sambungan"
                                                    placeholder="Masukkkan Nama Sambungan">
                                                @error('nm_sambungan')
                                                    <div>{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <label class="fieldlabels">Foto Rumah Anda*</label>
                                <input type="file" name="foto_rumah" />
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="fieldlabels">Latitude</label>
                                            <input type="text" class="form-control" placeholder="-"
                                                name="latitude" id="latitude">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="fieldlabels">Longitude</label>
                                            <input type="text" class="form-control" placeholder="-"
                                                name="longitude" id="longitude">
                                        </div>
                                    </div>
                                </div>
                                <button type="button" id="locationButton" class="btn btn-primary">Pilih Lokasi</button>
                                <div class="map" id="map"></div>
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
                                        <h2 class="fs-title">Finalisasi</h2>
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
    {{-- Autocomplate --}}
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script>
         $(document).ready(function() {
            $('.js-example-basic-single').select2({
                placeholder: "Select a state"
            });

            $('.js-example-basic-single').on('select2:open', function(e) {
                $('.select2-search__field').on('input', function() {
                    let inputValue = $(this).val();
                    // Custom code for handling input if needed
                });
            });
        });
    </script> 
    <script>
         $(document).ready(function() {
            // Ambil data desa dari backend
            var desaData = @json($desa);

            // Ketika kecamatan dipilih
            $('#kecamatan').change(function() {
                var kecamatanID = $(this).val();
                $('#desa').empty();
                $('#desa').append('<option value="">Pilih Desa</option>');

                if (kecamatanID) {
                    // Filter desa berdasarkan kecamatan yang dipilih
                    var filteredDesa = desaData.filter(function(desa) {
                        return desa.district_id == kecamatanID;
                    });

                    // Tambahkan desa yang sesuai ke dropdown desa
                    $.each(filteredDesa, function(key, desa) {
                        $('#desa').append('<option value="' + desa.id + '">' + desa.name + '</option>');
                    });
                }
            });
        });
    </script>
    {{-- <script>
        // Fetch and populate the list of districts (kecamatan)
        fetch('https://www.emsifa.com/api-wilayah-indonesia/api/districts/3314.json')
            .then(response => response.json())
            .then(districts => {
                let selectKecamatan = '<option>Pilih Kecamatan</option>';
                districts.forEach(element => {
                    selectKecamatan +=
                        `<option data-id="${element.id}" value="${element.name}">${element.name}</option>`;
                });
                document.getElementById('kecamatan').innerHTML = selectKecamatan;
            });

        // Add an event listener to the district dropdown
        document.getElementById('kecamatan').addEventListener('change', (e) => {
            const kecamatanName = e.target.value;
            const selectedOption = e.target.options[e.target.selectedIndex];
            const kecamatanId = selectedOption.getAttribute('data-id');

            fetch(`https://www.emsifa.com/api-wilayah-indonesia/api/villages/${kecamatanId}.json`)
                .then(response => response.json())
                .then(villages => {
                    let selectVillages = '<option>Pilih Desa</option>';
                    villages.forEach(element => {
                        selectVillages += `<option value="${element.name}">${element.name}</option>`;
                    });
                    document.getElementById('desa').innerHTML = selectVillages;
                });
        });

        // Add an event listener to the village dropdown
        document.getElementById('desa').addEventListener('change', (e) => {
            const kelurahan = e.target.value;
            document.getElementById('kelurahan').value = kelurahan;
            console.log(document.getElementById('kelurahan').value);
        });
    </script> --}}

    <script>
        function updateUnit(selectedUnit) {
            var unitSelect = document.getElementById('nm_unit');
            var kodeUnitInput = document.getElementById('kd_unit');

            // Reset kode unit input
            kodeUnitInput.value = "";

            // Loop through the unit options to find the selected one
            for (var i = 0; i < unitSelect.options.length; i++) {
                var option = unitSelect.options[i];

                if (option.value === selectedUnit) {
                    // Set kode unit input value based on the selected unit
                    kodeUnitInput.value = option.getAttribute('data-kd-unit');
                    break;
                }
            }
        }
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

    @if ($errors->any())
        <script>
            $erros = [];

            @foreach ($errors->all() as $error)
                $erros.push("{{ $error }}");
            @endforeach

            Swal.fire({
                title: "Gagal",
                icon: "error",
                text: "Mohon Maaf, Pendaftaran Gagal. Periksa Kembali Data\n" + $erros.join("\n"),
                timer: 3000,
                showConfirmButton: false
            });
        </script>
    @endif


    @if (session('success'))
        <script>
            Swal.fire({
                title: "Berhasil",
                icon: "success",
                text: "{{ session('success') }}",
                timer: 3000,
                showConfirmButton: false
            });
        </script>
    @elseif (session('error'))
        <script>
            Swal.fire({
                title: "Gagal",
                icon: "error",
                text: "Mohon Maaf, Pendaftaran Gagal. Periksa Kembali Data Anda",
                timer: 3000,
                showConfirmButton: false
            });
        </script>
    @endif

    {{-- Maps --}}
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
    <script src="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.js"></script>
    <script>
        var map = L.map('map').setView([51.505, -0.09], 13);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);

        var currentLocationMarker;

        function getCurrentLocation() {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(function(position) {
                    var lat = position.coords.latitude;
                    var lon = position.coords.longitude;

                    if (currentLocationMarker) {
                        map.removeLayer(currentLocationMarker);
                    }

                    currentLocationMarker = L.marker([lat, lon]).addTo(map)
                        .bindPopup('Your current location')
                        .openPopup();
                    map.setView([lat, lon], 13);

                    document.getElementById('latitude').value = lat;
                    document.getElementById('longitude').value = lon;
                }, function(error) {
                    console.error("Error Code = " + error.code + " - " + error.message);
                });
            } else {
                alert("Geolocation is not supported by this browser.");
            }
        }
        document.getElementById('locationButton').addEventListener('click', getCurrentLocation);

        var pickedMarker;
        map.on('click', function(e) {
            if (pickedMarker) {
                map.removeLayer(pickedMarker);
            }
            pickedMarker = L.marker(e.latlng).addTo(map)
                .bindPopup('Picked Location: ' + e.latlng.toString())
                .openPopup();

            document.getElementById('latitude').value = e.latlng.lat;
            document.getElementById('longitude').value = e.latlng.lng;
        });

        // Pencarian Lokasi
        var geocoder = L.Control.geocoder({
            defaultMarkGeocode: false
        }).on('markgeocode', function(e) {
            var latlng = e.geocode.center;
            if (pickedMarker) {
                map.removeLayer(pickedMarker);
            }
            pickedMarker = L.marker(latlng).addTo(map)
                .bindPopup('Search Result: ' + latlng.toString())
                .openPopup();
            map.setView(latlng, 13);

            document.getElementById('latitude').value = latlng.lat;
            document.getElementById('longitude').value = latlng.lng;
        }).addTo(map);
    </script>
</body>

</html>
