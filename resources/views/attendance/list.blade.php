<!doctype html>
<html class="no-js " lang="en">

<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=Edge">
<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
<meta name="description" content="Responsive Bootstrap 4 and web Application ui kit.">
<meta name="csrf-token" content="{{ csrf_token() }}">

<title>@yield('title')</title>
<!-- Favicon-->
<link rel="icon" href="favicon.ico" type="image/x-icon">
<link rel="stylesheet" href="{{asset('assets/plugins/bootstrap/css/bootstrap.min.css')}}">
@yield('css')
<!-- Custom Css -->
<link rel="stylesheet" href="{{asset('assets/css/style.min.css')}}">
    {{-- @include('css') --}}
</head>

<body class="theme-blush">

<!-- Page Loader -->
<div class="page-loader-wrapper">
    <div class="loader">
        <div class="m-t-30"><img class="zmdi-hc-spin" src="{{asset('assets/images/loader.svg')}}" width="48" height="48" alt="Aero"></div>
        <p>Please wait...</p>
    </div>
</div>

<!-- Overlay For Sidebars -->
<div class="overlay"></div>

<div class="pt-3 pb-3">
    <form action="{{route('attendances.save')}}" method="POST">
        @csrf
        <input type="hidden" name="date" value="{{$d}}">
        <table class="w-100 table-bordered">
            <tr>
                <th>ID</th>
                <th>
                    Name
                </th>
                <th>
                    Present
                </th>
            </tr>

            @foreach ($at_arr as $at)
                <tr>
                    <td>
                        {{$at->student_id}}
                    </td>
                    <td>
                        {{$at->name}}
                    </td>
                    <td>
                        <input type="hidden" name="student_id[]" value="{{$at->student_id}}">
                        <input type="checkbox" name="attend_{{$at->student_id}}" id="" value="1" {{$at->attend==1?"checked":""}}>
                    </td>
                </tr>
            @endforeach
            <tr>
                <td></td>
                <td></td>
                <td>
                    <input type="submit" value="Save" class="btn btn-primary">
                </td>
            </tr>
        </table>
    </form>
</div>

<!-- Jquery Core Js --> 
<script src="{{asset('assets/bundles/libscripts.bundle.js')}}"></script> <!-- Lib Scripts Plugin Js --> 
<script src="{{asset('assets/bundles/vendorscripts.bundle.js')}}"></script> <!-- Lib Scripts Plugin Js --> 
<script>
    $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
</script>
@yield('js')
<script src="{{asset('assets/bundles/mainscripts.bundle.js')}}"></script>

</body>

</html>