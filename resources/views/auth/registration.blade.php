@extends('layouts.app')
@section('content')
<!-- ============================================================== -->
<!-- Start Page Content here -->
<!-- ============================================================== -->

<div class="content-page">
<div class="content">
<div class="container">


<div class="account-pages mt-5 mb-5">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-8 col-lg-8 col-xl-4">
                  
                        <div class="card">

                            <div class="card-body p-4">
                                
                                <div class="text-center mb-4">
                                    <h4 class="text-uppercase mt-0">Register</h4>
                                </div>

                                <form method="POST" action="{{route('register-user')}}">
                @if(Session::has('success') )
                    <div class="alert-success"> {{Session::get('success')}}</div>
                    @endif
                    @if(Session::has('fail') )
                    <div class="alert-danger"> {{Session::get('fail')}}</div>
                    @endif
                    @csrf

                                    <div class="mb-3">
                                    <lable for="name"> Full Name</lable>
                                    <input type="text" name="name" class="form-control" value="{{old('name')}}">
                                    <span class="text-danger">@error('name') {{$message}}  @enderror</span>
                                    </div>
                                    <div class="mb-3">
                                    <lable for="UserName"> UserID</lable>
                                    <input type="text" name="UserName" class="form-control" value="{{old('UserName')}}">
                                    <span class="text-danger">@error('UserName') {{$message}}  @enderror</span>
                                    </div>
                                      <div class="mb-3">
                                    <lable for="phone">Phone</lable>
                                    <input type="text" name="phone" class="form-control" value="{{old('phone')}}">
                                    <span class="text-danger">@error('phone') {{$message}}  @enderror</span>
                                    </div>
                                    <div class="mb-3">
                                    <lable for="password">Password</lable>
                                    <input type="text" name="password" class="form-control"  value="{{old('password')}}">
                                    <span class="text-danger">@error('password') {{$message}}  @enderror</span>
                                    </div>
                                    <div class="mb-3">
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input" id="checkbox-signup">
                                            <label class="form-check-label" for="checkbox-signup">I accept <a href="javascript: void(0);" class="text-dark">Terms and Conditions</a></label>
                                        </div>
                                    </div>
                                    <div class="form-group" class="mb-3 text-center d-grid">
                                    <button class="btn btn-primary" type="submit">Sign Up</button>  
                                    </div>
                                    

                                </form>

                            </div> <!-- end card-body -->
                        </div>
                        <!-- end card -->

                        <div class="row mt-3">
                            <div class="col-12 text-center">
                                <p class="text-muted">Already have account?  <a href="pages-login.html" class="text-dark ms-1"><b>Sign In</b></a></p>
                            </div> <!-- end col -->
                        </div>
                        <!-- end row -->

                    </div> <!-- end col -->
                </div>
                <!-- end row -->
            </div>
            <!-- end container -->
        </div>
       
</div>
</div>
</div>
@endsection
