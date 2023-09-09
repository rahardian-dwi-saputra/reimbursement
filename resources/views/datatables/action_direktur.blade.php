<a href="/detail/reimbursement/{{ $id }}" class="btn btn-sm btn-primary" title="detail">
	<i class="fa fa-search"></i>
</a>
@if($status == 'Pengajuan')
<a href="/validasi/reimbursement/{{ $id }}" class="btn btn-sm btn-warning" title="validasi">
	<i class="fa fa-edit"></i> Persetujuan
</a>
@endif