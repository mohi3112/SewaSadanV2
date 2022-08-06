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
                                    <h4 class="text-uppercase mt-0">Change Rent</h4>
                                </div>

                                <form method="POST" action="{{route('update-rent')}}">
                @if(Session::has('success') )
                    <div class="alert-success"> {{Session::get('success')}}</div>
                    @endif
                    @if(Session::has('fail') )
                    <div class="alert-danger"> {{Session::get('fail')}}</div>
                    @endif
                    @csrf

                                    <div class="mb-3">
                                    <lable for="Room"> Private Rooms</lable>
                                    <input type="number" name="Room" class="form-control" value="{{old('Room')}}">
                                    <span class="text-danger">@error('Room') {{$message}}  @enderror</span>
                                    </div>
                                    <div class="mb-3">
                                    <lable for="Extra"> Extra Beds</lable>
                                    <input type="number" name="Extra" class="form-control" value="{{old('Extra')}}">
                                    <span class="text-danger">@error('Extra') {{$message}}  @enderror</span>
                                    </div>
                                
                                    <div class="form-group" class="mb-3 text-center d-grid">
                                    <button class="btn btn-primary" type="submit">Change Rent</button>  
                                    </div>
                                    

                                </form>

                            </div> <!-- end card-body -->
                        </div>
                        <!-- end card -->

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
