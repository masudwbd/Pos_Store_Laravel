@extends('layouts.app')

@section('content')

@php
    $categories = DB::table('categories')->get();
    $suppliers = DB::table('suppliers')->get();
@endphp

<div class="container mt-5">
    <h4 class="">Add New Product</h4>
    <div class="form-container p-3 mt-3" style="border:1px solid gray">
        <form action="{{route('product.store')}}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-6">
                    <div class="form-group">
                        <label for="">Name</label>
                        <input type="text" class="form-control" name="product_name" id="">
                    </div>
                    <div class="form-group">
                        <label for="">Category</label><span><a href="{{route('category.add')}}"><i class="ml-2 fa fa-plus"></i></a></span>
                        <select class="form-control" name="category_id" id="">
                            @foreach ($categories as $category)
                                <option value="{{$category->id}}">{{$category->category_name}}</option>
                            @endforeach
                        </select>
                        
                    </div>
                    <div class="form-group">
                        <label for="">Supplier</label>
                        <select class="form-control" name="supplier_id" id="">
                            @foreach ($suppliers as $supplier)
                                <option value="{{$supplier->id}}">{{$supplier->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Product Code</label>
                        <input type="text" class="form-control" name="product_code" id="">
                    </div>
                    <div class="form-group">
                        <label for="">Product Garage</label>
                        <input type="text" class="form-control" name="product_garage" id="">
                    </div>
                    <div class="form-group">
                        <label for="">Product Route</label>
                        <input type="text" class="form-control" name="product_route" id="">
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <label for="">Product Image</label>
                        <input type="file" class="form-control" name="product_image" id="">
                    </div>
                    <div class="form-group">
                        <label for="">Buy Date</label>
                        <input type="date" class="form-control" name="buy_date" id="">
                    </div>
                    <div class="form-group">
                        <label for="">Expire Date</label>
                        <input type="date" class="form-control" name="expire_date" id="">
                    </div>
                    <div class="form-group">
                        <label for="">Buying Price</label>
                        <input type="number" class="form-control" name="buying_price" id="">
                    </div>
                    <div class="form-group">
                        <label for="">Selling Price</label>
                        <input type="number" class="form-control" name="selling_price" id="">
                    </div>
                </div>
            </div>
    
            <input type="submit" value="Add Product" class="btn btn-success">
        </form>
    </div>
</div>

<script>
      $('.dropify').dropify();
</script>

@endsection
