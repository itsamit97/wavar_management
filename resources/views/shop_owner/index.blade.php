@extends('layout.admin_master')
@section('content')

<!-- Shop Modal -->
<div style="width: auto;  background-color: #4e73df; height:55px;  margin-bottom: 30px;">
    <!-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#shopModal"
        style="margin-top: 8px; float: right;">
        Add Shop 
    </button> -->
</div>
<!-- Start Shop Table -->
<div class="container mt-3">
    <table id="example" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <tr>
                <th>Id</th>
                <th>Shop Name</th>
                <th>Total Shop Branches</th>
                <th>Total Branch Bill</th>
                <th>Main Branch Identifier</th>
                <th>Shop Owner</th>
                <th>Phone No</th>
                <th>Email</th>
                <th>Contact Period</th>
                <!-- <th>Status</th>
                <th>Is Enable</th> -->
                <!-- <th>Sort Order</th> -->
                <th>Edit</th>
            </tr>
        </thead>
        <tbody>
            <!-- @php $i = 1; @endphp -->
            <tr>
                <td>{{$i}}</td>
                <td>{{$shopData->shop_name}}</td>
                <td>{{$shopData->shop_branch_count}}</td>
                <td>
                    <?php
                    $sumBillAmount = \App\Models\BranchBill::where('shop_id', $shopData->id)->sum('bill_amount');
                    echo $sumBillAmount;
                    ?>
                </td>
                <td>{{$shopData->branch_identifier}}</td>
                <td>{{$shopData->user->owner_name}}</td>
                <td>{{$shopData->phone_no}}</td>
                <td>{{$shopData->email}}</td>
                <td>{{$shopData->contact_period}}</td>
             
             
                <td>
                    <a href="{{route('shop-owner.edit',$shopData->id)}}" class="btn btn-primary"
                        ><button>Edit</button></a>
                </td>
            </tr>
         
        </tbody>
    </table>
</div>
<!-- End Shop Table -->


@stop