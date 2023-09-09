<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Reimbursement;
use DataTables;

class PembayaranController extends Controller
{
    public function index(){
    	return view('pembayaran.index');
    }
}
