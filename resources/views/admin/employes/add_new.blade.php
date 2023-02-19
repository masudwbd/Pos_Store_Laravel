@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h4 class="">Add New Employe</h4>
    <div class="form-container p-5 mt-5" style="border:1px solid gray">
        <form action="{{route('employe.store')}}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="">Name</label>
                <input type="text" class="form-control" name="name" id="">
            </div>
            <div class="form-group">
                <Select name="position" class="form-control">
                    <option value="1">Account Manager</option>
                    <option value="2">Seller</option>
                    <option value="3">Security</option>
                </Select>
            </div>
            <div class="form-group">
                <label for="">Monthly Salary</label>
                <input type="text" class="form-control" name="salary" id="">
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
                <label for="photo">Employe Photo</label>
                <input type="file" class="form-control dropify"
                name="photo">
            </div>
            <input type="submit" value="Add Employe" class="btn btn-success">
        </form>
    </div>
</div>

<script>
      $('.dropify').dropify();
</script>

@endsection
