<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Reimbursement;
use App\Models\Reimbursement_history;
use DataTables;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PembayaranController extends Controller
{
    public function index(){
    	if (request()->ajax()){
    		$reimbursement = Reimbursement::select(
                            'id',
                            'nama',
                            'tanggal_pengajuan',
                            'status',
                            'step'
                        )->whereNotNull('status');

    		return Datatables::of($reimbursement)
                    ->addIndexColumn()
                    ->editColumn('status', 'datatables.status')
                    ->editColumn('step', 'datatables.step')
                    ->addColumn('action', 'datatables.action_finance')
                    ->rawColumns(['status','step','action'])
                    ->make(true);
    	}

    	return view('pembayaran.index');
    }

    public function show(Reimbursement $reimbursement){
        $ext  = pathinfo($reimbursement->dokumen, PATHINFO_EXTENSION);
        $history = Reimbursement_history::where(
            'reimbursement_id', $reimbursement->id
        )->orderBy('waktu', 'desc')->get();
        return view('pembayaran.show', [
            'reimbursement' => $reimbursement,
            'ektensi' => $ext,
            'history' => $history
        ]);
    }
    public function validasi(Reimbursement $reimbursement){
        $ext  = pathinfo($reimbursement->dokumen, PATHINFO_EXTENSION);
        return view('pembayaran.validasi', [
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
        $data_history['karyawan_id'] = Auth::guard('webkaryawan')->user()->nip;
        $data_history['waktu'] = date('Y-m-d H:i:s');
        $data_history['jenis_aktifitas'] = 'Persetujuan';
        $data_history['judul'] = 'Persetujuan Finance';
        if($request->validasi == 1){
            $data_history['aktivitas'] = 'Pengajuan Reimbursement telah disetujui oleh Finance';
            $data_history['warna'] = 'success';
            $data_history['icon'] = 'fa fa-check';
        }
        else{
            $data_history['aktivitas'] = 'Pengajuan Reimbursement ditolak oleh Finance';
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
                'status' => 'Selesai',
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
                ->to('/finance/reimbursement')
                ->with([
                    'success' => 'Validasi Reimbursement berhasil disimpan'
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
    public function input_bukti_pembayaran(Reimbursement $reimbursement){
        return view('pembayaran.bukti_pembayaran', [
            'reimbursement' => $reimbursement
        ]);
    }
    public function upload_bukti_pembayaran(Request $request, Reimbursement $reimbursement){
        $request->validate([
            'bukti_pembayaran' => 'nullable|mimes:jpg,jpeg,png,gif|max:2048',
        ]);

        if($request->file('bukti_pembayaran')){
            if($reimbursement->bukti_pembayaran){
                Storage::delete($reimbursement->bukti_pembayaran);
            }
            $path = $request->file('bukti_pembayaran')->store('bukti-pembayaran');

            $reimbursement->update([
                'bukti_pembayaran' => $path
            ]);

            if ($reimbursement){
                return redirect()
                    ->to('/finance/reimbursement')
                    ->with([
                        'success' => 'Bukti pembayaran berhasil disimpan'
                    ]);
            }
        }

        return redirect()->to('/finance/reimbursement');
    }
}
