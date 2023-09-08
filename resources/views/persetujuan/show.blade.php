@extends('template/main')
@section('title','Karyawan')
@section('container')

<style>
	table.borderless td{
		border: none !important;
	}
</style>

<div class="container-fluid">
	<h1 class="h3 mb-2 text-gray-800">Reimbursement</h1>
	
	<div class="card shadow mb-4">
		<div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Detail Data Pengajuan Reimbursement</h6>
        </div>
		<div class="card-body">
			<table class="table borderless">
				<tr>
					<td width="19%">Nama Reimbursement</td>
					<td width="1%">:</td>
					<td width="80%">{{ $reimbursement->nama }}</td>
				</tr>
				<tr>
					<td>Tanggal Pengajuan</td>
					<td>:</td>
					<td>{{ $reimbursement->tanggal_pengajuan }}</td>
				</tr>
				<tr>
					<td>Dokumen Pengajuan</td>
					<td>:</td>
					<td>{{ str_replace('dokumen-pengajuan/','',$reimbursement->dokumen) }}</td>
				</tr>
				<tr>
					<td>Status</td>
					<td>:</td>
					<td>{{ $reimbursement->status }}</td>
				</tr>
				<tr>
					<td>Deskripsi</td>
					<td>:</td>
					<td>{{ $reimbursement->deskripsi }}</td>
				</tr>
			</table>
			
			<a href="{{ route('reimbursement.index') }}" class="btn btn-primary">
				<i class="fa fa-arrow-left"></i> Kembali
			</a>
		</div>
	</div>
</div>
@endsection