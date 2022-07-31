<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Admin Routes

Route::get('/', function () {
	return redirect('admin');
});
Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/admin', 'Admin\LoginController@index');
Route::post('/adminlogin', 'Admin\LoginController@adminlogin')->name('admin.login');
Route::get('/AdminDashboard', 'AdminController@AdminDashboard');


// Software Information Routes

Route::get('/company', 'Admin\SoftwareController@company');
Route::post('/companyinsert', 'Admin\SoftwareController@companyinsert');
Route::get('/deletecompany/{id}', 'Admin\SoftwareController@deletecompany');
Route::get('/getcompany', 'Admin\SoftwareController@getcompany');
Route::get('/editcompany/{id}', 'Admin\SoftwareController@editcompany');
Route::post('/updatecompany/{id}', 'Admin\SoftwareController@updatecompany');


Route::get('/branch', 'Admin\SoftwareController@branch');
Route::post('/branchinsert', 'Admin\SoftwareController@branchinsert');
Route::get('/deletebranch/{id}', 'Admin\SoftwareController@deletebranch');
Route::get('/getbranch', 'Admin\SoftwareController@getbranch');
Route::get('/editbranch/{id}', 'Admin\SoftwareController@editbranch');
Route::post('/updatebranch/{id}', 'Admin\SoftwareController@updatebranch');


// Customer Information Routes

Route::get('/customer', 'Admin\CustomerController@customer');
Route::post('/customerinsert', 'Admin\CustomerController@customerinsert');
Route::get('/deletecustomer/{id}', 'Admin\CustomerController@deletecustomer');
Route::get('/managecustomer', 'Admin\CustomerController@managecustomer');
Route::get('/editcustomer/{id}', 'Admin\CustomerController@editcustomer');
Route::post('/updatecustomer/{id}', 'Admin\CustomerController@updatecustomer');


// Supplier Information Routes

Route::get('/supplier', 'Admin\SupplierController@supplier');
Route::post('/supplierinsert', 'Admin\SupplierController@supplierinsert');
Route::post('/supplierinsert2', 'Admin\SupplierController@supplierinsert2');
Route::get('/deletesupplier/{id}', 'Admin\SupplierController@deletesupplier');
Route::get('/managesupplier', 'Admin\SupplierController@managesupplier');
Route::get('/editsupplier/{id}', 'Admin\SupplierController@editsupplier');
Route::post('/updatesupplier/{id}', 'Admin\SupplierController@updatesupplier');


// Product Setting

Route::get('/item', 'Admin\ProductController@item');
Route::post('/iteminsert', 'Admin\ProductController@iteminsert');
Route::post('/iteminsert2', 'Admin\ProductController@iteminsert2');
Route::get('/getitem', 'Admin\ProductController@getitem');
Route::get('/deleteitem/{id}', 'Admin\ProductController@deleteitem');
Route::get('/edititem/{id}', 'Admin\ProductController@edititem');
Route::post('/updateitem/{id}', 'Admin\ProductController@updateitem');


Route::get('/category', 'Admin\ProductController@category');
Route::post('/categoryinsert', 'Admin\ProductController@categoryinsert');
Route::get('/getcategory', 'Admin\ProductController@getcategory');
Route::get('/deletecategory/{id}', 'Admin\ProductController@deletecategory');
Route::get('/editcategory/{id}', 'Admin\ProductController@editcategory');
Route::post('/updatecategory/{id}', 'Admin\ProductController@updatecategory');


Route::get('/subcategory', 'Admin\ProductController@subcategory');
Route::post('/subcategoryinsert', 'Admin\ProductController@subcategoryinsert');
Route::get('/getsubcategory', 'Admin\ProductController@getsubcategory');
Route::get('/deletesubcategory/{id}', 'Admin\ProductController@deletesubcategory');
Route::get('/editsubcategory/{id}', 'Admin\ProductController@editsubcategory');
Route::post('/updatesubcategory/{id}', 'Admin\ProductController@updatesubcategory');



Route::get('/brand', 'Admin\ProductController@brand');
Route::post('/brandinsert', 'Admin\ProductController@brandinsert');
Route::get('/getbrand', 'Admin\ProductController@getbrand');
Route::get('/deletebrand/{id}', 'Admin\ProductController@deletebrand');
Route::get('/editbrand/{id}', 'Admin\ProductController@editbrand');
Route::post('/updatebrand/{id}', 'Admin\ProductController@updatebrand');



Route::get('/measurement', 'Admin\ProductController@measurement');
Route::post('/measurementinsert', 'Admin\ProductController@measurementinsert');
Route::get('/getmeasurement', 'Admin\ProductController@getmeasurement');
Route::get('/deletemeasurement/{id}', 'Admin\ProductController@deletemeasurement');
Route::get('/editmeasurement/{id}', 'Admin\ProductController@editmeasurement');
Route::post('/updatemeasurement/{id}', 'Admin\ProductController@updatemeasurement');





//  Product info


Route::get('/product', 'Admin\ProductController@product');
Route::post('/productinsert', 'Admin\ProductController@productinsert');
Route::post('/productinsert2', 'Admin\ProductController@productinsert2');
Route::get('/deleteproduct/{id}', 'Admin\ProductController@deleteproduct');
Route::get('/manageproduct', 'Admin\ProductController@manageproduct');
Route::get('/editproduct/{id}', 'Admin\ProductController@editproduct');
Route::post('/updateproduct/{id}', 'Admin\ProductController@updateproduct');


// Ajax get data

Route::get('/getcatajax/{id}', 'Admin\ProductController@getcatajax');
Route::get('/getsubcatajax/{id}', 'Admin\ProductController@getsubcatajax');
Route::get('/getproductajax/{id}', 'Admin\ProductController@getproductajax');
Route::get('/getsupplierphone/{id}', 'Admin\ProductController@getsupplierphone');
		
// Purchase

Route::get('/purchase', 'Admin\PurchaseController@purchase');
Route::get('/purchaseproductcart/{id}', 'Admin\PurchaseController@purchaseproductcart');
Route::get('/showpurchaseproductcart', 'Admin\PurchaseController@showpurchaseproductcart');
Route::post('qtyupdate/{id}', 'Admin\PurchaseController@qtyupdate');
Route::get('deletepurchasecartproduct/{id}', 'Admin\PurchaseController@deletepurchasecartproduct');
Route::post('/purchasepriceupdate/{id}', 'Admin\PurchaseController@purchasepriceupdate');
Route::post('/purchaseledger', 'Admin\PurchaseController@purchaseledger');
Route::get('/invoicepurchase/{id}', 'Admin\PurchaseController@invoicepurchase');
Route::get('/allpurchaseledger', 'Admin\PurchaseController@allpurchaseledger');
Route::get('/deletepurchaseledger/{id}', 'Admin\PurchaseController@deletepurchaseledger');
Route::get('/searchpurchaseinvoice', 'Admin\PurchaseController@searchpurchaseinvoice');
Route::get('/searchpurchaseinvoice2', 'Admin\PurchaseController@searchpurchaseinvoice2');
Route::get('/allpurchaseledgerreports', 'Admin\PurchaseController@allpurchaseledgerreports');
Route::get('/purchaseledgerreports', 'Admin\PurchaseController@purchaseledgerreports');



// Sales

Route::get('/sales', 'Admin\SalesController@sales');