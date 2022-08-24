<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class EmployeeController extends Controller
{
	public function employee(){
		return view('Admin.employee.employee');
	}

	public function employeeinsert(Request $r){

		
		$data = array(
			'employee_name'    => $r->employee_name, 
			'employee_phone'   => $r->employee_phone, 
			'employee_email'   => $r->employee_email, 
			'employee_address' => $r->employee_address, 
			'employee_nid'     => $r->employee_nid,
			'joining_date'     => $r->joining_date, 
			'branch'           => Auth('admin')->user()->branch,
			'admin'            => Auth('admin')->user()->id,
		);

		DB::table('employee_info')->insert($data);
	}

	public function deleteemployee($id){

		DB::table('employee_info')->where('id',$id)->delete();
	}

	public function manageemployee(){
		$data = DB::table('employee_info')
		->leftjoin('branch_info','branch_info.branch_id','employee_info.branch')
		->select('employee_info.*','branch_info.branch_name_en','branch_info.branch_name_bn')
		->where("employee_info.branch",Auth('admin')->user()->branch)
		->get();
		return view('Admin.employee.manageemployee',compact('data'));
	}


	public function editemployee($id){

		$data = DB::table('employee_info')->where('id',$id)->first();
		return view('Admin.employee.editemployee',compact('data'));
	}


	public function updateemployee(Request $r,$id){

		$data = array(
			'employee_name'    => $r->employee_name, 
			'employee_phone'   => $r->employee_phone, 
			'employee_email'   => $r->employee_email, 
			'employee_address' => $r->employee_address, 
			'employee_nid'     => $r->employee_nid,
			'joining_date'     => $r->joining_date, 
			'branch'           => Auth('admin')->user()->branch,
			'admin'            => Auth('admin')->user()->id,
		);
		DB::table('employee_info')->where('id',$id)->update($data);
	}

// End employee Methods




	public function employeesalarysetup(){
		$data = DB::table('employee_salary_initialized')
		->where("employee_salary_initialized.branch_id",Auth('admin')->user()->branch)
		->join("employee_info","employee_info.id","employee_salary_initialized.employee_id")
		->select("employee_salary_initialized.*","employee_info.employee_name")
		->get();
		return view('Admin.employee.employeesalarysetup',compact('data'));
	}

	public function employeesalarysetupinsert(Request $r){

		$validatedData = $r->validate([
			'employee_id' => 'required|unique:employee_salary_initialized|max:255',
		]);


		$data = array(
			'employee_id'       => $r->employee_id, 
			'employee_salary'   => $r->employee_salary, 
			'salary_status'     => $r->salary_status, 
			'date'              => date("Y-m-d"), 
			'branch_id'         => Auth('admin')->user()->branch, 
			'admin_id'          => Auth('admin')->user()->id, 

		);

		DB::table('employee_salary_initialized')->insert($data);
	}

	

	public function deleteemployeesalarysetup($id){

		DB::table('employee_salary_initialized')->where('id',$id)->delete();
	}

	public function getemployeesalarysetup(){
		$data = DB::table('employee_salary_initialized')
		->where("employee_salary_initialized.branch_id",Auth('admin')->user()->branch)
		->join("employee_info","employee_info.id","employee_salary_initialized.employee_id")
		->select("employee_salary_initialized.*","employee_info.employee_name")
		->get();
		return view('Admin.employee.getemployeesalarysetup',compact('data'));
	}


	public function editemployeesalarysetup($id){

		$data = DB::table('employee_salary_initialized')->where('id',$id)->first();
		return view('Admin.employee.editemployeesalarysetup',compact('data'));
	}


	public function updateemployeesalarysetup(Request $r,$id){

		$data = array(
			'employee_id'       => $r->employee_id, 
			'employee_salary'   => $r->employee_salary, 
			'salary_status'     => $r->salary_status, 
			'date'              => $r->date, 
			'branch_id'         => Auth('admin')->user()->branch, 
			'admin_id'          => Auth('admin')->user()->id, 

		);
		DB::table('employee_salary_initialized')->where('id',$id)->update($data);
	}


// End Salary Setup









	public function employeesalary(){
		return view('Admin.employee.employeesalary');
	}

	public function employeesalaryinsert(Request $r){

		
		$data = array(
			'employee_id'      => $r->employee_id, 
			'date'             => $r->payment_dates, 
			'transaction_type' => $r->transaction_type, 
			'salary_deposit'   => 0, 
			'salary_withdraw'  => $r->salary_withdraw,
			'note'             => $r->note, 
			'branch_id'        => Auth('admin')->user()->branch,
			'admin_id'         => Auth('admin')->user()->id,
		);

		DB::table('employee_salary_payment')->insert($data);
	}

	public function deleteemployeesalary($id){

		DB::table('employee_salary_payment')->where('id',$id)->delete();
	}

	public function manageemployeesalary(){
		$data = DB::table('employee_salary_payment')
		->leftjoin('employee_info','employee_info.id','employee_salary_payment.employee_id')
		->select('employee_salary_payment.*','employee_info.employee_name','employee_info.employee_phone')
		->where("employee_salary_payment.branch_id",Auth('admin')->user()->branch)
		->get();
		return view('Admin.employee.manageemployeesalary',compact('data'));
	}


	public function editemployeesalary($id){

		$data = DB::table('employee_salary_payment')->where('id',$id)->first();
		return view('Admin.employee.editemployeesalary',compact('data'));
	}


	public function updateemployeesalary(Request $r,$id){

		$data = array(
			'employee_id'      => $r->employee_id, 
			'date'             => $r->payment_dates, 
			'transaction_type' => $r->transaction_type, 
			'salary_deposit'   => $r->salary_deposit, 
			'salary_withdraw'  => $r->salary_withdraw,
			'note'             => $r->note, 
			'branch_id'        => Auth('admin')->user()->branch,
			'admin_id'         => Auth('admin')->user()->id,
		);

		DB::table('employee_salary_payment')->where('id',$id)->update($data);
	}



	public function getemployeebalance($id){

		$salary_deposit = DB::table("employee_salary_payment")->where("employee_id",$id)->sum("salary_deposit");
		$salary_withdraw = DB::table("employee_salary_payment")->where("employee_id",$id)->sum("salary_withdraw");

		$balance = $salary_deposit-$salary_withdraw;

		return response()->json($balance);

	}








// End employee Salary


	public function depositeemployeesalary(Request $r){

		

		$salary = $r->depositeemployee_id;


		foreach ($salary as $s) {

			$salarys = DB::table("employee_salary_initialized")->where("employee_id",$s)->get();
			$check = DB::table("employee_salary_payment")->where("employee_id",$s)->where("month",$r->month)->where("year",$r->year)->first();
			
			if (isset($check)) {
				
			}
			else{

				foreach ($salarys as $data) {

					DB::table("employee_salary_payment")->insert([

						"employee_id"      => $data->employee_id,
						"date"             => date('Y-m-d'),
						"transaction_type" => "",
						"salary_deposit"   => $data->employee_salary,
						"salary_withdraw"  => 0,
						"note"             => "",
						"month"            => $r->month,
						"year"             => $r->year,
						'branch_id'        => Auth('admin')->user()->branch,
						'admin_id'         => Auth('admin')->user()->id,

					]);

				}
				
			}

			

		}

		return redirect()->back();

		
	}





}
