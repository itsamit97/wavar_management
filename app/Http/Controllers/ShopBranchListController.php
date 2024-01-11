<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Shop;
use App\Models\ShopBranch;
use Auth;
use App\Models\User;

use Illuminate\Support\Facades\DB;
class ShopBranchListController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $shopData = Shop::where('user_id',Auth::User()->id)->first();
        $shopBranchs = ShopBranch::where('shop_id',$shopData->id)->get();
        return view('shop_branches.index',['shopBranches'=>$shopBranchs]);
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
        $request->validate([
            'address' => 'required',
            'user_name' => 'required|unique:users',
            'password' => 'required|min:8',
            'sort_order' => 'required',
        ]);

        try {
            DB::beginTransaction();

            $shopId = Shop::where('user_id',Auth::User()->id)->select('id')->first();
         
            $userTbl = new User;
            $userTbl->user_name = $request->user_name;
            $userTbl->password =  bcrypt($request->password);
            $userTbl->role = 3;
            $userTbl->save();  // Save the user data
            $shopBranchTbl = new ShopBranch;
            $shopBranchTbl->user_id = $userTbl->id;
            $shopBranchTbl->address = $request->address;
            $shopBranchTbl->shop_id = $shopId->id;
            $shopBranchTbl->sort_order = $request->sort_order;
            $shopBranchTbl->save();
            // dd($request->all());
            DB::commit();
        } catch (\Exception $e) {
            // dd($e);
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
