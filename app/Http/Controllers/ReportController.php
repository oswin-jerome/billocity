<?php

namespace App\Http\Controllers;

use App\Models\Expense;
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

    public function expense(Request $request){

        // $stocks = Stock::all();

        $stocks = [];
        $stocks =  new Expense();

        if(isset($request['from']) && isset($request['to'])){
            
            $stocks = Expense::whereDate('created_at','>=',$request['from'])->whereDate('created_at','<=',$request['to']);

            // return $request['from'];

        }

        return view('pages/report/expense',['expenses'=>$stocks->get()]);

    }


    public function c_credit(Request $request){
        $invoices = [];
        $invoices =  Invoice::where('status','=','PAUSED');

        if(isset($request['from']) && isset($request['to'])){
            
            $invoices = Invoice::whereDate('created_at','>=',$request['from'])->whereDate('created_at','<=',$request['to']);

            // return $request['from'];

        }


        return view('pages/report/customercredit',['invoices'=>$invoices->get()]);

    }

    public function s_debit(Request $request){

        // $stocks = Stock::all();

        $stocks = [];
        $stocks =  Stock::where('balance','>','0');

        if(isset($request['from']) && isset($request['to'])){
            
            $stocks = Stock::whereDate('created_at','>=',$request['from'])->whereDate('created_at','<=',$request['to']);

            // return $request['from'];

        }

        return view('pages/report/stockin',['stocks'=>$stocks->get()]);

    }
    

}
