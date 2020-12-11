@extends('layout')
@section('title','Due Accounts')
@section('css')
<link rel="stylesheet" href="{{asset('assets/plugins/jquery-datatable/dataTables.bootstrap4.min.css')}}">

@endsection
@section('content')
    <h3>
        Due List
    </h3>
    <table id="DueList" class="table">
        <tr>
            <th>
                Name
            </th>
            <th>
                Phone
            </th>
            <th>
                Paid Amount
            </th>
            <th>
                Due Amount
            </th>
        </tr>
        @foreach ($arr as $student)
            <tr>
                <td>
                    {{$student['name']}}
                </td>
                <td>
                    {{$student['phone']}}
                </td>
                <td>
                    {{$student['amount']}}
                </td>
                <td>
                    {{$student['dueamount']}}
                </td>
            </tr>
        @endforeach
    </table>
@endsection
@section('js')
<script src="{{asset('assets/bundles/datatablescripts.bundle.js')}}"></script>
<script src="{{asset('assets/plugins/jquery-datatable/buttons/dataTables.buttons.min.js')}}"></script>
<script src="{{asset('assets/plugins/jquery-datatable/buttons/buttons.bootstrap4.min.js')}}"></script>
<script>


    $(function () {
        $('#DueList').DataTable();
    });
</script>
@endsection
