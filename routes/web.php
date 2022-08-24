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
Route::get('/adminlogout', 'AdminController@adminlogout');




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
Route::post('/customerinsert2', 'Admin\CustomerController@customerinsert2');
Route::get('/deletecustomer/{id}', 'Admin\CustomerController@deletecustomer');
Route::get('/managecustomer', 'Admin\CustomerController@managecustomer');
Route::get('/editcustomer/{id}', 'Admin\CustomerController@editcustomer');
Route::post('/updatecustomer/{id}', 'Admin\CustomerController@updatecustomer');
Route::get('/customerduelist', 'Admin\CustomerController@customerduelist');



// Supplier Information Routes

Route::get('/supplier', 'Admin\SupplierController@supplier');
Route::post('/supplierinsert', 'Admin\SupplierController@supplierinsert');
Route::post('/supplierinsert2', 'Admin\SupplierController@supplierinsert2');
Route::get('/deletesupplier/{id}', 'Admin\SupplierController@deletesupplier');
Route::get('/managesupplier', 'Admin\SupplierController@managesupplier');
Route::get('/editsupplier/{id}', 'Admin\SupplierController@editsupplier');
Route::post('/updatesupplier/{id}', 'Admin\SupplierController@updatesupplier');
Route::get('/supplierduelist', 'Admin\SupplierController@supplierduelist');



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
Route::get('/searchproduct', 'Admin\ProductController@searchproduct');




// Ajax get data

Route::get('/getcatajax/{id}', 'Admin\ProductController@getcatajax');
Route::get('/getsubcatajax/{id}', 'Admin\ProductController@getsubcatajax');
Route::get('/getproductajax/{id}', 'Admin\ProductController@getproductajax');
Route::get('/getsupplierphone/{id}', 'Admin\ProductController@getsupplierphone');
Route::get('/getsalesproductajax/{id}', 'Admin\ProductController@getsalesproductajax');



		
// Purchase

Route::get('/purchase', 'Admin\PurchaseController@purchase');
Route::get('/purchaseproductcart/{id}', 'Admin\PurchaseController@purchaseproductcart');
Route::get('/showpurchaseproductcart', 'Admin\PurchaseController@showpurchaseproductcart');
Route::post('qtyupdate/{id}', 'Admin\PurchaseController@qtyupdate');
Route::get('deletepurchasecartproduct/{id}', 'Admin\PurchaseController@deletepurchasecartproduct');
Route::post('/purchasepriceupdate/{id}', 'Admin\PurchaseController@purchasepriceupdate');
Route::post('/purchasepricedicount/{id}', 'Admin\PurchaseController@purchasepricedicount');
Route::post('/purchasecost/{id}', 'Admin\PurchaseController@purchasecost');
Route::post('/purchaseledger', 'Admin\PurchaseController@purchaseledger');
Route::get('/invoicepurchase/{id}', 'Admin\PurchaseController@invoicepurchase');
Route::get('/allpurchaseledger', 'Admin\PurchaseController@allpurchaseledger');
Route::get('/deletepurchaseledger/{id}', 'Admin\PurchaseController@deletepurchaseledger');
Route::get('/searchpurchaseinvoice', 'Admin\PurchaseController@searchpurchaseinvoice');
Route::get('/searchpurchaseinvoice2', 'Admin\PurchaseController@searchpurchaseinvoice2');
Route::get('/allpurchaseledgerreports', 'Admin\PurchaseController@allpurchaseledgerreports');
Route::get('/purchaseledgerreports', 'Admin\PurchaseController@purchaseledgerreports');

Route::get('/purchasepayment', 'Admin\PurchaseController@purchasepayment');
Route::post('/purchasepaymententry', 'Admin\PurchaseController@purchasepaymententry');
Route::get('/purchasepaymentlist', 'Admin\PurchaseController@purchasepaymentlist');
Route::get('/deletepurchaseentry/{id}', 'Admin\PurchaseController@deletepurchaseentry');
Route::get('/editpurchasepaymententry/{id}', 'Admin\PurchaseController@editpurchasepaymententry');
Route::post('/updatepurchasepayment/{id}', 'Admin\PurchaseController@updatepurchasepayment');
Route::get('/getsuplierpreviousdue/{id}', 'Admin\PurchaseController@getsuplierpreviousdue');
Route::get('/purchasepaymentinvoice/{id}', 'Admin\PurchaseController@purchasepaymentinvoice');



// Sales

Route::get('/sales', 'Admin\SalesController@sales');
Route::get('/getcustomerphone/{id}', 'Admin\SalesController@getcustomerphone');
Route::get('/salesproductcart/{id}', 'Admin\SalesController@salesproductcart');
Route::get('/showsalesproductcart', 'Admin\SalesController@showsalesproductcart');
Route::get('deletesalescartproduct/{id}', 'Admin\SalesController@deletesalescartproduct');
Route::post('qtyupdatesales/{id}', 'Admin\SalesController@qtyupdatesales');
Route::post('/product_discount_amount/{id}', 'Admin\SalesController@product_discount_amount');
Route::post('salesledger', 'Admin\SalesController@salesledger');
Route::get('/invoicesales/{id}', 'Admin\SalesController@invoicesales');
Route::get('/allsalesledger', 'Admin\SalesController@allsalesledger');
Route::get('/deletesalesledger/{id}', 'Admin\SalesController@deletesalesledger');
Route::get('/searchsalesinvoice', 'Admin\SalesController@searchsalesinvoice');
Route::get('/searchsalesinvoice2', 'Admin\SalesController@searchsalesinvoice2');
Route::get('/allsalesledgerreports', 'Admin\SalesController@allsalesledgerreports');
Route::get('/salesledgerreports', 'Admin\SalesController@salesledgerreports');

Route::get('/salespayment', 'Admin\SalesController@salespayment');
Route::post('/salespaymententry', 'Admin\SalesController@salespaymententry');
Route::get('/getcustomerpreviousdue/{id}', 'Admin\SalesController@getcustomerpreviousdue');
Route::get('/salespaymentlist', 'Admin\SalesController@salespaymentlist');
Route::get('/salespaymentinvoice/{id}', 'Admin\SalesController@salespaymentinvoice');
Route::get('/deletesalesentry/{id}', 'Admin\SalesController@deletesalesentry');

Route::get('/editsalespaymententry/{id}', 'Admin\SalesController@editsalespaymententry');
Route::post('/updatesalespayment/{id}', 'Admin\SalesController@updatesalespayment');


// Income Expense Title

Route::get('/income_expensetitle', 'Admin\IncomeExpenseController@income_expensetitle');
Route::post('/income_expensetitleinsert', 'Admin\IncomeExpenseController@income_expensetitleinsert');
Route::get('/getincome_expensetitle', 'Admin\IncomeExpenseController@getincome_expensetitle');
Route::get('/deleteincome_expensetitle/{id}', 'Admin\IncomeExpenseController@deleteincome_expensetitle');
Route::get('/editincome_expensetitle/{id}', 'Admin\IncomeExpenseController@editincome_expensetitle');
Route::post('/updateincome_expensetitle/{id}', 'Admin\IncomeExpenseController@updateincome_expensetitle');


// Income Entry


Route::get('/incomeentry', 'Admin\IncomeExpenseController@incomeentry');
Route::post('/incomeentryinsert', 'Admin\IncomeExpenseController@incomeentryinsert');
Route::get('/getincomeentry', 'Admin\IncomeExpenseController@getincomeentry');
Route::get('/deleteincomeentry/{id}', 'Admin\IncomeExpenseController@deleteincomeentry');
Route::get('/editincomeentry/{id}', 'Admin\IncomeExpenseController@editincomeentry');
Route::post('/updateincomeentry/{id}', 'Admin\IncomeExpenseController@updateincomeentry');




// Expense Entry


Route::get('/expenseentry', 'Admin\IncomeExpenseController@expenseentry');
Route::post('/expenseentryinsert', 'Admin\IncomeExpenseController@expenseentryinsert');
Route::get('/getexpenseentry', 'Admin\IncomeExpenseController@getexpenseentry');
Route::get('/deleteexpenseentry/{id}', 'Admin\IncomeExpenseController@deleteexpenseentry');
Route::get('/editexpenseentry/{id}', 'Admin\IncomeExpenseController@editexpenseentry');
Route::post('/updateexpenseentry/{id}', 'Admin\IncomeExpenseController@updateexpenseentry');



// Stocks
Route::get('/stocks', 'Admin\StockController@stocks');
Route::get('/searchproductstock', 'Admin\StockController@searchproductstock');


// Bank

Route::get('/bankinformation', 'Admin\BankController@bankinformation');
Route::post('/bankinformationinsert', 'Admin\BankController@bankinformationinsert');
Route::get('/getbankinformation', 'Admin\BankController@getbankinformation');
Route::get('/deletebankinformation/{id}', 'Admin\BankController@deletebankinformation');
Route::get('/editbankinformation/{id}', 'Admin\BankController@editbankinformation');
Route::post('/updatebankinformation/{id}', 'Admin\BankController@updatebankinformation');



// Bank Transaction


Route::get('/banktransaction', 'Admin\BankController@banktransaction');
Route::post('/banktransactioninsert', 'Admin\BankController@banktransactioninsert');
Route::get('/managebanktransaction', 'Admin\BankController@managebanktransaction');
Route::get('/deletebanktransaction/{id}', 'Admin\BankController@deletebanktransaction');
Route::get('/editbanktransaction/{id}', 'Admin\BankController@editbanktransaction');
Route::post('/updatebanktransaction/{id}', 'Admin\BankController@updatebanktransaction');
Route::get('/gettotalamount/{id}', 'Admin\BankController@gettotalamount');
Route::get('/banktransactionreports', 'Admin\BankController@banktransactionreports');
Route::get('/bankvoucher/{id}', 'Admin\BankController@bankvoucher');
Route::get('/bankstatement', 'Admin\BankController@bankstatement');
Route::get('/bankstatementreports', 'Admin\BankController@bankstatementreports');



// Employee

Route::get('/employee', 'Admin\EmployeeController@employee');
Route::post('/employeeinsert', 'Admin\EmployeeController@employeeinsert');
Route::get('/deleteemployee/{id}', 'Admin\EmployeeController@deleteemployee');
Route::get('/manageemployee', 'Admin\EmployeeController@manageemployee');
Route::get('/editemployee/{id}', 'Admin\EmployeeController@editemployee');
Route::post('/updateemployee/{id}', 'Admin\EmployeeController@updateemployee');



Route::get('/employeesalarysetup', 'Admin\EmployeeController@employeesalarysetup');
Route::post('/employeesalarysetupinsert', 'Admin\EmployeeController@employeesalarysetupinsert');
Route::get('/getemployeesalarysetup', 'Admin\EmployeeController@getemployeesalarysetup');
Route::get('/deleteemployeesalarysetup/{id}', 'Admin\EmployeeController@deleteemployeesalarysetup');
Route::get('/editemployeesalarysetup/{id}', 'Admin\EmployeeController@editemployeesalarysetup');
Route::post('/updateemployeesalarysetup/{id}', 'Admin\EmployeeController@updateemployeesalarysetup');



Route::get('/employeesalary', 'Admin\EmployeeController@employeesalary');
Route::post('/employeesalaryinsert', 'Admin\EmployeeController@employeesalaryinsert');
Route::get('/deleteemployeesalary/{id}', 'Admin\EmployeeController@deleteemployeesalary');
Route::get('/manageemployeesalary', 'Admin\EmployeeController@manageemployeesalary');
Route::get('/editemployeesalary/{id}', 'Admin\EmployeeController@editemployeesalary');
Route::post('/updateemployeesalary/{id}', 'Admin\EmployeeController@updateemployeesalary');

Route::post('/depositeemployeesalary', 'Admin\EmployeeController@depositeemployeesalary');
Route::get('/getemployeebalance/{id}', 'Admin\EmployeeController@getemployeebalance');




