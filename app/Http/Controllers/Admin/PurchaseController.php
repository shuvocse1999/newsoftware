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

		
		return view('Admin.purchase.purchase');
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
				'per_unit_cost'      => 0.00,
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
		->select('purchase_current.*','pdt_productinfo.pdt_name_en','pdt_productinfo.pdt_name_bn','pdt_productinfo.pdt_sale_price')
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


	public function salepriceupdate(Request $request,$id){


		$session_id   = Session::getId();
		$data = DB::table('purchase_current')
		->where('purchase_current.session_id',$session_id)
		->where('purchase_current.id',$id)
		->update([

			'sale_price_per_unit' => $request->sale_price_per_unit

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

			'purchase_price' => $request->purchase_price

		]);

	}


	public function purchasepricedicount(Request $request,$id){
		$session_id   = Session::getId();
		$data = DB::table('purchase_current')
		->where('purchase_current.session_id',$session_id)
		->where('purchase_current.id',$id)
		->update([

			'discount_amount' => $request->discount_amount

		]);

	}



	public function purchasecost(Request $request,$id){
		$session_id   = Session::getId();
		$data = DB::table('purchase_current')
		->where('purchase_current.session_id',$session_id)
		->where('purchase_current.id',$id)
		->update([

			'per_unit_cost' => $request->purchasecost

		]);

	}


	




	public function purchaseledger(Request $request){

		$session_id   = Session::getId();
		$data = DB::table('purchase_current')
		->where('purchase_current.session_id',$session_id)
		->get();

		$invoice_no = IdGenerator::generate(['table' => 'purchase_ledger', 'field'=>'invoice_no','length' => 8, 'prefix' =>'PINV-']);



		foreach ($data as $d) {
			DB::table("purchase_entry")->insert([
				'invoice_no'        => $invoice_no,
				'product_id'        => $d->pdt_id,
				'sub_unit_id'       => $d->sub_unit_id,
				'product_quantity'  => $d->purchase_quantity,
				'purchase_price'    => $d->purchase_price,
				'per_unit_cost'     => $d->per_unit_cost,
				'discount_amount'   => $d->discount_amount,
				'admin_id'          => Auth('admin')->user()->id,
				'branch_id'         => Auth('admin')->user()->branch,


			]);

			$checkstockproduct =  DB::table("stock_products")->where("product_id",$d->pdt_id)->where("branch_id",Auth('admin')->user()->branch)->first();

			$qtysum =  DB::table("stock_products")->where("product_id",$d->pdt_id)->where("branch_id",Auth('admin')->user()->branch)->sum("quantity");

		

			if ($checkstockproduct) {
				DB::table("stock_products")->where("product_id",$d->pdt_id)->where("branch_id",Auth('admin')->user()->branch)->update([
					'quantity'                =>  $qtysum+$d->purchase_quantity,
					'purchase_price'          =>  $d->purchase_price-$d->discount_amount,
					'purchase_price_withcost' =>  ($d->purchase_price+$d->per_unit_cost)-$d->discount_amount,
					'sale_price'              =>  $d->sale_price_per_unit,

				]);
			}
			else{
				DB::table("stock_products")->insert([
					'invoice_no'              =>  $invoice_no,
					'product_id'              =>  $d->pdt_id,
					'quantity'                =>  $d->purchase_quantity,
					'purchase_price'          =>  $d->purchase_price-$d->discount_amount,
					'purchase_price_withcost' =>  ($d->purchase_price+$d->per_unit_cost)-$d->discount_amount,
					'sale_price'              =>  $d->sale_price_per_unit,
					'branch_id'               =>  Auth('admin')->user()->branch,
				]);
			}


		}  


		$explode = explode('/',$request->invoice_date);
		$invoice_date = $explode[2].'-'.$explode[0].'-'.$explode[1]; 


		DB::table("purchase_ledger")->insert([
			'invoice_no'       => $invoice_no,
			'voucher_no'       => $request->voucher_no,
			'voucher_date'     => $invoice_date,
			'invoice_date'     => $invoice_date,
			'suplier_id'       => $request->supplier_id,
			'total'            => $request->totalamount,
			'paid'             => $request->paid,
			'discount'         => $request->discount,
			'transaction_type' => $request->transaction_type,
			'entry_date'       => date('Y-m-d'),
			'admin_id'         => Auth('admin')->user()->id,
			'branch_id'        => Auth('admin')->user()->branch,


		]);


		DB::table("supplier_payment")->insert([
			'invoice_no'       => $invoice_no,
			'payment_date'     => $invoice_date,
			'entry_date'	   => date('Y-m-d'),
			'suplier_id'       => $request->supplier_id,
			'return_amount'    => "0.00",
			'payment'          => $request->paid,
			'payment_type'     => $request->transaction_type,
			'comment'          => "firstpayment",
			'admin_id'         => Auth('admin')->user()->id,
			'branch_id'        => Auth('admin')->user()->branch,


		]);


		DB::table('purchase_current')->where('session_id',$session_id)->delete();
		Session::regenerate();



		return redirect('invoicepurchase/'.$invoice_no);


	}

	public function invoicepurchase($id){

		$data = DB::table('purchase_ledger')
		->where("purchase_ledger.invoice_no",$id)
		->join("supplier_info",'supplier_info.supplier_id','purchase_ledger.suplier_id')
		->join("admins",'admins.id','purchase_ledger.admin_id')
		->select("purchase_ledger.*",'supplier_info.supplier_company_name','supplier_info.supplier_company_phone','admins.name')
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
		->select("purchase_ledger.*",'supplier_info.supplier_company_name','supplier_info.supplier_company_phone','admins.name')
		->orderBy("purchase_ledger.id",'DESC')
		->where("purchase_ledger.branch_id",Auth('admin')->user()->branch)
		->limit(25)
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

		DB::table("purchase_entry")
		->where("invoice_no",$data->invoice_no)
		->delete();

		DB::table("supplier_payment")
		->where("invoice_no",$data->invoice_no)
		->delete();


		DB::table("stock_products")
		->where("invoice_no",$data->invoice_no)
		->delete();


	}


	public function searchpurchaseinvoice(Request $r){

		$fromdate   = $r->fromdate;
		$todate     = $r->todate;

		$explode = explode('/',$r->fromdate);
		$fromdates = $explode[2].'-'.$explode[0].'-'.$explode[1]; 

		$explode = explode('/',$r->todate);
		$todates = $explode[2].'-'.$explode[0].'-'.$explode[1]; 

		if($fromdates != "" && $todates != ""){
			$data = DB::table('purchase_ledger')
			->whereBetween("purchase_ledger.invoice_date",array($fromdates,$todates))
			->join("supplier_info",'supplier_info.supplier_id','purchase_ledger.suplier_id')
			->select("purchase_ledger.*",'supplier_info.supplier_company_name','supplier_info.supplier_company_phone')
			->where("purchase_ledger.branch_id",Auth('admin')->user()->branch)
			->get();

		}


		return view("Admin.purchase.searchpurchaseinvoice",compact('data'));

	}





	public function searchpurchaseinvoice2(Request $r){


		$invoice_no = $r->invoice_no;


		$data = DB::table('purchase_ledger')
		->where("purchase_ledger.invoice_no",$invoice_no)
		->join("supplier_info",'supplier_info.supplier_id','purchase_ledger.suplier_id')
		->select("purchase_ledger.*",'supplier_info.supplier_company_name','supplier_info.supplier_company_phone')
		->where("purchase_ledger.branch_id",Auth('admin')->user()->branch)
		->get();

		return view("Admin.purchase.searchpurchaseinvoice",compact('data'));

	}



	public function allpurchaseledgerreports(){

		return view("Admin.purchase.allpurchaseledgerreports");

	}



	public function purchaseledgerreports(Request $request){

		$suplier_id = $request->suplier_id;
		$type       = $request->Type;
		$date1      = $request->start_date;
		$date2      = $request->end_date;
		$month      = $request->month;
		$year       = $request->year;


		if ($request->suplier_id == "All") {
			
			if ($type == 1) {

				$data = DB::table('purchase_ledger')
				->join("supplier_info",'supplier_info.supplier_id','purchase_ledger.suplier_id')
				->select("purchase_ledger.*",'supplier_info.supplier_company_name','supplier_info.supplier_company_phone')
				->where("purchase_ledger.invoice_date",$date1)
				->where("purchase_ledger.branch_id",Auth('admin')->user()->branch)
				->get();
			}

			elseif($type == 2){
				$data = DB::table('purchase_ledger')
				->join("supplier_info",'supplier_info.supplier_id','purchase_ledger.suplier_id')
				->select("purchase_ledger.*",'supplier_info.supplier_company_name','supplier_info.supplier_company_phone')
				->whereBetween("purchase_ledger.invoice_date",array($date1,$date2))
				->where("purchase_ledger.branch_id",Auth('admin')->user()->branch)
				->get();
			}


			elseif($type == 3){
				$data = DB::table('purchase_ledger')
				->join("supplier_info",'supplier_info.supplier_id','purchase_ledger.suplier_id')
				->select("purchase_ledger.*",'supplier_info.supplier_company_name','supplier_info.supplier_company_phone')
				->whereMonth("purchase_ledger.invoice_date",$month)
				->whereYear("purchase_ledger.invoice_date",$year)
				->where("purchase_ledger.branch_id",Auth('admin')->user()->branch)
				->get();
			}


			elseif($type == 4){
				$data = DB::table('purchase_ledger')
				->join("supplier_info",'supplier_info.supplier_id','purchase_ledger.suplier_id')
				->select("purchase_ledger.*",'supplier_info.supplier_company_name','supplier_info.supplier_company_phone')
				->whereYear("purchase_ledger.invoice_date",$year)
				->where("purchase_ledger.branch_id",Auth('admin')->user()->branch)
				->get();


			}



		}
		else{


			if ($type == 1) {

				$data = DB::table('purchase_ledger')
				->join("supplier_info",'supplier_info.supplier_id','purchase_ledger.suplier_id')
				->select("purchase_ledger.*",'supplier_info.supplier_company_name','supplier_info.supplier_company_phone')
				->where("purchase_ledger.invoice_date",$date1)
				->where("purchase_ledger.suplier_id",$suplier_id)
				->where("purchase_ledger.branch_id",Auth('admin')->user()->branch)
				->get();
			}

			elseif($type == 2){
				$data = DB::table('purchase_ledger')
				->join("supplier_info",'supplier_info.supplier_id','purchase_ledger.suplier_id')
				->select("purchase_ledger.*",'supplier_info.supplier_company_name','supplier_info.supplier_company_phone')
				->whereBetween("purchase_ledger.invoice_date",array($date1,$date2))
				->where("purchase_ledger.suplier_id",$suplier_id)
				->where("purchase_ledger.branch_id",Auth('admin')->user()->branch)
				->get();
			}


			elseif($type == 3){
				$data = DB::table('purchase_ledger')
				->join("supplier_info",'supplier_info.supplier_id','purchase_ledger.suplier_id')
				->select("purchase_ledger.*",'supplier_info.supplier_company_name','supplier_info.supplier_company_phone')
				->whereMonth("purchase_ledger.invoice_date",$month)
				->whereYear("purchase_ledger.invoice_date",$year)
				->where("purchase_ledger.suplier_id",$suplier_id)
				->where("purchase_ledger.branch_id",Auth('admin')->user()->branch)
				->get();
			}


			elseif($type == 4){
				$data = DB::table('purchase_ledger')
				->join("supplier_info",'supplier_info.supplier_id','purchase_ledger.suplier_id')
				->select("purchase_ledger.*",'supplier_info.supplier_company_name','supplier_info.supplier_company_phone')
				->whereYear("purchase_ledger.invoice_date",$year)
				->where("purchase_ledger.suplier_id",$suplier_id)
				->where("purchase_ledger.branch_id",Auth('admin')->user()->branch)
				->get();


			}


		}




		return view("Admin.purchase.purchaseledgerreports",compact('data','type','date1','date2','month','year'));

	}
	


	public function purchasepayment(){
		return view('Admin.purchase.purchasepayment');
	}


	public function purchasepaymententry(Request $r){

		$explode = explode('/',$r->payment_date);
		$payment_date = $explode[2].'-'.$explode[0].'-'.$explode[1]; 


		DB::table("supplier_payment")->insert([

			'payment_date'   => $payment_date,
			'suplier_id'     => $r->suplier_id,
			'payment'        => $r->payment,
			'payment_type'   => $r->payment_type,
			'return_amount'  => 0.00,
			'entry_date'     => date('Y-m-d'),
			'comment'        => $r->comment,
			'admin_id'       => Auth('admin')->user()->id,
			'branch_id'      => Auth('admin')->user()->branch,

		]);
	}

	public function purchasepaymentlist(){
		$data = DB::table("supplier_payment")
		->join('supplier_info','supplier_info.supplier_id','supplier_payment.suplier_id')
		->select("supplier_payment.*",'supplier_info.supplier_company_name','supplier_info.supplier_company_phone')
		->where("supplier_payment.branch_id",Auth('admin')->user()->branch)
		->get();
		return view("Admin.purchase.purchasepaymentlist", compact('data'));
	}


	public function deletepurchaseentry($id){
		DB::table("supplier_payment")->where("id",$id)->delete();
	}


	public function editpurchasepaymententry($id){

		$data = DB::table("supplier_payment")->where("id",$id)->first();

		$total        = DB::table("purchase_ledger")->where("suplier_id",$data->suplier_id)->sum('total');
		$discount     = DB::table("purchase_ledger")->where("suplier_id",$data->suplier_id)->sum('discount');
		$grandtotal   = $total-$discount;
		$paid         = DB::table("supplier_payment")->where("suplier_id",$data->suplier_id)->sum('payment');
		$totaldue     = $grandtotal-$paid;

		$supplier_phone   = DB::table("supplier_info")->where("supplier_id",$data->suplier_id)->first();

		return view("Admin.purchase.editpurchasepaymententry",compact('data','totaldue','supplier_phone'));
	}



	public function updatepurchasepayment(Request $r,$id){

		$explode = explode('/',$r->payment_date);
		$payment_date = $explode[2].'-'.$explode[0].'-'.$explode[1];


		DB::table("supplier_payment")->where("id",$id)->update([

			'payment_date'   => $payment_date,
			'suplier_id'     => $r->suplier_id,
			'payment'        => $r->payment,
			'payment_type'   => $r->payment_type,
			'return_amount'  => 0.00,
			'entry_date'     => date('Y-m-d'),
			'comment'        => $r->comment,
			'admin_id'       => Auth('admin')->user()->id,
			'branch_id'      => Auth('admin')->user()->branch,

		]);
	}


	public function getsuplierpreviousdue($id){

		$total      = DB::table("purchase_ledger")->where("suplier_id",$id)->sum('total');
		$discount   = DB::table("purchase_ledger")->where("suplier_id",$id)->sum('discount');
		$grandtotal = $total-$discount;
		$paid       = DB::table("supplier_payment")->where("suplier_id",$id)->sum('payment');
		$totaldue   = $grandtotal-$paid;

		return response()->json($totaldue);

	}



	public function purchasepaymentinvoice($id){
		$data = DB::table("supplier_payment")
		->where("supplier_payment.id",$id)
		->join('supplier_info','supplier_info.supplier_id','supplier_payment.suplier_id')
		->select("supplier_payment.*",'supplier_info.supplier_company_name','supplier_info.supplier_company_phone')
		->first();


		return view('Admin.purchase.purchasepaymentinvoice', compact('data'));
	}


}
