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

                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead>
                            <tr>
                                <th>Guest Name</th>
                                <th>Slip No</th>
                                <th>Room/Bed</th>
                                <th>Arrival Date</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($pending as $row)
                        <tr><th>{{$row->GuestName}}</th><th>{{$row->SlipNo}}</th><th>{{$row->Room}}/{{$row->Bed}}</th><th>{{$row->created_at}}</th><th><a href="/issue-beddings/{{$row->SlipNo}}">Issue Beddings</a></th></tr>
                        @endforeach
                               
                            </tbody>
                        </table>
                    </div>
                </div> 
            </div>



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
<table width=80% border=1 align="center">
    <tr>
    <td>Slip NO:<input type="text" name="SlipNo" value="{{Session::get('FinYear')}}/"></td>
    <td><input type="text" name="GuestName"></td>
    <td rowspan="3"><img height="100px" width="auto" src="/assets/images/uploads/guests/0814202217493962f8e85bdde43.png" alt=""></td>
    </tr>
    <tr>
    <td>Father's Name</td>
    <td><input type="text" name="Room/Bed"></td>
    </tr>
</table>
  
    

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