<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>@yield('title') | {{config('app.name')}}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Responsive bootstrap 4 admin template" name="description" />
    <meta content="Coderthemes" name="author" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{asset('be_assets')}}/images/favicon.ico">
    <!-- App css -->

    <link href="{{asset('be_assets/css/toastr.css') }}" rel="stylesheet" type="text/css" id="app-stylesheet"/>
    <link href="{{asset('be_assets')}}/css/bootstrap.min.css" rel="stylesheet" type="text/css" id="bootstrap-stylesheet" />
    <link href="{{asset('be_assets')}}/css/icons.min.css" rel="stylesheet" type="text/css" />
    <link href="{{asset('be_assets')}}/css/app.min.css" rel="stylesheet" type="text/css" id="app-stylesheet" />

</head>

<body>
    <div style="background: linear-gradient(180deg, #00C2D3 0%, #0486DC 100%); height: 100vh;" >
        <div class="account-pages  pt-5" >
            <div class="container">
                <div class="row justify-content-center mt-5 py-5">
                    <div class="col-md-8 col-lg-6">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="mb-4 d-flex justify-content-center">
                                    @yield('title')
                                </h4>
    
                                @yield('content')
                            </div>
                            <!-- end card-body -->
                        </div>
                    </div>
                    <!-- end col -->
                </div>
                <!-- end row -->
            </div>
            <!-- end container -->
        </div>
    </div>

<!-- end page -->

<!-- Vendor js -->
<script src="{{asset('be_assets')}}/js/vendor.min.js"></script>

<!-- App js -->
<script src="{{asset('be_assets')}}/js/app.min.js"></script>

<script src="{{asset('be_assets/js/toastr.min.js') }}"></script>

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
        @if(session()->has('success'))
        toastr.success('{{session()->get("success")}}');
        @endif

        @if(session()->has('error'))
        toastr.error('{{session()->get("error")}}');
        @endif


    });
</script>

</body>

</html>
