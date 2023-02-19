<div class="form-container p-3 mt-3" style="border:1px solid gray">
    <form action="{{route('supplier.update')}}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-6">
                <div class="form-group">
                    <label for="">Name</label>
                    <input type="text" value="{{$supplier->name}}" class="form-control" name="name" id="">
                    <input type="hidden" name="id" value="{{$supplier->id}}">
                </div>
                <div class="form-group">
                    <label for="">Email</label>
                    <input type="text" value="{{$supplier->email}}" class="form-control" name="email" id="">
                </div>
                <div class="form-group">
                    <label for="">Phone</label>
                    <input type="text" class="form-control" value="{{$supplier->phone}}" name="phone" id="">
                </div>
                <div class="form-group">
                    <label for="">Address</label>
                    <input type="text" class="form-control" value="{{$supplier->address}}" name="address" id="">
                </div>
                <div class="form-group">
                    <label for="">Type</label>
                    <select name="type" value="{{$supplier->type}}" class="form-control" id="">
                        <option value="1">Distributor</option>
                        <option value="2">Whole Seller</option>
                        <option value="3">Brochure</option>
                    </select>
                </div>        
            </div>
            <div class="col-6">
                <div class="form-group">
                    <label  for="">Shop Name</label>
                    <input type="text" value="{{$supplier->shop}}" class="form-control" name="shop" id="">
                </div>
                <div class="form-group">
                    <label for="">Account Holder</label>
                    <input type="text" value="{{$supplier->accountholder}}" class="form-control" name="account_holder" id="">
                </div>
                <div class="form-group">
                    <label for="">Account Number</label>
                    <input type="text" class="form-control" value="{{$supplier->accountnumber}}" name="account_number" id="">
                </div>
                <div class="form-group">
                    <label for="">Branch Name</label>
                    <input type="text" class="form-control" value="{{$supplier->branchname}}" name="branch_name" id="">
                </div>
                <div class="form-group">
                    <label for="">City</label>
                    <input type="text" class="form-control" value="{{$supplier->city}}" name="city" id="">
                </div>
            </div>
        </div>
     

        <input type="submit" value="Update Supplier" class="btn btn-success">
    </form>
</div>