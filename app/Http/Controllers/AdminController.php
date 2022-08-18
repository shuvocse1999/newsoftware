<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class AdminController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
    	$this->middleware('auth:admin');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function AdminDashboard()
    {
    	return view('Admin.layouts.dashboard');
    }

    public function adminlogout(){
        Auth::guard('admin')->logout();
        return redirect()->to("/");
    }
}
