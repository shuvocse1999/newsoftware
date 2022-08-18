<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use DB;

class IncomeExpenseController extends Controller
{
	public function income_expensetitle(){
		$data = DB::table('income_expense_title')->where("branch",Auth('admin')->user()->branch)->get();
		return view('Admin.incomeexpense.income_expensetitle',compact('data'));
	}

	public function income_expensetitleinsert(Request $r){

		$id = IdGenerator::generate(['table' => 'income_expense_title', 'field'=>'id','length' => 6, 'prefix' =>'INE-']);


		$data = array(
			'id'         => $id,
			'title'      => $r->title, 
			'details'    => $r->details, 
			'type'       => $r->type, 
			'branch'     => Auth('admin')->user()->branch, 
			'admin'      => Auth('admin')->user()->id, 

		);

		DB::table('income_expense_title')->insert($data);
	}

	

	public function deleteincome_expensetitle($id){

		DB::table('income_expense_title')->where('id',$id)->delete();
	}

	public function getincome_expensetitle(){
		$data = DB::table('income_expense_title')->where("branch",Auth('admin')->user()->branch)->get();
		return view('Admin.incomeexpense.getincome_expensetitle',compact('data'));
	}


	public function editincome_expensetitle($id){

		$data = DB::table('income_expense_title')->where('id',$id)->first();
		return view('Admin.incomeexpense.editincome_expensetitle',compact('data'));
	}


	public function updateincome_expensetitle(Request $r,$id){

		$data = array(
			'title'      => $r->title, 
			'details'    => $r->details, 
			'type'       => $r->type, 
			'branch'     => Auth('admin')->user()->branch,
			'admin'      => Auth('admin')->user()->id, 

		);
		DB::table('income_expense_title')->where('id',$id)->update($data);
	}


// End Title





	public function incomeentry(){
		$data = DB::table('income_entry')
		->join("income_expense_title","income_expense_title.id","income_entry.income_id")
		->select("income_entry.*","income_expense_title.title")
		->where("income_entry.branch",Auth('admin')->user()->branch)
		->get();
		return view('Admin.incomeexpense.incomeentry',compact('data'));
	}

	public function incomeentryinsert(Request $r){

		$id = IdGenerator::generate(['table' => 'income_entry', 'field'=>'id','length' => 6, 'prefix' =>'INC-']);

		$explode = explode('/',$r->date);
		$date = $explode[1].'-'.$explode[0].'-'.$explode[2];


		$data = array(
			'id'         => $id,
			'date'       => $date, 
			'entry_date' => date("Y-m-d"), 
			'income_id'  => $r->income_id,
			'amount'     => $r->amount,
			'note'       => $r->note, 
			'branch'     => Auth('admin')->user()->branch, 
			'admin'      => Auth('admin')->user()->id, 

		);

		DB::table('income_entry')->insert($data);
	}

	

	public function deleteincomeentry($id){

		DB::table('income_entry')->where('id',$id)->delete();
	}

	public function getincomeentry(){
		$data = DB::table('income_entry')
		->join("income_expense_title","income_expense_title.id","income_entry.income_id")
		->select("income_entry.*","income_expense_title.title")
		->where("income_entry.branch",Auth('admin')->user()->branch)
		->get();
		return view('Admin.incomeexpense.getincomeentry',compact('data'));
	}


	public function editincomeentry($id){

		$data = DB::table('income_entry')->where('id',$id)->first();
		return view('Admin.incomeexpense.editincomeentry',compact('data'));
	}


	public function updateincomeentry(Request $r,$id){



		$data = array(
			'date'       => $r->date, 
			'entry_date' => date("Y-m-d"), 
			'income_id'  => $r->income_id,
			'amount'     => $r->amount,
			'note'       => $r->note, 
			'branch'     => Auth('admin')->user()->branch, 
			'admin'      => Auth('admin')->user()->id, 

		);

		DB::table('income_entry')->where('id',$id)->update($data);
	}


// End Income Entry







	public function expenseentry(){
		$data = DB::table('expense_entry')
		->join("income_expense_title","income_expense_title.id","expense_entry.expense_id")
		->select("expense_entry.*","income_expense_title.title")
		->where("expense_entry.branch",Auth('admin')->user()->branch)
		->get();
		return view('Admin.incomeexpense.expenseentry',compact('data'));
	}

	public function expenseentryinsert(Request $r){

		$id = IdGenerator::generate(['table' => 'expense_entry', 'field'=>'id','length' => 6, 'prefix' =>'EXP-']);

		$explode = explode('/',$r->date);
		$date = $explode[1].'-'.$explode[0].'-'.$explode[2];


		$data = array(
			'id'         => $id,
			'date'       => $date, 
			'entry_date' => date("Y-m-d"), 
			'expense_id' => $r->expense_id,
			'amount'     => $r->amount,
			'note'       => $r->note, 
			'branch'     => Auth('admin')->user()->branch, 
			'admin'      => Auth('admin')->user()->id, 

		);

		DB::table('expense_entry')->insert($data);
	}

	

	public function deleteexpenseentry($id){

		DB::table('expense_entry')->where('id',$id)->delete();
	}

	public function getexpenseentry(){
		$data = DB::table('expense_entry')
		->join("income_expense_title","income_expense_title.id","expense_entry.expense_id")
		->select("expense_entry.*","income_expense_title.title")
		->where("expense_entry.branch",Auth('admin')->user()->branch)
		->get();
		return view('Admin.incomeexpense.getexpenseentry',compact('data'));
	}


	public function editexpenseentry($id){

		$data = DB::table('expense_entry')->where('id',$id)->first();
		return view('Admin.incomeexpense.editexpenseentry',compact('data'));
	}


	public function updateexpenseentry(Request $r,$id){



		$data = array(
			'date'       => $r->date, 
			'entry_date' => date("Y-m-d"), 
			'expense_id' => $r->expense_id,
			'amount'     => $r->amount,
			'note'       => $r->note, 
			'branch'     => Auth('admin')->user()->branch, 
			'admin'      => Auth('admin')->user()->id, 

		);

		DB::table('expense_entry')->where('id',$id)->update($data);
	}


// End Income Entry




























}
