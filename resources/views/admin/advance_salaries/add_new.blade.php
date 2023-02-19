@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h4 class="">Add Advance Salary</h4>
    <div class="form-container p-3 mt-3" style="border:1px solid gray">
        <form action="{{route('salary.store')}}" method="POST" enctype="multipart/form-data">
            @csrf
            @php
                $employes = DB::table('employes')->get();
            @endphp
            <div class="form-group">
                <label for="">Employe</label>
                <select class="form-control" name="employe_id" id="employe_id">
                    @foreach ($employes as $employe)
                        <option value="{{$employe->id}}">{{$employe->name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="">Month</label>
                <Select name="month" class="form-control">
                    <option value="january">January</option>
                    <option value="february">February</option>
                    <option value="march">March</option>
                    <option value="april">April</option>
                    <option value="may">May</option>
                    <option value="june">June</option>
                    <option value="july">July</option>
                    <option value="august">August</option>
                    <option value="septembar">Septembar</option>
                    <option value="Octobar">Octobar</option>
                    <option value="novembar">Novembar</option>
                    <option value="december">December</option>
                </Select>
            </div>
            <div class="form-group">
                <label for="">Year</label>
                <input type="number" class="form-control" name="year" id="">
            </div>
            <div class="form-group">
                <label for="">Advance Salary</label>
                <input type="number" class="form-control" name="advance_salary" id="">
            </div>
            <input type="submit" value="Add Supplier" class="btn btn-success">
        </form>
    </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
@endsection
