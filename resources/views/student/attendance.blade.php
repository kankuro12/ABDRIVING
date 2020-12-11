@extends('layout')
@section('title', 'Attendance')

@section('content')
    <h3 class="font-weight-bold">
        <a href="{{ route('students') }}">Students</a> /{{ $std->name }} /Attendance
    </h3>

    <div>
        <table class="table">
            <tr>
                <th>
                    Date
                </th>
                <th>
                    Attendance
                </th>
            </tr>
            @foreach ($std->attendances as $att)
                <tr>
                    <th>
                        {{ $att->date }}
                    </th>
                    <th>
                        {{ $att->attend == 1 ? 'Present' : 'absent' }}
                    </th>
                </tr>
            @endforeach
        </table>
    </div>

@endsection
