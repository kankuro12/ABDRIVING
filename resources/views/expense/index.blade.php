@extends('layout')
@section('title','Expenses')
@section('css')
    <link rel="stylesheet" href="{{asset('css/nepali.datepicker.v3.2.min.css')}}">
@endsection
@section('content')
<div class="mb-3">
    <form action="" method="POST">
    @csrf
    <div class="row">

        <div class="col-md-3">
            <input  type="text" class="form-control" name="date" id="date" placeholder="date" required>
        </div>
        <div class="col-md-4">
            <input type="text" class="form-control" name="title" placeholder="Expese title" required>
        </div>
        <div class="col-md-3">
            <input  type="number" min="0" class="form-control" name="amount" placeholder="Amount" required>
        </div>
        <div class="col-md-2">
            <input type="submit" class=" btn btn-primary" value="Add">
        </div>
    </div>
    </form>
</div> <br> <br>
<div >
    <table class="table">
        <tr>
            <th>
                Date
            </th>
            <th>
                Title
            </th>
            <th>
                Amount (Rs.)
            </th>
            <th>
                Action
            </th>
        </tr>

        @foreach ($expense as $exp)
        <form action="">
            <tr>
               <td><input type="text" name="date" id="exp-{{$exp->id}}" class="form-control date" value="{{ $exp->date }}"></td>
                <td><input type="text" name="title" class="form-control" value="{{ $exp->title }}"> </td>
                <td><input type="text" name="amount" class="form-control" value="{{ $exp->amount }}"> </td>
                <td>
                    <button class="btn btn-primary btn-sm">Update</button>
                </td>
            </tr>
        </form>
        @endforeach

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
