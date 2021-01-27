@extends('layout')
@section('css')
    <link rel="stylesheet" href="{{asset('css/nepali.datepicker.v3.2.min.css')}}">

@endsection
@section('content')

    <h3>
        Daily Record Transaction
    </h3>
    <div class="m-3 p-3 shadow">
        <form action="{{ route('account.daily') }}" method="POST">
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
    <div class="p-3 m-3 shadow">
        <table class="table">
            <tr>
                <th>
                    Date
                </th>
                <th>
                    Student
                </th>
                <th>
                    Amount
                </th>
                <th>
                    Accept
                </th>
            </tr>
            @php
                $total=0;
            @endphp
            @foreach ($transactions as $transaction)
                <tr>
                    <td>
                        {{$transaction->date}}
                    </td>
                    <td>
                        {{$transaction->student->name}}
                    </td>
                    <td class="font-weight-bold">
                        {{$transaction->amount}}
                        @php
                            $total+=$transaction->amount;
                        @endphp
                    </td>
                    <td>
                    <input type="checkbox"  id="accecpt-{{$transaction->id}}" onchange="accecpt({{$transaction->id}},this)" {{$transaction->accecpted==1?"checked":""}}>
                    </td>
                </tr>
                @endforeach
                @if(count($transactions)>0)
                    <tr>
                        <td colspan="2" class="text-right">
                            <span class="font-weight-bold">
                                Total Amount :
                            </span>
                        </td >
                        <td colspan="2" class="font-weight-bold">{{$total}}</td>
                    </tr>
                @endif
        </table>
        <hr>
        @if(count($transactions)>0)
            <div class="p-3">
                <form action="{{route('account.daily.acceptall')}}" method="post">
                    @csrf
                    <input type="hidden" name="date" value="{{$date}}">
                    <button class="btn btn-primary ">Accecpt All</button>
                </form>
            </div>
        @endif
    </div>


@endsection
@section('js')
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="{{asset('js/nepali.datepicker.v3.2.min.js')}}"></script>
    <script>
        var date = document.getElementById("date");

        date.nepaliDatePicker({
           ndpYear: true,
           ndpMonth: true,
        });


        function accecpt(id,element){
            var data={
                'id':id,
                'accept':element.checked
            };

            axios.post('{{route('account.daily.accept')}}',data)
            .then(function(response){
                if(element.checked){

                    showNotification('bg-success', 'Payment accepted successfully!');
                }else{
                    showNotification('bg-success', 'Payment acceptance Canceled successfully!');

                }

            })
            .catch(function(err){
                element.checked=!element.checked;
                showNotification('bg-danger', 'Process Failed');

            });
        }
    </script>
@endsection
