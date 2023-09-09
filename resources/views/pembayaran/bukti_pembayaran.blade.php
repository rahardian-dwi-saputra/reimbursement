@extends('template/main')
@section('title','Pembayaran Reimbursement')
@section('container')

<style>
	table.borderless td{
		border: none !important;
	}
</style>

<div class="container-fluid">
	<h1 class="h3 mb-2 text-gray-800">Pembayaran Reimbursement</h1>
	
	<div class="card shadow mb-4">
		<div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Upload Bukti Pembayaran</h6>
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

        	<form method="post" action="/finance/buktipembayaran/{{ $reimbursement->id }}" enctype="multipart/form-data">
        		@csrf

        		<div class="form-group row">
    				<label for="bukti_pembayaran" class="col-sm-2 col-form-label">
    					Bukti Pembayaran
    				</label>
    				<div class="col-sm-5">

    					<div class="custom-file mb-3">
    						<input type="file" class="form-control-file @error('bukti_pembayaran') is-invalid @enderror" id="bukti_pembayaran" name="bukti_pembayaran">
    						<small class="form-text text-muted">
    							Format .jpg, .jpeg, .png, atau .gif maksimal 2 MB
    						</small>
    						
    						@error('bukti_pembayaran')
                        	<div class="invalid-feedback">
                            	{{ $message }}
                        	</div>
                        	@enderror
  						</div>
					</div>
  				</div>

  				<div class="form-group row d-none" id="field-image">
                    <label class="col-sm-2 col-form-label"></label>
                    <div class="col-sm-5">
                        <img id="imagepreview" class="img-fluid" style="max-height: 200px; overflow-y: auto;" />
                        <div></div>
                    </div>
                </div>

				<div class="form-group row">
					<div class="col-sm-2"></div>
					<div class="col-sm-5">
						<button type="submit" class="btn btn-primary">
							<i class="fa fa-save"></i> Simpan
						</button>
						<a href="/finance/reimbursement" class="btn btn-secondary">
							<i class="fa fa-arrow-left"></i> Kembali
						</a>
					</div>
				</div>
        	</form>
        </div>
	</div>
</div>
<script>
	function readURL(input){
        $('#field-image').removeClass('d-none');
        
        var url = input.value;
        var ext = url.substring(url.lastIndexOf('.') + 1).toLowerCase();
        if (input.files && input.files[0]&& (ext == "gif" || ext == "png" || ext == "jpeg" || ext == "jpg")) {
            var reader = new FileReader();

            reader.onload = function (e){
                $('#field-image div div').html('');
                $('#imagepreview').removeClass('d-none');
                $('#imagepreview').attr('src', e.target.result);
            }

            reader.readAsDataURL(input.files[0]);
        }else{
            $('#imagepreview').addClass('d-none');
            $('#field-image div div').html('<p class="text-danger">File yang anda pilih bukan gambar</p>');
        }
    }
    $(function(){
    	$("#bukti_pembayaran").change(function(){
            readURL(this);
        });
    });   
</script>
@endsection