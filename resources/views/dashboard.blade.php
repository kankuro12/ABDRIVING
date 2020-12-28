@extends('layout')
@section('title', 'Dashboard')
@section('css')
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
@endsection
@section('content')
    <div class="p-2 dashboard">
        <div class="row">
            <div class="col-md-3 p-0 section href" data-target="{{ route('courses') }}">
                <h2>

                    <i class="fas fa-th-list"></i>

                    <span>

                        Courses
                    </span>
                </h2>
            </div>
            <div class="col-md-3 p-0 section href" data-target="{{ route('slots') }}">
                <h2>

                    <i class="fas fa-clock"></i>

                    <span>

                        Time Slots
                    </span>
                </h2>
            </div>
            <div class="col-md-3 p-0 section href" data-target="{{ route('students') }}">
                <h2>

                    <i class="fas fa-users"></i>

                    <span>

                        Students
                    </span>
                </h2>
            </div>
            <div class="col-md-3 p-0 section href" data-target="{{ route('students.add') }}">
                <h2>

                    <i class="fas fa-user-plus"></i>

                    <span>

                        Add Student
                    </span>
                </h2>
            </div>
            <div class="col-md-3 p-0 section href" data-target="{{ route('attendances') }}">
                <h2>
                    <i class="fas fa-calendar-alt"></i>
                    <span style="font-size:24px;">
                        Attendance
                    </span>
                </h2>
            </div>
            @if (Auth::user()->role == 1)
            <div class="col-md-3 p-0 section href" data-target="{{ route('transaction.request') }}">
                <h2>
                    <i class="fas fa-users"></i>
                    <span>
                        Send Daily Request
                    </span>
                </h2>
            </div>
            @endif
            @if (Auth::user()->role == 0)
                <div class="col-md-3 p-0 section href" data-target="{{ route('users') }}">
                    <h2>
                        <i class="fas fa-user-shield"></i>
                        <span>
                            Users
                        </span>
                    </h2>
                </div>

                <div class="col-md-3 p-0 section href" data-target="{{ route('account.daily') }}">
                    <h2>
                        <i class="fas fa-users"></i>
                        <span>
                            Daily Account
                        </span>
                    </h2>
                </div>
                <div class="col-md-3 p-0 section href" data-target="{{ route('branch.request') }}">
                    <h2>
                        <i class="fas fa-users"></i>
                        <span>
                            Branch Daily Request
                        </span>
                    </h2>
                </div>
                <div class="col-md-3 p-0 section href" data-target="{{ route('all.accept.request') }}">
                    <h2>
                        <i class="fas fa-users"></i>
                        <span>
                            All Accepted Request
                        </span>
                    </h2>
                </div>
            @endif

            <div class="col-md-3 p-0 section href" data-target="{{ route('account.due') }}">
                <h2>
                    <i class="fas fa-coins"></i>
                    <span>
                        Due List
                    </span>
                </h2>
            </div>
        </div>

    </div>

    @include('search')

@endsection
@section('js')

@endsection
