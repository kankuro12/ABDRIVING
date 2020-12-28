@extends('layout')
@section('css')
    <link rel="stylesheet" href="{{asset('css/nepali.datepicker.v3.2.min.css')}}">

@endsection
@section('content')
    <h3>
        Daily Record Transaction
    </h3>
    <div class="m-3 p-3 shadow">
        <form action="{{ route('transaction.request') }}" method="POST">
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
        <div class="row">
            <div class="col-md-6">
                <h3>Expenses</h3>
                <table class="table">
                    <tr>
                        <th>Date</th>
                        <th>Title</th>
                        <Th>Amount</Th>
                    </tr>
                    @php
                        $totalexp = 0;
                    @endphp
                    @foreach ($expense as $exp)
                        <tr>
                            <td>{{ $exp->date }}</td>
                            <td>{{ $exp->title }}</td>
                            <td>{{ $exp->amount }}</td>
                        </tr>
                        @php
                            $totalexp+=$exp->amount;
                        @endphp
                    @endforeach
                    @if(count($payment)>0)
                            <tr>
                                <td colspan="2" class="text-right">
                                    <span class="font-weight-bold">
                                        Total Amount :
                                    </span>
                                </td >
                                <td colspan="2" class="font-weight-bold">{{$totalexp}}</td>
                            </tr>
                        @endif
                </table>
            </div>
            <div class="col-md-6">
                <h3>Payment</h3>
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
                    </tr>
                    @php
                        $total=0;
                    @endphp
                    @foreach ($payment as $pay)
                        <tr>
                            <td>
                                {{$pay->date}}
                            </td>
                            <td>
                                {{$pay->student->name}}
                            </td>
                            <td class="font-weight-bold">
                                {{$pay->amount}}
                                @php
                                    $total+=$pay->amount;
                                @endphp
                            </td>
                        </tr>
                        @endforeach
                        @if(count($payment)>0)
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
            </div>
            <div class="col-md-12 text-right">
                <form action="{{ route('send.request') }}" method="POST">
                    @csrf
                    <input type="hidden" name="total_exp" value="{{ $totalexp }}">
                    <input type="hidden" name="total_payment"  value="{{ $total }}">
                    <input type="hidden" name="date" value="{{$date??""}}">
                    <button class="btn btn-primary">Send A Request</button>
                </form>
            </div>
        </div>
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
