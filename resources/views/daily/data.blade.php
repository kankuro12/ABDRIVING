<div class="row">
    <div class="col-md-6">
        <h6>Student Payment Transaction :- <strong>{{ $user->name }}</strong></h6>
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
        <h6>Expense Transaction :- <strong>{{ $user->name }}</strong></h6>
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
    <div class="col-md-12 mt-5">
        <h6>Extra Payment Transaction :- <strong>{{ $user->name }}</strong></h6>
        <hr>
        <table class="table table-bordered">
            <tr>
                <th>Date</th>
                <th>Title</th>
                <th>Paid By</th>
                <Th>Amount (Rs.)</Th>
                <th>Remarks</th>
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
</div>
