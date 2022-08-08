<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use DB;

class CustomerController extends Controller
{
	public function customer(){
		return view('Admin.customer.customer');
	}

	public function customerinsert(Request $r){

		$id = IdGenerator::generate(['table' => 'customer_info', 'field'=>'customer_id','length' => 6, 'prefix' =>'CUS-']);


		$data = array(
			'customer_id'        => $id,
			'customer_branch_id' => $r->customer_branch_id, 
			'customer_name_en'   => $r->customer_name_en, 
			'customer_name_bn'   => $r->customer_name_bn, 
			'customer_email'     => $r->customer_email, 
			'customer_phone'     => $r->customer_phone, 
			'customer_address'   => $r->customer_address,
			'customer_admin_id'  => Auth('admin')->user()->id,
		);

		DB::table('customer_info')->insert($data);
	}

	public function deletecustomer($id){

		DB::table('customer_info')->where('customer_id',$id)->delete();
	}

	public function managecustomer(){
		$data = DB::table('customer_info')
		->leftjoin('branch_info','branch_info.branch_id','customer_info.customer_branch_id')
		->select('customer_info.*','branch_info.branch_name_en','branch_info.branch_name_bn')
		->get();
		return view('Admin.customer.managecustomer',compact('data'));
	}


	public function editcustomer($id){

		$data = DB::table('customer_info')->where('customer_id',$id)->first();
		return view('Admin.customer.editcustomer',compact('data'));
	}


	public function updatecustomer(Request $r,$id){

		$data = array(
			'customer_branch_id' => $r->customer_branch_id, 
			'customer_name_en'   => $r->customer_name_en, 
			'customer_name_bn'   => $r->customer_name_bn, 
			'customer_email'     => $r->customer_email, 
			'customer_phone'     => $r->customer_phone, 
			'customer_address'   => $r->customer_address,
			'customer_admin_id'  => Auth('admin')->user()->id, 
		);
		DB::table('customer_info')->where('customer_id',$id)->update($data);
	}

// End Customer Methods



	public function customerinsert2(Request $r){

		$id = IdGenerator::generate(['table' => 'customer_info', 'field'=>'customer_id','length' => 6, 'prefix' =>'CUS-']);


		$data = array(
			'customer_id'        => $id,
			'customer_branch_id' => $r->customer_branch_id, 
			'customer_name_en'   => $r->customer_name_en, 
			'customer_name_bn'   => $r->customer_name_bn, 
			'customer_email'     => $r->customer_email, 
			'customer_phone'     => $r->customer_phone, 
			'customer_address'   => $r->customer_address,
			'customer_admin_id'  => Auth('admin')->user()->id,
		);

		DB::table('customer_info')->insert($data);
		return redirect()->back();

	}


}
