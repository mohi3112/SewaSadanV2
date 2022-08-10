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
                                    <h4 class="text-uppercase mt-0">Add New Stock Category</h4>
                                </div>

                                <form method="POST" action="{{route('add-category')}}">
                    @if(Session::has('success') )
                    <div class="alert-success"> {{Session::get('success')}}</div>
                    @endif
                    @if(Session::has('fail') )
                    <div class="alert-danger"> {{Session::get('fail')}}</div>
                    @endif
                    @csrf

                    <div class="mb-3">
                                    <lable for="Parent"> Parent Category</lable>
                                    <input type="hidden" name="CreatedBy" id="CreatedBy" value="{{ $x['UserName']}}">
                                    <input type="hidden" name="ParentCategory" id="ParentCategory">
                                    <select name="ParentId" id="ParentId"  class="form-control">
                                    <option selected="selected" value="0">None</option>
                                    @foreach($AllCat as $item)
                                    <option value="{{$item->id}}">{{$item->Category}}</option>
                                    @endforeach
                                    </select>
                                   </div>
                                   <div class="mb-3">
                                    <lable for="Parent"> Category Name</lable>
                                   
                                    <input  class="form-control" type="text" name="Category" id="Category">
                                    
                                   </div>
                                   <div class="mb-3">
                                    <lable for="Type"> Goods Type</lable>
                                    <select name="Type" id="Type"  class="form-control">
                                   
                                    <option value="">Select An Item</option>
                                    <option value="Assets">Assets</option>
                                    <option value="Consumables">Consumables</option>
                                   
                                    </select>
                                   </div>
                                    <div class="form-group" class="mb-3 text-center d-grid">
                                    <button class="btn btn-primary" type="submit">Add Category</button>  
                                    </div>
                                    

                                </form>

                            </div> <!-- end card-body -->
                        </div>
                        <!-- end card -->

                        <!-- end row -->

                    </div> <!-- end col -->




                    <div class="col-md-6 col-lg-6 col-xl-6">
                  


                    <div class="card">
                                    <div class="card-body">
                                        <h4 class="header-title mb-4">All Categories</h4>
        
                                        <ul class="nav nav-tabs">
                                            <li class="nav-item">
                                                <a href="#Assets" data-bs-toggle="tab" aria-expanded="false" class="nav-link active">
                                                    Assets
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a href="#Consumable" data-bs-toggle="tab" aria-expanded="true" class="nav-link">
                                                Consumable
                                                </a>
                                            </li>

                                        </ul>
                                        <div class="tab-content">
                                            <div class="tab-pane active" id="Assets">
                                                <table border="1" width="100%">
                                                    <thead>
                                                    <tr><th>Category ID</th><th>Category Name</th><th>Patent Category</th></tr>
                                                    </thead>
                                                    <tbody>
                                                    @foreach($Assets as $item)
                                                    <tr><td>{{$item->id}}</td><td>{{$item->Category}}</td><td>{{$item->ParentCategory}}</td></tr>
                                                    @endforeach
                                                    </tbody>
                                                </table>
                                        
                                        
                                            </div>
                                            <div class="tab-pane show" id="Consumable">
                                                <table border="1" width="100%">
                                                    <thead>
                                                    <tr><th>Category ID</th><th>Category Name</th><th>Patent Category</th></tr>
                                                    </thead>
                                                    <tbody>
                                                    @foreach($Consumable as $item)
                                                    <tr><td>{{$item->id}}</td><td>{{$item->Category}}</td><td>{{$item->ParentCategory}}</td></tr>
                                                    @endforeach
                                                    </tbody>
                                                </table>  
                                        
                                            </div>
                                            
                                        </div>
                                    </div>
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

@section('scripts')

<script>
   
    $(document).ready(function(){
//////////////////////Fetch Rooms By API Call////////////////////////////
$("#ParentId").change(function() {    var pid =$( "#ParentId option:selected").html();
$('#ParentCategory').val(pid);


});

});

</script>
<!--
<input type='button' value='Add' id='btnAddProfile'>
$("#btnAddProfile").attr('value', 'Save'); //versions older than 1.6

<input type='button' value='Add' id='btnAddProfile'>
$("#btnAddProfile").prop('value', 'Save'); //versions newer than 1.6
-->
@endsection