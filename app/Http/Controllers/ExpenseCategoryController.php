<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ExpenseCategory;
use Illuminate\Support\Facades\Validator;
class ExpenseCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = ExpenseCategory::all();
        return view('pages/expense/category/view',['categories'=>$categories]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages/expense/category/create');
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
            'name' => 'required|unique:categories',
        ]);

            
        if($validated->fails()){
            \Toastr::error($validated->errors(), 'Error', ["positionClass" => "toast-top-right"]);

            return redirect()->back();
        }

        $category = ExpenseCategory::create([
            'name'=>$request->name
        ]);

        if($category){
            \Toastr::success('Expense Category added', 'Success', ["positionClass" => "toast-top-right"]);
            return redirect()->back();
        }

        \Toastr::error('Unable to add Expense Category', 'Error', ["positionClass" => "toast-top-right"]);
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
        $category = ExpenseCategory::find($request->pid);
        $category->name = $request->name;
        $category->save();
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
}
