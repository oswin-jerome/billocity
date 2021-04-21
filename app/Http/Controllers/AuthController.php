<?php

namespace App\Http\Controllers;

use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function view_login(){

        return view('pages/login/login');
    }

    public function login(Request $request){
        $credentials = $request->only('email', 'password');
        if(Auth::attempt($credentials,true)){
            Toastr::success('Successfully logged in', 'Success', ["positionClass" => "toast-top-right"]);
            return redirect('/');
        }else{
            Toastr::error('Login failed', 'Error', ["positionClass" => "toast-top-right"]);
            return redirect()->back();
        }
    }
}
