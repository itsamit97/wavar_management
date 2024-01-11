@extends('layout.admin_master')
@section('content')

<!-- Shop bill Modal -->
<div style="width: auto;  background-color: #4e73df; height:55px;  margin-bottom: 30px;">
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#shopModal"
        style="margin-top: 8px; float: right;">
        Add Bill
    </button>
</div>
<!-- Start Shop billTable -->
<div class="container mt-3">
    <table id="example" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <tr>
                <th>Sr.No</th>
                <th>Bill Date</th>
                <th>Bill Amount</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
        </thead>
        <tbody>
            @php $i = 1; @endphp
            @foreach($branchBills as $key=>$value)
            <tr>
                <td>{{$i}}</td>
                <td>{{$value->bill_date}}</td>
                <td>{{$value->bill_amount}}</td>
                <td>
                    <a href="{{route('branch-bill.edit',$value->id)}}" class="btn btn-primary"
                        data-target="#editModal"><button>Edit</button></a>
                </td>
                <td>
                    <form action="{{ route('branch-bill.destroy',$value->id) }}" method="Post">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want delete this item')">Delete</button>
                    </form>
                </td>
            </tr>
            @php $i++; @endphp
            @endforeach
        </tbody>
    </table>
</div>
<!-- End Shop billTable -->

<!--Start Shop bill  Modal -->
<div class="modal fade" id="shopModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content ">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Bill</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{route('branch-bill.store')}}" method="post">
                    {{csrf_field()}}
                    <div class="row">
                        <div class="col-sm-6">
                            <lable>Date</lable>
                            <input type="date" name="bill_date" class="form-control" min="{{ date('Y-m-d') }}" required>
                        </div>
                        <div class="col-sm-6">
                            <lable>Bill Amount</lable>
                            <input type="text" name="bill_amount" class="form-control">
                        </div>
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
<!--End  Shop bill Modal -->

@stop