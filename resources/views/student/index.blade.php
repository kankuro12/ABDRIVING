@extends('layout')
@section('title','Students')
@section('css')
    <link rel="stylesheet" href="{{asset('assets/plugins/jquery-datatable/dataTables.bootstrap4.min.css')}}">
@endsection
@section('toolbar')
    <a class="btn btn-primary" href="{{route('students.add')}}">
        Add Student
    </a>
    <hr>
@endsection
@section('content')
    <div class="table-responsive">

        <table id="students"class="table table-bordered table-striped table-hover dataTable">
            <thead>
                <tr>
                    <th>
                        Image
                    </th>
                    <th>
                        Name
                    </th>
                    <th>
                        Phone
                    </th>
                    <th>
                        Program
                    </th>
                    <th>
                        Shift
                    </th>
                    <th>
                        balance
                    </th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($list as $std)
                    <tr>
                        <td>
                            <img src="{{asset($std->image)}}" style="max-width:150px;" alt="">
                        </td>
                        <td>
                            {{$std->name}}
                        </td>
                        <td>
                            {{$std->phone}}
                        </td>
                        <td>
                            {{$std->course->name}}
                        </td>
                        <td>
                            {{$std->slot->time}}
                        </td>
                        <td>
                            {{$std->balance}}
                        </td>
                        <td>
                            <a href="{{route('students.show',['std'=>$std->id])}}">Details</a>
                        </td>
                    </tr>
                    
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
@section('js')
<script src="{{asset('assets/bundles/datatablescripts.bundle.js')}}"></script>
<script src="{{asset('assets/plugins/jquery-datatable/buttons/dataTables.buttons.min.js')}}"></script>
<script src="{{asset('assets/plugins/jquery-datatable/buttons/buttons.bootstrap4.min.js')}}"></script>
<script>

   
    $(function () {
        $('#students').DataTable();
       


    });
</script>
@endsection