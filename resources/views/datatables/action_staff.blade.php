@if($status == '' || $status == 'Ditolak')
<a href="{{ $id }}" class="btn btn-sm btn-success" id="btn-send" title="kirim pengajuan">
	<i class="fa fa-paper-plane"></i>
</a>
@endif
<a href="/reimbursement/{{ $id }}" class="btn btn-sm btn-primary" title="detail">
	<i class="fa fa-search"></i>
</a>
@if($status == '' || $status == 'Ditolak')
<a href="/reimbursement/{{ $id }}/edit" class="btn btn-sm btn-warning" title="edit">
    <i class="fa fa-edit"></i>
</a> 
<a href="{{ $id }}" class="btn btn-sm btn-danger" id="btn-hapus" title="hapus">
    <i class="fa fa-trash"></i>
</a>
@endif