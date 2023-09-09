@extends('template/main')
@section('title','Karyawan')
@section('container')

<link rel="stylesheet" href="{{ asset('assets/css/timeline.css') }}">


<div class="container-fluid">
	<h1 class="h3 mb-2 text-gray-800">Reimbursement</h1>
	
	<div class="card shadow mb-4">
		<div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Detail Data Pengajuan Reimbursement</h6>
        </div>
		<div class="card-body">
			<table class="table borderless">
				<tr>
					<td width="19%">Nama Reimbursement</td>
					<td width="1%">:</td>
					<td width="80%">{{ $reimbursement->nama }}</td>
				</tr>
				<tr>
					<td>Tanggal Pengajuan</td>
					<td>:</td>
					<td>{{ $reimbursement->tanggal_pengajuan }}</td>
				</tr>
				<tr>
					<td>Dokumen Pengajuan</td>
					<td>:</td>
					<td>
						@if($ektensi == 'pdf')
							<a href="/display_pdf/{{ $reimbursement->id }}" target="_blank">
								{{ str_replace('dokumen-pengajuan/','',$reimbursement->dokumen) }}
							</a>
						@elseif(in_array($ektensi, array('jpg','jpeg','png','gif')))
							<img src="{{ asset('storage/'.$reimbursement->dokumen) }}" width="300" height="500" />
						@else	
							{{ str_replace('dokumen-pengajuan/','',$reimbursement->dokumen) }}
						@endif

					</td>
				</tr>
				<tr>
					<td>Status</td>
					<td>:</td>
					<td>
						<h6>
							@if($reimbursement->status == '')
								<span class="badge badge-secondary">
							@elseif($reimbursement->status == 'Pengajuan')
								<span class="badge badge-warning">
							@elseif($reimbursement->status == 'Disetujui')
								<span class="badge badge-success">
							@elseif($reimbursement->status == 'Ditolak')
								<span class="badge badge-danger">
							@elseif($reimbursement->status == 'Selesai')
								<span class="badge badge-primary">
							@endif

							@if($reimbursement->status == '')
								Draft
							@else
								{{ $reimbursement->status }}
							@endif

							</span>
						</h6>
					</td>
				</tr>
				<tr>
					<td>Step</td>
					<td>:</td>
					<td>
						<h6>
							@if($reimbursement->step == 'Staff')
								<span class="badge badge-secondary">
							@else
								<span class="badge badge-info">
							@endif
								{{ $reimbursement->step }}
							</span>
						</h6>
					</td>
				</tr>
				<tr>
					<td>Deskripsi</td>
					<td>:</td>
					<td>{{ $reimbursement->deskripsi }}</td>
				</tr>

				@if($reimbursement->bukti_pembayaran != '')
				<tr>
					<td>Bukti Pembayaran</td>
					<td>:</td>
					<td>{{ $reimbursement->bukti_pembayaran }}</td>
				</tr>
				@endif

				<tr>
					<td>Pemohon</td>
					<td>:</td>
					<td>{{ $reimbursement->karyawan->nama.' [ NIP: '.$reimbursement->karyawan->nip.' ]' }}</td>
				</tr>
			</table>
			
			@if(count($history) == 0)
			<a href="{{ route('reimbursement.index') }}" class="btn btn-primary">
				<i class="fa fa-arrow-left"></i> Kembali
			</a>
			@endif
		</div>

		@if(count($history) > 0)
		<div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">History Pengajuan Reimbursement</h6>
        </div>
        <div class="card-body">

        	<ul class="timeline">
        		@foreach($history as $step)
        		<li>
        			<div class="timeline-badge {{ $step->warna }}">
                        <i class="{{ $step->icon }}"></i>
                    </div>
                    <div class="timeline-panel">
                    	<div class="timeline-heading">
                    		<h4 class="timeline-title">
                                {{ $step->jenis_aktifitas }}
                            </h4>
                            <p>
                                <small class="text-muted">
                                <i class="fa fa-clock"></i> 
                                    {{ $step->waktu }}
                                </small>
                            </p>
                    	</div>
                    	<div class="timeline-body">
                    		<p>{{ $step->aktivitas }}</p>
                    		@if($step->jenis_aktifitas == 'Persetujuan' && $step->keterangan != '')
                    		Catatan: {{ $step->keterangan }}
                    		@endif


                    	</div>
                    </div>
        		</li>
        		@endforeach
        	</ul>
        	<br>
        	<a href="{{ route('reimbursement.index') }}" class="btn btn-primary">
				<i class="fa fa-arrow-left"></i> Kembali
			</a>
        </div>
        @endif

	</div>
</div>
@endsection