@if($status == '')
	<h6>
		<span class="badge badge-secondary">Draft</span>
	</h6>
@elseif($status == 'Pengajuan')
	<h6>
		<span class="badge badge-warning">{{ $status }}</span>
	</h6>
@elseif($status == 'Disetujui')
	<h6>
		<span class="badge badge-success">{{ $status }}</span>
	</h6>
@elseif($status == 'Ditolak')
	<h6>
		<span class="badge badge-danger">{{ $status }}</span>
	</h6>
@else
	<h6>
		<span class="badge badge-primary">{{ $status }}</span>
	</h6>
@endif