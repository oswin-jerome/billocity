<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Resources\ProductResource;
use App\Http\Resources\CustomerResource;
use App\Http\Resources\InvoiceResource;
use App\Models\Product;
use App\Models\Customer;
use App\Models\Invoice;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/products',function(){


    return ProductResource::collection(Product::all());

});

Route::get('/barcode/{code}',function(Request $request){
    return ProductResource::collection(Product::where('barcode','=',$request->code)->get());
});

Route::get('/product/{id}',function(Request $request){
    return ProductResource::collection(Product::where('id','=',$request->id)->get());
});

Route::get('/customer/{phone}',function(Request $request){
    return CustomerResource::collection(Customer::where('phone','=',$request->phone)->get());
});

Route::get('/invoice/{id}',function(Request $request){
    return InvoiceResource::collection(Invoice::where('id','=',$request->id)->get());
});
