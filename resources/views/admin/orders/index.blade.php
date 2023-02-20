@extends('layouts.app')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">All Orders</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <button class="btn btn-primary" data-toggle="modal" data-target="#addModal">+ Add
                                New</button>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">All Orders</h3>
                            </div>
                            <div class="row px-3">
                            <!-- /.card-header -->
                            <div class="form-group col-3 ml-3 mt-4">
                                <label for="date">Date</label>
                                <input type="date" class="form-control submitable_date" name="order_date" id="order_date">
                            </div>
                            <div class="form-group col-3 mt-4">
                                <label for="payment">Payment Type</label>
                                <select class="form-control payment_status" name="payment_status" id="payment_status">
                                    <option value="Cash">Cash</option>
                                    <option value="Card">Card</option>
                                    <option value="Due">Due</option>
                                </select>
                            </div>
                            <div class="card-body">
                                <table id="" class="table table-bordered table-striped ytable">
                                    <thead>
                                        <tr>
                                            <th>SL</th>
                                            <th>Customer_id</th>
                                            <th>Order_date</th>
                                            <th>Total_products</th>
                                            <th>Sub_total</th>
                                            <th>Total</th>
                                            <th>Payment_status</th>
                                            <th>Pay</th>
                                            <th>Due</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>

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


    
    {{-- Edit Modal --}}
    <div class="modal fade" class="" id="editModal" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="edit_child_category">Edit Subcategory</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div id="modal-body">

                </div>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-ajaxy/1.6.1/scripts/jquery.ajaxy.min.js"
        integrity="sha512-bztGAvCE/3+a1Oh0gUro7BHukf6v7zpzrAb3ReWAVrt+bVNNphcl2tDTKCBr5zk7iEDmQ2Bv401fX3jeVXGIcA=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js" defer></script>


    <script>
        $(function orders() {
            var table = $('.ytable').DataTable({
                processing: true,
                serverSide: true,
                "ajax": {
                    "url": "{{ route('orders.index') }}",
                    "data": function(e) {
                        e.order_date = $("#order_date").val();
                        e.payment_status = $("#payment_status").val();
                    }
                },
                columns:[
                    {data: 'DT_RowIndex', name:'DT_RowIndex'},
                    {data: 'customer_id', name:'customer_id'},
                    {data: 'order_date', name:'order_date'},
                    {data: 'total_products', name:'total_products'},
                    {data: 'sub_total', name:'sub_total'},
                    {data: 'total', name:'total'},
                    {data: 'payment_status', name:'payment_status'},
                    {data: 'pay', name:'pay'},
                    {data: 'due', name:'due'},
                    {data: 'action', name:'action', orderable:true, searchable:true},
                ]
            });
        });

        $(document).on('change', '.submitable_date', function() {
            $('.ytable').DataTable().ajax.reload();
        });

        $(document).on('change', '.payment_status', function() {
            $('.ytable').DataTable().ajax.reload();
        });


        
    $('body').on('click' , '.edit' , function(){
        let id = $(this).data('id');
        $.get('product/edit/' + id , function(data){
            $("#modal-body").html(data);
        });
    })

    </script>
@endsection
