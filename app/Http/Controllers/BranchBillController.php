<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Shop;
use App\Models\ShopBranch;
use App\Models\BranchBill;

use Auth;
class BranchBillController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $branch = ShopBranch::where('user_id',Auth::User()->id)->select('id')->first();
        $branchBills = BranchBill::where("branch_id",$branch->id)->get();
        return view('branch_bill.index',['branchBills'=>$branchBills]);
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
            'bill_date' => 'required|date',
            'bill_amount' => 'required|numeric',
        ]);

        $branch = ShopBranch::where('user_id',Auth::User()->id)->select('id','shop_id')->first();

        $shopBillTbl = new BranchBill;
        $shopBillTbl->branch_id = $branch->id;
        $shopBillTbl->shop_id = $branch->shop_id;
        $shopBillTbl->bill_date = $request->bill_date;
        $shopBillTbl->bill_amount =  $request->bill_amount;
        $shopBillTbl->save();
        return redirect()->back()->with('success', 'Bill added successfully');

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
        $branchBillTbl = BranchBill::find($id);
        return view('branch_bill.edit',['branchBillTbl'=>$branchBillTbl]);
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
        $branchBill  = BranchBill::find($id);
        $branchBill->bill_date = $request->bill_date;
        $branchBill->bill_amount =  $request->bill_amount;
        $branchBill->save();
        return redirect()->back()->with('success', 'Bill Update Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $branchBill = BranchBill::find($id);
        $branchBill->delete();
        return redirect()->back()->with('success', 'Bill Deleted successfully');
    }

    public function viewBranchBills()
    {
        $shopData = Shop::get();
        return view('branch_bill.view_branch_bills',['shops'=>$shopData]);
    }

    public function getShopWiseBranches(Request $request){
        $branches = ShopBranch::where('shop_id',$request->shop_id)->orderBy('sort_order','ASC')->get();
        $htmlDrop = '<option value="">Select Branch address</option>';
        foreach($branches as $key=>$value){
            $htmlDrop .='<option value="'.$value->id.'">'.$value->address.'</option>';
        }
        return $htmlDrop;
    }

    public function getBranchBill(Request $request){
        $branches = BranchBill::where('branch_id',$request->branch_id)->get();
        if(count($branches) == 0){
            return $str = "<center><h4>No Bill Found.</h4></center>";
        }
        $str = "";
        $i=1;
        foreach($branches as $key=>$value){
            $str .= "<tr>";
            $str .= "<td>".$i."</td>";
            $str .= "<td>".$value->bill_date."</td>";
            $str .= "<td>".$value->bill_amount."</td>";
            $str .= "</tr>";
            $i++;
        }
        return $str;
    }
    
}
