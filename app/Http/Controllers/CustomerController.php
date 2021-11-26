<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Customer;
use App\Models\Emi;
use App\Models\Invoice;
use Brian2694\Toastr\Facades\Toastr;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages/customer/view',['customers'=>Customer::all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages/customer/create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        // dd($request->all());
        $validated = Validator::make($request->all(),[
            'name' => 'required',
            'phone' => 'required|unique:customers',
        ]);

            
        if($validated->fails()){
            Toastr::error($validated->errors(), 'Error', ["positionClass" => "toast-top-right"]);

            return redirect()->back();
        }

        $customer = Customer::create([
            'name'=>$request->name,
            'phone'=>$request->phone,
            'email'=>$request->email,
            'dob'=>$request->dob,
            'gst'=>$request->gst,
            'address'=>$request->address,
        ]);

        

        if($customer){
            Toastr::success('Customer added', 'Success', ["positionClass" => "toast-top-right"]);
            return redirect()->back();
        }

        Toastr::error('Unable to add Customer', 'Error', ["positionClass" => "toast-top-right"]);
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
        $customer = Customer::find($id);
        $invoices = Invoice::where('customer','=',$id)->get();
        $emis = Emi::where('customer_id','=',$id)->get();
        return view('pages/customer/details',['customer'=>$customer,'invoices'=>$invoices,"emis"=>$emis]);
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
        $customer = Customer::find($request->pid);
        $customer->name = $request->name;
        $customer->phone = $request->phone;
        $customer->email = $request->email;
        $customer->gst = $request->gst;
        $customer->address = $request->address;
        $customer->dob = $request->dob;
        $customer->save();
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
