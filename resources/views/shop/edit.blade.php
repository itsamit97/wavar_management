@extends('layout.admin_master')
@section('content')

<!-- headder  -->
<div style="width: auto;  background-color: #4e73df; height:55px;  margin-bottom: 30px;">
    <a href="{{route('shop.index')}}"><button type="button" class="btn btn-primary" style="margin-top: 8px; float: right;">
        Shop Table
    </button></a>
</div>


<div class="modal-body">
    <form action="{{route('shop.update',$shopTbl->id)}}" method="post">
        <!-- @csrf -->
        @method('PUT')
        {{csrf_field()}}
        <div class="row">
            <div class="col-sm-6">
                <lable>Shop Name</lable>
                <input type="text" name="shop_name" value="{{$shopTbl->shop_name}}" class="form-control" placeholder="Enter Shop Name" required>
            </div>
            <div class="col-sm-6">
                <lable> Branch Identifir</lable>
                <input type="text" name="branch_identifier" value="{{$shopTbl->branch_identifier}}"  class="form-control"
                    placeholder="Enter Main Branch Identifir" required>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-6">
                <lable>Phone No.</lable>
                <input type="text" name="phone_no" value="{{$shopTbl->phone_no,$shopTbl->id}}" class="form-control" placeholder="Enter Phone No" required>
            </div>

            <div class="col-sm-6">
                <lable>Contact Period</lable>
                <input type="date" name="contact_period" value="{{$shopTbl->contact_period}}" class="form-control" placeholder="Enter Contact Period">
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12">
                <label for="is_disable">Enable Status:</label>
                <input type="radio" id="enable" name="is_disable" value="false" @if($shopTbl->is_disable == false) checked @endif> Enable
                <input type="radio" id="disable" name="is_disable" value="true" @if($shopTbl->is_disable == true) checked @endif> Disable
            </div>
        </div>

        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Update</button>
        </div>
    </form>
</div>

@stop