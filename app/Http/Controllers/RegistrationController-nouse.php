<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Auth;
class RegistrationController extends Controller
{
    public function Registration()
    {
        return view('users.registration');
    }

    public function RegistrationCreate(Request $request)
    {
        $request->validate([
            'owner_name' => 'required',
            'user_name' => 'required|unique:users',
            'password' => 'required|min:8|confirmed',
        ]);
        
        $request->merge([
            "password" => bcrypt($request->password),
            "role" => 1
        ]);
        User::create($request->all());
        return redirect()->route('login')->with('success', 'Registration successfully');
    }

    // Login
    public function Login()
    {
        return view('users.login');
    }

    public function LoginCreate(request $request){
        if(Auth::attempt(['user_name'=>$request->user_name,'password'=>$request->password])){
            return redirect()->back()->with('success', 'Login successfully');
        }else{
            return redirect()->back()->with('error', 'Please check your User Name password');
        }
    }
    
}