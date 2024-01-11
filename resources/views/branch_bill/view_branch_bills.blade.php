@extends('layout.admin_master')
@section('content')

<!-- Shop Branch Modal -->
<div style="width: auto;  background-color: #4e73df; height:55px;  margin-bottom: 30px;">
    
</div>
<!-- Start Shop Branch Table -->
<div class="container mt-3">

    <form  method="post">
        @csrf
        <div class="row">
            <div class="col-md-6">
                <label>Select Shop</label>
                <select name="shop_id" id="shop_id" class="form-control" required>
                    <option value="">Select Main Shop</option>
                    @foreach($shops as $shop)
                        <option value="{{ $shop->id }}">{{ $shop->shop_name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-6">
                <label>Select Branch Address</label>
                <select name="branch_id" id="branch_id"  class="form-control" required>
                </select>
            </div>
        </div>
    </form><br/>

    <table id="branch_bils" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <tr>
                <th>Sr.No</th>
                <th>Bill Date</th>
                <th>Bill Amount</th>
            </tr>
        </thead>
        <tbody id="tbody">
        </tbody>
    </table>
   
</div>
<!-- End Shop Branch Table -->

<script>
    $(document).ready(function() {
        $("#shop_id").change(function() {
        // var stateVal = $("#shop_id").val();
        var shop_id = $(this).val();
            var token = "{{csrf_token()}}";
            $.ajax({
                url: "get-shop-wise-branches",
                type: "post",
                data: {
                    _token: token,
                    'shop_id': shop_id
                },
                success: function(result){
                    // location.reload();
                    console.log(result);
                    $("#branch_id").html(result);
                }
            })
        });

        $("#branch_id").change(function() {
        var branch_id = $(this).val();
            var token = "{{csrf_token()}}";
            $.ajax({
                url: "get-branch-bill",
                type: "post",
                data: {
                    _token: token,
                    'branch_id': branch_id
                },
                success: function(result){
                    console.log(result);
                    $("#tbody").html(result);
                }
            })
        });
        
    });
    </script>

@stop