<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Reimbursement;
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
                        );

            return Datatables::of($reimbursement)
                    ->addIndexColumn()
                    ->editColumn('status', 'datatables.status')
                    ->editColumn('step', 'datatables.step')
                    ->addColumn('action', 'datatables.action')
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
            'dokumen' => 'required|mimes:pdf|max:2048',
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
        return view('reimbursement.show', ['reimbursement' => $reimbursement]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Reimbursement $reimbursement){
        return view('reimbursement.edit', [
            'title' => 'Edit Data Pengajuan Reimbursement',
            'reimbursement' => $reimbursement
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Reimbursement $reimbursement){
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function kirim_pengajuan(Reimbursement $reimbursement){

    }
}
