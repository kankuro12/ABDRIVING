@extends('layout')
@section('title','Course')
@section('content')
<div class="mb-3">
    <form action="{{route('courses.add')}}" method="POST">
    @csrf
    <div class="row">
        <div class="col-md-7">
            <input type="text" class="form-control" name="name" placeholder="Name" required>
        </div>
        <div class="col-md-3">
            <input  type="number" min="0" class="form-control" name="rate" placeholder="Rate" required>
        </div>
        <div class="col-md-2">
            <input type="submit" class=" btn btn-primary" value="Add">
        </div>
    </div>
    </form>
</div>
<div >
    <table class="table">
        <tr>
            <th>
                #id
            </th>
            <th>
                Name
            </th>
            <th>
                Rate
            </th>
            <th>

            </th>
        </tr>
        @foreach ($list as $c)
            <tr>
                <form action="{{route('courses.edit',['c'=>$c->id])}}" method="POST">
                @csrf
                <td>
                    {{$c->id}}
                </td>
                <td>
                    <input type="text" class="form-control" name="name" placeholder="Name" required value="{{$c->name}}">

                </td>
                <td>
                    <input  type="number" min="0" class="form-control" name="rate" placeholder="Rate" required value="{{$c->rate}}">

                </td>
                <td>
                    <input type="submit" class=" btn btn-primary" value="Update">
                    <a href="{{route('courses.del',['c'=>$c->id])}}" class="btn btn-danger"> Delete</a>
                    {{-- <a class="d-inline-block" href="{{route('payment.plan',['course'=>$c->id])}}" class="btn btn-success"> Payment Plan</a> --}}
                </td>
                </form>
            </tr>
        @endforeach
    </table>
</div>
@endsection
