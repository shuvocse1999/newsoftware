<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SalesController extends Controller
{
    public function sales(){
    	return view('Admin.sales.sales');
    }
}
