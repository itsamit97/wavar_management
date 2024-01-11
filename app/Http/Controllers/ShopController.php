<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Shop;
use App\Models\User;
use App\Models\ShopBranch;
use App\Models\BranchBill;


use Auth;
use Illuminate\Support\Facades\DB;
class ShopController extends Controller
{
    public function index()
    {
        $shopData = Shop::with('user', 'shop_branch') 
        ->orderBy('sort_order', 'asc')
        ->withCount('shop_branch')
        ->get();
        return view('shop.index',['shopData'=>$shopData]);
    }

    public function create()
    {
    }

    public function store(Request $request)
    {
        $request->validate([
            'shop_name' => 'required',
            'sort_order' => 'required|unique:shops',
            'branch_identifier' => 'required',
            'contact_period' => 'required',
            'phone_no' => 'required|digits:10',
            'email' => 'required|email|unique:shops',
            'owner_name' => 'required',
            'user_name' => 'required|unique:users',
            'password' => 'required|min:8',
        ]);

        try {
            DB::beginTransaction();
        
            //store user details
            $userTbl = new User;
            $userTbl->user_name = $request->user_name;
            $userTbl->password =  bcrypt($request->password);
            $userTbl->owner_name = $request->owner_name;
            $userTbl->role = 2;
            $userTbl->save();

            //store shop details
            $shopTbl = new Shop;
            $shopTbl->user_id = $userTbl->id;
            $shopTbl->shop_name = $request->shop_name;
            $shopTbl->sort_order = $request->sort_order;
            $shopTbl->branch_identifier = $request->branch_identifier;
            $shopTbl->contact_period = $request->contact_period;
            $shopTbl->phone_no = $request->phone_no;
            $shopTbl->email = $request->email;
            $shopTbl->status = 1; //1:active, 0:inactive
            $shopTbl->save();
            
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            // Handle the exception or log an error
            return redirect()->back()->with('error', 'Transaction failed');
        }
        return redirect()->back()->with('success', 'Shop added successfully');
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
        $shopTbl = Shop::find($id);
        return view('shop.edit',['shopTbl'=>$shopTbl]);
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
        $shopUpdate  = Shop::find($id);
        $shopUpdate->shop_name = $request->shop_name;
        $shopUpdate->branch_identifier = $request->branch_identifier;
        $shopUpdate->contact_period = $request->contact_period;
        $shopUpdate->phone_no = $request->phone_no;
        $shopUpdate->is_disable = $request->is_disable;

        $shopUpdate->save();
        return redirect()->back()->with('success', 'Shop Update Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $shopTbl = Shop::find($id);
        $shopTbl->delete();
        return redirect()->back()->with('success', 'Shop Delete successfully');
    }

}
