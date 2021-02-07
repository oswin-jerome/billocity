<?php

namespace App\Http\Controllers;

use App\Models\User;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        return view('pages/users/view',["users"=>User::all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages/users/create');
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
            'password' => 'required',
            'role' => 'required',
            'email' => 'required|unique:users',
        ]);

            
        if($validated->fails()){
            Toastr::error($validated->errors(), 'Error', ["positionClass" => "toast-top-right"]);
            // foreach($validated->errors() as $err){
            //     \Toastr::error('Please fill in name field', 'Error', ["positionClass" => "toast-top-right"]);
            // }
            return redirect()->back();
        }
        $user = User::create([
            "name"=>$request->name,
            "email"=>$request->email,
            "password"=>Hash::make($request->password),
            "role"=>$request->role,
        ]);

        if($user){
            Toastr::success("User added", 'Success', ["positionClass" => "toast-top-right"]);

            return redirect()->back();
        }else{

            Toastr::error("Something went wrong", 'Error', ["positionClass" => "toast-top-right"]);

            return redirect()->back();

        }

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
        $user = User::find($id);
        $user->delete();
        Toastr::warning("User deleted", 'Deleted', ["positionClass" => "toast-top-right"]);

        return redirect()->back();
    }
}
