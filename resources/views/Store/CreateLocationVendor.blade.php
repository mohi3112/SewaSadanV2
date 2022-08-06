@extends('layouts.app')
@section('content')
<!-- ============================================================== -->
<!-- Start Page Content here -->
<!-- ============================================================== -->
<?php use App\Http\Controllers\CustomAuthController;
 $x=CustomAuthController::checkinfo();?>
<div class="content-page">
<div class="content">
<div class="container">


<div class="account-pages mt-5 mb-5">
            <div class="container">
                <div class="row">
                    <div class="col-md-6 col-lg-6 col-xl-6">
                  
                        <div class="card">

                            <div class="card-body p-4">
                                
                                <div class="text-center mb-4">
                                    <h4 class="text-uppercase mt-0">Create New Location</h4>
                                </div>

                                <form method="POST" action="{{route('add-location')}}">
                    @if(Session::has('successLocation') )
                    <div class="alert-success"> {{Session::get('successLocation')}}</div>
                    @endif
                    @if(Session::has('failLocation') )
                    <div class="alert-danger"> {{Session::get('failLocation')}}</div>
                    @endif
                    @csrf

                                    <div class="mb-3">
                                    <lable for="LocationName"> Location Name</lable>
                                    <input type="text" name="LocationName" class="form-control" value="{{old('LocationName')}}">
                                    <span class="text-danger">@error('LocationName') {{$message}}  @enderror</span>
                                    </div>
                                    <input type="hidden" name="CreatedBy" value="{{ $x['UserName']}}">
                                    <div class="form-group" class="mb-3 text-center d-grid">
                                    <button class="btn btn-primary" type="submit">Add Location</button>  
                                    </div>
                                    

                                </form>

                            </div> <!-- end card-body -->
                        </div>
                        <!-- end card -->

                        <!-- end row -->
                        <div id="" style="overflow:scroll; height:400px;">
                       <table border="1" width="100%">
                        <thead>
                        <tr><th>Location ID</th><th>Location</th><th>CreatedBy</th><th>CreatedAt</th></tr>
                        </thead>
                        <tbody>
                        @foreach($location as $item)
                        <tr><th>{{$item->id}}</th><th>{{$item->LocationName}}</th><th>{{$item->CreatedBy}}</th><th>{{$item->created_at}}</th></tr>
                        @endforeach
                        </tbody>
                       </table>

                        </div>
                    </div> <!-- end col -->




                    <div class="col-md-6 col-lg-6 col-xl-6">
                  
                        <div class="card">

                            <div class="card-body p-4">
                                
                                <div class="text-center mb-4">
                                    <h4 class="text-uppercase mt-0">Create New Vendor</h4>
                                </div>

                                <form method="POST" action="{{route('add-vendor')}}">
                    @if(Session::has('successVendor') )
                    <div class="alert-success"> {{Session::get('successVendor')}}</div>
                    @endif
                    @if(Session::has('failVendor') )
                    <div class="alert-danger"> {{Session::get('failVendor')}}</div>
                    @endif
                    @csrf

                                    <div class="mb-3">
                                    <lable for="VendorName"> Vendor Name</lable>
                                    <input type="text" name="VendorName" class="form-control" value="{{old('VendorName')}}">
                                    <span class="text-danger">@error('VendorName') {{$message}}  @enderror</span>
                                    </div>
                                    <input type="hidden" name="CreatedBy" value="{{ $x['UserName']}}">
                                    <div class="form-group" class="mb-3 text-center d-grid">
                                    <button class="btn btn-primary" type="submit">Add Vendor</button>  
                                    </div>
                                    

                                </form>

                            </div> <!-- end card-body -->
                        </div>
                        <!-- end card -->

                        <!-- end row -->
                        <div id="" style="overflow:scroll; height:400px;">
                       <table border="1" width="100%">
                        <thead>
                        <tr><th>Vendor ID</th><th>Vendor</th><th>CreatedBy</th><th>CreatedAt</th></tr>
                        </thead>
                        <tbody>
                        @foreach($vendor as $item)
                        <tr><th>{{$item->id}}</th><th>{{$item->VendorName}}</th><th>{{$item->CreatedBy}}</th><th>{{$item->created_at}}</th></tr>
                        @endforeach
                        </tbody>
                       </table>

                        </div>
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
