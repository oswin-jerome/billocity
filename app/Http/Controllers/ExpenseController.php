<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ExpenseCategory;
use App\Models\Expense;

use Illuminate\Support\Facades\Validator;
class ExpenseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages/expense/view',['expenses'=>Expense::all(),'categories'=>ExpenseCategory::all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
        $categories = ExpenseCategory::all();
        return view('pages/expense/create',['categories'=>$categories]);
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
            'amount' => 'required',
            'category' => 'required',
        ]);

            
        if($validated->fails()){
            \Toastr::error($validated->errors(), 'Error', ["positionClass" => "toast-top-right"]);

            return redirect()->back();
        }

        $category = Expense::create([
            'amount'=>$request->amount,
            'category'=>$request->category,
        ]);

        if($category){
            \Toastr::success('Expense added', 'Success', ["positionClass" => "toast-top-right"]);
            return redirect()->back();
        }

        \Toastr::error('Unable to add Expense', 'Error', ["positionClass" => "toast-top-right"]);
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
        $category = Expense::find($request->pid);
        $category->amount = $request->amount;
        $category->category = $request->category;
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
