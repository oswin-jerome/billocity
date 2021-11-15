<?php

namespace App\Http\Controllers;

use App\Models\Emi;
use App\Models\EmiEntry;
use App\Models\Expense;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Invoice;
use App\Models\Purchase;
use App\Models\Stock;
use App\Models\Supplier;
use Barryvdh\DomPDF\Facade as PDF;
use Carbon\Carbon;

class ReportController extends Controller
{
    

    public function stock(){

        $products = Product::with(["getcategory","getbrand"])->get();

        return view('pages/report/stock',['products'=>$products]);

    }

    public function stock_out(){

        // $products = Product::all();
        $products = Product::with(["getcategory","getbrand","sold","sold.prod"])->get();
        return view('pages/report/stockout',['products'=>$products]);

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

        $debits = [];
        $debits =  Purchase::where('total','>','paid');

        if(isset($request['from']) && isset($request['to'])){
            
            $debits = Purchase::whereDate('created_at','>=',$request['from'])->whereDate('created_at','<=',$request['to'])->where('total','>','paid');

            // return $request['from'];

        }

        return view('pages/report/supplierdebit',['debits'=>$debits->get()]);

    }

    public function emi(){
        $emis =  Emi::all();
        return view('pages/report/emi',['emis'=>$emis]);
    }

    public function emi_pay(Request $request){
        $entries = new EmiEntry();
        $entries = $entries->with('emi');
        $from= "";
        $to= "";
        $status = "";
        if(isset($request->from) && isset($request->to)){
            $from = $request->from;
            $to = $request->to;
            $entries = $entries->whereBetween('date',[Carbon::parse($request->from)->startOfMonth(),Carbon::parse($request->from)->endOfMonth()]);
        }else{
            $from = Carbon::today()->startOfMonth()->format('Y-m-d');
            $to =Carbon::today()->endOfMonth()->format('Y-m-d');;
            $entries = $entries->whereBetween('date',[Carbon::today()->startOfMonth(),Carbon::today()->endOfMonth()]);

        }

        if(isset($request->status)){
            $status = $request->status;
            if($request->status=="not_paid"){
                $entries = $entries->where("paid_date",null);
            }
        }else{
            $status = "not_paid";
            $entries = $entries->where("paid_date",null);
        }
        $entries = $entries->get();
        // dd($entries->get());
        return view('pages/report/emipay',['entries'=>$entries,"from"=>$from, "to"=>$to,"status"=>$status]);
    }


    public function stock_report_pdf(){
        $stockCostValue = 0;
        $stockSellingValue = 0;
        // $products = Product::select("price","stock","cost_price")->get();
        $products = Product::with(["getcategory","getbrand"])->get();
        // dd(count($products));
        foreach ($products as $key => $value) {
            $stockSellingValue+=$value->price * $value->stock;
            $stockCostValue+=$value->cost_price * $value->stock;
        }
        
        $pdf = PDF::loadView('pdf/stock',['products'=>$products,
        "stockSellingValue"=>$stockSellingValue,
        "stockCostValue"=>$stockCostValue]);
        return $pdf->stream('stock.pdf');
    }
    

}
