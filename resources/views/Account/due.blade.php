@extends('layout')
@section('title','Due Accounts')
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
                    {{$student['dueamount']}}
                </td>
            </tr>
        @endforeach
    </table>
@endsection
