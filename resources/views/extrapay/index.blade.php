@extends('layout')
@section('title','Extra Payments')
@section('css')
    <link rel="stylesheet" href="{{asset('css/nepali.datepicker.v3.2.min.css')}}">
@endsection
@section('content')


<div class="mb-3">
    <form action="{{ route('extra.pay.store')}}" method="POST">
    @csrf
    <div class="row">

        <div class="col-md-3">
            <input  type="text" class="form-control" name="date" id="date" placeholder="date" required>
        </div>
        <div class="col-md-4">
            <input type="text" class="form-control" name="title" placeholder="Title" required>
        </div>

        <div class="col-md-3">
            <input  type="number" min="0" class="form-control" name="amount" placeholder="Amount" required>
        </div>

        <div class="col-md-3 mt-3">
            <input  type="text" class="form-control" name="pay_by" placeholder="Payment By" required>
        </div>

        <div class="col-md-5 mt-3">
            <input  type="text" class="form-control" name="remark" placeholder="Remarks" required>
        </div>

        <div class="col-md-2 mt-3">
            <input type="submit" class=" btn btn-primary" value="Add">
        </div>
    </div>
    </form>
</div>

<div class="col-md-12 mt-5">
    <h6>Extra Payment Transaction List</strong></h6>
    <hr>
    <table class="table table-bordered">
        <tr>
            <th>Date</th>
            <th>Title</th>
            <th>Paid By</th>
            <Th>Amount (Rs.)</Th>
            <th>Remarks</th>
            <th>Action</th>
        </tr>
        @php
            $totextra = 0;
        @endphp
        @foreach ($extra as $ex)
            <tr>
                <td>{{ $ex->date }}</td>
                <td>{{ $ex->title }}</td>
                <td>{{ $ex->payment_by }}</td>
                <td>{{ $ex->amount }}</td>
                <td>{{ $ex->remarks }}</td>
                <td><a class="btn btn-danger btn-sm" href="{{ route('extra.payment.delete',$ex->id) }}">Delete</a></td>
            </tr>
            @php
                $totextra+=$ex->amount;
            @endphp
        @endforeach
        <tr>
            <td colspan="3" class="text-right"><strong> Total </strong></td>
            <td colspan="2"><strong>{{$totextra}}</strong></td>
        </tr>
    </table>
</div>

@endsection
@section('js')
<script src="{{asset('js/nepali.datepicker.v3.2.min.js')}}"></script>
<script>
    var month = ('0'+NepaliFunctions.GetCurrentBsDate().month).slice(-2);
    var day = ('0'+NepaliFunctions.GetCurrentBsDate().day).slice(-2);
    $('#date').val(NepaliFunctions.GetCurrentBsYear()+'-'+month+'-'+day);

    window.onload = function() {
        var mainInput = document.getElementById("date");
        mainInput.nepaliDatePicker({
            ndpYear: true,
            ndpMonth: true,
        });

        $('.date').each(function(){
            console.log(this);
            this.nepaliDatePicker({
                ndpYear: true,
                ndpMonth: true,
            });
        });
    }







</script>
@endsection
