<?php

namespace App\Http\Controllers;

use App\DataTables\ProductDataTable;
use Illuminate\Http\Request;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Payment;
use App\Models\Product;
use App\Models\Supplier;
use App\Models\Stock;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(ProductDataTable $dataTable)
    {
        return $dataTable->render('pages/product/view');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages/product/create',[
            'brands'=>Brand::all(),
            'categories'=>Category::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = Validator::make($request->all(),[
            'name' => 'required',
            'brand' => 'required',
            'category' => 'required',
            'price' => 'required',
            'cost_price' => 'required',
            'gst' => 'required',
            
            // 'stock' => 'required',
        ]);

            
        if($validated->fails()){
            Toastr::error($validated->errors(), 'Error', ["positionClass" => "toast-top-right"]);

            return redirect()->back();
        }


        $product = Product::create([
            'name'=>$request->name,
            'barcode'=>$request->barcode,
            'brand'=>$request->brand,
            'category'=>$request->category,
            'cost_price'=>$request->cost_price,
            'price'=>$request->price,
            'gst'=>$request->gst,
            'hsn_code'=>$request->hsn_code,
            'stock'=>0,
            'type'=>$request->type,
        ]);

        if($product){
            Toastr::success('Product added', 'Success', ["positionClass" => "toast-top-right"]);
            return redirect()->back();
        }

        Toastr::error('Unable to add Product', 'Error', ["positionClass" => "toast-top-right"]);
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
        
        return view('pages/product/edit',['product'=>Product::find($id), 'brands'=>Brand::all(),
        'categories'=>Category::all()]);
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
        $product = Product::find($id);
        $product->update($request->all());
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
        $prod = Product::find($id);
        // dd($prod->stocks);
        // $prod->sold()->delete();
        $prod->delete();
        return redirect()->back();
    }


    public function stock_in_view()
    {
        $products = Product::all();
        $suppliers = Supplier::all();
        return view('pages/product/stockin',['products'=>$products,'suppliers'=>$suppliers]);
    }

    public function stock_in(Request $request){

        $product = Product::find($request->product);
        // return $product;
        $stock = new Stock();
        $stock->product = $request->product;
        $stock->supplier = $request->supplier;
        $stock->stock = $request->stock;
        $stock->total = $request->stock * $product->price;
        $stock->paid = $request->amount;
        $stock->balance = ($product->price * $request->stock) - $request->amount;

        


        if(!$stock->save()){
            $stock->delete();
            Toastr::success('Something went wrong (0)', 'error', ["positionClass" => "toast-top-right"]);
            return redirect()->back();
        }

        // save transaction
        $pay = new Payment();
        $pay->amount = $request->amount;
        $pay->supplier = $request->supplier;
        $pay->stock_invoice =$stock->id;
        $pay->save();

        $product->stock = $product->stock + $request->stock;
        if(!$product->save()){
            Toastr::success('Something went wrong (1)', 'error', ["positionClass" => "toast-top-right"]);
            return redirect()->back();
        }

        Toastr::success('Stock Updated', 'Success', ["positionClass" => "toast-top-right"]);
        return redirect()->back();
    }

}
