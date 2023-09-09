@extends('template/main')
@section('title','Validasi Reimbursement')
@section('container')

<style>
	table.borderless td{
		border: none !important;
	}
</style>

<div class="container-fluid">
	<h1 class="h3 mb-2 text-gray-800">Validasi Reimbursement</h1>
	
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
					<td>
						@if($ektensi == 'pdf')
							<a href="/display_pdf/{{ $reimbursement->id }}" target="_blank">
								{{ str_replace('dokumen-pengajuan/','',$reimbursement->dokumen) }}
							</a>
						@elseif(in_array($ektensi, array('jpg','jpeg','png','gif')))
							<img src="{{ asset('storage/'.$reimbursement->dokumen) }}" width="300" height="500" />
						@else	
							{{ str_replace('dokumen-pengajuan/','',$reimbursement->dokumen) }}
						@endif
					</td>
				</tr>
				<tr>
					<td>Status</td>
					<td>:</td>
					<td>
						<h6>
							@if($reimbursement->status == '')
								<span class="badge badge-secondary">
							@elseif($reimbursement->status == 'Pengajuan')
								<span class="badge badge-warning">
							@elseif($reimbursement->status == 'Disetujui')
								<span class="badge badge-success">
							@elseif($reimbursement->status == 'Ditolak')
								<span class="badge badge-danger">
							@elseif($reimbursement->status == 'Selesai')
								<span class="badge badge-primary">
							@endif

							@if($reimbursement->status == '')
								Draft
							@else
								{{ $reimbursement->status }}
							@endif

							</span>
						</h6>
					</td>
				</tr>
				<tr>
					<td>Step</td>
					<td>:</td>
					<td>
						<h6>
							@if($reimbursement->step == 'Staff')
								<span class="badge badge-secondary">
							@else
								<span class="badge badge-info">
							@endif
								{{ $reimbursement->step }}
							</span>
						</h6>
					</td>
				</tr>
				<tr>
					<td>Deskripsi</td>
					<td>:</td>
					<td>{{ $reimbursement->deskripsi }}</td>
				</tr>
				<tr>
					<td>Pemohon</td>
					<td>:</td>
					<td>{{ $reimbursement->karyawan->nama.' [ NIP: '.$reimbursement->karyawan->nip.' ]' }}</td>
				</tr>
			</table>
			
		</div>
		<div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Validasi Pengajuan Reimbursement</h6>
        </div>
        <div class="card-body">

        	@if(session()->has('error'))
			<div class="alert alert-danger alert-dismissible fade show" role="alert">
				{{ session('error') }}
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
    				<span aria-hidden="true">&times;</span>
  				</button>
  			</div>
  			@endif

        	<form method="post" action="/validasi/reimbursement/{{ $reimbursement->id }}">
        		@csrf
        		<div class="form-group row">
					<label for="validasi" class="col-sm-2 col-form-label">
						Status <span style="color:red;">*</span>
					</label>
					<div class="col-sm-7">
						<div class="form-check form-check-inline">
  							<input class="form-check-input" type="radio" name="validasi" id="validasi" value="1">
  							<label class="form-check-label" for="inlineRadio1">
  								Setujui
  							</label>
						</div>
						<div class="form-check form-check-inline">
  							<input class="form-check-input" type="radio" name="validasi" id="validasi" value="0">
  							<label class="form-check-label" for="inlineRadio2">
  								Tolak
  							</label>
						</div>
						@error('validasi')
						<small class="form-text text-danger">
							{{ $message }}
						</small>
						@enderror
					</div>
				</div>
        		<div class="form-group row">
					<label for="catatan" class="col-sm-2 col-form-label">
						Catatan
					</label>
					<div class="col-sm-7">
						<textarea class="form-control @error('catatan') is-invalid @enderror" id="catatan" name="catatan" rows="6" placeholder="Catatan">{{ old('catatan') }}</textarea>
						@error('catatan')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
					</div>
				</div>
				<div class="form-group row">
					<div class="col-sm-2"></div>
					<div class="col-sm-5">
						<button type="submit" class="btn btn-primary">
							<i class="fa fa-save"></i> Simpan
						</button>
						<a href="/daftar/reimbursement" class="btn btn-secondary">
							<i class="fa fa-arrow-left"></i> Kembali
						</a>
					</div>
				</div>
        	</form>
        </div>
	</div>
</div>
@endsection