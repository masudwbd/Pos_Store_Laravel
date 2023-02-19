@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h4 class="">Add New Customer</h4>
    <div class="form-container p-3 mt-3" style="border:1px solid gray">
        <form action="{{route('customer.store')}}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="">Name</label>
                <input type="text" class="form-control" name="name" id="">
            </div>
            <div class="form-group">
                <label for="">Email</label>
                <input type="text" class="form-control" name="email" id="">
            </div>
            <div class="form-group">
                <label for="">Phone</label>
                <input type="text" class="form-control" name="phone" id="">
            </div>
            <div class="form-group">
                <label for="">Address</label>
                <input type="text" class="form-control" name="address" id="">
            </div>
            <div class="form-group">
                <label for="">Account Holder</label>
                <input type="text" class="form-control" name="account_holder" id="">
            </div>
            <div class="form-group">
                <label for="">Account Number</label>
                <input type="number" class="form-control" name="account_number" id="">
            </div>
            <div class="form-group">
                <label for="">Branch Name</label>
                <input type="text" class="form-control" name="branch_name" id="">
            </div>
            <div class="form-group">
                <label for="">City</label>
                <input type="text" class="form-control" name="city" id="">
            </div>
            <input type="submit" value="Add Customer" class="btn btn-success">
        </form>
    </div>
</div>

<script>
      $('.dropify').dropify();
</script>

@endsection
