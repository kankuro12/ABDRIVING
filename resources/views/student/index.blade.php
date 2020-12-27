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

      <!-- Nav tabs -->
      <ul class="nav nav-tabs p-0 mb-3 nav-tabs-success" role="tablist">
        <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#incomplete"> Current Students </a></li>
        <li class="nav-item"><a class="nav-link " data-toggle="tab" href="#complete"> Passed Out Students </a></li>

    </ul>
    <div class="tab-content">
        <div role="tabpanel" class="tab-pane in active" id="incomplete">
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
                                    <a href="{{route('students.show',['std'=>$std->id])}}" target="_blank">Details</a>
                                    |
                                    <a href="{{route('students.attendance',['std'=>$std->id])}}"  target="_blank">Attendance</a>
                                    |
                                    <div class="text-center">
                                        <a href="{{route('students.passout',['std'=>$std->id])}}" target="_blank">Mark As Passout</a>
                                    </div>
                                </td>
                            </tr>

                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div role="tabpanel" class="tab-pane " id="complete">
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
                        @foreach ($old as $std)
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
                                    |
                                    <a href="{{route('students.attendance',['std'=>$std->id])}}">Attendance</a>
                                    |
                                    <a href="{{route('students.passout.cancel',['std'=>$std->id])}}">Passout Cancel</a>


                                </td>
                            </tr>

                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
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
