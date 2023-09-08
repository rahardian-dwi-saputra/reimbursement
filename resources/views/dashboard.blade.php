@extends('template/main')
@section('title','Dashboard')
@section('container')

<div class="container-fluid">
	<h1 class="h3 mb-2 text-gray-800">Dashboard</h1>
	
	<div class="card shadow mb-4">
		<div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Data Grup Akses</h6>
        </div>
		<div class="card-body">
			<div id="pesan"></div>
			<div class="row">
				<div class="col-md-2">
					<a href="#" class="btn btn-success btn-sm" id="btn-tambah-grup">
						<i class="fa fa-plus"> Tambah Data</i>
					</a>
				</div>
			</div>
			<br/>
			
           
		</div>
	</div>
</div>

<script>
	$(document).ready(function(){ 
		
	
	});
</script>
@endsection