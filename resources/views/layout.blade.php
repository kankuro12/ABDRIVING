<!doctype html>
<html class="no-js " lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <meta name="description" content="Responsive Bootstrap 4 and web Application ui kit.">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>AB Driving Center - @yield('title')</title>
    <!-- Favicon-->
    <link rel="icon" href="favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="{{asset('assets/plugins/bootstrap/css/bootstrap.min.css')}}">
    @yield('css')
    <!-- Custom Css -->
    <link rel="stylesheet" href="{{asset('assets/css/style.min.css')}}">
    @include('css')
    <script src="https://kit.fontawesome.com/4ea06e897a.js" crossorigin="anonymous"></script>
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

<!-- Main Search -->
<div id="search">
    <button id="close" type="button" class="close btn btn-primary btn-icon btn-icon-mini btn-round">x</button>
    <form>
        <input type="search" value="" placeholder="Search..." />
        <button type="submit" class="btn btn-primary">Search</button>
    </form>
</div>


<!-- Left Sidebar -->
<aside id="leftsidebar" class="sidebar">
    <div class="navbar-brand">
        <button class="btn-menu ls-toggle-btn" type="button"><i class="zmdi zmdi-menu"></i></button>
        <a href="/"><img src="{{asset('assets/images/logo.svg')}}" width="25" alt="Aero"><span class="m-l-10">AB Driving Center</span></a>
    </div>
    <div class="menu">
        <ul class="list">
            <li>
                <div class="user-info">
                    <a class="image" href="#"><img src="https://cdn4.iconfinder.com/data/icons/basic-interface-overcolor/512/user-512.png" alt="User"></a>
                    <div class="detail">

                        <h5>{{Auth::user()->name}}</h5>
                        <small>{{Auth::user()->email}}</small>
                    </div>
                </div>
            </li>
            <li><a href="/"><i class="zmdi zmdi-home"></i><span>Dashboard</span></a></li>
            <li><a href="{{route('courses')}}"><i class="zmdi zmdi-view-list-alt"></i><span>Courses</span></a></li>
            <li><a href="{{route('slots')}}"><i class="zmdi zmdi-alarm"></i><span>Slots</span></a></li>

            <li> <a href="javascript:void(0);" class="menu-toggle"><i class="zmdi zmdi-assignment"></i><span>Student</span></a>
                <ul class="ml-menu">
                    <li><a href="{{route('students.add')}}">Add New</a></li>
                    <li><a href="{{route('students')}}">List</a></li>
                    <li><a href="{{route('attendances')}}">Attendance</a></li>
                </ul>
            </li>
            {{-- <li> <a href="javascript:void(0);" class="menu-toggle"><i class="zmdi zmdi-assignment"></i><span>Program</span></a>
                <ul class="ml-menu">
                    <li><a href="{{route('courses.add')}}">Add New</a></li>
                    <li><a href="{{route('courses')}}">List</a></li>

                </ul>
            </li> --}}
            {{-- <li><a href="{{ route('profile.show') }}"><i class="zmdi zmdi-home"></i><span>Dashboard</span></a></li> --}}
            <li><a href="#"><i class="zmdi zmdi-sign-in"></i><span>
                <form method="POST" action="{{ route('logout') }}" style="display:inline;">
                    @csrf
                    <input type="submit" value="logout" style="display:inline;background:transparent;border:none;">
                </form>
            </span></a></li>

        </ul>
    </div>
</aside>



<!-- Main Content -->
<section class="content">

    <div class="body_scroll">
        <div class="block-header">

            <div class="row">
                <div class="col-lg-7 col-md-6 col-sm-12">
                    <h2>@yield('title')</h2>
                    <button type="button" class="btn btn-default waves-effect m-r-20 href"  data-target="{{route('dashboard')}}">Dashboard</button>
                    <button type="button" class="btn btn-default waves-effect m-r-20" data-toggle="modal" data-target="#timesheet">Time Sheet</button>
                    <button type="button" class="btn btn-default waves-effect m-r-20" data-toggle="modal" data-target="#duelist">Due List</button>
                    <ul class="breadcrumb">
                        @yield('breadcrumb')
                    </ul>
                    <button class="btn btn-primary btn-icon mobile_menu" type="button"><i class="zmdi zmdi-sort-amount-desc"></i></button>
                </div>
                <div class="col-lg-5 col-md-6 col-sm-12">
                    <button class="btn btn-primary btn-icon float-right right_icon_toggle_btn" type="button"><i class="zmdi zmdi-arrow-right"></i></button>
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="row clearfix">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="header">
                            <h2>@yield('header')</h2>
                        </div>
                        <div class="body">
                            <div class="pt-2 pb-2">
                                @yield('toolbar')
                            </div>
                            <div class="pt-2 pb-2">
                                @if(session()->has('message'))
                                    <div class="alert alert-success">
                                        {{ session()->get('message') }}
                                    </div>
                                @endif

                                @if ($errors->any())
                                    @foreach ($errors->all() as $error)
                                        <div class="alert alert-danger">{{ $error }}</div>
                                    @endforeach
                                @endif
                            </div>
                            @yield('content')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@include('dashboard.timesheet')
@include('dashboard.duelist')

<!-- Jquery Core Js -->
<script src="{{asset('assets/bundles/libscripts.bundle.js')}}"></script> <!-- Lib Scripts Plugin Js -->
<script src="{{asset('assets/bundles/vendorscripts.bundle.js')}}"></script> <!-- Lib Scripts Plugin Js -->
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $('.href').click(function(){
        window.location.href=$(this).data('target');
    });
</script>
<script src="{{asset('assets\js\pages\ui\notifications.js')}}"></script>
<script src="{{asset('assets\plugins\bootstrap-notify\bootstrap-notify.js')}}"></script>
@yield('js')
<script src="{{asset('assets/bundles/mainscripts.bundle.js')}}"></script>

</body>

</html>
