@extends('layout')
@section('css')
    <link rel="stylesheet" href="{{asset('css/nepali.datepicker.v3.2.min.css')}}">

@endsection
@section('content')
    <h3>
        Branch List
    </h3>
       <table class="table table-bordered">
        <tr>
            <th>Branch Name</th>
            <th>Action</th>
        </tr>
        @foreach (\App\Models\User::all() as $u)
            <tr>
                <td>{{ $u->name }}</td>
                <td><a href="{{ route('branch.report',$u->id)}}" class="btn btn-primary">View</a></td>
            </tr>
        @endforeach
       </table>
@endsection
@section('js')
<script src="{{asset('js/nepali.datepicker.v3.2.min.js')}}"></script>
<script>
    var date = document.getElementById("date");

            date.nepaliDatePicker({
               ndpYear: true,
               ndpMonth: true,
            });
</script>
@endsection
