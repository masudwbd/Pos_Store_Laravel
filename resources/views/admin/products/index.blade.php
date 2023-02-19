@extends('layouts.app')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">All Employes</h1>
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
                                <h3 class="card-title">All Products</h3>
                            </div>
                            <div class="row px-3">
                            <!-- /.card-header -->
                            
                            <div class="card-body">
                                <table id="" class="table table-bordered table-striped ytable">
                                    <thead>
                                        <tr>
                                            <th>SL</th>
                                            <th>Name</th>
                                            <th>Category</th>
                                            <th>Supplier</th>
                                            <th>Code</th>
                                            <th>Garage</th>
                                            <th>Route</th>
                                            <th>Image</th>
                                            <th>Buy Date</th>
                                            <th>Expire Date</th>
                                            <th>Buying Price</th>
                                            <th>Selling Price</th>
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
        $(function advance_salaries() {
            var table = $('.ytable').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('product.index') }}",
                columns:[
                    {data: 'DT_RowIndex', name:'DT_RowIndex'},
                    {data: 'product_name', name:'product_name'},
                    {data: 'category_name', name:'category_name'},
                    {data: 'name', name:'name'},
                    {data: 'product_code', name:'product_code'},
                    {data: 'product_garage', name:'product_garage'},
                    {data: 'product_route', name:'product_route'},
                    {data: 'product_image', name:'product_image'},
                    {data: 'buy_date', name:'buy_date'},
                    {data: 'expire_date', name:'expire_date'},
                    {data: 'buying_price', name:'buying_price'},
                    {data: 'selling_price', name:'selling_price'},
                    {data: 'action', name:'action', orderable:true, searchable:true},
                ]
            });
        });


        
    $('body').on('click' , '.edit' , function(){
        let id = $(this).data('id');
        $.get('product/edit/' + id , function(data){
            $("#modal-body").html(data);
        });
    })

    </script>
@endsection
