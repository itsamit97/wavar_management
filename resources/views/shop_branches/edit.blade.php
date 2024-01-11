@extends('layout.admin_master')
@section('content')

<!-- headder  -->
<div style="width: auto;  background-color: #4e73df; height:55px;  margin-bottom: 30px;">
    <a href="{{route('shop-branches-list.index')}}"><button type="button" class="btn btn-primary"
            style="margin-top: 8px; float: right;">
            Shop Branches Table
        </button></a>
</div>


<div class="modal-body">
    <form action="{{route('shop-branches-list.update',$shopBranchTbl->id)}}" method="post">
        <!-- @csrf -->
        @method('PUT')
        {{csrf_field()}}
        <div class="row">
            <div class="col-sm-12">
                <lable>Main Shop</lable>
                <input type="text"    class="form-control" value="{{$shopName->shop_name}}" placeholder="Enter Assign Nname" readonly>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-6">
                <lable>Address.</lable>
                <input type="text" name="address" value="{{$shopBranchTbl->address}}" class="form-control" placeholder="Enter Address" required>
            </div>
            <div class="col-sm-6">
                <lable>Sort Order</lable>
                <input type="text" name="sort_order" value="{{$shopBranchTbl->sort_order}}" class="form-control"
                    placeholder="Enter Phone No" required>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12">
                <label for="is_disable">Enable Status:</label>
                <input type="radio" id="enable" name="is_disable" value="false" @if($shopBranchTbl->is_disable == false) checked @endif> Enable
                <input type="radio" id="disable" name="is_disable" value="true" @if($shopBranchTbl->is_disable == true) checked @endif> Disable
            </div>
        </div>


        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Update</button>
        </div>
    </form>
</div>

@stop