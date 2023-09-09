@extends('template/main')
@section('title','Karyawan')
@section('container')

<style>
	table.borderless td{
		border: none !important;
	}
</style>

<div class="container-fluid">
	<h1 class="h3 mb-2 text-gray-800">Profil</h1>
	
	<div class="card shadow mb-4">
		<div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Detail Profil Saya</h6>
        </div>
		<div class="card-body">
			<table class="table borderless">
				<tr>
					<td width="19%">Nama</td>
					<td width="1%">:</td>
					<td width="80%">{{ Auth::guard('webkaryawan')->user()->nama }}</td>
				</tr>
				<tr>
					<td>NIP</td>
					<td>:</td>
					<td>{{ Auth::guard('webkaryawan')->user()->nip }}</td>
				</tr>
				<tr>
					<td>Jabatan</td>
					<td>:</td>
					<td>{{ Auth::guard('webkaryawan')->user()->jabatan }}</td>
				</tr>
			</table>
			
		</div>
	</div>
</div>
@endsection