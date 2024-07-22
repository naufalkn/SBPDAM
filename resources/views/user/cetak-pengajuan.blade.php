<!DOCTYPE html>
<html>

<head>
    <title>Bukti Pembayaran</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            margin: 0;
            padding: 0;
            background-color: #fff;
        }

        .logo-img {
            display: none;
            /* Menyembunyikan elemen gambar asli */
        }

        .kop-surat {
            position: relative;
            z-index: 1;
            /* Pastikan elemen ini berada di atas */
        }

        .kop-surat::before {
            content: "";
            background-image: url('{{ $gambar }}');
            background-repeat: no-repeat;
            background-size: 25% 25%;
            background-position: center center;
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: -1;
            /* Pastikan elemen ini berada di bawah konten */
            opacity: 0.5;
            /* Atur opacity sesuai kebutuhan */
        }

        .underline-kopsurat {
            position: relative;
            z-index: 1;
            /* Pastikan elemen ini berada di atas */
        }

        .line-up,
        .line-under {
            height: 2px;
            background-color: #000;
        }


        .content {
            background-color: white;
            padding: 0 24px;

        }

        .content img {
            background-repeat: no-repeat;
            background-size: cover;
            background-position: center center;
            position: relative;
        }

        .content .kop-surat {
            background-color: white;
            display: flex;
            gap: 24px;
            padding-top: 16px;
            padding-bottom: 16px;
        }

        .kop-surat img {
            width: 80px;
            display: flex;
            margin-left: 16px;
            /* background-color: green; */
        }

        .kop-surat .isi-kop {
            color: black;
            display: block;
            text-align: center;
            width: 100%;
        }

        .isi-kop .big-semi {
            font-size: 20px;
            font-weight: 600;
        }

        .isi-kop .big-bold {
            font-size: 24px;
            font-weight: 700;
        }

        .isi-kop .detail-kop {
            font-size: 12px;
        }

        .isi-kop .sosmed {
            font-size: 12px;
        }

        .content .underline-kopsurat {
            width: 100%;
        }

        .underline-kopsurat .line-up {
            border-style: solid;
            border-top: 2px;
            border-width: 1px;
            margin-bottom: 3px;
        }

        .underline-kopsurat .line-under {
            border-style: solid;
            border-top: 2px;
            border-width: 4px;
        }

        .content .sub-content {
            background-color: white;
            /* row-gap: 16px; */
        }

        .sub-content .title {
            width: 100%;
            font-size: 25px;
            text-align: center;
            display: block;
            padding: 16px;
        }

        .detail {
            width: 100%;
            padding-left: 20px;
            /* background-color: yellow; */
        }

        table {
            width: 100%;
            /* Mengatur lebar tabel menjadi 100% */
            border-collapse: collapse;
            /* Menghindari jarak ganda pada border */
            border: none;
            /* Menghilangkan border */
        }

        td {
            padding: 5px;
            /* Menambah jarak di dalam sel */
            border: none;
            /* Menambahkan border untuk visualisasi */
        }

        .keterangan {
            padding: 12px;
            font-size: 16px;
            /* background-color: yellow; */
        }

        .keterangan .perihal {
            width: 100%;
        }

        .keterangan .biaya {
            width: 100%;
        }

        .biaya p {
            margin-bottom: 3px
        }

        .catatan {
            width: 100%;
            padding: 16px;
            /* background-color: yellow; */
        }

        .catatan p {
            margin-bottom: 10px;
        }

        .kuitansi {
            width: 100%;
            padding: 16px;
            /* background-color: yellow; */
        }

        .kuitansi p {
            font-weight: 600;
        }
    </style>
</head>

<body>
    <div class="content">
        {{-- <img src="{{ $gambar }}" alt="Logo" class="logo-img"> --}}
        <div class="kop-surat">
            <div class="isi-kop">
                <p class="big-semi">PEMERINTAH KABUPATEN SRAGEN</p>
                <p class="big-bold">PERUMDA AIR MINUM TIRTO NEGORO</p>
                <p class="common-text">Jl. Ronggowarsito No. 18 Sragen 57214 Telp: (0271) 891590 Fax: (0271) 890027</p>
                <p class="common-text">www.pdamtirtonegorosragen.com email:info@pdamsragen.com call center : 08112631515
                </p>
            </div>
        </div>
        <div class="underline-kopsurat">
            <div class="line-up"></div>
            <div class="line-under"></div>
        </div>
        <div class="sub-content">
            <p class="title">BUKTI PENGAJUAN</p>
            
            <div class="keterangan">
                <div class="perihal">
                    <p>Dengan hormat,</p>
                    <p>&nbsp;&nbsp;&nbsp;&nbsp;Kami mengajukan permohonan untuk berhenti berlangganan layanan air dari PERUMDA AIR MINUM TIRTO NEGORO di alamat kami. Saya, </p>
                </div>
                {{-- <div class="biaya">
                    <p>Uang Sejumlah :</p>
                    <p>Rp. 23,000.00</p>
                    <p>Dua Puluh Tiga Ribu Rupiah</p>
                </div> --}}
            </div>
            <div class="detail">
                <table>
                    <tr>
                        <td>Nama</td>
                        <td>: </td>
                        <td>{{ $pelanggan->nama }}</td>
                        <td>Jenis</td>
                        <td>:</td>
                        <td>Pengajuan</td>
                        
                    </tr>
                    <tr>
                        <td>Alamat</td>
                        <td>:</td>
                        <td>Dk. {{ $pelanggan->dukuh }} RT {{ $pelanggan->rt }} RW. {{ $pelanggan->rw }}
                            {{ $pelanggan->kelurahan }} {{ $pelanggan->kecamatan }}</td>
                        <td>Unit</td>
                        <td>:</td>
                        <td>{{ $pelanggan->nm_unit }}</td>
                    </tr>
                    <tr>
                        <td>Alasan Pengajuan</td>
                        <td>:</td>
                        <td>{{ $bukti->alasan }}</td>
                    </tr>
                    <tr>
                        <td>Tanggal Pengajuan</td>
                        <td>:</td>
                        <td>{{ \Carbon\Carbon::parse($pelanggan->tgl_pengajuan)->format('d-m-Y') ?? '-' }}</td>
                    </tr>
                    <tr>
                        <td>Berlangganan Sejak</td>
                        <td>:</td>
                        <td>{{ \Carbon\Carbon::parse($pelanggan->tgl_aktif)->format('d-m-Y') ?? '-' }}</td>
                    </tr>
                </table>
            </div>
        </div>
        <div class="catatan">
            <p>Dengan ini, saya <b>{{ $pelanggan->nama }}</b> menyatakan bahwa permohonan ini kami ajukan dengan sebenar-benarnya dan berharap dapat diproses sesuai dengan ketentuan yang berlaku. </p>
        </div>
        <div class="kuitansi">
            <p># KUITANSI INI BERLAKU SEBAGAI BUKTI PENGAJUAN YANG SAH #</p>
        </div>
    </div>
</body>

</html>
