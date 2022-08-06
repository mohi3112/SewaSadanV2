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
                                    <h4 class="text-uppercase mt-0">Create New Room</h4>
                                </div>

                                <form method="POST" action="{{route('create-room')}}">
                @if(Session::has('success') )
                    <div class="alert-success"> {{Session::get('success')}}</div>
                    @endif
                    @if(Session::has('fail') )
                    <div class="alert-danger"> {{Session::get('fail')}}</div>
                    @endif
                    @csrf

                                    <div class="mb-3">
                                    <lable for="RoomNo"> Room No</lable>
                                    <input type="number" name="RoomNo" class="form-control" value="{{old('RoomNo')}}">
                                    <span class="text-danger">@error('RoomNo') {{$message}}  @enderror</span>
                                    </div>
                                    <div class="mb-3">
                                    <lable for="RoomType"> Room Type</lable>
                                    <select name="RoomType"  class="form-control" >
                                        <option value="NonAcHall">Non A/C Hall</option>
                                        <option value="AcHall">A/C Hall</option>
                                        <option value="PrivateRoom">Private Room</option>
                                        <option value="ExtraBed">Extra Beds</option>
                                    </select>
                                     <span class="text-danger">@error('RoomType') {{$message}}  @enderror</span>
                                    </div>
                                      <div class="mb-3">
                                    <lable for="RoomRent">Room Rent</lable>
                                    <input type="number" name="RoomRent" class="form-control" value="{{old('RoomRent')}}">
                                    <span class="text-danger">@error('RoomRent') {{$message}}  @enderror</span>
                                    </div>
                                
                            
                                    <div class="form-group" class="mb-3 text-center d-grid">
                                    <button class="btn btn-primary" type="submit">Add Room</button>  
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
