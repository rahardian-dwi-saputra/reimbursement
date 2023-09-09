<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Karyawan;
use DataTables;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;

class KaryawanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(){
        if (request()->ajax()){
            $karyawan = Karyawan::select(
                            'nip',
                            'nama',
                            'jabatan'
                        );

            return Datatables::of($karyawan)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
                        return '<a href="/karyawan/'.$row->nip.'" class="btn btn-sm btn-primary" title="detail">
                        <i class="fa fa-search"></i></a>
                        <a href="/karyawan/'.$row->nip.'/edit" class="btn btn-sm btn-warning" title="edit">
                        <i class="fa fa-edit"></i></a> <a href="'.$row->nip.'" class="btn btn-sm btn-danger" id="btn-hapus" title="hapus">
                        <i class="fa fa-trash"></i></a>';
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
        return view('karyawan.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(){
        return view('karyawan.create', ['title' => 'Tambah Data Karyawan']);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request){
        $request->validate([
            'nama' => 'required|string|max:255',
            'nip' => 'required|unique:karyawan,nip|max:30',
            'jabatan' => 'required',
            'password' => 'required|min:5|max:100',
        ]);

        $karyawan = Karyawan::create([
            'nip' => $request->nip,
            'nama' => strtoupper($request->nama),
            'jabatan' => $request->jabatan,
            'password' => Hash::make($request->password)
        ]);

        if ($karyawan){
            return redirect()
                ->route('karyawan.index')
                ->with([
                    'success' => 'Data karyawan baru berhasil ditambahkan'
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
    public function show(Karyawan $karyawan){
        return view('karyawan.show', ['karyawan' => $karyawan]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Karyawan $karyawan){
        return view('karyawan.edit', [
            'title' => 'Edit Data Karyawan',
            'karyawan' => $karyawan
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Karyawan $karyawan){
        $request->validate([
            'nama' => 'required|string|max:255',
            'nip' => ['required',
                        'max:30',
                        Rule::unique('karyawan', 'nip')->ignore($karyawan)
                    ],
            'jabatan' => 'required',
            'password_baru' => 'nullable|min:5|max:100',
        ]);

        $karyawan->update([
            'nip' => $request->nip,
            'nama' => strtoupper($request->nama),
            'jabatan' => $request->jabatan,
        ]);

        if($request->filled('password_baru')){
            $karyawan->update([
                'password' => Hash::make($request->password_baru)
            ]);
        }

        if ($karyawan){
            return redirect()
                ->route('karyawan.index')
                ->with([
                    'success' => 'Data karyawan berhasil diedit'
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
    public function destroy(Karyawan $karyawan){
        $cek = DB::table('reimbursements')
                    ->where('diajukan_oleh', $karyawan->nip)
                    ->exists();
        if($cek){
            return response()->json([
                'success' => false,
                'message' => 'Karyawan masih memiliki data Reimbursement',
            ]);
        }

        $cek = DB::table('reimbursement_histories')
                    ->where('karyawan_id', $karyawan->nip)
                    ->exists();

        if($cek){
            return response()->json([
                'success' => false,
                'message' => 'Karyawan memiliki data Reimbursement',
            ]);
        }

        if($karyawan->nip == '1234'){
            return response()->json([
                'success' => false,
                'message' => 'Data tidak dapat dihapus',
            ]);
        }

        $delete = Karyawan::destroy($karyawan->nip);

        if($delete){
            return response()->json([
                'success' => true,
                'message' => 'Data karyawan berhasil dihapus',
            ]);
        }else{
            return response()->json([
                'success' => false,
                'message' => 'Terjadi masalah, silakan coba lagi',
            ]);
        }
    }
}
