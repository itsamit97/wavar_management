<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Shop;
use App\Models\User;
use Auth;
use App\Models\ShopBranch;
class ShopOwnerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        // $shopData = Shop::where('user_id',Auth::User()->id)->first();
      

        $shopData = Shop::with('user', 'shop_branch') 
        ->orderBy('sort_order', 'asc')
        ->withCount('shop_branch')
        ->where('user_id',Auth::User()->id)
        ->first();

        return view('shop_owner.index',['shopData'=>$shopData]);
        
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
        //
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
        $shopOwnTbl = Shop::find($id);
        return view('shop_owner.edit',['shopOwnTbl'=>$shopOwnTbl]);
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
        // dd($request->all());
        $shopOwnUpdate  = Shop::find($id);
        $shopOwnUpdate->branch_identifier = $request->branch_identifier;
        $shopOwnUpdate->email = $request->email;
        $shopOwnUpdate->phone_no = $request->phone_no;
        $shopOwnUpdate->save();
        return redirect()->back()->with('success', 'Shop Own Update Successfully');

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

    public function viewShopOwnerBranchBills()
    {
        $shopData = Shop::where('user_id', Auth::user()->id)->select('id','shop_name')->first();
        $branches = ShopBranch::where('shop_id',$shopData->id)->orderBy('sort_order','ASC')->get();
        return view('branch_bill.view_shop_owner_branch_bills',['shopData'=>$shopData, 'branches'=>$branches]);
    }
}
