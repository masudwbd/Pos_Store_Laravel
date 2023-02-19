@extends('layouts.app')

@section('content')

<div class="container mt-5">
    <div class="form-container p-3 mt-3">
        <h4 class="text-center bg-primary p-2">Today Is @php echo date("d D") @endphp </h4>
        <form action="{{route('present.update')}}" method="POST" enctype="multipart/form-data">
            @csrf
                <table class="table table-bordered">
                    <thead>
                      <tr>
                        <th scope="col">Name</th>
                        <th scope="col">Photo</th>
                        <th scope="col">Attendance</th>
                      </tr>
                    </thead>
                    <tbody>
                    @foreach ($employes as $employer)
                        @php
                            $employer_details = DB::table('employes')->where('id', $employer->employer_id)->first();
                        @endphp
                        <tr>
                            <td>{{$employer_details->name}}</td>
                            <td ><img src="{{asset($employer_details->photo)}}" style="height:80px;width:80px" alt=""></td>
                            <td>
                                <div class="form-check">
                                    <span class="mr-4"><input class="form-check-input" @if($employer->attendance == 'present') checked="" @endif type="radio" value="present" name="attendance[{{$employer->id}}]" id="flexRadioDefault1"> Present</span>
                                    <span><input class="form-check-input mr-4" type="radio" @if($employer->attendance == 'absence') checked="" @endif  value="absence" name="attendance[{{$employer->id}}]" id="flexRadioDefault1"> Absence</span>
                                </div>
                            </td>
                            <input type="hidden" name="user_id[]" value="{{$employer->id}}">
                            <input type="hidden" name="date" value="{{$employer->date}}">
                            <input type="hidden" name="year" value="{{$employer->year}}">
                            <input type="hidden" name="edit_date" value="{{$employer->edit_date}}">
                        </tr>
                    @endforeach
                    </tbody>
                  </table>
                  <input type="submit" value="Save Data" class="btn btn-success float-right">
        </form>
    </div>
</div>

<script>
      $('.dropify').dropify();
</script>

@endsection
