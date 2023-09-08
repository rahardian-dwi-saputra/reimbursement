@if($status == '')
	<h6>
		<span class="badge badge-secondary">Draft</span>
	</h6>
@elseif($status == 'Pengajuan')
	<h6>
		<span class="badge badge-warning">{{ $status }}</span>
	</h6>
@else
<span class="badge badge-primary">Primary</span>
@endif