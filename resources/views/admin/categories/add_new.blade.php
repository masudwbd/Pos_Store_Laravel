@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h4 class="">Add New Category</h4>
    <div class="form-container p-3 mt-3" style="border:1px solid gray">
        <form action="{{route('category.store')}}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="">Category Name</label>
                <input type="text" class="form-control" name="category_name" id="">
            </div>
            <input type="submit" value="Add Category" class="btn btn-success">
        </form>
    </div>
</div>



@endsection
