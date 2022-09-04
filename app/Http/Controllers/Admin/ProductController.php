<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use DB;

class ProductController extends Controller
{
	public function item(){
		$data = DB::table('pdt_item')->get();
		return view('Admin.product.item',compact('data'));
	}

	public function iteminsert(Request $r){

		$id = IdGenerator::generate(['table' => 'pdt_item', 'field'=>'item_id','length' => 6, 'prefix' =>'ITM-']);


		$data = array(
			'item_id'        => $id,
			'item_name_en'    => $r->item_name_en, 
			'item_name_bn'    => $r->item_name_bn, 
			'item_url'        => $r->item_url, 
			'item_status'     => $r->item_status, 
			'item_admin_id'   => Auth('admin')->user()->id, 

		);

		DB::table('pdt_item')->insert($data);
	}

	public function iteminsert2(Request $r){

		$id = IdGenerator::generate(['table' => 'pdt_item', 'field'=>'item_id','length' => 6, 'prefix' =>'ITM-']);


		$data = array(
			'item_id'        => $id,
			'item_name_en'    => $r->item_name_en, 
			'item_name_bn'    => $r->item_name_bn, 
			'item_admin_id'   => Auth('admin')->user()->id, 

		);

		DB::table('pdt_item')->insert($data);
		return redirect()->back();
	}

	

	public function deleteitem($id){

		DB::table('pdt_item')->where('item_id',$id)->delete();
	}

	public function getitem(){
		$data = DB::table('pdt_item')->get();
		return view('Admin.product.getitem',compact('data'));
	}


	public function edititem($id){

		$data = DB::table('pdt_item')->where('item_id',$id)->first();
		return view('Admin.product.edititem',compact('data'));
	}


	public function updateitem(Request $r,$id){

		$data = array(
			'item_id'        => $id,
			'item_name_en'    => $r->item_name_en, 
			'item_name_bn'    => $r->item_name_bn, 
			'item_url'        => $r->item_url, 
			'item_status'     => $r->item_status, 
			'item_admin_id'   => Auth('admin')->user()->id,
		);

		DB::table('pdt_item')->where('item_id',$id)->update($data);
	}


// End Item



	public function category(){
		$data = DB::table('pdt_category')
		->join('pdt_item','pdt_item.item_id','pdt_category.cat_item_id')
		->select('pdt_category.*','pdt_item.item_name_bn','pdt_item.item_name_en')
		->get();
		return view('Admin.product.category',compact('data'));
	}

	public function categoryinsert(Request $r){

		$id = IdGenerator::generate(['table' => 'pdt_category', 'field'=>'cat_id','length' => 6, 'prefix' =>'CAT-']);


		$data = array(
			'cat_id'         => $id,
			'cat_item_id'    => $r->cat_item_id, 
			'cat_name_en'    => $r->cat_name_en, 
			'cat_name_bn'    => $r->cat_name_bn, 
			'cat_url'        => $r->cat_url, 
			'cat_status'     => $r->cat_status, 
			'cat_admin_id'   => Auth('admin')->user()->id, 

		);

		DB::table('pdt_category')->insert($data);
	}



	public function categoryinsert2(Request $r){

		$id = IdGenerator::generate(['table' => 'pdt_category', 'field'=>'cat_id','length' => 6, 'prefix' =>'CAT-']);


		$data = array(
			'cat_id'         => $id,
			'cat_item_id'    => $r->cat_item_id, 
			'cat_name_en'    => $r->cat_name_en, 
			'cat_name_bn'    => $r->cat_name_bn, 
			'cat_url'        => $r->cat_url, 
			'cat_status'     => $r->cat_status, 
			'cat_admin_id'   => Auth('admin')->user()->id, 

		);

		DB::table('pdt_category')->insert($data);
		return redirect()->back();
	}


	

	public function deletecategory($id){

		DB::table('pdt_category')->where('cat_id',$id)->delete();
	}

	public function getcategory(){
		$data = DB::table('pdt_category')
		->join('pdt_item','pdt_item.item_id','pdt_category.cat_item_id')
		->select('pdt_category.*','pdt_item.item_name_bn','pdt_item.item_name_en')
		->get();
		return view('Admin.product.getcategory',compact('data'));
	}


	public function editcategory($id){

		$data = DB::table('pdt_category')->where('cat_id',$id)->first();
		return view('Admin.product.editcategory',compact('data'));
	}


	public function updatecategory(Request $r,$id){

		$data = array(
			'cat_id'         => $id,
			'cat_item_id'    => $r->cat_item_id, 
			'cat_name_en'    => $r->cat_name_en, 
			'cat_name_bn'    => $r->cat_name_bn, 
			'cat_url'        => $r->cat_url, 
			'cat_status'     => $r->cat_status, 
			'cat_admin_id'   => Auth('admin')->user()->id, 
		);

		DB::table('pdt_category')->where('cat_id',$id)->update($data);
	}

	// End Category






	public function subcategory(){
		$data = DB::table('pdt_subcategory')
		->join('pdt_item','pdt_item.item_id','pdt_subcategory.subcat_item_id')
		->join('pdt_category','pdt_category.cat_id','pdt_subcategory.subcat_cat_id')
		->select('pdt_subcategory.*','pdt_item.item_name_bn','pdt_item.item_name_en','pdt_category.cat_name_en','pdt_category.cat_name_bn')
		->get();
		return view('Admin.product.subcategory',compact('data'));
	}

	public function subcategoryinsert(Request $r){

		$id = IdGenerator::generate(['table' => 'pdt_subcategory', 'field'=>'subcat_id','length' => 6, 'prefix' =>'SUB-']);


		$data = array(
			'subcat_id'         => $id,
			'subcat_item_id'    => $r->subcat_item_id, 
			'subcat_cat_id'     => $r->subcat_cat_id, 
			'subcat_name_en'    => $r->subcat_name_en, 
			'subcat_name_bn'    => $r->subcat_name_bn, 
			'subcat_url'        => $r->subcat_url, 
			'subcat_status'     => $r->subcat_status, 
			'subcat_admin_id'      => Auth('admin')->user()->id, 

		);

		DB::table('pdt_subcategory')->insert($data);
	}

	public function deletesubcategory($id){

		DB::table('pdt_subcategory')->where('subcat_id',$id)->delete();
	}

	public function getsubcategory(){
		$data = DB::table('pdt_subcategory')
		->join('pdt_item','pdt_item.item_id','pdt_subcategory.subcat_item_id')
		->join('pdt_category','pdt_category.cat_id','pdt_subcategory.subcat_cat_id')
		->select('pdt_subcategory.*','pdt_item.item_name_bn','pdt_item.item_name_en','pdt_category.cat_name_en','pdt_category.cat_name_bn')
		->get();
		return view('Admin.product.getsubcategory',compact('data'));
	}


	public function editsubcategory($id){

		$data = DB::table('pdt_subcategory')->where('subcat_id',$id)->first();
		return view('Admin.product.editsubcategory',compact('data'));
	}


	public function updatesubcategory(Request $r,$id){

		$data = array(
			'subcat_id'         => $id,
			'subcat_item_id'    => $r->subcat_item_id, 
			'subcat_cat_id'     => $r->subcat_cat_id, 
			'subcat_name_en'    => $r->subcat_name_en, 
			'subcat_name_bn'    => $r->subcat_name_bn, 
			'subcat_url'        => $r->subcat_url, 
			'subcat_status'     => $r->subcat_status, 
			'subcat_admin_id'      => Auth('admin')->user()->id, 

		);

		DB::table('pdt_subcategory')->where('subcat_id',$id)->update($data);
	}

	// End Subcategory







	public function brand(){
		$data = DB::table('pdt_brand')->get();
		return view('Admin.product.brand',compact('data'));
	}

	public function brandinsert(Request $r){

		$id = IdGenerator::generate(['table' => 'pdt_brand', 'field'=>'brand_id','length' => 6, 'prefix' =>'BRN-']);


		$data = array(
			'brand_id'        => $id,
			'brand_name_en'    => $r->brand_name_en, 
			'brand_name_bn'    => $r->brand_name_bn,
			'brand_status'     => $r->brand_status, 
			'brand_admin_id'   => Auth('admin')->user()->id, 

		);

		DB::table('pdt_brand')->insert($data);
	}


	public function brandinsert2(Request $r){

		$id = IdGenerator::generate(['table' => 'pdt_brand', 'field'=>'brand_id','length' => 6, 'prefix' =>'BRN-']);


		$data = array(
			'brand_id'        => $id,
			'brand_name_en'    => $r->brand_name_en, 
			'brand_name_bn'    => $r->brand_name_bn,
			'brand_status'     => $r->brand_status, 
			'brand_admin_id'   => Auth('admin')->user()->id, 

		);

		DB::table('pdt_brand')->insert($data);
		return redirect()->back();
	}

	

	public function deletebrand($id){

		DB::table('pdt_brand')->where('brand_id',$id)->delete();
	}

	public function getbrand(){
		$data = DB::table('pdt_brand')->get();
		return view('Admin.product.getbrand',compact('data'));
	}


	public function editbrand($id){

		$data = DB::table('pdt_brand')->where('brand_id',$id)->first();
		return view('Admin.product.editbrand',compact('data'));
	}


	public function updatebrand(Request $r,$id){

		$data = array(
			'brand_id'        => $id,
			'brand_name_en'    => $r->brand_name_en, 
			'brand_name_bn'    => $r->brand_name_bn,
			'brand_status'     => $r->brand_status, 
			'brand_admin_id'   => Auth('admin')->user()->id, 

		);

		DB::table('pdt_brand')->where('brand_id',$id)->update($data);
	}


// End Brand




	public function measurement(){
		$data = DB::table('measurement_unit')->get();
		return view('Admin.product.measurement',compact('data'));
	}

	public function measurementinsert(Request $r){


		$data = array(	
			'measurement_sl'       => $r->measurement_sl , 
			'measurement_unit'      => $r->measurement_unit,
			'measurement_admin_id'  => Auth('admin')->user()->id, 

		);

		DB::table('measurement_unit')->insert($data);
	}

	public function deletemeasurement($id){

		DB::table('measurement_unit')->where('measurement_id',$id)->delete();
	}

	public function getmeasurement(){
		$data = DB::table('measurement_unit')->get();
		return view('Admin.product.getmeasurement',compact('data'));
	}


	public function editmeasurement($id){

		$data = DB::table('measurement_unit')->where('measurement_id',$id)->first();
		return view('Admin.product.editmeasurement',compact('data'));
	}


	public function updatemeasurement(Request $r,$id){

		$data = array(
			'measurement_sl'       => $r->measurement_sl, 
			'measurement_unit'      => $r->measurement_unit,
			'measurement_admin_id'  => Auth('admin')->user()->id, 

		);

		DB::table('measurement_unit')->where('measurement_id',$id)->update($data);
	}


// End Measurement




	public function product(){
		return view('Admin.product.product');
	}



	public function productinsert(Request $r){

		$id = IdGenerator::generate(['table' => 'pdt_productinfo', 'field'=>'pdt_id','length' => 8, 'prefix' =>'p-']);


		$data = array(
			'pdt_id'             => $id,
			'pdt_item_id'        => $r->pdt_item_id, 
			'pdt_cat_id'         => $r->pdt_cat_id, 
			'pdt_subcat_id'      => $r->pdt_subcat_id, 
			'pdt_brand_id'       => $r->pdt_brand_id, 
			'pdt_name_en'        => $r->pdt_name_en, 
			'pdt_name_bn'        => $r->pdt_name_bn,
			'pdt_measurement'    => $r->pdt_measurement,
			'pdt_purchase_price' => $r->pdt_purchase_price,
			'pdt_sale_price'     => $r->pdt_sale_price,
			'pdt_short_details'  => $r->pdt_short_details,
			'pdt_details'        => $r->pdt_details,
			'pdt_condition'      => $r->pdt_condition,
			'pdt_barcode'        => $r->pdt_barcode,
			'pdt_suspension'     => $r->pdt_suspension,
			'pdt_shelf_no'       => $r->pdt_shelf_no,
			'pdt_over_stock'     => $r->pdt_over_stock,
			'pdt_order_qunt'     => $r->pdt_order_qunt,
			'pdt_url'            => $r->pdt_url,
			'pdt_status'         => $r->pdt_status,
			'pdt_barcode'        => $id,
			'pdt_admin_id'       => Auth('admin')->user()->id,
		);

		DB::table('pdt_productinfo')->insert($data);
	}

	public function deleteproduct($id){

		DB::table('pdt_productinfo')->where('pdt_id',$id)->delete();
	}

	public function manageproduct(){
		$data = DB::table('pdt_productinfo')
		->leftjoin('pdt_item','pdt_item.item_id','pdt_productinfo.pdt_item_id')
		->leftjoin('pdt_category','pdt_category.cat_id','pdt_productinfo.pdt_cat_id')
		->leftjoin('pdt_subcategory','pdt_subcategory.subcat_id','pdt_productinfo.pdt_subcat_id')
		->leftjoin('pdt_brand','pdt_brand.brand_id','pdt_productinfo.pdt_brand_id')
		->leftjoin('measurement_unit','measurement_unit.measurement_id','pdt_productinfo.pdt_measurement')
		->select('pdt_productinfo.*','pdt_item.item_name_en','pdt_item.item_name_bn','pdt_category.cat_name_en','pdt_category.cat_name_bn','pdt_subcategory.subcat_name_en','pdt_subcategory.subcat_name_bn','pdt_brand.brand_name_en','pdt_brand.brand_name_bn','measurement_unit.measurement_unit')
		->paginate(25);
		return view('Admin.product.manageproduct',compact('data'));
	}


	public function editproduct($id){

		$data = DB::table('pdt_productinfo')->where('pdt_id',$id)->first();
		return view('Admin.product.editproduct',compact('data'));
	}


	public function updateproduct(Request $r,$id){

		$data = array(
			'pdt_item_id'        => $r->pdt_item_id, 
			'pdt_cat_id'         => $r->pdt_cat_id, 
			'pdt_subcat_id'      => $r->pdt_subcat_id, 
			'pdt_brand_id'       => $r->pdt_brand_id, 
			'pdt_name_en'        => $r->pdt_name_en, 
			'pdt_name_bn'        => $r->pdt_name_bn,
			'pdt_measurement'    => $r->pdt_measurement,
			'pdt_purchase_price' => $r->pdt_purchase_price,
			'pdt_sale_price'     => $r->pdt_sale_price,
			'pdt_short_details'  => $r->pdt_short_details,
			'pdt_details'        => $r->pdt_details,
			'pdt_condition'      => $r->pdt_condition,
			'pdt_barcode'        => $r->pdt_barcode,
			'pdt_suspension'     => $r->pdt_suspension,
			'pdt_shelf_no'       => $r->pdt_shelf_no,
			'pdt_over_stock'     => $r->pdt_over_stock,
			'pdt_order_qunt'     => $r->pdt_order_qunt,
			'pdt_url'            => $r->pdt_url,
			'pdt_status'         => $r->pdt_status,
			'pdt_barcode'        => $id,
			'pdt_admin_id'       => Auth('admin')->user()->id,
		);
		DB::table('pdt_productinfo')->where('pdt_id',$id)->update($data);
	}



	public function searchproduct(Request $request){

		$searchproduct = $request->searchproduct;

		if ($searchproduct == NULL) {
			$data = DB::table('pdt_productinfo')
			->leftjoin('pdt_item','pdt_item.item_id','pdt_productinfo.pdt_item_id')
			->leftjoin('pdt_category','pdt_category.cat_id','pdt_productinfo.pdt_cat_id')
			->leftjoin('pdt_subcategory','pdt_subcategory.subcat_id','pdt_productinfo.pdt_subcat_id')
			->leftjoin('pdt_brand','pdt_brand.brand_id','pdt_productinfo.pdt_brand_id')
			->leftjoin('measurement_unit','measurement_unit.measurement_id','pdt_productinfo.pdt_measurement')
			->select('pdt_productinfo.*','pdt_item.item_name_en','pdt_item.item_name_bn','pdt_category.cat_name_en','pdt_category.cat_name_bn','pdt_subcategory.subcat_name_en','pdt_subcategory.subcat_name_bn','pdt_brand.brand_name_en','pdt_brand.brand_name_bn','measurement_unit.measurement_unit')
			->paginate(25);
		}
		else{
			$data = DB::table('pdt_productinfo')
			->leftjoin('pdt_item','pdt_item.item_id','pdt_productinfo.pdt_item_id')
			->leftjoin('pdt_category','pdt_category.cat_id','pdt_productinfo.pdt_cat_id')
			->leftjoin('pdt_subcategory','pdt_subcategory.subcat_id','pdt_productinfo.pdt_subcat_id')
			->leftjoin('pdt_brand','pdt_brand.brand_id','pdt_productinfo.pdt_brand_id')
			->leftjoin('measurement_unit','measurement_unit.measurement_id','pdt_productinfo.pdt_measurement')
			->select('pdt_productinfo.*','pdt_item.item_name_en','pdt_item.item_name_bn','pdt_category.cat_name_en','pdt_category.cat_name_bn','pdt_subcategory.subcat_name_en','pdt_subcategory.subcat_name_bn','pdt_brand.brand_name_en','pdt_brand.brand_name_bn','measurement_unit.measurement_unit')
			->orwhere('pdt_productinfo.pdt_name_en', 'like', '%' . $searchproduct . '%')
			->orwhere('pdt_productinfo.pdt_name_bn', 'like', '%' . $searchproduct . '%')
			->orwhere('pdt_item.item_name_en', 'like', '%' . $searchproduct . '%')
			->orwhere('pdt_item.item_name_bn', 'like', '%' . $searchproduct . '%')
			->paginate(50);
		}

		
		return view('Admin.product.searchproduct',compact('data'));
	}



// End Product Methods



	public function getcatajax($id){
		echo "<option value=''>Select Category</option>";
		$data = DB::table('pdt_category')->where('cat_item_id',$id)->get();
		foreach ($data as $d) {
			echo "<option value='$d->cat_id'>$d->cat_name_en ( $d->cat_name_bn )</option>";
		}
	}

	public function getsubcatajax($id){
		echo "<option value=''>Select Subcategory</option>";
		$data = DB::table('pdt_subcategory')->where('subcat_cat_id',$id)->get();
		foreach ($data as $d) {
			echo "<option value='$d->subcat_id'>$d->subcat_name_en ( $d->subcat_name_bn )</option>";
		}
	}


	public function getproductajax($id){
		echo "<option value=''>Select Product</option>";
		$data = DB::table('pdt_productinfo')->where('pdt_item_id',$id)->where('pdt_status',1)->get();
		foreach ($data as $d) {
			echo "<option value='$d->pdt_id'>$d->pdt_name_en $d->pdt_name_bn </option>";
		}
	}



	public function getsupplierphone($id){
		$data = DB::table('supplier_info')->where('supplier_id',$id)->first();

		echo "<div class='input-group-addon'><i class='fa fa-phone'></i></div><input type='number' value='$data->supplier_phone'  name='supplier_phone' id='supplier_phone' class='form-control' placeholder='Mobile' readonly>";
		
	}





	public function getsalesproductajax($id){
		echo "<option value=''>Select Product</option>";
		$data = DB::table('stock_products')
		->leftjoin("pdt_productinfo","pdt_productinfo.pdt_id","stock_products.product_id")
		->where("pdt_productinfo.pdt_item_id",$id)
		->select("stock_products.*","pdt_productinfo.pdt_name_en","pdt_productinfo.pdt_name_bn","pdt_productinfo.pdt_item_id")
		->get();


		foreach ($data as $d) {
			echo "<option value='$d->product_id'>$d->pdt_name_en $d->pdt_name_bn </option>";
		}
	}








// Ajax get data

}
