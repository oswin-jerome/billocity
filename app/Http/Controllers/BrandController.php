<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Brand;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Validator;
class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $brands = Brand::all();
        return view('pages/brand/view',['brands'=>$brands]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
        return view('pages/brand/create');
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
            'name' => 'required|unique:brands',
        ]);

            
        if($validated->fails()){
            Toastr::error($validated->errors(), 'Error', ["positionClass" => "toast-top-right"]);
            // foreach($validated->errors() as $err){
            //     \Toastr::error('Please fill in name field', 'Error', ["positionClass" => "toast-top-right"]);
            // }
            return redirect()->back();
        }

       $brand =  Brand::create([
            'name'=>$request->name
        ]);

        if($brand){
            Toastr::success('Brand added', 'Success', ["positionClass" => "toast-top-right"]);
            return redirect()->back();
        }

        Toastr::error('Unable to add brand', 'Error', ["positionClass" => "toast-top-right"]);
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
        
        $brand = Brand::where('id','=',$id)->first();
        return view('pages/brand/details',['brand'=>$brand]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        
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
        $brand = Brand::find($request->pid);
        $brand->name = $request->name;
        $brand->save();
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
        $brand = Brand::find($id);
        if(count($brand->products)>0){

            Toastr::error($brand->name." is linked with some products", 'Unable to delete', ["positionClass" => "toast-top-right"]);
            return redirect()->back();
        }
        $brand->delete();
        Toastr::warning("Brand deleted", 'Deleted', ["positionClass" => "toast-top-right","class" => "toast-error"]);

        return redirect()->back();
    }
}
