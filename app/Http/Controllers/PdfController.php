<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Reimbursement;

class PdfController extends Controller
{
    public function display_dokumen(Reimbursement $reimbursement){
    	if($reimbursement->dokumen != ''){
    		$ext  = pathinfo($reimbursement->dokumen, PATHINFO_EXTENSION);
    		if($ext == 'pdf'){
    			return response()->file(
    				storage_path('app/public/'.$reimbursement->dokumen),
    				['content-type'=>'application/pdf']
    			);
    		}
    	}
    	echo 'File tidak ditemukan';
    }
}
