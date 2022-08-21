<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class BankController extends Controller
{
	public function bankinformation(){
		$data = DB::table('bank_information')->where("branch_id",Auth('admin')->user()->branch)->get();
		return view('Admin.bank.bankinformation',compact('data'));
	}

	public function bankinformationinsert(Request $r){


		$data = array(
			'bank_name'     => $r->bank_name, 
			'account_number'=> $r->account_number, 
			'details'       => $r->details, 
			'contact'       => $r->contact, 
			'account_type'  => $r->account_type, 
			'bankingType'   => $r->bankingType, 
			'branch_id'     => Auth('admin')->user()->branch, 
			'admin'         => Auth('admin')->user()->id, 

		);

		DB::table('bank_information')->insert($data);
	}

	

	public function deletebankinformation($id){

		DB::table('bank_information')->where('id',$id)->delete();
	}

	public function getbankinformation(){
		$data = DB::table('bank_information')->where("branch_id",Auth('admin')->user()->branch)->get();
		return view('Admin.bank.getbankinformation',compact('data'));
	}


	public function editbankinformation($id){

		$data = DB::table('bank_information')->where('id',$id)->first();
		return view('Admin.bank.editbankinformation',compact('data'));
	}


	public function updatebankinformation(Request $r,$id){

		
		$data = array(
			'bank_name'     => $r->bank_name, 
			'account_number'=> $r->account_number, 
			'details'       => $r->details, 
			'contact'       => $r->contact, 
			'account_type'  => $r->account_type, 
			'bankingType'   => $r->bankingType, 
			'branch_id'        => Auth('admin')->user()->branch, 
			'admin'         => Auth('admin')->user()->id, 

		);
		DB::table('bank_information')->where('id',$id)->update($data);
	}


// End Bank info





	public function banktransaction(){
		return view('Admin.bank.banktransaction');
	}

	public function banktransactioninsert(Request $r){


		$data = array(
			'account_id'                   => $r->account_id, 
			'transaction_type'             => $r->transaction_type, 
			'vouchar_cheque_no'            => $r->vouchar_cheque_no, 
			'deposit_withdraw_amount'      => $r->deposit_withdraw_amount, 
			'deposit_withdraw_date'        => $r->deposit_withdraw_date, 
			'deposit_withdraw_entryDate'   => date("Y-m-d"), 
			'branch_id'                    => Auth('admin')->user()->branch, 
			'admin_id'                     => Auth('admin')->user()->id, 

		);

		DB::table('bank_transaction')->insert($data);
	}

	public function managebanktransaction(){

		$data = DB::table('bank_transaction')
		->where("bank_transaction.branch_id",Auth('admin')->user()->branch)
		->join("bank_information","bank_information.id","bank_transaction.account_id")
		->select("bank_transaction.*","bank_information.bank_name","bank_information.account_number")
		->get();
		return view('Admin.bank.managebanktransaction',compact('data'));
	}



	public function deletebanktransaction($id){

		DB::table('bank_transaction')->where('id',$id)->delete();
	}



	public function editbanktransaction($id){

		$data = DB::table('bank_transaction')->where('id',$id)->first();
		return view('Admin.bank.editbanktransaction',compact('data'));
	}


	public function updatebanktransaction(Request $r,$id){


		$data = array(
			'account_id'                   => $r->account_id, 
			'transaction_type'             => $r->transaction_type, 
			'vouchar_cheque_no'            => $r->vouchar_cheque_no, 
			'deposit_withdraw_amount'      => $r->deposit_withdraw_amount, 
			'deposit_withdraw_date'        => $r->deposit_withdraw_date, 
			'deposit_withdraw_entryDate'   => date("Y-m-d"), 
			'branch_id'                    => Auth('admin')->user()->branch, 
			'admin_id'                     => Auth('admin')->user()->id, 

		);

		DB::table('bank_transaction')->where("id",$id)->update($data);
	}

	public function gettotalamount($id){

		$deposite = DB::table("bank_transaction")->where("account_id",$id)->where("transaction_type","Deposit")->where("bank_transaction.branch_id",Auth('admin')->user()->branch)->sum("deposit_withdraw_amount");
		$withdraw = DB::table("bank_transaction")->where("account_id",$id)->where("transaction_type","Withdraw")->where("bank_transaction.branch_id",Auth('admin')->user()->branch)->sum("deposit_withdraw_amount");
		$bankcost = DB::table("bank_transaction")->where("account_id",$id)->where("transaction_type","Bank-Cost")->where("bank_transaction.branch_id",Auth('admin')->user()->branch)->sum("deposit_withdraw_amount");
		$bankinterest = DB::table("bank_transaction")->where("account_id",$id)->where("transaction_type","Bank-Insterest")->where("bank_transaction.branch_id",Auth('admin')->user()->branch)->sum("deposit_withdraw_amount");

		$totalbalance = (($deposite+$bankinterest)-($withdraw+$bankcost));
		return response()->json($totalbalance);
	}


	public function banktransactionreports(){

		$data = DB::table("bank_transaction")
		->join("bank_information","bank_information.id","bank_transaction.account_id")
		->select("bank_transaction.*","bank_information.bank_name","bank_information.account_number")
		->where("bank_transaction.branch_id",Auth('admin')->user()->branch)
		->get();

		return view("Admin.bank.banktransactionreports",compact('data'));

	}


	public function bankvoucher($id){
		$data = DB::table("bank_transaction")
		->join("bank_information","bank_information.id","bank_transaction.account_id")
		->join("admins","admins.id","bank_transaction.admin_id")
		->select("bank_transaction.*","bank_information.bank_name","bank_information.account_number","admins.name")
		->where("bank_transaction.id",$id)
		->first();
		return view("Admin.bank.bankvoucher",compact('data'));
	}

	public function bankstatement(){
		$bank  = DB::table("bank_information")->where("branch_id",Auth('admin')->user()->branch)->get();
		return view("Admin.bank.bankstatement",compact('bank'));
	}


	public function bankstatementreports(Request $request){


		$bank_id     = $request->bank_id;
		$type        = $request->Type;
		$date1       = $request->start_date;
		$date2       = $request->end_date;
		$month       = $request->month;
		$year        = $request->year;



		if ($request->bank_id == "All") {
			
			if ($type == 1) {

				$data = DB::table("bank_transaction")
				->join("bank_information","bank_information.id","bank_transaction.account_id")
				->select("bank_transaction.*","bank_information.bank_name","bank_information.account_number","bank_information.account_type")
				->where("bank_transaction.deposit_withdraw_date",$date1)
				->where("bank_transaction.branch_id",Auth('admin')->user()->branch)
				->get();

				
			}

			elseif($type == 2){

				$data = DB::table("bank_transaction")
				->join("bank_information","bank_information.id","bank_transaction.account_id")
				->select("bank_transaction.*","bank_information.bank_name","bank_information.account_number","bank_information.account_type")
				->whereBetween("bank_transaction.deposit_withdraw_date",array($date1,$date2))
				->where("bank_transaction.branch_id",Auth('admin')->user()->branch)
				->get();


			}


			elseif($type == 3){

				$data = DB::table("bank_transaction")
				->join("bank_information","bank_information.id","bank_transaction.account_id")
				->select("bank_transaction.*","bank_information.bank_name","bank_information.account_number","bank_information.account_type")
				->whereMonth("bank_transaction.deposit_withdraw_date",$month)
				->whereYear("bank_transaction.deposit_withdraw_date",$year)
				->where("bank_transaction.branch_id",Auth('admin')->user()->branch)
				->get();

			}


			elseif($type == 4){

				$data = DB::table("bank_transaction")
				->join("bank_information","bank_information.id","bank_transaction.account_id")
				->select("bank_transaction.*","bank_information.bank_name","bank_information.account_number","bank_information.account_type")
				->whereYear("bank_transaction.deposit_withdraw_date",$year)
				->where("bank_transaction.branch_id",Auth('admin')->user()->branch)
				->get();


			}


		}
		else{


			if ($type == 1) {

				$data = DB::table("bank_transaction")
				->join("bank_information","bank_information.id","bank_transaction.account_id")
				->select("bank_transaction.*","bank_information.bank_name","bank_information.account_number","bank_information.account_type")
				->where("bank_transaction.deposit_withdraw_date",$date1)
				->where("bank_transaction.branch_id",Auth('admin')->user()->branch)
				->where("bank_transaction.account_id",$bank_id)
				->get();
			}

			elseif($type == 2){
				$data = DB::table("bank_transaction")
				->join("bank_information","bank_information.id","bank_transaction.account_id")
				->select("bank_transaction.*","bank_information.bank_name","bank_information.account_number","bank_information.account_type")
				->whereBetween("bank_transaction.deposit_withdraw_date",array($date1,$date2))
				->where("bank_transaction.branch_id",Auth('admin')->user()->branch)
				->where("bank_transaction.account_id",$bank_id)
				->get();
			}


			elseif($type == 3){
				$data = DB::table("bank_transaction")
				->join("bank_information","bank_information.id","bank_transaction.account_id")
				->select("bank_transaction.*","bank_information.bank_name","bank_information.account_number","bank_information.account_type")
				->whereMonth("bank_transaction.deposit_withdraw_date",$month)
				->whereYear("bank_transaction.deposit_withdraw_date",$year)
				->where("bank_transaction.branch_id",Auth('admin')->user()->branch)
				->where("bank_transaction.account_id",$bank_id)
				->get();
			}


			elseif($type == 4){
				
				$data = DB::table("bank_transaction")
				->join("bank_information","bank_information.id","bank_transaction.account_id")
				->select("bank_transaction.*","bank_information.bank_name","bank_information.account_number","bank_information.account_type")
				->whereYear("bank_transaction.deposit_withdraw_date",$year)
				->where("bank_transaction.branch_id",Auth('admin')->user()->branch)
				->where("bank_transaction.account_id",$bank_id)
				->get();




			}


		}



		return view("Admin.bank.bankstatementreportstab",compact('data','type','date1','date2','month','year'));

	}


// End Bank Transaction


}
