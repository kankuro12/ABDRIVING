<style>
    .nb{
        border:none;
        padding:1px !important;
    }
    .nb:focus, .nb:active , .nb:hover{
        border:1px solid #7e7e7e;
    }
</style>
<div class="p-3 shadow">
    <h3 style="font-weight:800">
        Payments (Remaning Balance : Rs.{{$std->balance}}) |
        @if ($std->complete==0)

        <a href="{{route('students.passout',['std'=>$std->id])}}" class="btn btn-primary btn-sm">Mark As Passout</a>
        @endif
    </h3>
    <hr>
    <form  method="post" action="{{route('payments.add')}}">
        @csrf

        <div class="row">
            <input type="hidden" name="student_id" value="{{$std->id}}">
            <div class="col-md-2">
                <label >Bill No</label>
                <input type="text" name="billno" id="billno" class="form-control" placeholder="Bill No" required>
            </div>
            <div class="col-md-2">
                <label for="">Amount</label>
                <input type="number" max="{{$std->balance}}" name="amount" id="amount" min="1" required class="form-control" placeholder="Amount" required>
            </div>
            <div class="col-md-2">
                <label for="">Date</label>
                <input type="text" name="date" id="p-date"  required class="form-control" placeholder="Payment Date" required>
            </div>
            <div class="col-md-4">
                <label for="">Next Payment After</label>
                <input type="text" name="nextpayment" id="nextpayment"  required class="form-control" placeholder="Next Payment Days After" required>
            </div>
            <div class="col-md-2">
                <label for="">Action</label>

                <input type="submit" value="Add Payment" class="btn btn-primary">
            </div>
        </div>
    </form>

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
                    <input class="form-control nb" type="text" name="billno" id="billno-{{$pay->id}}" value="{{$pay->billno}}">

                </td>
                <td>
                    <input class="form-control nb" type="text" name="date" id="p-date-{{$pay->id}}" value="{{$pay->date}}">

                </td>
                <td>
                    <input class="form-control nb" type="number" name="amount" id="amount-{{$pay->id}}" value="{{$pay->amount}}">

                </td>
                <td>
                    <input type="submit" value="Update" class="btn btn-primary btn-sm m-0">
                    {{-- <a href="{{route('payments.del',['pay'=>$pay->id])}}" class="btn btn-danger">Delete</a> --}}
                </td>

            </tr>
        @endforeach
    </table>
</div>
