@extends('layout.admin_master')
@section('content')

<!-- Shop Branch Modal -->
<div style="width: auto;  background-color: #4e73df; height:55px;  margin-bottom: 30px;">
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#shopBranchModal"
        style="margin-top: 8px; float: right;">
        Add Shop Branch
    </button> 
</div>
<!-- Shop Branch Table -->


<div class="container mt-3">
    <table id="example" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <tr>
                <th>Id</th>
                <th>Main Shop</th>
                <th>Address</th>
                <th>Branch Bill</th>
                <th>User Name</th>
                <th>Sort Order</th>
                <th>Is Enable</th>
                <th>Delete</th>
                <th>Edit</th>
            </tr>
        </thead>
        <tbody>
        @php $i = 1; @endphp
            @foreach($shopBranches as $key=>$value)
            <tr>

                <td>{{$i}}</td>
                <td>{{$value->shop->shop_name}}</td>
                <td>{{$value->address}}</td>
                <td>
                    <?php
                    $sumBillAmount = \App\Models\BranchBill::where('branch_id', $value->id)->sum('bill_amount');
                    echo $sumBillAmount;
                    ?>
                </td>
                <td>{{$value->user->user_name}}</td>
                <td>{{$value->sort_order}}</td>
                <td>{{($value->is_disable == true) ? "Disabled" : "Enabled"}}</td>

                <form action="{{ route('shop-branches-list.destroy',$value->id) }}" method="Post">
                    @csrf
                    @method('DELETE')
                    <td> <button type="submit" class="btn btn-danger"
                            onclick="return confirm('Are you sure you want delete this item')">Delete</button></td>
                </form>
                <td><a href="{{route('shop-branches-list.edit',$value->id)}}" class="btn btn-primary"
                        ><button>Edit</button></a></td>
            </tr>
            @endforeach
            @php $i++; @endphp
        </tbody>
    </table>
</div>
<!-- End Shop Table -->


<!--Start Shop Branch  Modal -->
<div class="modal fade" id="shopBranchModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Shop Branch Modal</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('shop-branches-list.store') }}" method="post">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <label>Address</label>
                            <input type="text" name="address" class="form-control" required>
                        </div>
                        <div class="col-md-6">
                            <label>Sort Order</label>
                            <input type="text" name="sort_order" class="form-control" >
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-md-6">
                            <label>User Name</label>
                            <input type="text" name="user_name" class="form-control">
                        </div>
                        <div class="col-md-6">
                            <label>Password</label>
                            <input type="text" name="password" class="form-control" required>
                        </div>
                    </div>
                    
                    <div class="modal-footer mt-3">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!--End  Shop Branch  Modal -->



@stop