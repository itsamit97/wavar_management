@extends('layout.admin_master')
@section('content')

<!-- headder  -->
<div style="width: auto;  background-color: #4e73df; height:55px;  margin-bottom: 30px;">
 <!-- <a href=""><button style="margin-top: 8px; float: right;">Shop-Own-Tbl</button></a> -->
 <a href="{{route('shop-owner.index')}}"  style="margin-top: 8px; float: right; color:white;margin-right:17px;  padding-top:9px;">Shop-Own-Tbl</a>


</div>

<div class="modal-body">
    <form action="{{route('shop-owner.update',$shopOwnTbl->id)}}" method="post">
        <!-- @csrf -->
        @method('PUT')
        {{csrf_field()}}
        <div class="row">
            <div class="col-sm-6">
                <lable>Email</lable>
                <input type="email" name="email" value="{{$shopOwnTbl->email}}" class="form-control" placeholder="Enter Shop Name" required>
            </div>
            <div class="col-sm-6">
                <lable>Phone No.</lable>
                <input type="text" name="phone_no" value="{{$shopOwnTbl->phone_no}}" class="form-control" placeholder="Enter Phone No" required>
            </div>
        
        </div>

        <div class="row">
        <div class="col-sm-12">
                <lable> Branch Identifir</lable>
                <input type="text" name="branch_identifier" value="{{$shopOwnTbl->branch_identifier}}"  class="form-control"
                    placeholder="Enter Main Branch Identifir" required>
            </div>
            <!-- <div class="col-sm-6">
                <lable>Contact Period</lable>
                <input type="date" name="contact_period" value="{{$shopOwnTbl->contact_period}}" class="form-control" placeholder="Enter Contact Period">
            </div> -->
        </div>


        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Update</button>
        </div>
    </form>
</div>

@stop