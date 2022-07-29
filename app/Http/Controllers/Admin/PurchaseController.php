<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use DB;
use Session;

class PurchaseController extends Controller
{
	public function purchase(){

		$invoice_no = IdGenerator::generate(['table' => 'purchase_ledger', 'field'=>'invoice_no','length' => 8, 'prefix' =>'PINV-']);
		return view('Admin.purchase.purchase',compact('invoice_no'));
	}



	public function purchaseproductcart(Request $request,$id)
	{

		$session_id   = Session::getId();
		$checkproduct = DB::table('pdt_productinfo')->where('pdt_id',$id)->first();


		$checkaddproduct = DB::table('purchase_current')->where('purchase_current.session_id',$session_id)->where('purchase_current.pdt_id',$id)->first();

		if ($checkaddproduct) 
		{

			DB::table('purchase_current')->where('pdt_id',$id)
			->update([
				'purchase_quantity'=>$checkaddproduct->purchase_quantity+1
			]);


		}
		else
		{

			DB::table('purchase_current')->insert([
				'pdt_id'             => $id,
				'sub_unit_id'        => $checkproduct->pdt_measurement,
				'purchase_quantity'  => '1',
				'purchase_price'     => $checkproduct->pdt_purchase_price,
				'discount_amount'    => 0.00,
				'per_unit_cost'      => $checkproduct->pdt_purchase_price,
				'sale_price_per_unit'=> $checkproduct->pdt_sale_price,
				'session_id'         => $session_id,
				'admin_id'           => Auth('admin')->user()->id,
			]);

		}



	}


	public function showpurchaseproductcart(){
		$session_id   = Session::getId();
		$data = DB::table('purchase_current')
		->where('purchase_current.session_id',$session_id)
		->join('pdt_productinfo','pdt_productinfo.pdt_id','purchase_current.pdt_id')
		->select('purchase_current.*','pdt_productinfo.pdt_name_en','pdt_productinfo.pdt_name_bn')
		->get();

		return view('Admin.purchase.showpurchaseproductcart',compact('data'));
	}




	public function qtyupdate(Request $request,$id){
		$session_id   = Session::getId();
		$data = DB::table('purchase_current')
		->where('purchase_current.session_id',$session_id)
		->where('purchase_current.id',$id)
		->update([

			'purchase_quantity' => $request->purchase_quantity

		]);

	}


	public function deletepurchasecartproduct($id){
		$session_id   = Session::getId();
		$data = DB::table('purchase_current')
		->where('purchase_current.session_id',$session_id)
		->where('purchase_current.id',$id)
		->delete();

	}


	public function purchasepriceupdate(Request $request,$id){
		$session_id   = Session::getId();
		$data = DB::table('purchase_current')
		->where('purchase_current.session_id',$session_id)
		->where('purchase_current.id',$id)
		->update([

			'per_unit_cost' => $request->per_unit_cost

		]);

	}




	public function purchaseledger(Request $request){

		$session_id   = Session::getId();
		$data = DB::table('purchase_current')
		->where('purchase_current.session_id',$session_id)
		->get();

		foreach ($data as $d) {
			DB::table("purchase_entry")->insert([
				'invoice_no'        => $request->invoice_no,
				'product_id'        => $d->pdt_id,
				'sub_unit_id'       => $d->sub_unit_id,
				'product_quantity'  => $d->purchase_quantity,
				'purchase_price'    => $d->purchase_price,
				'per_unit_cost'     => $d->per_unit_cost,
				'discount_amount'   => 0.00,
				'admin_id'          => Auth('admin')->user()->id,


			]);
		}


		$explode = explode('/',$request->invoice_date);
		$invoice_date = $explode[1].'-'.$explode[0].'-'.$explode[2]; 


		DB::table("purchase_ledger")->insert([
			'invoice_no'       => $request->invoice_no,
			'invoice_date'     => $invoice_date,
			'suplier_id'       => $request->supplier_id,
			'total_amount'     => $request->grandtotal,
			'paid'             => $request->paid,
			'discount'         => $request->discount,
			'due'              => $request->due,
			'transaction_type' => $request->transaction_type,
			'entry_date'       => date('d-m-Y'),
			'admin_id'         => Auth('admin')->user()->id,
			'branch_id'        => Auth('admin')->user()->id,


		]);


		DB::table('purchase_current')->where('session_id',$session_id)->delete();
		Session::regenerate();



		return redirect('invoicepurchase/'.$request->invoice_no);


	}

	public function invoicepurchase($id){

		$data = DB::table('purchase_ledger')
		->where("purchase_ledger.invoice_no",$id)
		->join("supplier_info",'supplier_info.supplier_id','purchase_ledger.suplier_id')
		->join("admins",'admins.id','purchase_ledger.admin_id')
		->select("purchase_ledger.*",'supplier_info.supplier_name_en','supplier_info.supplier_phone','admins.name')
		->first();

		$product = DB::table("purchase_entry")
		->where("purchase_entry.invoice_no",$data->invoice_no)
		->join("pdt_productinfo",'pdt_productinfo.pdt_id','purchase_entry.product_id')
		->get();

		return view("Admin.purchase.invoicepurchase",compact('data','product'));
	}


	public function allpurchaseledger(){

		$data = DB::table('purchase_ledger')
		->join("supplier_info",'supplier_info.supplier_id','purchase_ledger.suplier_id')
		->join("admins",'admins.id','purchase_ledger.admin_id')
		->select("purchase_ledger.*",'supplier_info.supplier_name_en','supplier_info.supplier_phone','admins.name')
		->orderBy("purchase_ledger.id",'DESC')
		->limit(10)
		->get();


		return view("Admin.purchase.allpurchaseledger",compact('data'));
	}

	public function deletepurchaseledger($id){

		$data = DB::table('purchase_ledger')
		->where("id",$id)
		->first();

		DB::table('purchase_ledger')
		->where("id",$id)
		->delete();

		DB::table("purchase_entry")->where("invoice_no",$data->invoice_no)->delete();



	}


	public function searchpurchaseinvoice(Request $r){

		$fromdate   = $r->fromdate;
		$todate     = $r->todate;

		$explode = explode('/',$r->fromdate);
		$fromdates = $explode[1].'-'.$explode[0].'-'.$explode[2]; 

		$explode = explode('/',$r->todate);
		$todates = $explode[1].'-'.$explode[0].'-'.$explode[2]; 

		if($fromdates != "" && $todates != ""){
			$data = DB::table('purchase_ledger')
			->whereBetween("purchase_ledger.invoice_date",array($fromdates,$todates))
			->join("supplier_info",'supplier_info.supplier_id','purchase_ledger.suplier_id')
			->select("purchase_ledger.*",'supplier_info.supplier_name_en','supplier_info.supplier_phone')
			->get();

		}


		return view("Admin.purchase.searchpurchaseinvoice",compact('data'));

	}





	public function searchpurchaseinvoice2(Request $r){


		$invoice_no = $r->invoice_no;

	
		$data = DB::table('purchase_ledger')
		->where("purchase_ledger.invoice_no",$invoice_no)
		->join("supplier_info",'supplier_info.supplier_id','purchase_ledger.suplier_id')
		->select("purchase_ledger.*",'supplier_info.supplier_name_en','supplier_info.supplier_phone')
		->get();

		return view("Admin.purchase.searchpurchaseinvoice",compact('data'));

	}



}
