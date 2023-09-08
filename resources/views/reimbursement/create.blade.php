@extends('template/main')
@section('title','Reimbursement')
@section('container')

<link rel="stylesheet" href="{{ asset('assets/plugin/jquery-ui/jquery-ui.css') }}">
<div class="container-fluid">
	<h1 class="h3 mb-2 text-gray-800">Reimbursement</h1>
	
	<div class="card shadow mb-4">
		<div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">{{ $title }}</h6>
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

			<div class="alert alert-warning" role="alert">
				Tanda <span style="color:red;">*</span> Wajib diisi
			</div>
			<br>

			<form method="post" action="{{ route('reimbursement.store') }}" enctype="multipart/form-data">
				@csrf
					
				<div class="form-group row">
					<label for="nama" class="col-sm-2 col-form-label">
						Nama <span style="color:red;">*</span>
					</label>
					<div class="col-sm-7">
						<input type="text" class="form-control @error('nama') is-invalid @enderror" id="nama" name="nama" placeholder="Nama" value="{{ old('nama') }}">
						@error('nama')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
					</div>
				</div>

				<div class="form-group row">
					<label for="tanggal_pengajuan" class="col-sm-2 col-form-label">
						Tanggal Pengajuan <span style="color:red;">*</span>
					</label>
					<div class="col-sm-3">
						<div class="input-group has-validation">
  							<div class="input-group-prepend">
    							<span class="input-group-text">
    								<i class="fas fa-fw fa-calendar"></i>
    							</span>
  							</div>
  							<input type="text" class="form-control @error('tanggal_pengajuan') is-invalid @enderror" name="tanggal_pengajuan" id="tanggal_pengajuan">
  							@error('tanggal_pengajuan')
                        	<div class="invalid-feedback">
                            	{{ $message }}
                        	</div>
                        	@enderror
						</div>
					</div>
				</div>

  				<div class="form-group row">
    				<label for="dokumen" class="col-sm-2 col-form-label">
    					Dokumen
    				</label>
    				<div class="col-sm-5">

    					<div class="custom-file mb-3">
    						<input type="file" class="custom-file-input @error('dokumen') is-invalid @enderror" id="dokumen" name="dokumen">
    						<small class="form-text text-muted">
    							Format .pdf maksimal 2 MB
    						</small>
    						<label class="custom-file-label">Pilih file...</label>
    						@error('dokumen')
                        	<div class="invalid-feedback">
                            	{{ $message }}
                        	</div>
                        	@enderror
  						</div>
					</div>
  				</div>

				<div class="form-group row">
					<label for="deskripsi" class="col-sm-2 col-form-label">
						Deskripsi
					</label>
					<div class="col-sm-7">
						<textarea class="form-control" id="deskripsi" name="deskripsi" rows="6" placeholder="Deskripsi"></textarea>
						@error('deskripsi')
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
						<a href="{{ route('reimbursement.index') }}" class="btn btn-secondary">
							<i class="fa fa-arrow-left"></i> Kembali
						</a>
					</div>
				</div>
			</form>

		</div>
	</div>
</div>
<script src="{{ asset('assets/plugin/jquery-ui/jquery-ui.js') }}"></script>
<script>
	$(document).ready(function(){
		$("#tanggal_pengajuan").datepicker({
			dateFormat: "dd-mm-yy"
		});
	});
</script>
@endsection