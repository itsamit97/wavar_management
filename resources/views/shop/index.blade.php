@extends('layout.admin_master')
@section('content')

<!-- Shop Modal -->
<div style="width: auto;  background-color: #4e73df; height:55px;  margin-bottom: 30px;">
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#shopModal"
        style="margin-top: 8px; float: right;">
        Add Shop 
    </button>
</div>
<!-- Start Shop Table -->
<div class="container mt-3">
    <table id="example" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <tr>
                <th>Sr.No</th>
                <th>Shop Name</th>
                <th>Total Shop Branches</th>
                <th>Total Branch Bill</th>
                <th>Main Branch Identifier</th>
                <th>Shop Owner</th>
                <th>Phone No</th>
                <th>Email</th>
                <th>User Name</th>
                <th>Contact Period</th>
                <th>Status</th>
                <th>Is Enable</th>
                <th>Sort Order</th>
                <th>Delete</th>
                <th>Edit</th>
            </tr>
        </thead>
        <tbody>
            @php $i = 1; @endphp
            @foreach($shopData as $key=>$value)
            <tr>
                <td>{{$i}}</td>
                <td>{{$value->shop_name}}</td>
                <td> {{ $value->shop_branch_count }} </td>
                <td>
                    <?php
                    $sumBillAmount = \App\Models\BranchBill::where('shop_id', $value->id)->sum('bill_amount');
                    echo $sumBillAmount;
                    ?>
                </td>

                <td>{{$value->branch_identifier}}</td>
                <td>{{$value->user->owner_name}}</td>
                <td>{{$value->phone_no}}</td>
                <td>{{$value->email}}</td>
                <td>{{$value->user->user_name}}</td>
                <td>{{$value->contact_period}}</td>
                <td>{{($value->status == 1) ? "Active" : "Inactive"}}</td>
                <td>{{($value->is_disable == true) ? "Disabled" : "Enabled"}}</td>
                <td>{{$value->sort_order}}</td>
                <form action="{{ route('shop.destroy',$value->id) }}" method="Post">
                    @csrf
                    @method('DELETE')
                    <td> <button type="submit" class="btn btn-danger"
                            onclick="return confirm('Are you sure you want delete this item')">Delete</button></td>
                </form>
                <td>
                    <a href="{{route('shop.edit',$value->id)}}" class="btn btn-primary"
                        data-target="#editModal"><button>Edit</button></a>
                </td>
            </tr>
            @php $i++; @endphp
            @endforeach
        </tbody>
    </table>
</div>
<!-- End Shop Table -->


<!--Start Shop  Modal -->
<div class="modal fade" id="shopModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content ">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Shop</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{route('shop.store')}}" method="post">
                    <!-- @csrf -->
                    {{csrf_field()}}
                    <div class="row">
                        <div class="col-sm-6">
                            <lable>Shop Name</lable>
                            <input type="text" name="shop_name" class="form-control"
                                required>
                        </div>
                        <div class="col-sm-6">
                            <lable>Main Branch Identifier</lable>
                            <input type="text" name="branch_identifier" class="form-control" required>
                        </div>
                        
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <lable>Contact Period</lable>
                            <input type="date" name="contact_period" class="form-control" min="{{ date('Y-m-d') }}">
                        </div>
                        <div class="col-sm-6">
                            <lable>Sort-Order</lable>
                            <input type="text" name="sort_order" class="form-control" >
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-6">
                            <lable>Phone No.</lable>
                            <input type="text" name="phone_no" class="form-control" required>
                        </div>
                        <div class="col-sm-6">
                            <lable>Email</lable>
                            <input type="email" name="email" class="form-control" required>
                        </div>
                    </div>

                    <div class="row">
                    <div class="col-sm-4">
                            <lable>Owner Name</lable>
                            <input type="text" name="owner_name" class="form-control">
                        </div>
                        <div class="col-sm-4">
                            <lable>User Name</lable>
                            <input type="text" name="user_name" class="form-control">
                        </div>
                        <div class="col-sm-4">
                            <lable>Password</lable>
                            <input type="text" name="password" class="form-control" required>
                        </div>
                        <!-- <div class="col-sm-6">
                                <lable>User Name</lable>
                                <input type="text" name="user_name" class="form-control" placeholder="ser Name">
                            </div> -->
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!--End  Shop  Modal -->
@stop