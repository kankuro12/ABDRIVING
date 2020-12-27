@extends('layout')
@section('title','Student - '.$std->name)
@section('css')
    <link rel="stylesheet" href="{{asset('css/nepali.datepicker.v3.2.min.css')}}">
@endsection
@section('content')

    <h3 class="font-weight-bold">
        <a href="{{ route('students') }}">Students</a>/{{$std->name}} /Details
    </h3>
    <h4>Deal Amount : {{ $std->dealamount }} (Rs.)</h4>
    <h5>Packege : {{ $std->course->name}}</h5>
    @php
        $att = \App\Models\Attendance::where('student_id',$std->id)->where('attend',1)->count();
    @endphp
    <h5>Total Attendance : {{$att}} Days</h5>

<div class="">
    @include('student.payment',['std'=>$std])

</div>

<div class=" mb-4">
    @include('student.edit',['std'=>$std])
</div>

@endsection
@section('js')
    <script src="{{asset('js/nepali.datepicker.v3.2.min.js')}}"></script>
    <script>
        date=document.getElementById('p-date');
        date.nepaliDatePicker({
            ndpYear: true,
            ndpMonth: true,
        });
        @foreach($std->payments as $pay)
            date_{{$pay->id}}=document.getElementById('p-date-{{$pay->id}}');
            date_{{$pay->id}}.nepaliDatePicker({
                ndpYear: true,
                ndpMonth: true,
            });
        @endforeach
    </script>
@endsection
