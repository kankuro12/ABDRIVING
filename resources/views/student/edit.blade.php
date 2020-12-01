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

<div class="mb-2 text-center">
    <img src="{{asset($std->image)}}" alt="" style="width: 150px;height:150px;border-radius:10px;">
</div>
<form action="{{route('students.show',['std'=>$std->id])}}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="row">
        <div class="col-md-9">
            <div class="form-group">
                <label for="Program">Program</label>
                <select name="Program" id="program" class="form-control" required>
                    @foreach (\App\Models\Course::all() as $course)
                            <option value="{{$course->name}}" {{$std->Program==$course->name?"selected":""}}>
                                {{$course->name}}
                            </option>
                        @endforeach
                </select>
                {{-- <input type="text" class="form-control" required placeholder="Name" name="name" required > --}}
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label for="shift">Shift</label>
                <select name="time" id="time" class="form-control">
                    @foreach (\App\Models\Slot::all() as $slot)
                            <option value="{{$slot->time}}" {{$std->time==$slot->time?"checked":""}}>
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
                <label for="name">Name</label>
                <input type="text" value="{{$std->name}}" class="form-control" required placeholder="Name" name="name" required >
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control"  placeholder="Email" name="email" value="{{$std->email}}">
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="phone">Phone </label>
                <input maxlength="10" minlength="8" type="text" class="form-control" required placeholder="Phone number" name="phone"  value="{{$std->phone}}">
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="caddress">Current Address </label>
                <input  type="text" class="form-control"  placeholder="Current Address" name="caddress" value="{{$std->caddress}}">
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="paddress">Permanent Address </label>
                <input  type="text" class="form-control" required placeholder="Permanent Address" name="paddress" value="{{$std->paddress}}">
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="fname">father's Name </label>
                <input  type="text" class="form-control"  placeholder="Father's Name" name="fname" value="{{$std->fname}}" >
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="mname">mother's Name </label>
                <input  type="text" class="form-control"  placeholder="Mother's Name" name="mname" value="{{$std->mname}}" >
            </div>
        </div>
       
        <div class="col-md-3">
            <div class="form-group">
                <label for="name">Blood Group</label>
                <select  class="form-control" required  name="bloodgroup">
                    @foreach ($bg as $b)
                        <option value="{{$b}}" {{$std->bloodgroup==$b?"selected":""}}>{{$b}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label for="gender">Gender</label>
                <select  class="form-control" required  name="gender">
                   <option value="male" {{$std->gender=="male"?"selected":""}}>Male</option>
                   <option value="female" {{$std->gender=="female"?"selected":""}}>Female</option>
                   <option value="others" {{$std->gender=="others"?"selected":""}}>Others</option>
                </select>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="dob">Date Of Birth</label>
                <input type="text" name="dob" class="form-control" required  id="dob" required value="{{$std->dob}}">
            </div>
        </div>
        <div class="col-md-2">
            <div class="form-group">
                <label for="age">Age</label>
                <input type="number" min="1" name="age" class="form-control" required name="age" id="age" placeholder="Age" required  value="{{$std->age}}">
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label for="citino">Citizenship No</label>
                <input type="text" name="citino" class="form-control" required  id="citino" placeholder="Citizenship No"  value="{{$std->citino}}">
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label for="education">Education</label>
                <input type="text" name="education" class="form-control" required  id="education" placeholder="Education"  value="{{$std->education}}">
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="ftype">Family Type</label>
                <select name="ftype" class="form-control" required  id="ftype">
                    <option value="single"  {{$std->ftype=="single"?"selected":""}}>Single</option>
                    <option value="union" {{$std->ftype=="union"?"selected":""}}>Union</option>
                </select>
            </div>
        </div>
        <div class="col-md-2">
            <div class="form-group">
                <label for="fmember">Members</label>
                <input type="number" min="1" name="fmember" class="form-control"   id="fmember" placeholder="Members" value="{{$std->fmember}}">
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label for="occupation">Occupation</label>
                <input type="text" name="occupation" class="form-control" placeholder="Occupation"  value="{{$std->occupation}}">
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label for="dealamount">Deal Amount</label>
                <input type="number" min="0" name="dealamount" class="form-control" placeholder="Deal Amount" required  value="{{$std->dealamount}}">
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="startfrom">Start Date</label>
                <input type="text" name="startfrom" placeholder="Start Date" id="startfrom" required class="form-control" value="{{$std->startfrom}}">
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="image">Photo</label>
                <input type="file"  name="image" class="form-control" accept="image/*" >
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group">
                <hr>
                <input type="submit" value="Update Student" class="btn btn-primary">
            </div>
        </div>
    </div>
    </form>