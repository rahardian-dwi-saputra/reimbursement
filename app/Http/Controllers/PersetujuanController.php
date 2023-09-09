<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Reimbursement;
use App\Models\Reimbursement_history;
use DataTables;
use Illuminate\Support\Facades\Auth;

class PersetujuanController extends Controller
{
    public function index(){
    	if (request()->ajax()){
    		$reimbursement = Reimbursement::select(
                            'id',
                            'nama',
                            'tanggal_pengajuan',
                            'status',
                            'step'
                        );

    		return Datatables::of($reimbursement)
                    ->addIndexColumn()
                    ->editColumn('status', 'datatables.status')
                    ->editColumn('step', 'datatables.step')
                    ->addColumn('action', 'datatables.action_direktur')
                    ->rawColumns(['status','step','action'])
                    ->make(true);
    	}

    	return view('persetujuan.index');
    }
    public function validasi(Reimbursement $reimbursement){
        $ext  = pathinfo($reimbursement->dokumen, PATHINFO_EXTENSION);
        return view('persetujuan.validasi', [
            'reimbursement' => $reimbursement,
            'ektensi' => $ext
        ]);
    }
    public function kirim_validasi(Request $request, Reimbursement $reimbursement){
        $request->validate([
            'validasi' => 'required|in:1,0',
            'catatan' => 'nullable|string',
        ]);

        $data_history = array();
        $data_history['reimbursement_id'] = $reimbursement->id;
        $data_history['karyawan'] = Auth::guard('webkaryawan')->user()->nip;
        $data_history['waktu'] = date('Y-m-d H:i:s');
        $data_history['jenis_aktifitas'] = 'Persetujuan';
        if($request->validasi == 1){
            $data_history['aktivitas'] = 'Pengajuan Reimbursement telah disetujui oleh Direktur dan diteruskan ke bagian Finance';
            $data_history['status'] = 'Setuju';
            $data_history['warna'] = 'success';
            $data_history['icon'] = 'fa fa-check';
        }
        else{
            $data_history['aktivitas'] = 'Pengajuan Reimbursement ditolak oleh Direktur';
            $data_history['status'] = 'Tolak';
            $data_history['warna'] = 'danger';
            $data_history['icon'] = 'fa fa-exclamation-circle';
        }

        $data_history['keterangan'] = '';
        if($request->filled('catatan')){
            $data_history['keterangan'] = $request->catatan;
        }

        Reimbursement_history::create($data_history);

        if($request->validasi == 1){
            $reimbursement->update([
                'status' => 'Disetujui',
                'step' => 'Finance',
            ]);
        }else{
            $reimbursement->update([
                'status' => 'Ditolak',
                'step' => 'Staff',
            ]);
        }

        if ($reimbursement){
            return redirect()
                ->route('/daftar/reimbursement')
                ->with([
                    'success' => 'Validasi Reimbursement berhasil'
                ]);
        } else {
            return redirect()
                ->back()
                ->withInput()
                ->with([
                    'error' => 'Terjadi masalah, silakan coba lagi'
                ]);
        }
    }
}
