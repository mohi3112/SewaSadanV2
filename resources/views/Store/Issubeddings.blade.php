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
            <div class="col-md-12 col-lg-12 col-xl-12">
            
                <div class="card">
                    <div class="body">
                      
<div style="padding:25px;">
<form method="post" action="{{route('add-new-asset')}}">
@if(Session::has('success') )
<div class="alert-success"> {{Session::get('success')}}</div>
@endif
@if(Session::has('fail') )
<div class="alert-danger"> {{Session::get('fail')}}</div>
@endif
@csrf
<div class="row">
    <div class="col-md-12">

  
    

        <div class="mb-3">
            <input type="submit" name="saveasset" id="saveasset" value="Create Asset">       
         </div>


    </div>

</div>

</div>

</form>
</div>
                    </div>
                </div>
            
            </div>
        </div>    
    </div>
</div>

       
</div>
@endsection
@section('scripts')

<script>
   
    $(document).ready(function(){
//////////////////////Fetch Rooms By API Call////////////////////////////
$.ajax({  type : "GET" , url : "/get-all-rooms?status=vacant&groupby=roomno" ,success:function(response){ console.log(response);
    $.each(response.VacantRooms, function(key,value){ $("#AssignedTo").append("<option value=" + value.RoomNo +"> Room No: "+value.RoomNo+"</option>");  });
}     });

});
</script>
@endsection