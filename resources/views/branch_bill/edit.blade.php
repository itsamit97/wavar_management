@extends('layout.admin_master')
@section('content')

<!-- header  -->
<div style="width: auto;  background-color: #4e73df; height:55px;  margin-bottom: 30px;">
    <a href="{{route('branch-bill.index')}}"><button type="button" class="btn btn-primary" style="margin-top: 8px; float: right;">
        Branch Bill Table
    </button></a>
</div>

<div class="modal-body">
    <form action="{{route('branch-bill.update',$branchBillTbl->id)}}" method="post">
        <!-- @csrf -->
        @method('PUT')
        {{csrf_field()}}

        <div class="row">
            <div class="col-sm-6">
                <lable>Date</lable>
                <input type="date" name="bill_date" value="{{$branchBillTbl->bill_date}}" class="form-control" required>
            </div>
            <div class="col-sm-6">
                <lable>Bill Amount</lable>
                <input type="text" name="bill_amount" value="{{$branchBillTbl->bill_amount}}" class="form-control">
            </div>
        </div>

        <div class="modal-footer">
            <button type="submit" class="btn btn-primary">Update</button>
        </div>
    </form>
</div>

@stop