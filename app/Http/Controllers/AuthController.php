<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function index(){
    	return view('login'); 
    }
    public function authenticate(Request $request){
    	$this->validate($request, [
            'nip' => 'required',
            'password' => 'required',
        ]);

    	if(Auth::guard('webkaryawan')->attempt($request->only(['nip', 'password'])))
        {
            return redirect()->route('dashboard');
        }
    	return back()->with('LoginError','NIP atau password salah');
    }
    public function logout(){
    	Auth::guard('webkaryawan')->logout();
    	return redirect('/login');
    }
}
