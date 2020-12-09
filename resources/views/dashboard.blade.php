@extends('layout');
@section('title','Dashboard')
@section('css')
    <link rel="stylesheet" href="{{asset('css/dashboard.css')}}">
@endsection
@section('content')
<div class="p-2 dashboard">
    <div class="row">
        <div class="col-md-3 p-0 section href" data-target="{{route('students')}}">
                <h2>

                    <i class="fas fa-users"></i>
                   
                    <span>

                        Students
                    </span>
                </h2>
        </div>
        <div class="col-md-3 p-0 section href" data-target="{{route('students')}}">
            <h2>

                <i class="fas fa-users"></i>
               
                <span>

                    Students
                </span>
            </h2>
    </div>
        <div class="col-md-3 p-0 section href" data-target="{{route('attendances')}}" >
                <h2>
                    <i class="fas fa-calendar-alt"></i>
                    <span>
                        Attendance
                    </span>
                </h2>
        </div>
        @if(Auth::user()->role==0)
            <div class="col-md-3 p-0 section href" data-target="{{route('users')}}" >
                    <h2>
                        <i class="fas fa-user-shield"></i>
                        <span>
                            Users
                        </span>
                    </h2>
            </div>
        @endif
    </div>
</div>

@include('search')
@endsection
@section('js')
    
@endsection