<h6>
@if($status == '')
	<span class="badge badge-secondary">Draft</span>
@elseif($status == 'Pengajuan')
	<span class="badge badge-warning">{{ $status }}</span>
@elseif($status == 'Disetujui')
	<span class="badge badge-success">{{ $status }}</span>
@elseif($status == 'Ditolak')
	<span class="badge badge-danger">{{ $status }}</span>
@else
	<span class="badge badge-primary">{{ $status }}</span>
@endif
</h6>