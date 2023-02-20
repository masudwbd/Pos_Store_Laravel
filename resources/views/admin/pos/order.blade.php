@extends('layouts.app')
@section('content')

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid ">
            <div class="m-4">
                <h3>Order Details</h3>
                <div class="d-flex justify-content-between mt-3">
                    <div class="">
                        <h5>Name : {{$customer->name}}</h5>
                        <h5>Address : {{$customer->address}}</h5>
                        <h5>City : {{$customer->city}}</h5>
                        <h5>Phone : {{$customer->phone}}</h5>
                    </div>
                    <div class="">
                        <h5>Order Date : @php echo date('d/m/y') @endphp</h5>
                    </div>
                </div>
                <div class="table-container mt-4">
                    <table class="table table-bordered">
                        <thead>
                          <tr>
                            <th scope="col">Name</th>
                            <th scope="col">Quantity</th>
                            <th scope="col">Price</th>
                            <th scope="col">Subtotal</th>
                          </tr>
                        </thead>
                        <tbody>
                        @foreach ($items as $item)
                            <tr>
                                <th>{{$item->name}}</th>
                                <th>{{$item->qty}}</th>
                                <th>{{$item->price}}</th>
                                <th>{{$item->qty * $item->price}}</th>
                            </tr>
                        @endforeach
                        <tr>
                            <td >Total : {{cart::total()}}</td>
                        </tr>
                        </tbody>
                      </table>
                      <div class="float-right">
                        <button onclick="setTimeout(function(){ window.print(); }, 1000);" class="btn btn-success"><i class="fas fa-print"></i> Print</button>
                        <button data-toggle="modal" data-target="#exampleModal" class="btn btn-success ">Submit</button>
                      </div>

                </div>
            </div>
          
        </div>
    </div>
</div>

{{-- modal  --}}
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
            <form action="{{route('order.store')}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-4">
                        <div class="form-group">
                            <label for="">Paid Amount</label>
                            <select class="form-control" name="payment_status" id="">
                                <option value="Cash">Cash</option>
                                <option value="Card">Card</option>
                                <option value="Due">Due</option>
                            </select>
                        </div>

                    </div>
                    <div class="col-4">
                        <div class="form-group">
                            <label for="">Pay Amount</label>
                            <input class="form-control" value="{{cart::total()}}" name="pay" id="">
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="form-group">
                            <label for="">Due Amount</label>
                            <input class="form-control" type="number" name="due" id="">
                        </div>
                    </div>
                </div>
                <input type="hidden" name="customer_id" value="{{$customer->id}}" >
                <input type="hidden" name="order_date" value="{{date('d-m-y')}}" >
                <input type="hidden" name="order_status" value="pending" >
                <input type="hidden" name="total_products" value="{{cart::count()}}" >
                <input type="hidden" name="subtotal" value="{{Cart::subtotal()}}" >
                <input type="hidden" name="vat" value="{{cart::tax()}}" >
                <input type="hidden" name="total" value="{{cart::total()}}" >
           

        </div>
        <div class="modal-footer">
            <input type="submit" value="Save Order" class="btn btn-success">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
        </form>
      </div>
    </div>
</div>



@endsection