<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PERUMDA AIR MINUM TIRTO NEGORO KABUPATEN SRAGEN</title>
</head>
<body>
    <h1>SELAMAT BERGABUNG DI WEBSITE SBPDAM</h1>
    <p>Hello, {{ $name }}!</p>
    <p>Selamat Pendaftaran akun berhasil, anda bisa memulai untuk melakukan pendaftaran berlangganan.</p>
    <a href="{{ url('/verifikasi/' . $token) }}">Verify Email</a>
</body>
</html>