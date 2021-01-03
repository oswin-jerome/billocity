<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Invoice;
use App\Models\Stock;
class ReportController extends Controller
{
    

    public function stock(){

        $products = Product::all();

        return view('pages/report/stock',['products'=>$products]);

    }


    public function sales(Request $request){
        $invoices = [];
        $invoices =  new Invoice();

        if(isset($request['from']) && isset($request['to'])){
            
            $invoices = Invoice::whereDate('created_at','>=',$request['from'])->whereDate('created_at','<=',$request['to']);

            // return $request['from'];

        }


        return view('pages/report/sales',['invoices'=>$invoices->get()]);

    }

    public function stockin(Request $request){

        // $stocks = Stock::all();

        $stocks = [];
        $stocks =  new Stock();

        if(isset($request['from']) && isset($request['to'])){
            
            $stocks = Stock::whereDate('created_at','>=',$request['from'])->whereDate('created_at','<=',$request['to']);

            // return $request['from'];

        }

        return view('pages/report/stockin',['stocks'=>$stocks->get()]);

    }
    

}
