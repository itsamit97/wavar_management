<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Shop;
use App\Models\ShopBranch;



use Auth;
class UserController extends Controller
{
    
    public function Registration()
    {
        $adminExists = User::where('role',1)->count();

        if($adminExists > 0){
            //  return redirect()->route('login');
        return redirect()->route('login')->with('success', 'No Access For Registration ');


        }else{

            return view('users.registration');

        }
        
    }

    public function RegistrationCreate(Request $request)
    {
        $request->validate([
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

    public function Login()
    {
        return view('users.login');
    }

    public function LoginCreate(request $request){

        //update status to expired if contract period is expired
        $updatedCount = Shop::whereDate('contact_period', '<', now())
            ->where('status', 1)
            ->update(['status' => 0]);

        if(Auth::attempt(['user_name'=>$request->user_name,'password'=>$request->password,'role'=>1])){
            // admin 
            return redirect()->route('shop.index');

        }else if(Auth::attempt(['user_name'=>$request->user_name,'password'=>$request->password,'role'=>2])){
           //Shop -owner 
           $checkIfShopIsNotActive = Shop::where('user_id',Auth::user()->id)
           ->where('status',0)
           ->orWhere('is_disable',true)
           ->count();
           if($checkIfShopIsNotActive){
               return redirect()->back()->with('error', 'Either your contract is expired or admin disabled your account. Please connect with admin. ');
           }
        
           return redirect()->route('shop-owner.index');
       
        }else if(Auth::attempt(['user_name'=>$request->user_name,'password'=>$request->password,'role'=>3])){
           //branch -owner 
            
            $shop = ShopBranch::where('user_id', Auth::user()->id)->select('shop_id','is_disable')->first();
            $checkIfShopIsNotActive = Shop::where('id', $shop->shop_id)
            ->where('status',0)
            ->orWhere('is_disable',true)
            ->count();
            if($checkIfShopIsNotActive){
                return redirect()->back()->with('error', 'Either the contract of your main shop is expired or admin disabled the main shop account. Please connect with admin.');
            }

            if($shop->is_disable == true){
                return redirect()->back()->with('error', 'Your branch has been disabled, please contact admin.');
            }

            return redirect()->route('branch-bill.index');
        }else {
            return redirect()->back()->with('error', 'Username or Password is incorrect');
        }
    }


    public function Logout(){
        Auth::logout();
        return redirect()->route('login');
    }

    public function checkExpiry($userId){
        $checkIfShopIsNotActive = Shop::where('user_id', $userId)
        ->where('status',0)
        ->orWhere('is_disable',true)
        ->count();
        if($checkIfShopIsNotActive){
            return redirect()->back()->with('error', 'Either your contract is expired or Admin disabled your account. Please connect to admin. ');
        }
    }
}




