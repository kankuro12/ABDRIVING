<div class="pt-3 pb-3">
    <hr>
    <h3 style="font-weight:800">
        Payments (Balance : Rs.{{$std->balance}})
    </h3>
    <hr>
    <form  method="post" action="{{route('payments.add')}}">
        @csrf

        <div class="row">
            <input type="hidden" name="student_id" value="{{$std->id}}">
            <div class="col-md-2">
                <input type="text" name="billno" id="billno" class="form-control" placeholder="Bill No">
            </div>
            <div class="col-md-4">
                <input type="number" name="amount" id="amount" min="1" max="{{$std->balance}}" required class="form-control" placeholder="Amount">
            </div>
            <div class="col-md-4">
                <input type="text" name="date" id="p-date"  required class="form-control" placeholder="Payment Date">
            </div>
            <div class="col-md-2">
                <input type="submit" value="Add Payment" class="btn btn-primary">
            </div>
        </div>
    </form>
    <hr>
    <table class="table">
        <tr>
            <th>RefNo</th>
            <th>
                Bill No
            </th>
            <th>
                Date
            </th>
            <th>
                Amount
            </th>
            <th>

            </th>
        </tr>
        @foreach ($std->payments as $pay)
            <tr>
                <form action="{{route('payments.edit',['pay'=>$pay->id])}}" method="post">
                    @csrf

                </form>
                <td>
                    {{$pay->id}}
                </td>
                <td>
                    <input type="text" name="billno" id="billno-{{$pay->id}}" value="{{$pay->billno}}">

                </td>
                <td>
                    <input type="text" name="date" id="p-date-{{$pay->id}}" value="{{$pay->date}}">
                    
                </td>
                <td>
                    <input type="number" name="amount" id="amount-{{$pay->id}}" value="{{$pay->amount}}">
                    
                </td>
                <td>
                    <input type="submit" value="Update" class="btn btn-primary">
                    {{-- <a href="{{route('payments.del',['pay'=>$pay->id])}}" class="btn btn-danger">Delete</a> --}}
                </td>
               
            </tr>
        @endforeach
    </table>
</div>