<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\ReportController;

use App\Models\Product;
use App\Models\Customer;
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

Route::get('/', function () {
    return view('pages/home/home');
});

Route::get('/pos', function () {
    return view('pages/pos/pos',['products'=>Product::select('id','name')->get(),'customers'=>Customer::select('id','name','phone')->get()]);
});

Route::resource('brands',BrandController::class);
Route::resource('categories',CategoryController::class);
Route::resource('products',ProductController::class);
Route::resource('customers',CustomerController::class);
Route::resource('suppliers',SupplierController::class);
Route::resource('invoices',InvoiceController::class);
Route::get('prods/stockin','App\Http\Controllers\ProductController@stock_in_view');
Route::post('prods/stockin','App\Http\Controllers\ProductController@stock_in');
Route::get('prods/returned','App\Http\Controllers\InvoiceController@viewreturned');
Route::post('invoice/cancel','App\Http\Controllers\InvoiceController@cancelProduct');

Route::get('/test',function(){
    $product = new Product();
    return $product;
});




// Report
Route::get('reports/stock','App\Http\Controllers\ReportController@stock');
Route::get('reports/sales','App\Http\Controllers\ReportController@sales');
Route::get('reports/stockin','App\Http\Controllers\ReportController@stockin');