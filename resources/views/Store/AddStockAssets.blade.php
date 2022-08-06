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
    <div class="col-md-6">

        <div class="mb-3">
            <lable for="Type"> Item Name:</lable>
            <input type="text" name="ItemName" class="form-control">   
        </div>

        <div class="mb-3">
            <lable for="Type"> Location Name:</lable>
            <select name="LocationId" id="LocationId"  class="form-control">                                    
            <option value="0">Select An Option</option>
            @foreach($location as $item)
            <option value="{{$item->id}}">{{$item->LocationName}}</option>
            @endforeach
            </select>
            <input type="hidden" name="LocationName" value="{{$item->LocationName}}" class="form-control">   
        </div>

        <div class="mb-3">
            <lable for="Type"> Vendor Name:</lable>
            <select name="VendorId" id="VendorId"  class="form-control">                                    
            <option value="0">Select An Option</option>
            @foreach($vendor as $item)
            <option value="{{$item->id}}">{{$item->VendorName}}</option>
            @endforeach
            </select>
            <input type="hidden" name="VendorName" value="{{$item->VendorName}}" class="form-control">   
        </div>
        <div class="mb-3">
            <lable for="Type"> Category:</lable>
            <select name="CategoryId" id="CategoryId"  class="form-control">                                    
            <option value="0">Select An Option</option>
            @foreach($allcat as $item)
            <option value="{{$item->id}}">{{$item->Category}}</option>
            @endforeach
            </select>
            <input type="hidden" name="CategoryName" value="{{$item->Category}}" class="form-control">   
        </div>

        <div class="mb-3">
            <lable for="Type"> Stock Type:</lable>
            <select name="StockType" id="StockType"  class="form-control">                                    
            <option>Select An Option</option>
            <option value="running" selected="selected">Running Stock</option>
            <option value="reserve">Reserve Stock</option>
            </select>
            
        </div>

        <div class="mb-3">
            <lable for="Type"> Assign To Room:</lable>
            <select name="AssignedTo" id="AssignedTo"  class="form-control">                                    
            </select>
            <input type="hidden" name="CreatedBy" id="CreatedBy" value="{{ $x['UserName']}}">
        </div>

    </div>


    <div class="col-md-6">

        <div class="mb-3">
            <lable for="Type"> Rate:</lable>
            <input type="text" name="Rate" class="form-control">   
        </div>

        <div class="mb-3">
            <lable for="Type"> Quantity:</lable>
            <input type="text" name="Quantity" class="form-control">  
        </div>

        <div class="mb-3">
            <lable for="Type"> Quality:</lable>
            <select name="Quality"  class="form-control">  
                <option value="0">Select Option</option>
                <option value="plain">Plain</option>
                <option value="strip">Strips</option>
                <option value="check">Check</option>
                <option value="printed">Printed</option>
                <option value="light-gift">Light-Gift</option>
                <option value="xl-winter">XL-Winter</option>
                <option value="new">New</option>
                <option value="light">Light</option>
                <option value="tv">TV Remote</option>
                <option value="ac">AC Remote</option>
                <option value="none">None</option>
            </select>
        </div>
        <div class="mb-3">
            <lable for="Type"> Color:</lable>
            <select name="Color"  class="form-control">  
                <option value="0">Select Option</option>
                <option value="red">Red</option>
                <option value="brown">Brown</option>
                <option value="green">Green</option>
                <option value="black">Black</option>
                <option value="white">White</option>
                <option value="blue">Blue</option>
                <option value="grey">Grey</option>
                <option value="mehndi">Mehndi</option>
                <option value="grey-black">Grey-Black</option>
                <option value="NA">N/A</option>

            </select> 
        </div>

        <div class="mb-3">
        <lable for="Type"> Measure:</lable>
            <select name="Measures"   class="form-control">  
                <option value="0">Select Option</option>
                <option value="grams">Grams</option>
                <option value="kg">Kilograms(kg)</option>
                <option value="pcs">Pieces(pcs)</option>
                <option value="ltr">Liters(ltr)</option>
                <option value="meter">Meters(M)</option>
                <option value="NA">N/A</option>
            </select>   
        </div>

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