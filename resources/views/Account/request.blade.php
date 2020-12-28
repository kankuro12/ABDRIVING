@extends('layout')
@section('css')
    <link rel="stylesheet" href="{{asset('css/nepali.datepicker.v3.2.min.css')}}">

@endsection
@section('content')

    <h3>
        Daily Transaction Request
    </h3>
    <div class="m-3 p-3 shadow">
        <form action="{{ route('account.transaction.request') }}" method="POST">
            @csrf
            <div class="row">
                <div class="col-md-4">
                    <input type="text" name="date" id="date" class="form-control" value="{{$date??""}}">
                </div>
                <div class="col-md-4">
                    <input type="submit" value="Load Transctions Request" class="btn btn-primary">
                </div>
            </div>
        </form>
    </div>

    <div class="row m-3 p-3 shadow">
            <div class="col-md-6">


                <table class="table table-bordered">
                    <tr>
                        <th>Student</th>
                        <th>Amount</th>
                    </tr>
                    @foreach ($payment as $pay)
                        <tr>
                            <td>{{ $pay->student->name }}</td>
                            <td>{{ $pay->amount }}</td>
                        </tr>
                    @endforeach

                </table>
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

            axios.post('',data)
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
