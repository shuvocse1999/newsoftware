<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use DB;

class SoftwareController extends Controller
{
	public function company(){
		$data = DB::table('company_info')->get();
		return view('Admin.software.company',compact('data'));
	}

	public function companyinsert(Request $r){

		$id = IdGenerator::generate(['table' => 'company_info', 'field'=>'company_id','length' => 6, 'prefix' =>'COM-']);


		$data = array(
			'company_id'         => $id,
			'company_name_en'    => $r->company_name_en, 
			'company_name_bn'    => $r->company_name_bn, 
			'company_mobile'     => $r->company_mobile, 
			'company_address_en' => $r->company_address_en, 
			'company_address_bn' => $r->company_address_bn, 
			'company_email'      => $r->company_email, 
			'status'             => $r->status, 
		);

		DB::table('company_info')->insert($data);
	}

	public function deletecompany($id){

		DB::table('company_info')->where('company_id',$id)->delete();
	}

	public function getcompany(){
		$data = DB::table('company_info')->get();
		return view('Admin.software.getcompany',compact('data'));
	}


	public function editcompany($id){

		$data = DB::table('company_info')->where('company_id',$id)->first();
		return view('Admin.software.editcompany',compact('data'));
	}


	public function updatecompany(Request $r,$id){

		$data = array(
			'company_name_en'    => $r->company_name_en, 
			'company_name_bn'    => $r->company_name_bn, 
			'company_mobile'     => $r->company_mobile, 
			'company_address_en' => $r->company_address_en, 
			'company_address_bn' => $r->company_address_bn, 
			'company_email'      => $r->company_email, 
			'status'             => $r->status, 
		);

		DB::table('company_info')->where('company_id',$id)->update($data);
	}

// End Company Methods


	public function branch(){
		$data = DB::table('branch_info')
		->join('company_info','company_info.company_id','branch_info.company_id')
		->select('branch_info.*','company_info.company_name_en','company_info.company_name_bn')
		->get();
		return view('Admin.software.branch',compact('data'));
	}

	public function branchinsert(Request $r){

		$id = IdGenerator::generate(['table' => 'branch_info', 'field'=>'branch_id','length' => 6, 'prefix' =>'BRC-']);


		$data = array(
			'branch_id'            => $id,
			'company_id'          => $r->company_id , 
			'branch_name_en'       => $r->branch_name_en, 
			'branch_name_bn'       => $r->branch_name_bn, 
			'branch_mobile'        => $r->branch_mobile, 
			'branch_address_en'    => $r->branch_address_en, 
			'branch_address_bn'    => $r->branch_address_bn, 
			'branch_email'         => $r->branch_email, 
			'status'               => $r->status, 
		);



		DB::table('branch_info')->insert($data);
	}

	public function deletebranch($id){

		DB::table('branch_info')->where('branch_id',$id)->delete();
	}

	public function getbranch(){
		$data = DB::table('branch_info')
		->join('company_info','company_info.company_id','branch_info.company_id')
		->select('branch_info.*','company_info.company_name_en','company_info.company_name_bn')
		->get();
		return view('Admin.software.getbranch',compact('data'));
	}


	public function editbranch($id){

		$data = DB::table('branch_info')->where('branch_id',$id)->first();
		return view('Admin.software.editbranch',compact('data'));
	}


	public function updatebranch(Request $r,$id){

		$data = array(
			'company_id'           => $r->company_id , 
			'branch_name_en'       => $r->branch_name_en, 
			'branch_name_bn'       => $r->branch_name_bn, 
			'branch_mobile'        => $r->branch_mobile, 
			'branch_address_en'    => $r->branch_address_en, 
			'branch_address_bn'    => $r->branch_address_bn, 
			'branch_email'         => $r->branch_email, 
			'status'               => $r->status, 
		);
		DB::table('branch_info')->where('branch_id',$id)->update($data);
	}



}
