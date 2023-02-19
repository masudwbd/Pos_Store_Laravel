@extends('layouts.app')

@section('content')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="header-container p-3 m-2 bg-primary">
                <div class="d-flex justify-content-between">
                    <div class="title">
                        <h5>POS (Point Of Sale)</h5>
                    </div>
                    <div class="date">
                        @php
                            echo date("d_m_y")
                        @endphp
                    </div>
                </div>
            </div>
            @php
                $categories = DB::table('categories')->get();
                $customers = DB::table('customers')->get();
            @endphp
            <div class="categories-container mr-2">
                <div class="d-flex justify-content-start">
                    @foreach ($categories as $category)
                        <div class="">
                            <button class="btn btn-primary m-2">{{$category->category_name}}</button>
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="pos-container m-2 mt-4">
                <div class="row">
                    <div class="col-4">
                        <div class="card text-left">
                            <div class="card-header">
                                <div class="d-flex justify-content-between">
                                    {{-- <div class="">
                                        <h5>Customer</h5>
                                    </div>
                                    <div class="">
                                        <button class="btn btn-primary" >Add Customer</button>
                                    </div>   --}}
                                    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                          <div class="modal-content">
                                            <div class="modal-header">
                                              <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                              </button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="{{route('customer.store')}}" method="POST" enctype="multipart/form-data">
                                                    @csrf
                                                    <div class="row">
                                                        <div class="col-6">
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
                                                        </div>
                                                        <div class="col-6">
                                                            <div class="form-group">
                                                                <label for="">Account Holder</label>
                                                                <input type="text" class="form-control" name="account_holder" id="">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="">Account Number</label>
                                                                <input type="text" class="form-control" name="account_number" id="">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="">Branch Name</label>
                                                                <input type="text" class="form-control" name="branch_name" id="">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="">City</label>
                                                                <input type="text" class="form-control" name="city" id="">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <input type="submit" value="Add Customer" class="btn btn-success">
                                                </form>

                                            </div>
                                            <div class="modal-footer">
                                              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            </div>
                                          </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <table class="table bordered">
                                    <thead>
                                        <tr style="background-color:skyblue;">
                                            <th>Name</th>
                                            <th>Qty</th>
                                            <th>Price</th>
                                            <th>Sub Total</th>
                                            <th>Remove</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $items = Cart::content();
                                        @endphp
                                        @foreach ($items as $item)
                                        <tr>
                                                <td>{{$item->name}}</td>
                                                <td>
                                                    <form action="{{route('cart.update' , $item->rowId)}}" method="POST">
                                                    @csrf
                                                    
                                                    <input type="number"  name="qty" style="width:60px" value="{{$item->qty}}">
                                                    <button class="btn btn-success btn-sm" style="margin-top:-5px" type="submit"><i class="fas fa-check"></i></button>
                                                    </form>
                                                </td>
                                                <td>{{$item->price}}</td>
                                                <td>{{$item->price * $item->qty }}</td>
                                                
                                                <td> 
                                                    <form action="{{route('cart.delete', $item->rowId)}}" method="POST">
                                                        @csrf
                                                        
                                                        <button type="submit" class="btn btn-danger"><i class="fa fa-trash"></i></button>
                                                    </form>
                                                </td>
                                                
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="card-footer">
                                    <div class="">
                                        <h5>VAT: {{Cart::tax()}}</h5>
                                        <h5>Total: {{Cart::total()}}</h5>
                                    </div>
                                    @if ($errors->any())
                                        <div class="alert alert-danger">
                                            <ul>
                                                @foreach ($errors->all() as $error)
                                                    <li>{{ $error }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif
                                    <div class="">
                                        <form action="{{route('create.invoice')}}" method="POST">
                                            @csrf
                                            <div class="customer-container mt-4">
                                                <Select class="form-control" name="customer_id" style="width:90%">
                                                    <option disabled="" selected="" value="">Select A Customer</option>
                                                    @foreach ($customers as $customer)
                                                        <option  value="{{$customer->id}}">{{$customer->name}}</option>
                                                    @endforeach
                                                </Select>
                                                <a href=""  data-toggle="modal" data-target="#exampleModal">
                                                    <i style="float:right; margin-top:-25px;margin-right:10px" class="fas fa-plus"></i>
                                                </a>
                                            </div>
                                            <button type="submit" class="btn btn-success btn-block mt-2">Create Invoice</button>
                                        </form>
                                    </div>     
                            </div>
                        </div>
                    </div>
                    <div class="col-8">
                        <section class="content">
                            <div class="container-fluid">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="card">
                                            <div class="card-header">
                                                <h3 class="card-title">All Products</h3>
                                            </div>
                                            <div class="row px-3">
                                            <!-- /.card-header -->
                                            
                                            <div class="card-body">
                                                <table id="" class="table table-bordered table-striped ytable">
                                                    <thead>
                                                        <tr>
                                                            <th>Image</th>
                                                            <th>Name</th>
                                                            <th>Category</th>
                                                            <th>Code</th>
                                                            <th>Add</th>

                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($products as $product)
                                                        <form action="{{route('product.add.to.cart')}}" method="POST">
                                                        @csrf
                                                        <input type="hidden" name="id" value="{{$product->id}}">
                                                        <input type="hidden" name="name" value="{{$product->product_name}}">
                                                        <input type="hidden" name="qty" value="1">
                                                        <input type="hidden" name="price" value="{{$product->selling_price}}">
                                                        @php
                                                            $category = DB::table('categories')->where('id', $product->category_id)->first();
                                                        @endphp
                                                            <tr>
                                                                <td><img src="{{asset($product->product_image)}}" style="height:50px;width:50px" alt=""> </td>
                                                                <td>{{$product->product_name}}</td>
                                                                <td>{{$category->category_name}}</td>
                                                                <td>{{$product->product_code}}</td> 
                                                                <td> <input type="submit" class="btn btn-info" value="Add To Cart"> </td>
                                                            </form>
                                                            </tr>
                                                        @endforeach
                                                        
                                                    </tbody>
                                                </table>
                                            </div>
                                            <!-- /.card-body -->
                                        </div>
                                        <!-- /.card -->
                                    </div>
                                    <!-- /.col -->
                                </div>
                                <!-- /.row -->
                            </div>
                            <!-- /.container-fluid -->
                        </section>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection