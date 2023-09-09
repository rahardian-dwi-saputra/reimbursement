@extends('template/main')
@section('title','Validasi Reimbursement')
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
	<h1 class="h3 mb-2 text-gray-800">Validasi Reimbursement</h1>
	
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

<script src="{{ asset('assets/vendor/datatables/jquery.dataTables.js') }}"></script>
<script src="{{ asset('assets/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>
<script>
	$(document).ready(function(){ 

		var table = $('#data-reimbursement').DataTable({
            processing: true,
            serverSide: true,
            ajax: "/daftar/reimbursement",
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
	
	});
</script>
@endsection