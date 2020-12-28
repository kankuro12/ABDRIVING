@extends('layout')
@section('css')
    <link rel="stylesheet" href="{{asset('css/nepali.datepicker.v3.2.min.css')}}">

@endsection
@section('content')
    <h3>
        Branch Daily Transaction Request
    </h3>
        <div class="m-3 p-3 shadow">
            <form action="{{ route('branch.request') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-md-4">
                        <input type="text" name="date" id="date" class="form-control" value="{{$date??""}}">
                    </div>
                    <div class="col-md-4">
                        <input type="submit" value="Load Transctions" class="btn btn-primary">
                    </div>
                </div>
            </form>
        </div>
            <div class="row m-3 p-3">
                @foreach ($daily as $re)
                <div class="col-md-4 shadow">
                    <h5 class="text-center">{{ $re->branch }}</h5>
                    <hr>
                    <strong>Total Payments : Rs. {{ $re->total_payment }}</strong><br>
                    <strong>Total Expense : Rs. {{ $re->total_exp }}</strong><br>
                    <strong>Date : {{ $re->date }}</strong>
                    <div class="text-right">
                       <a href="{{ route('accept.request',$re->id)}}" class="btn btn-primary">Accept</a>
                    </div>
                </div>
                @endforeach
            </div>
    </div>

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
