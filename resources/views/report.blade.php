<!DOCTYPE html>
<html>
<head>
	<title>Membuat Laporan PDF Dengan DOMPDF Laravel</title>
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
	</center>
 
	<table class='table table-bordered'>
		<thead>
			<tr>
				<th>No</th>
				<th>Nama</th>
				<th>Nama Product</th>
				<th>Harga Product</th>
				<th>Qty</th>
				<th>Total Harga</th>
				<th>Status</th>
			</tr>
		</thead>
		<tbody>
			@php $i=1 @endphp
			@foreach($transaction as $data)
			<tr>
				<td>{{ $i++ }}</td>
				<td>{{$data->nama}}</td>
				<td>{{$data->productId->name}}</td>
				<td>{{$data->productId->harga }}</td>
				<td>{{$data->qty}}</td>
				<td>{{$data->productId->harga * $data->qty }}</td>
				<td>{{$data->status}}</td>
			</tr>
			@endforeach

		</tbody>
	</table>
 
</body>
</html>