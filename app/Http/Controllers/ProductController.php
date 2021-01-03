<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\Supplier;
use App\Models\Stock;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages/product/view',['products'=>Product::all()]);
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
            'stock' => 'required',
        ]);

            
        if($validated->fails()){
            \Toastr::error($validated->errors(), 'Error', ["positionClass" => "toast-top-right"]);

            return redirect()->back();
        }


        $product = Product::create([
            'name'=>$request->name,
            'barcode'=>$request->barcode,
            'brand'=>$request->brand,
            'category'=>$request->category,
            'price'=>$request->price,
            'stock'=>$request->stock,
        ]);

        if($product){
            \Toastr::success('Product added', 'Success', ["positionClass" => "toast-top-right"]);
            return redirect()->back();
        }

        \Toastr::error('Unable to add Product', 'Error', ["positionClass" => "toast-top-right"]);
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
            \Toastr::success('Something went wrong (0)', 'error', ["positionClass" => "toast-top-right"]);
            return redirect()->back();
        }

        $product->stock = $product->stock + $request->stock;
        if(!$product->save()){
            \Toastr::success('Something went wrong (1)', 'error', ["positionClass" => "toast-top-right"]);
            return redirect()->back();
        }

        \Toastr::success('Stock Updated', 'Success', ["positionClass" => "toast-top-right"]);
        return redirect()->back();
    }

}
