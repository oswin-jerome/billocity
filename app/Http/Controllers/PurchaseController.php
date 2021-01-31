<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Product;
use App\Models\Purchase;
use App\Models\Stock;
use App\Models\Supplier;
use Illuminate\Http\Request;

class PurchaseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages/purchase/view',[
            'purchases'=>Purchase::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages/purchase/add',['products'=>Product::select('id','name')->get(),'suppliers'=>Supplier::select('id','name','phone')->get()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // print_r($request->supplier);
        // print_r($request->invoice_no);
        // print_r($request->invoice_date);
        // print_r($request->ref_no);
        // print_r($request->products);
        // print_r($request->final_price);
        // print_r($request->discount_per);
        // print_r($request->quantities);
        // print_r($request->paid_amount);


        $purchase = new Purchase();
        $purchase->supplier = $request->supplier;
        $purchase->invoice_no = $request->invoice_no;
        $purchase->date = $request->invoice_date;
        $purchase->ref_no = $request->ref_no;
        $purchase->paid = $request->paid_amount;
        $purchase->save();


        $total = 0;

        foreach ($request->products as $key => $product) {
            $prod = Product::find($product);
            $stock = new Stock();
            $stock->product = $product;
            $stock->purchase = $purchase->id;
            $stock->stock = $request->quantities[$key];

            $stock->price = $prod->cost_price * $request->quantities[$key];
            $stock->discount = $request->discount_per[$key];
            $stock->total = ($prod->cost_price * $request->quantities[$key]) - ($stock->discount * ($prod->cost_price * $request->quantities[$key])/100);
            $total += $stock->total;
            $stock->save();
            $prod->stock += $stock->stock;
            $prod->save();
        }

        $purchase->total = $total;
        $purchase->save();
        
        
        return redirect()->back();



    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('pages/purchase/details',['invoice'=>Purchase::find($id)]);
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
        
        // Salse return
        $purchase = Purchase::find($id);

        foreach ($request->deleted as $key => $value) {
            $stockProduct = Stock::find($value);
            $product = Product::find($stockProduct->product);
            $product->stock = $product->stock -  $request->qty[$key];
            $product->save();
            $origstock = $stockProduct->stock;
            $stockProduct->stock -= $request->qty[$key];
            $stockProduct->price -= ($stockProduct->price/$origstock) * $request->qty[$key];
            $stockProduct->total -= ($stockProduct->total/$origstock) * $request->qty[$key];
            
            // $invoice->final_price = $invoice->final_price - ($stockProduct->sold_price * $stockProduct->quantity);
            // $invoice->total = $invoice->total - ($stockProduct->sold_price * $stockProduct->quantity);
            // $invoice->paid_amount = $invoice->paid_amount - ($stockProduct->sold_price * $stockProduct->quantity);
            // if($invoice->final_price==($invoice->paid_amount)){
            //     $invoice->status = 'COMPLETED';
    
            // }
            $purchase->total -=($stockProduct->total/$origstock) * $request->qty[$key];
            $purchase->save();
            // $stockProduct->status = "RETURNED";
            $stockProduct->save();
            // echo($soldProduct);
        }

        return redirect()->back();
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


    public function get_pay(Request $request){
        $invoice = Purchase::find($request->pid);
        $invoice->paid = $invoice->paid + $request->amount;
        // if($invoice->final_price==($invoice->paid_amount)){
        //     $invoice->status = 'COMPLETED';

        // }
        $invoice->save();
        return redirect()->back();
    }


}
