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
			'branch_id'        => Auth('admin')->user()->branch, 
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
			'admin_id'                        => Auth('admin')->user()->id, 

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

		$deposite = DB::table("bank_transaction")->where("account_id",$id)->where("transaction_type","Deposit")->sum("deposit_withdraw_amount");
		$withdraw = DB::table("bank_transaction")->where("account_id",$id)->where("transaction_type","Withdraw")->sum("deposit_withdraw_amount");
		$bankcost = DB::table("bank_transaction")->where("account_id",$id)->where("transaction_type","Bank-Cost")->sum("deposit_withdraw_amount");
		$bankinterest = DB::table("bank_transaction")->where("account_id",$id)->where("transaction_type","Bank-Insterest")->sum("deposit_withdraw_amount");

		$totalbalance = (($deposite+$bankinterest)-($withdraw+$bankcost));
		return response()->json($totalbalance);
	}


	public function banktransactionreports(){

		$data = DB::table("bank_transaction")
		->join("bank_information","bank_information.id","bank_transaction.account_id")
		->select("bank_transaction.*","bank_information.bank_name","bank_information.account_number")
		->get();

		return view("Admin.bank.banktransactionreports",compact('data'));

	}


// End Bank Transaction


}
