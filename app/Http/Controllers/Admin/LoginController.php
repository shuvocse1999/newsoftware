<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Hash;
use Auth;

class LoginController extends Controller
{
	public function index(){
		return view('Admin.login.login');
	}

	public function adminlogin(Request $request)
	{
		$this->validate($request, [
			'email'   => 'required|email',
			'password' => 'required|min:6'
		]);

		if (Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password])) {
			if(Auth('admin')->user()->status == 1){
				return redirect('AdminDashboard');
			}
			else{
				return redirect()->back();
			}
			
		}
		else{
			return redirect()->back();
		} 
		
	}

	public function logout()
	{
		Auth::guard('admin')->logout();
		return redirect('/admin');
	}
}

