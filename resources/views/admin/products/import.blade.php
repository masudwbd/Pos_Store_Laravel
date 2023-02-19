@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="d-flex justify-content-between">
        <div class="header">
            <h4 class="">Import Products</h4>
        </div>
        <div class="download">
            <a href="{{route('product.export')}}"><button class="btn btn-warning">Download Demo</button></a>
        </div>
    </div>
    <div class="form-container p-3 mt-3" style="border:1px solid gray">
        <form action="{{route('product.import')}}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="">Import File</label>
                <input type="file" class="form-control" name="import_products" id="">
            </div>
            <input type="submit" value="Add Products" class="btn btn-success">
        </form>
    </div>
</div>



@endsection
