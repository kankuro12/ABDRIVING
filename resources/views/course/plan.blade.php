@extends('layout')
@section('title',$course->name. '- Payment Plan')
@section('content')
    <div class="p-3 m-3 shadow">
        <form action="{{route('payment.plan.add')}}" method="POST">
            @csrf
            <input type="hidden" name="course_id" value="{{$course->id}}">
            <div class="row">
                <div class="col-md-5">
                    <input type="number" name="day" min="0" class="form-control" required placeholder="Days">
                </div>
                <div class="col-md-5">
                    <input type="number" name="amount" min="0" class="form-control" required placeholder="Total Amount">
                </div>
                <div class="col-md-2">
                    <input type="submit" value="save" class="btn btn-primary">
                </div>
            </div>
        </form>
    </div>

    <div class="p-3 m-3 shadow">
        <table class="table">
            <div class="row">
                <div class=" col-md-4">
                    Day
                </div>
                <div class=" col-md-4">
                    Total Paid Amount
                </div>
            </div>

            @foreach ($course->plans as $plan)

                    <form action="{{route('payment.plan.edit',['plan'=>$plan->id])}}" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-md-4">
                                <input type="number" name="day" min="0" class="form-control" required placeholder="Days" value="{{$plan->day}}">
                            </div>
                            <div class="col-md-4">
                                <input type="number" name="amount" min="0" class="form-control" required placeholder="Total Amount" value="{{$plan->amount}}">
                            </div>
                            <div class="col-md-4">
                                <input type="submit" value="save" class="btn btn-primary">
                            <a href="{{route('payment.plan.del',['plan'=>$plan->id])}}" class="btn btn-danger">Delete</a>
                            </div>
                        </div>
                    </form>
                <hr style="margin:0px;padding:0px;">
            @endforeach
        </table>
    </div>
@endsection
