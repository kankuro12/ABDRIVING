@extends('layout')
@section('title','Add Student')
@section('css')
    <link rel="stylesheet" href="{{asset('css/nepali.datepicker.v3.2.min.css')}}">
@endsection
@section('content')
@php
    $bg=[
                'A+',
                'B+',
                'O+',
                'AB+',
                'A-',
                'B-',
                'O-',
                'AB-'
            ];
@endphp

<h3 class="font-weight-bold">
    <a href="{{ route('students') }}">Students</a> / Add
</h3>
    <div>
        <form action="{{route('students.add')}}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-md-9">
                <div class="form-group">
                    <label for="Program">Program <span class="text-danger">*</span></label>
                    <select name="course_id" id="program" class="form-control" required>
                        @foreach (\App\Models\Course::all() as $course)
                            <option value="{{$course->id}}">
                                {{$course->name}}
                            </option>
                        @endforeach

                    </select>
                    {{-- <input type="text" class="form-control" required placeholder="Name" name="name" required > --}}
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label for="shift">Shift <span class="text-danger">*</span></label>
                    <select name="slot_id" id="time" class="form-control">
                        @foreach (\App\Models\Slot::all() as $slot)
                            <option value="{{$slot->id}}">
                                {{$slot->time}}
                            </option>
                        @endforeach

                    </select>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="name">Name <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" required placeholder="Name" name="name" required >
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control"  placeholder="Email" name="email" >
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="phone">Phone <span class="text-danger">*</span></label>
                    <input maxlength="10" minlength="8" type="text" class="form-control" required placeholder="Phone number" name="phone" >
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="caddress">Current Address <span class="text-danger">*</span></label>
                    <input  type="text" class="form-control"  placeholder="Current Address" name="caddress" required>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="paddress">Permanent Address <span class="text-danger">*</span></label>
                    <input  type="text" class="form-control" required placeholder="Permanent Address" name="paddress" >
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="fname">father's Name </label>
                    <input  type="text" class="form-control"  placeholder="Father's Name" name="fname" >
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="mname">mother's Name </label>
                    <input  type="text" class="form-control"  placeholder="Mother's Name" name="mname" >
                </div>
            </div>

            <div class="col-md-3">
                <div class="form-group">
                    <label for="name">Blood Group</label>
                    <select  class="form-control"  name="bloodgroup">
                        @foreach ($bg as $b)
                            <option value="{{$b}}">{{$b}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label for="gender">Gender <span class="text-danger">*</span></label>
                    <select  class="form-control" required  name="gender">
                       <option value="male">Male</option>
                       <option value="female">Female</option>
                       <option value="others">Others</option>
                    </select>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="dob">Date Of Birth</label>
                    <input type="text" name="dob" class="form-control"  id="dob">
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <label for="age">Age</label>
                    <input type="number" min="1" name="age" class="form-control" name="age" id="age" placeholder="Age" >
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label for="citino">Citizenship No</label>
                    <input type="text" name="citino" class="form-control"  id="citino" placeholder="Citizenship No">
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label for="education">Education</label>
                    <input type="text" name="education" class="form-control"  id="education" placeholder="Education">
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="ftype">Family Type</label>
                    <select name="ftype" class="form-control"  id="ftype">
                        <option value="single">Single</option>
                        <option value="union">Union</option>
                    </select>
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <label for="fmember">Members</label>
                    <input type="number" min="1" name="fmember" class="form-control"  name="fmember" id="fmember" placeholder="Members">
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label for="occupation">Occupation</label>
                    <input type="text" name="occupation" class="form-control" placeholder="Occupation">
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label for="dealamount">Deal Amount <span class="text-danger">*</span></label>
                    <input type="number" min="0" name="dealamount" class="form-control" placeholder="Deal Amount" required>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="startfrom">Start Date <span class="text-danger">*</span></label>
                    <input type="text" name="startfrom" placeholder="Start Date" id="startfrom" required class="form-control">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="image">Photo</label>
                    <input type="file" name="image" class="form-control" accept="image/*" >
                </div>
            </div>
            <div class="col-md-12">
                <hr>
                <h3 style="font-weight: 800;margin-bottom:5px;">
                    First Payment
                </h3>
                <div class="row">
                    <div class="col-md-2">
                        <label >Bill No <span class="text-danger">*</span></label>
                        <input type="text" name="billno" id="billno" class="form-control" placeholder="Bill No" required>
                    </div>
                    <div class="col-md-2">
                        <label for="">Amount <span class="text-danger">*</span></label>
                        <input type="number" name="amount" id="amount" min="1" required class="form-control" placeholder="Amount" required>
                    </div>
                    <div class="col-md-2">
                        <label for="">Date <span class="text-danger">*</span></label>
                        <input type="text" name="date" id="p-date"  required class="form-control" placeholder="Payment Date" required>
                    </div>
                    <div class="col-md-6">
                        <label for="">Next Payment After <span class="text-danger">*</span></label>
                        <input type="number" name="nextpayment" id="nextpayment"  required class="form-control" placeholder="Next Payment Days After" required>
                    </div>

                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <hr>
                    <input type="submit" value="Add Student" class="btn btn-primary">
                </div>
            </div>
        </div>
        </form>
    </div>
@endsection
@section('js')
    <script src="{{asset('js/nepali.datepicker.v3.2.min.js')}}"></script>
    <script type="text/javascript">
        window.onload = function() {
            var mainInput = document.getElementById("dob");

            mainInput.nepaliDatePicker({
                ndpYear: true,
                ndpMonth: true,
            });

            var mainInput1 = document.getElementById("startfrom");

            mainInput1.nepaliDatePicker({
                ndpYear: true,
                ndpMonth: true,
            });
            date=document.getElementById('p-date');
            date.nepaliDatePicker({
                ndpYear: true,
                ndpMonth: true,
            });
            $('#dob').on("input",function(){

            });
        };
    </script>
@endsection
