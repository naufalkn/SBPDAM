<!DOCTYPE html>
<html>
<head>
	<title>Membuat Laporan PDF Dengan DOMPDF Laravel</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
	<style type="text/css">
		table tr td,
		table tr th{
			font-size: 9pt;
		}
	</style>
	<center>
		<h5>Membuat Laporan PDF Dengan DOMPDF Laravel</h4>
		<h6><a target="_blank" href="https://www.malasngoding.com/membuat-laporan-…n-dompdf-laravel/">www.malasngoding.com</a></h5>
	</center>
 
	<table class='table table-bordered'>
		<thead>
			<tr>
                <th>Nama</th>
				<th>Email</th>
				<th>Alamat</th>
				<th>Telepon</th>
				<th>Pekerjaan</th>
				<th>Total Pembayaran</th>
				<th>Status Pembayaran</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td>{{ $pelanggan->nama }}</td>
				<td>{{$pelanggan->email}}</td>
				<td>{{$pelanggan->dukuh}}</td>
				<td>{{$pelanggan->no_telepon}}</td>
				<td>{{$pelanggan->pekerjaan}}</td>
				<td>{{$transaksi->total_bayar}}</td>
				<td>{{$transaksi->status}}</td>
			</tr>
		</tbody>
	</table>
 
</body>
</html>