<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\ExpenseCategoryController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\StockController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\UserController;
use App\Models\Product;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;

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

Route::resource('/',DashboardController::class)->middleware("auth");

Route::get('/pos', function () {
    return view('pages/pos/pos',['products'=>Product::select('id','name')->get(),'customers'=>Customer::select('id','name','phone')->get()]);
})->middleware("auth");

Route::resource('expenses',ExpenseController::class)->middleware("auth");
Route::resource('expense-categories',ExpenseCategoryController::class)->middleware("auth");
Route::resource('brands',BrandController::class)->middleware("auth");
Route::resource('categories',CategoryController::class)->middleware("auth");
Route::resource('products',ProductController::class)->middleware("auth");
Route::resource('customers',CustomerController::class)->middleware("auth");
Route::resource('suppliers',SupplierController::class)->middleware("auth");
Route::resource('invoices',InvoiceController::class)->middleware("auth");
Route::resource('stocks',StockController::class)->middleware("auth");
Route::resource('users',UserController::class)->middleware("auth");
Route::resource('purchases',PurchaseController::class)->middleware("auth");

Route::get('prods/stockin','App\Http\Controllers\ProductController@stock_in_view')->middleware("auth");
Route::post('prods/stockin','App\Http\Controllers\ProductController@stock_in')->middleware("auth");
Route::get('prods/returned','App\Http\Controllers\InvoiceController@viewreturned')->middleware("auth");
Route::post('invoice/cancel','App\Http\Controllers\InvoiceController@cancelProduct')->middleware("auth");
Route::get('pending_customer_payment','App\Http\Controllers\InvoiceController@pending')->middleware("auth");
Route::post('invoice/get_pay','App\Http\Controllers\InvoiceController@get_pay')->middleware("auth");
Route::post('purchases/get_pay','App\Http\Controllers\PurchaseController@get_pay')->middleware("auth");
Route::get("/login","App\Http\Controllers\AuthController@view_login")->name("login");
Route::post("/login","App\Http\Controllers\AuthController@login");
Route::get('/test',function(){
    $product = new Product();
    return $product;
});




// Report
Route::get('reports/stock','App\Http\Controllers\ReportController@stock')->middleware("auth");
Route::get('reports/sales','App\Http\Controllers\ReportController@sales')->middleware("auth");
Route::get('reports/stockin','App\Http\Controllers\ReportController@stockin')->middleware("auth");
Route::get('reports/expense','App\Http\Controllers\ReportController@expense')->middleware("auth");
Route::get('reports/c_credit','App\Http\Controllers\ReportController@c_credit')->middleware("auth");
Route::get('reports/s_debit','App\Http\Controllers\ReportController@s_debit')->middleware("auth");
Route::get('reports/stock_out','App\Http\Controllers\ReportController@stock_out')->middleware("auth");

Route::get("barcode",function(){
    return view('pages/barcode/create');
});

Route::post("barcode",function(Request $request){
    return view('pages/barcode/view',["code"=>$request->code]);
})->name("barcode.generate");

Route::get('/logout',function(){
    Auth::logout();

    // $request->session()->invalidate();

    // $request->session()->regenerateToken();

    return redirect('/');
});


Route::get('/migrate',function(){
    return Artisan::call('migrate');
});