
<div class="form-container p-4 mt-3" style="border:1px solid gray">
    <form action="{{route('category.update')}}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="">Name</label>
            <input type="text" value="{{$category->category_name}}" class="form-control" name="category_name" id="">
            <input type="hidden" name="id" value="{{$category->id}}">
        </div>
        <input type="submit" value="Update Customer" class="btn btn-success btn-block">
    </form>
</div>
</div>


