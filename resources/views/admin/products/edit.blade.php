

@php
    $categories = DB::table('categories')->get();
    $suppliers = DB::table('suppliers')->get();
@endphp

        <form action="{{route('product.update')}}" class="p-4" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-6">
                    <div class="form-group">
                        <label for="">Name</label>
                        <input type="text" value="{{$product->product_name}}" class="form-control" name="product_name" id="">
                        <input type="hidden" value="{{$product->id}}" name="id">
                    </div>
                    <div class="form-group">
                        <label for="">Category</label><span><a href="{{route('category.add')}}"><i class="ml-2 fa fa-plus"></i></a></span>
                        <select class="form-control" name="category_id" id="">
                            @foreach ($categories as $category)
                                <option @if($category->id == $product->category_id) ? selected=""  @endif value="{{$category->id}}" >{{$category->category_name}}</option>
                            @endforeach
                        </select>
                        
                    </div>
                    <div class="form-group">
                        <label for="">Supplier</label>
                        <select class="form-control" name="supplier_id" id="">
                            @foreach ($suppliers as $supplier)
                                <option @if($supplier->id == $product->supplier_id) ? selected=""  @endif value="{{$supplier->id}}" >{{$supplier->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Product Code</label>
                        <input type="text" value="{{$product->product_code}}" class="form-control" name="product_code" id="">
                    </div>
                    <div class="form-group">
                        <label for="">Product Garage</label>
                        <input type="text" value="{{$product->product_garage}}" class="form-control" name="product_garage" id="">
                    </div>
                    <div class="form-group">
                        <label for="">Product Route</label>
                        <input type="text" value="{{$product->product_route}}" class="form-control" name="product_route" id="">
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <label for="">Product Image</label>
                        <input type="file" class="form-control" name="product_image" id="">
                        <input type="hidden" name="old_image" value="{{$product->product_image}}">
                    </div>
                    <div class="form-group">
                        <label for="">Buy Date</label>
                        <input type="date" class="form-control" name="buy_date" value="{{$product->buy_date}}" id="">
                    </div>
                    <div class="form-group">
                        <label for="">Expire Date</label>
                        <input type="date" class="form-control" value="{{$product->expire_date}}" name="expire_date" id="">
                    </div>
                    <div class="form-group">
                        <label for="">Buying Price</label>
                        <input type="number" class="form-control" value="{{$product->buying_price}}" name="buying_price" id="">
                    </div>
                    <div class="form-group">
                        <label for="">Selling Price</label>
                        <input type="number" class="form-control" value="{{$product->selling_price}}" name="selling_price" id="">
                    </div>
                </div>
            </div>
    
            <input type="submit" value="Update Product" class="btn btn-success">
        </form>
    </div>

<script>
      $('.dropify').dropify();
</script>

