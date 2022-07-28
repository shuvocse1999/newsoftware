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







}
