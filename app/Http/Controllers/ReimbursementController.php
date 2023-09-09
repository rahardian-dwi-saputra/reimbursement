<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Reimbursement;
use App\Models\Reimbursement_history;
use DataTables;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ReimbursementController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(){
        if (request()->ajax()){
            $reimbursement = Reimbursement::select(
                            'id',
                            'nama',
                            'tanggal_pengajuan',
                            'status',
                            'step'
                        )->where('diajukan_oleh', Auth::guard('webkaryawan')->user()->nip);

            return Datatables::of($reimbursement)
                    ->addIndexColumn()
                    ->editColumn('status', 'datatables.status')
                    ->editColumn('step', 'datatables.step')
                    ->addColumn('action', 'datatables.action_staff')
                    ->rawColumns(['status','step','action'])
                    ->make(true);
        }
        return view('reimbursement.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(){
        return view('reimbursement.create', [
            'title' => 'Tambah Data Pengajuan Reimbursement'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request){
        $request->validate([
            'nama' => 'required|string|max:255',
            'tanggal_pengajuan' => 'required|date_format:d-m-Y',
            'dokumen' => 'required|mimes:pdf,jpg,jpeg,png,gif|max:2048',
            'deskripsi' => 'nullable|string',
        ]);

        $path = '';
        if($request->file('dokumen')){
            $path = $request->file('dokumen')->store('dokumen-pengajuan');
        }

        $reimbursement = Reimbursement::create([
            'nama' => $request->nama,
            'deskripsi' => $request->deskripsi,
            'tanggal_pengajuan' => $request->tanggal_pengajuan,
            'dokumen' => $path,
            'diajukan_oleh' => Auth::guard('webkaryawan')->user()->nip
        ]);

        if ($reimbursement){
            return redirect()
                ->route('reimbursement.index')
                ->with([
                    'success' => 'Data pengajuan reimbursement baru berhasil ditambahkan'
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

    /**
     * Display the specified resource.
     */
    public function show(Reimbursement $reimbursement){
        $ext  = pathinfo($reimbursement->dokumen, PATHINFO_EXTENSION);
        $history = Reimbursement_history::where(
            'reimbursement_id', $reimbursement->id
        )->orderBy('waktu', 'desc')->get();
        return view('reimbursement.show', [
            'reimbursement' => $reimbursement,
            'ektensi' => $ext,
            'history' => $history
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Reimbursement $reimbursement){
        $ext  = pathinfo($reimbursement->dokumen, PATHINFO_EXTENSION);
        return view('reimbursement.edit', [
            'title' => 'Edit Data Pengajuan Reimbursement',
            'reimbursement' => $reimbursement,
            'ektensi' => $ext
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Reimbursement $reimbursement){
        $request->validate([
            'nama' => 'required|string|max:255',
            'tanggal_pengajuan' => 'required|date_format:d-m-Y',
            'dokumen' => 'nullable|mimes:pdf,jpg,jpeg,png,gif|max:2048',
            'deskripsi' => 'nullable|string',
        ]);

        $reimbursement->update([
            'nama' => $request->nama,
            'deskripsi' => $request->deskripsi,
            'tanggal_pengajuan' => $request->tanggal_pengajuan,
            'diajukan_oleh' => Auth::guard('webkaryawan')->user()->nip
        ]);

        if($request->file('dokumen')){
            if($reimbursement->dokumen){
                Storage::delete($reimbursement->dokumen);
            }

            $path = $request->file('dokumen')->store('dokumen-pengajuan');

            $reimbursement->update([
                'dokumen' => $path,
            ]);
        }

        if ($reimbursement){
            return redirect()
                ->route('reimbursement.index')
                ->with([
                    'success' => 'Data pengajuan reimbursement berhasil diedit'
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

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Reimbursement $reimbursement){
        if($reimbursement->dokumen){
            Storage::delete($reimbursement->dokumen);
        }

        $delete = Reimbursement::destroy($reimbursement->id);

        if($delete){
            return response()->json([
                'success' => true,
                'message' => 'Data Pengajuan Reimbursement berhasil dihapus',
            ]);
        }else{
            return response()->json([
                'success' => false,
                'message' => 'Terjadi masalah, silakan coba lagi',
            ]);
        }
    }

    public function kirim_pengajuan(Reimbursement $reimbursement){

        $reimbursement->update([
            'status' => 'Pengajuan',
            'step' => 'Direktur',
        ]);

        if ($reimbursement){
            Reimbursement_history::create([
                'reimbursement_id' => $reimbursement->id,
                'karyawan' => Auth::guard('webkaryawan')->user()->nip,
                'waktu' => date('Y-m-d H:i:s'),
                'aktivitas' => 'Reimbursement telah diajukan',
                'warna' => 'warning',
                'icon' => 'fa fa-paper-plane',
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Reimbursement berhasil dikirim ke Direktur',
            ]);
        }else{
            return response()->json([
                'success' => false,
                'message' => 'Terjadi masalah, silakan coba lagi',
            ]);
        }
        
    }
}
