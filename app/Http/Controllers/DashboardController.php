<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Invoice;
use App\Models\SoldProduct;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Customer;
use App\Models\Product;
use App\Models\Purchase;
use App\Models\ReturnedProduct;
use App\Models\Stock;
use App\Models\Supplier;
class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $todaysProfit = Invoice::whereDate('created_at','=',now())->get()->sum('profit');
        $todaysSales = Invoice::whereDate('created_at','=',now())->get()->count();
        $countSold = SoldProduct::whereDate('created_at','=',now())->get()->sum('quantity');
        $stockAddedToday = Stock::whereDate('created_at','=',now())->get()->count();

        $totalFinal = Invoice::sum('final_price');
        $totalPaid = Invoice::sum('paid_amount');
        $debit = Purchase::sum('total') - Purchase::sum('paid');
        $prd = Purchase::all();
        // $debit = 0;
        // foreach ($prd as $key => $value) {
        //     $t = $value->products->sum('total');
        //     $pa = $value->sum('paid');
        //     $debit+=$t - $pa;
        // }

        $stockCostValue = 0;
        $stockSellingValue = 0;
        $products = Product::select("price","stock","cost_price")->get();
        // dd(count($products));
        foreach ($products as $key => $value) {
            $stockSellingValue+=$value->price * $value->stock;
            $stockCostValue+=$value->cost_price * $value->stock;
        }

        $lowstocks= Product::where('stock','<',10)->with(["getbrand"])->get();
        $pendingSupplier = Purchase::where('total','!=','paid')->with(["getsupplier"])->get();
        return view('pages/home/home',['todaysProfit'=>$todaysProfit,'countSold'=>$countSold,
        'stockAddedToday'=>$stockAddedToday,'todaysSales'=>$todaysSales,
        'credit'=>$totalFinal - $totalPaid,'debit'=>$debit,'lowstocks'=>$lowstocks,
        'pendingsupplier'=>$pendingSupplier,
        "stockSellingValue"=>$stockSellingValue,
        "stockCostValue"=>$stockCostValue
            
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
