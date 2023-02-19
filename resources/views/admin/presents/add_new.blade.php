@extends('layouts.app')

@section('content')

@php
    $employes = DB::table('employes')->get();
@endphp

<div class="container mt-5">
    <div class="form-container p-3 mt-3">
        <h4 class="text-center bg-primary p-2">Today Is @php echo date("d D") @endphp </h4>
        <form action="{{route('present.store')}}" method="POST" enctype="multipart/form-data">
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
                        <tr>
                            <th>{{$employer->name}}</th>
                            <td ><img src="{{asset($employer->photo)}}" style="height:80px;width:80px" alt=""></td>
                            <td>
                                <div class="form-check">
                                    <span class="mr-4"><input class="form-check-input " type="radio" value="present" name="attendance[{{$employer->id}}]" id="flexRadioDefault1"> Present</span>
                                    <span><input class="form-check-input mr-4" type="radio" value="absence" name="attendance[{{$employer->id}}]" id="flexRadioDefault1"> Absence</span>
                                </div>
                            </td>
                            <input type="hidden" name="user_id[]" value="{{$employer->id}}">
                            <input type="hidden" name="date" value="@php echo date("d_m_y") @endphp">
                            <input type="hidden" name="year" value="@php echo date("y") @endphp">
                            <input type="hidden" name="edit_date" value="@php echo date("d_m_y") @endphp">
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
