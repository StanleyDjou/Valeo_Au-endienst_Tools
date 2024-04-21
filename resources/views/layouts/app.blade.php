<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8"/>
    <title>@yield('pageTitle', config('app.name'))</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="{{asset('be_assets')}}/images/valeo-small.png"
">

    <link href="{{asset('be_assets')}}/css/bootstrap.min.css" rel="stylesheet" type="text/css"
          id="bootstrap-stylesheet"/>
    <link href="{{asset('be_assets')}}/libs/select2/select2.min.css" rel="stylesheet" type="text/css"/>
    <link href="{{asset('be_assets')}}/css/icons.min.css" rel="stylesheet" type="text/css"/>
    <link href="{{asset('be_assets')}}/css/app.min.css" rel="stylesheet" type="text/css" id="app-stylesheet"/>
    <link href="{{asset('be_assets/css/toastr.css') }}" rel="stylesheet" type="text/css" id="app-stylesheet"/>
    <link href="{{asset('css/style.css')}}" rel="stylesheet">
    <link href="{{asset('css/custo.css')}}" rel="stylesheet">
    <link href="{{asset('be_assets')}}/css/style.css" rel="stylesheet" type="text/css"/>
    <link href="{{asset('assets')}}/css/dashboard.css" rel="stylesheet">
    <link href="{{asset('be_assets/css/toastr.css') }}" rel="stylesheet" type="text/css" id="app-stylesheet"/>
    @livewireStyles
    <style>
        .error {
            color: #ff0000;
            font-size: 12px;
        }

        .btn {
            padding: 0.25rem 0.5rem;
            font-size: .875rem;
            line-height: 1.5;
            border-radius: 0.2rem;
        }

        [x-cloak] {
            display: none !important;
        }

        .overlay, .cover {
            width: 100%;
            height: 100%;
            position: fixed;
            top: 0;
            left: 0;
            z-index: 100;
            background: black;
            opacity: 0.75;
        }

        .user-box .user-info {
            z-index: 10;
        }

        .modal {
            display: flex;
            align-items: center;
            justify-content: center;
            position: fixed;
            overflow-y: scroll;
            z-index: 1000;
            width: 100%;
            height: 100%;
        }

        .modal-header {
            border-bottom: none;
        }

        .modal-footer {
            border-top: none;
        }

        .modal-inner {
            background-color: white;
            border-top: 20px #797979 solid;
            border-radius: 0.5em;
            max-width: 1000px;
            width: 1000px;
            padding: 2em;
            margin: auto;
        }

        .modal-inner.short {
            max-width: 500px;
            width: 500px;
        }

        .btn.focus, .btn:focus {
            box-shadow: none;
        }

        .bg-orange-l{
            background-color: #FF9719;
        }

    </style>

</head>

<body>

    <div style="">
        <div id="" class="">

            <?php
            if (!auth()->user()->isAdmin() && \Auth::user()->clients()->count() > 0 && current_client() === null) {
                Session::put('current_client', \Auth::user()->clients()->first()->id);
            }else if(!auth()->user()->isAdmin() &&  \Auth::user()->institutions()->count() > 0 && current_institution() === null){
                Session::put('current_institution', \Auth::user()->institutions()->first()->id);
            }
            ?>
        

            <!-- Topbar Start -->
            <div class="navbar-custom bg-white">

                <ul class="list-unstyled topnav-menu  float-right mb-0">

                    <livewire:notifications/>
        
                    <li class="dropdown notification-list">
                        <a class="nav-link dropdown-toggle nav-user mr-0" data-toggle="dropdown" href="#" role="button"
                           aria-haspopup="false" aria-expanded="false">
                            <img src="{{isset(auth()->user()->profile) ? auth()->user()->profile_picture : asset('be_assets/images/users/avatar-1.jpg')}}" alt="user-image" class="rounded-circle">
                            <span class="pro-user-name ml-1">
                                            {{auth()->user()->name}}
                                    </span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right profile-dropdown ">
        
                            <a href="{{ route('logout') }}" class="dropdown-item notify-item ">
                                Logout
                            </a>
        
                        </div>
                    </li>
        
                </ul>
        
                <!-- LOGO -->
                <div class="logo-box">
                    <a href="{{route('admin.dashboard')}}" class="logo text-center logo-dark">
                                <span class="logo-lg">
        
                                    <img src="{{asset('be_assets')}}/images/valeo-logo.png" alt="" height="40">
                                    <!-- <span class="logo-lg-text-dark">Simple</span> -->
                                </span>
                        <span class="logo-sm">
                                    <!-- <span class="logo-lg-text-dark">S</span> -->
                                    <img src="{{asset('be_assets')}}/images/valeo-small.png" alt="" height="22">
        
                                </span>
                    </a>
        
                    <a href="{{route('admin.dashboard')}}" class="logo text-center logo-light">
                                <span class="logo-lg">
        
                                    <img src="{{asset('be_assets')}}/images/valeo-logo.png" alt="" height="60">
        
                                    <!-- <span class="logo-lg-text-light">Simple</span> -->
                                </span>
                        <span class="logo-sm">
                                    <!-- <span class="logo-lg-text-light">S</span> -->
                                    <img src="{{asset('be_assets')}}/images/valeo-small.png" alt="" height="22">
        
                                </span>
                    </a>
                </div>

                <ul class="list-unstyled topnav-menu  topnav-menu-left m-0">
                    <li>
                        <button class="button-menu-mobile ">
                            <i class="mdi mdi-menu"></i>
                        </button>
                    </li>

                </ul>
        
            </div>
            <!-- end Topbar --> <!-- ========== Left Sidebar Start ========== -->
            <div class="left-side-menu ">
        
                <div id="sidebar-menu">
        
                    <ul class="metismenu" id="side-menu">
                        <li>
                            <a href="{{route('admin.dashboard')}}">
                                <i class="fa fa-home"></i>
                                <span> Dashboard</span>
                            </a>
                        </li>

                        <li>
                            <a href="javascript: void(0);">
                                <i class="fa fa-industry"></i>
                                <span>Manage Trips</span>
                                <span class="menu-arrow"></span>
                            </a>
                            <ul class="nav-second-level" style="">
                                <li><a href="{{route('trip.index')}}"><i class=""></i>All Trips</a></li>
                                <li><a href="{{route('trip.index', ['trip_state' => 'planned'])}}"><i class=""></i>Planned Trips</a></li>
                                <li><a href="{{route('trip.index', ['trip_state' => 'ongoing'])}}"><i class=""></i>Ongoing Trips</a></li>
                                <li><a href="{{route('trip.index', ['trip_state' => 'passed'])}}"><i class=""></i>Past Trips</a></li>
                            </ul>
                        </li>
        
                        <li>
                            <a href="javascript: void(0);">
                                <i class="fa fa-users"></i>
                                <span>Manage Users</span>
                                <span class="menu-arrow"></span>
                            </a>
                            <ul class="nav-second-level " style="">
                                <li><a href="{{route('edit.user')}}"><i class=""></i>Add User</a></li>
                                <li><a href="{{route('index.user')}}"><i class=""></i>All Users</a></li>
                            </ul>
                        </li>


                        <li><a href="{{route('constant.index')}}"><i class="fa fa-question-circle"></i><span>Constants</span> </a></li>

                        <li>
                            <a href="javascript: void(0);">
                                <i class="fa fa-user"></i>
                                <span>Profile</span>
                                <span class="menu-arrow"></span>
                            </a>
                            <ul class="nav-second-level " style="">
                                <li><a href="{{route('change.password')}}"><i class=""></i>Change Password</a></li>
                                <li><a href="{{route('update.profile')}}"><i class=""></i>My Profile</a></li>
                            </ul>
                        </li>
        
                    </ul>
        
        
                </div>
                <!-- End Sidebar -->
        
                <div class="clearfix"></div>
        
        
            </div>
            <!-- Left Sidebar End -->
        
            <!-- ============================================================== -->
            <!-- Start Page Content here -->
            <!-- ============================================================== -->
        
            <div class="content-page" style="background-color: #f1f1f1 !important">
                <div class="content">
        
                    <!-- Start container-fluid -->
                    <div class="container-fluid" style="background-color: #f1f1f1 !important">
                        @yield('content')
                        {{$slot ?? ""}}
                    </div>
                    <!-- end container-fluid -->
        
        
                    <!-- Footer Start -->
                    <footer class="footer">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-md-12">
                                    2023 &copy; @yield('pageTitle', config('app.name'))
                                </div>
                            </div>
                        </div>
                    </footer>
                    <!-- end Footer -->
        
                </div>
                <!-- end content -->
        
            </div>
            <!-- END content-page -->
        
        </div>
    </div>

<!-- Begin page -->



<!-- END wrapper -->

<!-- Vendor js -->
<script src="{{asset('be_assets')}}/js/vendor.min.js"></script>
<script src="{{asset('be_assets')}}/js/app.min.js"></script>
<script src="{{asset('be_assets/js/toastr.min.js') }}"></script>
<script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
<script src="https://cdn.tiny.cloud/1/s8i05r191jbb0uet8083xhpvoabmrj813lvht3pb2uwajslv/tinymce/6/tinymce.min.js"
        referrerpolicy="origin"></script>

@livewireScripts

<script>
    $(function () { //ready

        toastr.options = {
            "closeButton": true,
            "debug": false,
            "newestOnTop": false,
            "progressBar": false,
            "positionClass": "toast-top-right",
            "preventDuplicates": false,
            "hideDuration": "1000",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
        };

        Livewire.on('success', message => {
            toastr.success(message);
        })

        @if(session()->has('success'))
        toastr.success('{{session()->get("success")}}');
        @endif

        @if(session()->has('error'))
        toastr.error('{{session()->get("error")}}');
        @endif

        Livewire.on('error', message => {
            toastr.error(message);
        });

        Livewire.on('refreshParent', event => {
            alert('the refreshParent event was fired');
        });
</script>

    });
</script>
@yield('script')

</body>

</html>
