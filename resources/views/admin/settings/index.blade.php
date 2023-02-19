@extends('layouts.app')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 pl-2"> Settings</h1>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->
        <section class="content">
            <div class="container-fluid">
                <div class="p-4">
                    <form action="{{route('settings.update')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row" style="border:1px solid black;padding:20px">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="">Company Name</label>
                                    <input type="text" class="form-control" name="company_name"
                                        value="{{ $data->company_name }}" id="">
                                    <input type="hidden" name="id" value="{{$data->id}}">
                                </div>
                                <div class="form-group">
                                    <label for="">Company Address</label>
                                    <input type="text" class="form-control" name="company_address"
                                        value="{{ $data->company_address }}" id="">
                                </div>
                                <div class="form-group">
                                    <label for="">Company Email</label>
                                    <input type="text" class="form-control" name="company_email"
                                        value="{{ $data->company_email }}" id="">
                                </div>
                                <div class="form-group">
                                    <label for="">Company Phone</label>
                                    <input type="text" class="form-control" name="company_phone"
                                        value="{{ $data->company_phone }}" id="">
                                </div>
                                <div class="form-group">
                                    <label for="">Company Logo</label>
                                    <input type="hidden" class="form-control" name="old_logo"
                                        value="{{ $data->company_logo }}" id="">
                                    <input type="file" class="form-control" name="company_logo"
                                    id="">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="">Company Mobile</label>
                                    <input type="text" class="form-control" name="company_mobile"
                                        value="{{ $data->company_mobile }}" id="">
                                </div>
                                <div class="form-group">
                                    <label for="">Company City</label>
                                    <input type="text" class="form-control" name="company_city"
                                        value="{{ $data->company_city }}" id="">
                                </div>
                                <div class="form-group">
                                    <label for="">Company Country</label>
                                    <input type="text" class="form-control" name="company_country"
                                        value="{{ $data->company_country }}" id="">
                                </div>
                                <div class="form-group">
                                    <label for="">Company Zipcode</label>
                                    <input type="text   " class="form-control" name="company_zipcode"
                                        value="{{ $data->company_zipcode }}" id="">
                                </div>
                            </div>
                        </div>
                        <div class="mt-5"> <input class="btn btn-block btn-success" type="submit" value="Update Settings"></div>
                    </form>
                </div>
            </div>
        </section>
    </div>



    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-ajaxy/1.6.1/scripts/jquery.ajaxy.min.js"
        integrity="sha512-bztGAvCE/3+a1Oh0gUro7BHukf6v7zpzrAb3ReWAVrt+bVNNphcl2tDTKCBr5zk7iEDmQ2Bv401fX3jeVXGIcA=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js" defer></script>
    <script>
        $('body').on('click', '.edit', function() {
            let id = $(this).data('id');
            $.get('employe/edit/' + id, function(data) {
                $("#modal-body").html(data);
            });
        })
    </script>
@endsection
