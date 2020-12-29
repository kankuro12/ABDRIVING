@extends('layout')
@section('title','Students')
@section('css')
    <link rel="stylesheet" href="{{asset('assets/plugins/jquery-datatable/dataTables.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/nepali.datepicker.v3.2.min.css')}}">
@endsection
@section('toolbar')
    <a class="btn btn-primary" href="{{route('students.add')}}">
        Add Student
    </a>
    <hr>
@endsection
@section('content')

        <div class="p-3 mb-3 shadow">
            <form action="{{ route('student.by.custome.date') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-md-2">
                        <select name="year" id="year" class="form-control show-tick ms select2">
                        </select>
                    </div>
                    <div class="col-md-2">
                        <select name="month" id="month" class="form-control show-tick ms select2">
                        </select>
                    </div>

                    <div class="col-md-4">
                        <input type="submit" value="Load Student" class="btn btn-primary">
                    </div>
                </div>
            </form>
        </div>

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
<script src="{{asset('js/nepali.datepicker.v3.2.min.js')}}"></script>
<script src="{{asset('assets/bundles/datatablescripts.bundle.js')}}"></script>
<script src="{{asset('assets/plugins/jquery-datatable/buttons/dataTables.buttons.min.js')}}"></script>
<script src="{{asset('assets/plugins/jquery-datatable/buttons/buttons.bootstrap4.min.js')}}"></script>
<script>

var month = Array.from(NepaliFunctions.GetBsMonths());
    var i =1;
    month.forEach(element => {
        $('#month').append('<option value="'+i+'">'+element+'</option>');
        i++;
    });

    var start_y = 2070;
    var now_yr = NepaliFunctions.GetCurrentBsYear();
    var now_yr1 = now_yr;
    for (let index = start_y; index < now_yr; index++) {
        $('#year').append('<option value="'+now_yr1+'">'+now_yr1+'</option>');
        now_yr1--;
    }


    $(function () {
        $('#students').DataTable();
    });
</script>
@endsection


