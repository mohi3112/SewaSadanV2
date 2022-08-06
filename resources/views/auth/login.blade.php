<!DOCTYPE html>
<html lang="en">
    <head>

        <meta charset="utf-8" />
<title>:: Sewa Sadan ::</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta content="sewa sadan in a charitable trust run by RamSharnam Ashram Gohana" name="description" />
<meta content="cwcindia" name="author" />
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<!-- App favicon -->
<link rel="shortcut icon" href="{{ asset('assets/images/favicon.ico')}}">

        <!-- App css -->
<link href="{{ asset('assets/css/config/default/bootstrap.min.css')}}" rel="stylesheet" type="text/css" id="bs-default-stylesheet" />
<link href="{{ asset('assets/css/config/default/app.min.css')}}" rel="stylesheet" type="text/css" id="app-default-stylesheet" />

<link href="{{ asset('assets/css/config/default/bootstrap-dark.min.css')}}" rel="stylesheet" type="text/css" id="bs-dark-stylesheet" disabled="disabled" />
<link href="{{ asset('assets/css/config/default/app-dark.min.css')}}" rel="stylesheet" type="text/css" id="app-dark-stylesheet" disabled="disabled" />

<!-- icons -->
<link href="{{ asset('assets/css/icons.min.css')}}" rel="stylesheet" type="text/css" />

    </head>
    <!-- body start -->
<body class="loading" data-layout='{"mode": "light", "width": "fluid", "menuPosition": "fixed", "sidebar": { "color": "light", "size": "default", "showuser": true}, "topbar": {"color": "light"}, "showRightSidebarOnPageLoad": true}'>

<!-- Begin page -->
<div id="wrapper">

<div class="account-pages my-5">
    <div class="container">

        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6 col-xl-4">
                <div class="text-center">   
                    <a href="index.html">
                        <img src="../assets/images/logo-dark.png" alt="" height="22" class="mx-auto">
                    </a>
                    <p class="text-muted mt-2 mb-4">Responsive Admin Dashboard</p>

                </div>
                <div class="card">
                    <div class="card-body p-4">
                        
                        <div class="text-center mb-4">
                            <h4 class="text-uppercase mt-0">Sign In</h4>
                        </div>

                        <form method="POST" action="{{route('user-login')}}">
                        @if(Session::has('success') )
                            <div class="alert-success"> {{Session::get('success')}}</div>
                            @endif
                            @if(Session::has('fail') )
                            <div class="alert-danger"> {{Session::get('fail')}}</div>
                            @endif
                        @csrf
                            <div class="mb-3">
                            <lable for="UserName"> User ID</lable>
                        <input type="text" name="UserName" class="form-control"  value="{{old('UserName')}}">
                        <span class="text-danger">@error('UserName') {{$message}}  @enderror</span>
                            </div>

                            <div class="mb-3">
                            <lable for="password">Password</lable>
                        <input type="text" name="password" class="form-control" >
                        <span class="text-danger">@error('password') {{$message}}  @enderror</span>
                             </div>

                            <div class="mb-3">
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" id="checkbox-signin" checked>
                                    <label class="form-check-label" for="checkbox-signin">Remember me</label>
                                </div>
                            </div>

                            <div class="mb-3 d-grid text-center">
                            <button class="btn btn-block btn-primary" type="submit">Login</button>  
                            </div>
                        </form>

                    </div> <!-- end card-body -->
                </div>
                <!-- end card -->

                <div class="row mt-3">
                    <div class="col-12 text-center">
                        <p> <a href="pages-recoverpw.html" class="text-muted ms-1"><i class="fa fa-lock me-1"></i>Forgot your password?</a></p>
                        <p class="text-muted">Don't have an account? <a href="pages-register.html" class="text-dark ms-1"><b>Sign Up</b></a></p>
                    </div> <!-- end col -->
                </div>
                <!-- end row -->

            </div> <!-- end col -->
        </div>
        <!-- end row -->
    </div>
    <!-- end container -->
</div>

<!-- end Footer -->

</div>
            <!-- ============================================================== -->
            <!-- End Page content -->
            <!-- ============================================================== -->


        </div>
        <!-- END wrapper -->

        <!-- Vendor js -->
        <script src="{{ asset('assets/js/vendor.min.js')}}"></script>

        <!-- knob plugin -->
        <script src="{{ asset('assets/libs/jquery-knob/jquery.knob.min.js')}}"></script>

        <!--Morris Chart-->
        <script src="{{ asset('assets/libs/morris.js06/morris.min.js')}}"></script>
        <script src="{{ asset('assets/libs/raphael/raphael.min.js')}}"></script>
  
        <!-- Dashboar init js-->
        <script src="{{ asset('assets/js/pages/dashboard.init.js')}}"></script>

        <!-- App js-->
        <script src="{{ asset('assets/js/app.min.js')}}"></script>
</body>
</html>
