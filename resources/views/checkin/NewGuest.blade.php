@extends('layouts.app')
@section('content')
<!-- ============================================================== -->
<!-- Start Page Content here -->
<!-- ============================================================== -->
@include('sweetalert::alert')

<?php use App\Http\Controllers\CustomAuthController;?>
<?php $x=CustomAuthController::checkinfo(); ?>

<div class="content-page">
<div class="content">
<div class="container">
<div class="block-header"><div class="row"><div class="col-lg-7 col-md-6 col-sm-12"><h2>Room Check-In</h2></div></div></div>

<div class="account-pages mt-5 mb-5">
            <div class="container">
                <div class="row ">
                    <div class="col-md-6 col-lg-6 col-xl-6">
                        
                        <form method="POST" action="{{route('create-guest')}}" enctype="multipart/form-data">
                    @if(Session::has('success') )
                    <div class="alert-success"> {{Session::get('success')}}</div>
                    @endif
                    @if(Session::has('fail') )
                    <div class="alert-danger"> {{Session::get('fail')}}</div>
                    @endif
                    @csrf

                                    <div class="mb-3">
                                    <lable for="guestname"> Attendant Name:</lable>
                                    <input type="text" name="guestname" class="form-control" <?php if(isset($currentguest)) {  echo "readonly=readonly";} ?> value="<?php if(isset($currentguest)) { echo $currentguest['Name'];} else { ?>{{  old('guestname') }} <?php } ?> ">
                                    <span class="text-danger">@error('guestname') {{$message}}  @enderror</span>
                                    </div>
                                    <div class="mb-3">
                                    <lable for="fnwo">  Father/Husband Name:</lable>
                                    <input type="text" name="fnwo" class="form-control" <?php if(isset($currentguest)) {  echo "readonly=readonly";} ?> value="<?php if(isset($currentguest)) { echo $currentguest['FatherName'];} else { ?>{{  old('fnwo') }} <?php } ?>">
                                    <span class="text-danger">@error('fnwo') {{$message}}  @enderror</span>
                                    </div>
                                    <div class="mb-3">
                                    <lable for="mobile"> Mobile:</lable>
                                    <input type="text" maxlength="10" name="mobile" class="form-control" <?php if(isset($currentguest)) {  echo "readonly=readonly";} ?> value="<?php if(isset($currentguest)) { echo $currentguest['Mobile'];} else { ?>{{  old('mobile') }} <?php } ?>">
                                    <span class="text-danger">@error('mobile') {{$message}}  @enderror</span>
                                    </div>
                                    <div class="mb-3">
                                    <lable for="address"> Address:</lable>
                                    <input type="text" name="address" class="form-control" <?php if(isset($currentguest)) {  echo "readonly=readonly";} ?> value="<?php if(isset($currentguest)) { echo $currentguest['Address'];} else { ?>{{  old('address') }} <?php } ?>">
                                    <span class="text-danger">@error('address') {{$message}}  @enderror</span>
                                    </div> 
                                    <!-- @if(Session::has('SecondSsid') )
                                    
                                    
                                    <div class="toast fade d-flex align-items-center text-white bg-primary border-0 mt-4 hide" role="alert" aria-live="assertive" aria-atomic="true">
                                            <div class="toast-body">
                                                Second Person Saved!
                                                <br>Page Is Refreshed Please Select ID Type Again.
                                            </div>
                                            <button type="button" class="btn-close btn-close-white ms-auto me-2" data-bs-dismiss="toast" aria-label="Close"></button>
                                        </div>
                                    @endif -->
                                    <?php if(isset($idvault)) { ?>
                                    <div class="row mb-3">             
                                    <div class="col-md-8">
                                    <lable for="IDProof"> ID Proof:</lable>
                                    <select name="IDProof" id="IDProof"  class="form-control" >
                                    <option value="NotSelected" selected="selected">Select An ID Type</option>
                                       <?php if(isset($idvault)){ ?>
                                        <?php if($idvault['DrivingLicence']!="") { ?><option value="{{$idvault['DrivingLicence']}}">Driving Licence => {{$idvault['DrivingLicence']}}</option><?php } ?>
                                        <?php if($idvault['AadharCard']!="") { ?><option value=" {{$idvault['AadharCard']}}">Aadhar Card => {{$idvault['AadharCard']}}</option><?php } ?>
                                        <?php if($idvault['VoterCard']!="") { ?><option value="{{$idvault['VoterCard']}}">Voter Card => {{$idvault['VoterCard']}}</option><?php } ?>
                                        <?php if($idvault['RationCard']!="") { ?><option value="{{$idvault['RationCard']}}">Ration Card => {{$idvault['RationCard']}}</option><?php } ?>
                                        <?php if($idvault['Passport']!="") { ?><option value="{{$idvault['Passport']}}">Passport => {{$idvault['Passport']}}</option><?php } ?>
                                        <?php if($idvault['GovtID']!="") { ?><option value="{{$idvault['GovtID']}}">GovtID => {{$idvault['GovtID']}}</option><?php } ?>
                                        <?php if($idvault['Others']!="") { ?><option value="{{$idvault['Others']}}">Others => {{$idvault['Others']}}</option><?php } ?>
                                                            <?php } ?>
                                    </select>
                                  <span class="text-danger">@error('address') {{$message}}  @enderror</span>
                                    </div>
                                    <div class="col-md-4"><lable for="editbutton">ID Vault:</lable>
                                    <button type="button" value="<?php if(isset($idvault)){ echo $idvault['SSID'];}?>" class="btn btn-success editbtns" id="edtbtn">ADD/EDIT IDs</button>
                                             </div>
                                    </div>

                                        <?php } ?>

                                      <div class="mb-3">
                                    
                                    
                                    <?php if(isset($currentguest['Photo'])) 
                                    {
                                        ?> <img src="#" height="100px" width="auto"> <?php 
                                    } 
                                    else
                                    { ?>
<lable for="photo">Photo: </lable>
                                    <input type="file" name="photo" class="form-control"  placeholder="Choose image" id="photo">
                                    <?php }

                                       ?><span class="text-danger">@error('photo') {{$message}}  @enderror</span>
                                    </div>

                                    <div class="form-group" class="mb-3 text-center d-grid">
                                    <button class="btn btn-primary" type="submit">Add Guest</button>  
                                    <?php if(isset($currentguest['Photo'])) 
                                    { 
                                        echo "<button type='button' value='createsec' class='btn btn-success createsec' id='createsec'>ADD Second Person</button>";
                                    } ?>
                                    </div>

                                    
                                </form>

                        



                        <!-- end row -->

                    </div> <!-- end col -->

                    <div class="col-md-6 col-lg-6 col-xl-6">

                    <form method="POST" action="{{route('visit-entry')}}" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                <lable for="RoomNo"> Room No:</lable>
                <select name="RoomNo" id="RoomNo"  class="form-control">
                    <option value="0">Select Your Room</option>
                </select>
                <span class="text-danger">@error('patientname') {{$message}}  @enderror</span>
                </div>                
                <div class="mb-3">
                <lable for="BedNo"> Bed No:</lable>
                <select name="BedNo" id="BedNo"  class="form-control">
                <option value="0">Select Your Bed</option>
                </select>
                <span class="text-danger">@error('patientname') {{$message}}  @enderror</span>
                </div>               
                
                <div class="mb-3">
                <lable for="guestname"> Patient Name:</lable>
                <input type="text" name="patientname" class="form-control">
                <span class="text-danger">@error('patientname') {{$message}}  @enderror</span>
                </div>
                <div class="mb-3">
                <lable for="mrdno">MRD NO:</lable>
                <input type="text" name="mrdno" class="form-control">
                <span class="text-danger">@error('mrdno') {{$message}}  @enderror</span>
                </div>
                <div class="mb-3">
                <lable for="patientadmitdate"> Patient Admit Date:</lable>
                <input type="date" name="patientadmitdate" class="form-control" data-date-format="dd/mm/yy">
                <span class="text-danger">@error('patientadmitdate') {{$message}}  @enderror</span>
                </div>
                <div class="row">
                <div class="col-md-6">
                <lable for="RoomRent"> Room Rent:</lable>
                <input type="text" name="RoomRent" id="RoomRent" class="form-control">
                <span class="text-danger">@error('RoomRent') {{$message}}  @enderror</span>
                </div>
                <div class="col-md-6 mb-3">
                <lable for="Security"> Security:</lable>
                <input type="text" name="Security" id="Security" class="form-control">
                <span class="text-danger">@error('Security') {{$message}}  @enderror</span>
                </div>
                <!-- Other Inputs -->
                <input type="text" name="GuestName" id="GuestName" value="<?php if(isset($currentguest)) { echo $currentguest['Name'];}else{?> {{  old('GuestName') }} <?php } ?> "class="form-control">
                <input type="text" name="FatherName" id="FatherName" class="form-control" value="<?php if(isset($currentguest)) { echo $currentguest['FatherName'];}else{?> {{  old('FatherName') }} <?php } ?> ">
                <input type="text" name="SSID" id="SSID" class="form-control" value="<?php if(isset($currentguest)) { echo $currentguest['SSID'];}else{?> {{  old('SSID') }} <?php } ?>  ">
                <input type="text" name="RoomType" id="RoomType" class="form-control" value="{{  old('RoomType') }}" >
                <input type="text" name="CreatedBy" id="CreatedBy" value="{{ $x['UserName']}}" class="form-control" >
                <input type="text" name="IDNumber" id="IDNumber" class="form-control" value="{{  old('IDNumber') }}">
                <input type="text" name="Mobile" id="Mobile" value="<?php if(isset($currentguest)) { echo $currentguest['Mobile'];}else{?> {{  old('Mobile') }} <?php } ?>" class="form-control" >
                </div>
               
                <div class="row mb-3">
                    <label for="inputPassword3" class="col-3 col-xl-3 col-form-label"> <center>Second Person:</center> </label>
                    <div class="col-3 col-md-3">
                    <input type="text" name="SecSSID" id="SecSSID" value="{{Session::get('SecondSsid')}}" class="form-control">
                     </div>
                     <div class="col-6 col-md-6">
                    <button type="submit" id="checkinbutton" class="btn btn-primary" ></button> </div>
                </div>
 

                    </form>
                    </div>

                </div>
                <!-- end row -->
            </div>
            <!-- end container -->
        </div>
     
        


<!--  Modal Starts -->
<div id="EditModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title">ADD Or Update IDs For <?php if(isset($idvault)) { ?>{{$idvault['Name']}} <?php } ?></h4>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                <div class="row">
                     <div class="col-md-12 col-lg-12 col-xl-12">
                        <form method="POST" action="{{route('updateidv')}}" enctype="multipart/form-data">
                    @if(Session::has('success') )
                    <div class="alert-success"> {{Session::get('success')}}</div>
                    @endif
                    @if(Session::has('fail') )
                    <div class="alert-danger"> {{Session::get('fail')}}</div>
                    @endif
                    @csrf
                    <div class="col-md-12">
                    <lable for="DrivingLicence"> Driving Licence:</lable>
                    
                    <input type="hidden" id="editssid" name="ssid" class="form-control" value="<?php if(isset($idvault)) { echo $idvault['SSID']; } ?>">
                    <input type="text" id="editlicence" name="DrivingLicence" class="form-control" value="<?php if(isset($idvault)) { echo $idvault['DrivingLicence']; } ?>">
                    <span class="text-danger">@error('DrivingLicence') {{$message}}  @enderror</span>
                    </div>

                    <div class="col-md-12">
                    <lable for="AadharCard"> Aadhar Card:</lable>
                    <input type="text"  id="editaadhar" name="AadharCard" class="form-control" value="<?php if(isset($idvault)) { echo $idvault['AadharCard']; } ?>">
                    <span class="text-danger">@error('AadharCard') {{$message}}  @enderror</span>
                    </div>

                    <div class="col-md-12">
                    <lable for="VoterCard"> Voter Card:</lable>
                    <input type="text"  id="editvoter" name="VoterCard" class="form-control" value="<?php if(isset($idvault)) { echo $idvault['VoterCard']; } ?>">
                    <span class="text-danger">@error('VoterCard') {{$message}}  @enderror</span>
                    </div>

                    <div class="col-md-12">
                    <lable for="RationCard"> Ration Card:</lable>
                    <input type="text" id="editration" name="RationCard" class="form-control" value="<?php if(isset($idvault)) { echo $idvault['RationCard']; } ?>">
                    <span class="text-danger">@error('RationCard') {{$message}}  @enderror</span>
                    </div>

                    <div class="col-md-12">
                    <lable for="Passport"> Passport:</lable>
                    <input type="text" id="editpassport" name="Passport" class="form-control" value="<?php if(isset($idvault)) { echo $idvault['Passport']; } ?>">
                    <span class="text-danger">@error('Passport') {{$message}}  @enderror</span>
                    </div>

                    <div class="col-md-12">
                    <lable for="GovtID"> GovtID:</lable>
                    <input type="text" id="editgovtid" name="GovtID" class="form-control" value="<?php if(isset($idvault)) { echo $idvault['GovtID']; } ?>">
                    <span class="text-danger">@error('GovtID') {{$message}}  @enderror</span>
                    </div>
                    <div class="col-md-12">
                    <lable for="Others">Others:</lable>
                    <input type="text" id="editothers" name="Others" class="form-control" value="<?php if(isset($idvault)) { echo $idvault['Others']; } ?>">
                    <span class="text-danger">@error('Others') {{$message}}  @enderror</span>
                    </div>


                    </div>
                    </div>
                   
                    </div>
                                                     
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary waves-effect" data-bs-dismiss="modal">Close</button>
                                                        <button class="btn btn-info waves-effect waves-light" type="submit">Save Details</button>
                                                       
                                                    </div> </form>
                                                </div>
                                            </div>
                                        </div><!-- /.modal -->

                                        <div class="button-list">
                                            <!-- Responsive modal -->
                                           </div>

                                    

<!--  Modal Ends -->

<!-- Add 2nd person Modal Starts -->
<div id="second" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="secondpersonlable" aria-hidden="true" style="display: none;">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title">Add Second Person With <?php if(isset($idvault)) { ?>{{$idvault['Name']}} <?php } ?></h4>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                <div class="row">
                     <div class="col-md-12 col-lg-12 col-xl-12">
                        <form method="POST" action="{{route('create-sec-guest')}}" enctype="multipart/form-data">
                    @if(Session::has('success') )
                    <div class="alert-success"> {{Session::get('success')}}</div>
                    @endif
                    @if(Session::has('fail') )
                    <div class="alert-danger"> {{Session::get('fail')}}</div>
                    @endif
                    @csrf
                    <div class="mb-3">
                    <lable for="guestname"> Attendant Name:</lable>
                    <input type="text" name="secondguestname" class="form-control" >
                    <span class="text-danger">@error('secondguestname') {{$message}}  @enderror</span>
                    </div>
                    <div class="mb-3">
                    <lable for="fnwo">  Father/Husband Name:</lable>
                    <input type="text" name="secondfnwo" class="form-control" >
                    <span class="text-danger">@error('secondfnwo') {{$message}}  @enderror</span>
                    </div>
                    <div class="mb-3">
                    <lable for="mobile"> Mobile:</lable>
                    <input type="text" maxlength="10"  name="secondmobile" class="form-control">
                    <span class="text-danger">@error('secondmobile') {{$message}}  @enderror</span>
                    </div>
                    <div class="mb-3">
                    <lable for="address"> Address:</lable>
                    <input type="text" name="secondaddress" class="form-control" >
                    <span class="text-danger">@error('secondaddress') {{$message}}  @enderror</span>
                    </div> 

                        <div class="mb-3">
                    <lable for="photo">Photo: </lable>
                    <input type="file" name="secondphoto" class="form-control"  placeholder="Choose image" id="photo">
                    <span class="text-danger">@error('secondphoto') {{$message}}  @enderror</span>
                    </div>

                    </div>
                    </div>
                   
                    </div>
                                                     
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary waves-effect" data-bs-dismiss="modal">Close</button>
                                                        <button class="btn btn-info waves-effect waves-light" type="submit">Save Details</button>
                                                       
                                                    </div> </form>
                                                </div>
                                            </div>
                                        </div><!-- /.modal -->

                                        <div class="button-list">
                                            <!-- Responsive modal -->
                                           </div>

                                    

<!--  Modal Ends -->






</div>
</div>
</div>
@endsection

@section('scripts')

<script>
   
    $(document).ready(function(){
//////////////////////Fetch Rooms By API Call////////////////////////////
$.ajax({  type : "GET" , url : "/get-all-rooms?status=vacant&groupby=roomno" ,success:function(response){ console.log(response);
    $.each(response.VacantRooms, function(key,value){ $("#RoomNo").append("<option value=" + value.RoomNo +">"+value.RoomNo+"    =>   "+value.RoomType+"</option>");  });
}     })
/////////////////Rooms Fetch Done//////////////////////////////////////
/////////////////////Fetch Beds By API Call///////////////////////////
$("#RoomNo").change(function() {    var sroom =$( "#RoomNo :selected").val();  

$.ajax({  type : "GET" , url : "/get-all-rooms?status=vacant&roomno="+sroom ,success:function(response){ console.log(response);
$("#BedNo").empty();
$.each(response.VacantRooms, function(key,value){ $("#BedNo").append("<option value=" + value.BedNo +">"+value.BedNo+"</option>");  });
}     })

});

$("#IDProof").change(function() {    var selectedID =$( "#IDProof :selected").val();  
    $('#IDNumber').val(selectedID);
});

///////////////////////Beds Fetched//////////////////////////////////
/////////////////////Fetch Beds Rent By API Call///////////////////////////
$("#BedNo").change(function() {    var sroom =$( "#RoomNo :selected").val(); var sbed = $("#BedNo :selected").val();  
$.ajax({  type : "GET" , url : "/get-all-rooms?status=vacant&roomno="+sroom+"&bedno="+sbed ,success:function(response){ console.log(response);
    $('#RoomRent').val(response.VacantRooms[0].RoomRent);
    var totsec=response.VacantRooms[0].RoomRent*response.preferences[0].values;
    var rtype =response.VacantRooms[0].RoomType;
    $('#Security').val(totsec);$('#RoomType').val(rtype);
    var subbtntext="Checkin For : "+sroom+"/"+sbed;
    $("#checkinbutton").html(subbtntext);
}     })

});
///////////////////////Beds Fetched//////////////////////////////////

/////////////////////Fill Popup Form With User Info/////////////////////
    $("#edtbtn").click(function() {  $('#EditModal').modal('show');  });
    var sid =$( "#edtbtn" ).val();
    $.ajax({  type : "GET" , url : "/editidv/"+sid ,success:function(response){ console.log(response);}     })
    $('#editlicence').val(response.selected.DrivingLicence);
    $('#editvoter').val(response.selected.VoterCard);
    $('#editaadhar').val(response.selected.AadharCard);
    $('#editration').val(response.selected.RationCard);
    $('#editpassport').val(response.selected.Passport);
    $('#editgovtid').val(response.selected.GovtID);
    $('#editothers').val(response.selected.Others);
    $('#editssid').val(sid);

});

/////////////////////////Show second person model////////////
$("#createsec").click(function() {  $('#second').modal('show');  });
//////////////////////////////////////////////////////////////////
    
</script>
<!--
<input type='button' value='Add' id='btnAddProfile'>
$("#btnAddProfile").attr('value', 'Save'); //versions older than 1.6

<input type='button' value='Add' id='btnAddProfile'>
$("#btnAddProfile").prop('value', 'Save'); //versions newer than 1.6
-->
@endsection