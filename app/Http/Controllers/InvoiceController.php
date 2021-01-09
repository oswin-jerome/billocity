<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Invoice;
use App\Models\Product;
use App\Models\SoldProduct;
use App\Models\ReturnedProduct;
use App\Models\Customer;
class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages/invoices/view',['invoices'=>Invoice::orderBy('created_at', 'DESC')->get()]);
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

        // TODO: add discount types and amount

        $totalPriceWithOutDiscounts = 0;
        $totalPriceWithDiscounts = 0;
        $profitWithoutDiscount = 0;
        $invoice = new Invoice();

        // Calculate total and update stock
        foreach($request->products  as $key=>$product) {
            // do stuff
            $product = Product::find($product);
            $totalPriceWithOutDiscounts = $totalPriceWithOutDiscounts + $product->price * $request->quantities[$key];
            

            // calculate profit
            $profitWithoutDiscount += ($product->price *$request->quantities[$key])- ($product->cost_price *$request->quantities[$key]);


            // update stock
            $product->stock = $product->stock - $request->quantities[$key];
            $product->save();

            // add item to check out list
            
        }
        // get discounts
        $discount = 0;
        $totalPriceWithDiscounts = $totalPriceWithOutDiscounts;
        if($request->has('redeem') && $request->has('customer') && $request->redeem=='true'){
            $customer = Customer::find($request->customer);
            $discount = $customer->points;
            $totalPriceWithDiscounts = $totalPriceWithOutDiscounts - $customer->points;
            $invoice->points_redeem = $customer->points;
            $customer->points = 0;
            $customer->save();
        }
        $invoice->total = $totalPriceWithOutDiscounts;
        $invoice->final_price = $totalPriceWithDiscounts;
        $invoice->profit_wd = $profitWithoutDiscount;
        $invoice->profit = $profitWithoutDiscount - $discount; // subract discount
        $invoice->status = 'COMPLETED';
        $invoice->payment_method = 'CASH'; //TODO: link to accounts table 
        if($request->has('customer')){
            $invoice->customer = $request->customer;

            // add points
            $customer = Customer::find($request->customer);
            $customer->points = $customer->points + $totalPriceWithDiscounts * 0.1;
            $customer->save();
        }
        $invoice->paid_amount = $totalPriceWithDiscounts; //Change for credit
        $invoice->save();


        // add products to sold_products
        foreach($request->products  as $key=>$product) {
            $product = Product::find($product);

            $sold = new SoldProduct();
            $sold->product = $product->id;
            $sold->invoice = $invoice->id;
            // TODO: add customer
            $sold->product_price = $product->price;
            $sold->sold_price = $product->price - 0; // TODO: any discounts on product
            $sold->quantity = $request->quantities[$key];
            $sold->profit = ($product->price *$request->quantities[$key])- ($product->cost_price *$request->quantities[$key]);
            $sold->status = "DONE";

            $sold->save();

        }


        return redirect('invoices/'.$invoice->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('pages/pos/invoice',['invoice'=>Invoice::find($id),'ret_products'=>SoldProduct::where('invoice','=',$id)->where('status','=','RETURNED')->get()]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $invoice = Invoice::find($id);

        return view('pages/invoices/salesreturn',['invoice'=>$invoice,'products'=>Product::all(),'customers'=>Customer::all()]);
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


        $invoice = Invoice::find($id);

        foreach ($request->deleted as $key => $value) {
            $soldProduct = SoldProduct::find($value);
            $product = Product::find($soldProduct->product);
            $product->stock = $product->stock +  $soldProduct->quantity;
            $product->save();
            $invoice->final_price = $invoice->final_price - ($soldProduct->sold_price * $soldProduct->quantity);
            $invoice->total = $invoice->total - ($soldProduct->sold_price * $soldProduct->quantity);
            $invoice->paid_amount = $invoice->paid_amount - ($soldProduct->sold_price * $soldProduct->quantity);
            $invoice->save();
            $soldProduct->status = "RETURNED";
            $soldProduct->save();
            echo($soldProduct);
        }
        return redirect('invoices/'.$id);
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



    public function viewreturned(){
         return view('pages/invoices/viewreturned',['products'=>SoldProduct::where('status','=','RETURNED')->get(),'cancled'=>SoldProduct::where('status','=','CANCLED')->get()]);
    }



    // Cancel Bil
    public function cancelProduct(Request $request){

        $invoice = Invoice::find($request->id);

        foreach ($invoice->products as $key => $value) {
           $prod = $value->prod;
           $prod->stock = $prod->stock + $value->quantity;
           $prod->save();
           $value->status = 'CANCLED';
           $value->save();
        }

        $invoice->status = "CANCLED";
        $invoice->save();

        return redirect()->back();
        // return view('pages/invoices/viewreturned',['products'=>ReturnedProduct::all()]);
    }
}
