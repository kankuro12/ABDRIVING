@extends('layout');
@section('title','Slots')
@section('content')
<div class="pb-3 pt-3 pl-3 pr-3">
    <div class="row">
        <div class="col-md-3 shadow mb-2">
            <form action="{{route('slots.add')}}" method="post">
                @csrf
                <br>
                <label for="time">time</label>
                <input type="text" name="time" class="form-control" required> 
                <br>
                <input type="submit" value="Add Slot" class="btn btn-primary">
            </form>
        </div>
        @foreach ($list as $slot)
        <div class="col-md-3 mb-2 shadow">
            <form action="{{route('slots.edit',['slot'=>$slot->id])}}" method="post">
                @csrf
                <br>

                <label for="time">time</label>
                <input type="text" name="time" class="form-control" value="{{$slot->time}}" required> 
                <br>
                <input type="submit" value="Update Slot" class="btn btn-primary">
                <a href="{{route('slots.del',['slot'=>$slot->id])}}" class="btn btn-danger">
                    Delete
                </a>
            </form>
        </div>
        @endforeach
    </div>
</div>
@endsection