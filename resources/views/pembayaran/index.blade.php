@extends('template/main')
@section('title','Pembayaran Reimbursement')
@section('container')

<link rel="stylesheet" href="{{ asset('assets/vendor/datatables/dataTables.bootstrap4.css') }}">
<style>
	#data-reimbursement{
		font-size: 10pt;
	}
	#data-reimbursement th, #data-reimbursement td{
		text-align:center;
	}
	#data-reimbursement td:nth-child(5){
		white-space:nowrap;
	}
	#data-reimbursement td:nth-child(2){
		text-align: left;
	}
</style>

<div class="container-fluid">
	<h1 class="h3 mb-2 text-gray-800">Pembayaran Reimbursement</h1>
	
	<div class="card shadow mb-4">
		<div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Daftar Pengajuan Reimbursement</h6>
        </div>
		<div class="card-body">
			
			@if(session()->has('success'))
				<div class="alert alert-success alert-dismissible fade show" role="alert">
					{{ session('success') }}
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
    					<span aria-hidden="true">&times;</span>
  					</button>
  				</div>
			@endif

			<div class="alert alert-success alert-dismissible" style="display:none;">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <p style="display:inline">Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>     
            </div>
			
            <div class="table-responsive">
				<table class="table table-bordered" id="data-reimbursement" width="100%" cellspacing="0">
					<thead>
						<tr>
							<th>No</th>
							<th>Nama</th>
							<th>Tanggal</th>
							<th>Status</th>
							<th>Step</th>
							<th>Opsi</th>
						</tr>
					</thead>
					<tbody>
					
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="modal_send" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header bg-warning text-white">
				<h5 class="modal-title" id="exampleModalLabel">Konfirmasi</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form id="form-send">
				<input type="hidden" id="link_send" />
				<div class="modal-body">
					@csrf
					<p style="text-align:center;">
						Ajukan data ini ke Direktur?
					</p>
				</div>
				<div class="modal-footer">
					<button type="submit" class="btn btn-primary" id="btn-hapus">Ya</button>
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Tidak</button>
				</div>
			</form>
		</div>	
	</div>
</div>

<div class="modal fade" id="modal_confirm" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header bg-danger text-white">
				<h5 class="modal-title" id="exampleModalLabel">Konfirmasi</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form id="form-hapus">
				<input type="hidden" id="link_hapus" />
				<div class="modal-body">
					@csrf
                    @method('DELETE')
					<p style="text-align:center;">
						Apakah anda yakin ingin menghapus data ini? <br/>Tekan tombol OK untuk melanjutkan
					</p>
				</div>
				<div class="modal-footer">
					<button type="submit" class="btn btn-primary" id="btn-hapus">OK</button>
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
				</div>
			</form>
		</div>	
	</div>
</div>

<script src="{{ asset('assets/vendor/datatables/jquery.dataTables.js') }}"></script>
<script src="{{ asset('assets/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>
<script>
	$(document).ready(function(){ 

		var table = $('#data-reimbursement').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('reimbursement.index') }}",
            columns: [
               {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},
               {data: 'nama', name: 'nama'},
               {data: 'tanggal_pengajuan', name: 'tanggal_pengajuan'},
               {data: 'status', name: 'status'},
               {data: 'step', name: 'step'},
               {
                  data: 'action', 
                  name: 'action', 
                  orderable: true, 
                  searchable: true
               },
            ]
      	});

      	//konfirmasi kirim
		$(document).on('click', 'a#btn-send', function(e){
			e.preventDefault();
			$('#link_send').val($(this).attr('href'));
			$('#modal_send').modal('show');
		});

		//kirim pengajuan
		$('#form-send').submit(function(e){
			e.preventDefault();
			$.ajax({
				url: "/kirimpengajuan/"+$('#link_send').val(),
				type: 'POST',
                dataType: 'json',
                data: $(this).serializeArray(),
                success: function(response){
                	$('#link_send').val('');
					$('#modal_send').modal('hide');
					if(response.success == true){
                        $('div.alert').addClass('alert-success');
                        $('div.alert').removeClass('alert-danger');
                    }else{
                        $('div.alert').addClass('alert-danger');
                        $('div.alert').removeClass('alert-success');
                    }

                    $('div.alert').show();
                    $('div.alert p').text(response.message);
                    table.ajax.reload(null, false);
                    $('div.alert').fadeOut(10000);
				}
			});
		});







		
		//konfirmasi hapus
		$(document).on('click', 'a#btn-hapus', function(e){
			e.preventDefault();
			$('#link_hapus').val($(this).attr('href'));
			$('#modal_confirm').modal('show');
		});

		//hapus data
		$('#form-hapus').submit(function(e){
			e.preventDefault();
			$.ajax({
				url: "/karyawan/"+$('#link_hapus').val(),
				type: 'POST',
                dataType: 'json',
                data: $(this).serializeArray(),
                success: function(response){
                	$('#link_hapus').val('');
					$('#modal_confirm').modal('hide');
					if(response.success == true){
                        $('div.alert').addClass('alert-success');
                        $('div.alert').removeClass('alert-danger');
                    }else{
                        $('div.alert').addClass('alert-danger');
                        $('div.alert').removeClass('alert-success');
                    }

                    $('div.alert').show();
                    $('div.alert p').text(response.message);
                    table.ajax.reload(null, false);
                    $('div.alert').fadeOut(10000);
				}
			});
		});
	
	});
</script>
@endsection