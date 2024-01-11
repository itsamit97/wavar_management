<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Shop;
use App\Models\ShopBranch;
use Illuminate\Support\Facades\DB;


use App\Models\User;
use Auth;

class ShopBranchController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $shops = Shop::select('id','shop_name','status')->get();
    
        $shopBranches = ShopBranch::with(['shop', 'user'])->orderBy('sort_order','asc')->get();

        
    //    $relationData =  Shop::get('shop_name')->shopBranchFunc;
    //     dd('shopBranch relation',$relationData);
        return view('shop_branch.index',['shops'=>$shops,'shopBranches'=>$shopBranches]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //shop_id,assign_name,assign_lastname,phone_no,address,user_name,password,role
        
        $request->validate([
            'shop_id' => 'required',
            'address' => 'required',
            'user_name' => 'required|unique:users',
            'password' => 'required|min:8',
            'sort_order' => 'required',
        ]);

        try {
            DB::beginTransaction();
        
            $userTbl = new User;
            $userTbl->user_name = $request->user_name;
            $userTbl->password =  bcrypt($request->password);
            $userTbl->role = 3;
            $userTbl->save();  // Save the user data
        
            $shopBranchTbl = new ShopBranch;
            $shopBranchTbl->user_id = $userTbl->id;
            $shopBranchTbl->shop_id = $request->shop_id;  
            $shopBranchTbl->address = $request->address;
            $shopBranchTbl->sort_order = $request->sort_order;
            $shopBranchTbl->save();
            
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            // Handle the exception or log an error
            return redirect()->back()->with('error', 'Transaction failed');
        }
        return redirect()->back()->with('success', 'Shop Add successfully');

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
        $shopBranchTbl = ShopBranch::find($id);
        $shopName = Shop::where('id',$shopBranchTbl->shop_id)->first();
        // dd('shopName',$shopName);
        return view('shop_branch.edit',['shopBranchTbl'=>$shopBranchTbl,'shopName'=>$shopName]);
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
         
        $upShopBranch =  ShopBranch::find($id);    //Shop Table
        $upShopBranch->address = $request->address;
        $upShopBranch->sort_order = $request->sort_order;
        $upShopBranch->is_disable = $request->is_disable;

        $upShopBranch->save();
        return redirect()->back()->with('success', 'Shop Branch Update Successfully');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $shopBranchTbl = ShopBranch::find($id);
        $shopBranchTbl->delete();
        return redirect()->back()->with('success', 'Shop Branch Delete successfully');
    }
}
