@extends('template/main')
@section('title','Karyawan')
@section('container')

<div class="container-fluid">
	<h1 class="h3 mb-2 text-gray-800">Karyawan</h1>
	
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
				<i class="fa fa-info"></i> Tanda <span style="color:red;">*</span> Wajib diisi
			</div>
			<br>

			<form method="post" action="{{ route('karyawan.update', $karyawan->nip) }}">
				@csrf
				@method('PUT')
					
				<div class="form-group row">
					<label for="nama_user" class="col-sm-2 col-form-label">
						Nama <span style="color:red;">*</span>
					</label>
					<div class="col-sm-5">
						<input type="text" class="form-control @error('nama') is-invalid @enderror" id="nama" name="nama" placeholder="Nama karyawan" value="{{ old('nama', $karyawan->nama) }}">
						@error('nama')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
					</div>
				</div>

				<div class="form-group row">
					<label for="nip" class="col-sm-2 col-form-label">
						NIP <span style="color:red;">*</span>
					</label>
					<div class="col-sm-5">
						<input type="text" class="form-control @error('nip') is-invalid @enderror" id="nip" name="nip" placeholder="NIP" value="{{ old('nip', $karyawan->nip) }}">
						@error('nip')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
					</div>
				</div>

				<div class="form-group row">
					<label for="jabatan" class="col-sm-2 col-form-label">
						Jabatan <span style="color:red;">*</span>
					</label>
					<div class="col-sm-3">
						<select class="form-control @error('jabatan') is-invalid @enderror" id="jabatan" name="jabatan">
							<option value="">Silahkan pilih</option>
							<option value="DIREKTUR" @if(old('jabatan', $karyawan->jabatan) == 'DIREKTUR') selected @endif>DIREKTUR</option>
							<option value="FINANCE" @if(old('jabatan', $karyawan->jabatan) == 'FINANCE') selected @endif>FINANCE</option>
							<option value="STAFF" @if(old('jabatan', $karyawan->jabatan) == 'STAFF') selected @endif>STAFF</option>
						</select>
						@error('jabatan')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
					</div>
				</div>

				<div class="form-group row">
					<label for="password_baru" class="col-sm-2 col-form-label">
						Password Baru
					</label>
					<div class="col-sm-4">
						<input type="password" class="form-control @error('password_baru') is-invalid @enderror" id="password_baru" name="password_baru" placeholder="Password Baru">
						@error('password_baru')
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
						<a href="{{ route('karyawan.index') }}" class="btn btn-secondary">
							<i class="fa fa-arrow-left"></i> Kembali
						</a>
					</div>
				</div>
			</form>

		</div>
	</div>
</div>
@endsection