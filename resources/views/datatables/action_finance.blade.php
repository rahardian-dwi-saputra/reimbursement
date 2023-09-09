<a href="/finance/reimbursement/{{ $id }}" class="btn btn-sm btn-primary" title="detail">
	<i class="fa fa-search"></i>
</a>
@if($status == 'Disetujui')
<a href="/finance/validasi/{{ $id }}" class="btn btn-sm btn-warning" title="validasi">
	<i class="fa fa-edit"></i> Persetujuan
</a>
@elseif($status == 'Selesai')
<a href="/finance/buktipembayaran/{{ $id }}" class="btn btn-sm btn-info" title="validasi">
	<i class="fa fa-upload"></i> Bukti Pembayaran
</a>
@endif