
    <div class="form-container p-4 mt-3" style="border:1px solid gray">
        <form action="{{route('customer.update')}}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="">Name</label>
                <input type="text" value="{{$customer->name}}" class="form-control" name="name" id="">
                <input type="hidden" name="id" value="{{$customer->id}}">
            </div>
            <div class="form-group">
                <label for="">Email</label>
                <input type="text" value="{{$customer->email}}"  class="form-control" name="email" id="">
            </div>
            <div class="form-group">
                <label for="">Phone</label>
                <input type="text" value="{{$customer->phone}}"  class="form-control" name="phone" id="">
            </div>
            <div class="form-group">
                <label for="">Address</label>
                <input type="text" value="{{$customer->address}}"  class="form-control" name="address" id="">
            </div>
            <div class="form-group">
                <label for="">Account Holder</label>
                <input type="text" value="{{$customer->accountholder}}"  class="form-control" name="account_holder" id="">
            </div>
            <div class="form-group">
                <label for="">Account Number</label>
                <input type="number"  value="{{$customer->accountnumber}}"  class="form-control" name="account_number" id="">
            </div>
            <div class="form-group">
                <label for="">Branch Name</label>
                <input type="text" value="{{$customer->branchname}}"  class="form-control" name="branch_name" id="">
            </div>
            <div class="form-group">
                <label for="">City</label>
                <input type="text" class="form-control" value="{{$customer->city}}"  name="city" id="">
            </div>
            <input type="submit" value="Update Customer" class="btn btn-success btn-block">
        </form>
    </div>
</div>


