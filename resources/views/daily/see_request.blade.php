@extends('layout')
@section('css')
    <link rel="stylesheet" href="{{asset('css/nepali.datepicker.v3.2.min.css')}}">

@endsection
@section('content')
    <h3>
        Branch Transaction Report
    </h3>
        <div class="m-3 p-3 shadow">
            <form method="POST">
                @csrf
                <div class="row">
                    <div class="col-md-4">
                        <input type="text" name="date" id="date" class="form-control">
                    </div>
                    <input type="hidden" id="u_id" name="user_id" value="{{ $user->id }}">
                    <div class="col-md-4">
                        <span onclick="getRepost();" class="btn btn-primary">Load Transctions</span>
                    </div>
                </div>
            </form>
        </div>
        <div id="loadedData"  style="border: 1px black solid; padding:1rem;">

        </div>

        <div  style="border: 1px black solid; padding:1rem; margin-top:2rem;">
            <div class="row">
                <div class="col-md-6">
                    <h6>All Time Payment Transaction :- <strong>{{ $user->name }}</strong></h6>
                    <hr>
                    <table class="table table-bordered">
                        <tr>
                            <th>Date</th>
                            <th>Student</th>
                            <th>Amount (Rs.)</th>
                        </tr>
                        @php
                            $total = 0;
                        @endphp
                        @foreach ($daily as $trans)
                            <tr>
                                <td>{{ $trans->date }}</td>
                                <td>{{ $trans->student->name }}</td>
                                <td>{{ $trans->amount }}</td>
                            </tr>
                            @php
                                $total+=$trans->amount
                            @endphp
                        @endforeach
                        <tr>
                            <td colspan="2" class="text-right"><strong> Total </strong></td>
                            <td><strong>{{$total}}</strong></td>
                        </tr>
                    </table>
                </div>
                <div class="col-md-6">
                    <h6>All Time Expense Transaction :- <strong>{{ $user->name }}</strong></h6>
                    <hr>
                    <table class="table table-bordered">
                        <tr>
                            <th>Date</th>
                            <th>Title</th>
                            <Th>Amount (Rs.)</Th>
                        </tr>
                        @php
                            $expTotal = 0;
                        @endphp
                        @foreach ($expenses as $exp)
                            <tr>
                                <td>{{ $exp->date }}</td>
                                <td>{{ $exp->title }}</td>
                                <td>{{ $exp->amount }}</td>
                            </tr>
                            @php
                                $expTotal+=$exp->amount;
                            @endphp
                        @endforeach
                        <tr>
                            <td colspan="2" class="text-right"><strong> Total </strong></td>
                            <td><strong>{{$expTotal}}</strong></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>

@endsection
@section('js')
<script src="{{asset('js/nepali.datepicker.v3.2.min.js')}}"></script>
<script>
        var month = ('0'+NepaliFunctions.GetCurrentBsDate().month).slice(-2);
        var day = ('0'+NepaliFunctions.GetCurrentBsDate().day).slice(-2);
        $('#date').val(NepaliFunctions.GetCurrentBsYear()+'-'+month+'-'+day);
        var date = document.getElementById("date");

            date.nepaliDatePicker({
               ndpYear: true,
               ndpMonth: true,
            });
        window.onload = function() {
           getRepost();
        }


function getRepost(){
    var date = $('#date').val();
    var user_id = $('#u_id').val();
    axios({
    method: 'post',
    url: '{{ route("branch.request")}}',
    data: {'date':date,'user_id':user_id}
    })
  .then(function (response) {
    $('#loadedData').empty();
    $('#loadedData').html(response.data);
  })
    .then(function (response) {
        // handle success
        console.log(response);
    })
    .catch(function (error) {
        // handle error
        console.log(error);
    });
}


</script>
@endsection
