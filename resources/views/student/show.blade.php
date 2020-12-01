@extends('layout');
@section('title','Student - '.$std->name)
@section('css')
    <link rel="stylesheet" href="{{asset('css/nepali.datepicker.v3.2.min.css')}}">
@endsection
@section('content')
<div class="mt-4 mb-4">
    @include('student.edit',['std'=>$std])
</div>
<div>
    @include('student.payment',['std'=>$std])

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