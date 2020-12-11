@extends('layout')
@section('title','Attendance')
@section('css')
    <link rel="stylesheet" href="{{asset('css/nepali.datepicker.v3.2.min.css')}}">
@endsection
@section('content')
    <div class="p-3">
        <form action="{{route('attendances.get')}}" method="post" target="_loader">
            @csrf
            <div class="row">
                <div class="col-md-3">
                    <label for="date">Date</label>
                    <input type="text" name="date" id="date" class="form-control" readonly required>
                </div>
                <div class="col-md-3">
                    <label for="program">Program</label>
                    <select name="program" id="program" class="form-control" >
                        <option value="-11">Select A Program</option>

                        @foreach (\App\Models\Course::all() as $course)
                            <option value="{{$course->id}}">
                                {{$course->name}}
                            </option>
                        @endforeach

                    </select>
                </div>
                <div class="col-md-3">
                    <label for="shift">Shift</label>
                    <select name="time" id="time" class="form-control">
                            <option value="-11">Select Shift</option>
                            @foreach (\App\Models\Slot::all() as $slot)
                                <option value="{{$slot->id}}">
                                    {{$slot->time}}
                                </option>
                            @endforeach

                    </select>
                </div>
                <div class="col-md-3">
                    <br>
                    <input type="submit" value="Load Sheet" class="btn btn-primary">
                </div>


            </div>
        </form>
    </div>
    <hr>
    <div class="p-3">
        <iframe name="_loader" frameborder="0" style="width:100%;height:800px;border:1px solid #838383;border-radius:10px;"></iframe>
    </div>
@endsection
@section('js')
    <script src="{{asset('js/nepali.datepicker.v3.2.min.js')}}"></script>
    <script>
        date=document.getElementById('date');
        date.nepaliDatePicker({
            ndpYear: true,
            ndpMonth: true,
        });

    </script>
@endsection
