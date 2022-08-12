@extends('layouts.app')
@section('content')
<!-- ============================================================== -->
<!-- Start Page Content here -->
<!-- ============================================================== -->
<?php
    function displaywords($number){
        $words = array('0' => '', '1' => 'one', '2' => 'two',
        '3' => 'three', '4' => 'four', '5' => 'five', '6' => 'six',
        '7' => 'seven', '8' => 'eight', '9' => 'nine',
        '10' => 'ten', '11' => 'eleven', '12' => 'twelve',
        '13' => 'thirteen', '14' => 'fourteen',
        '15' => 'fifteen', '16' => 'sixteen', '17' => 'seventeen',
        '18' => 'eighteen', '19' =>'nineteen', '20' => 'twenty',
        '30' => 'thirty', '40' => 'forty', '50' => 'fifty',
        '60' => 'sixty', '70' => 'seventy',
        '80' => 'eighty', '90' => 'ninety');
        $digits = array('', '', 'hundred', 'thousand', 'lakh', 'crore');
       
        $number = explode(".", $number);
        $result = array("","");
        $j =0;
        foreach($number as $val){
            // loop each part of number, right and left of dot
            for($i=0;$i<strlen($val);$i++){
                // look at each part of the number separately  [1] [5] [4] [2]  and  [5] [8]
                
                $numberpart = str_pad($val[$i], strlen($val)-$i, "0", STR_PAD_RIGHT); // make 1 => 1000, 5 => 500, 4 => 40 etc.
                if($numberpart <= 20){
                    $numberpart = 1*substr($val, $i,2);
                    $i++;
                    $result[$j] .= $words[$numberpart] ." ";
                }else{
                    //echo $numberpart . "<br>\n"; //debug
                    if($numberpart > 90){  // more than 90 and it needs a $digit.
                        $result[$j] .= $words[$val[$i]] . " " . $digits[strlen($numberpart)-1] . " "; 
                    }else if($numberpart != 0){ // don't print zero
                        $result[$j] .= $words[str_pad($val[$i], strlen($val)-$i, "0", STR_PAD_RIGHT)] ." ";
                    }
                }
            }
            $j++;
        }
        if(trim($result[0]) != "") echo $result[0] . "Rupees ";
        if($result[1] != "") echo $result[1] . "Paise";
        echo " Only";
    }
?>
<div class="content-page">
<div class="content">

<!-- Start Content-->
<div class="container-fluid">

    <div class="row">

        <div class="col-xl-12 col-md-12">
            <div class="card">
                <div class="card-body">
  
<ul class="nav nav-tabs">
                    <li class="nav-item">
                        <a href="#allset" data-bs-toggle="tab" aria-expanded="false" class="nav-link active">
                            Print All
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#passonly" data-bs-toggle="tab" aria-expanded="true" class="nav-link">
                        Pass Only
                        </a>
                    </li>

                </ul>
            <div class="tab-content">
                <div class="tab-pane active" id="allset">
                                           
                    <div id="PrintMe" class="print" style="border: 1px solid #a1a1a1; background: white; padding: 10px; margin: 0 auto; text-align: center;">
    <div class="row">
		<div class="col-md-12">
			<h3 align="center">SHRI RAM SHARNAM SEWA SADAN</h3>
            <h5 align="center">A Unit Of Ram Sewa Swami Satyanand Trust</h5>
		</div>
	</div>
	<div class="row">
		<div class="col-md-1">
        </div>
		<div class="col-md-10">
                <table align="center" style="width:70%;height:auto;text-align:left;"  id="applicationf">
                    
                    <tr><td colspan="3"><center><b>APPLICATION FORM</b></center> </td></tr>
                    <tr><td>Security Slip No:</td><td>{{$first[0]->SlipNo}}</td><td rowspan="12"><img src="{{$first[0]->Photo}}" height="150px" width="auto" align="left" style="v-align:text-top;"></td></tr>
                    <tr><td>Arrival  Time:</td><td>{{$first[0]->CheckinDate}}</td></tr>
                    <tr><td>Att Name:</td><td>{{$first[0]->GuestName}}</td></tr>
                    <tr><td>Address:</td><td>{{$first[0]->Address}}</td></tr>
                    <tr><td>Mobile:</td><td>{{$first[0]->Mobile}}</td></tr>
                    <tr><td>MRD/Adm No:</td><td >{{$first[0]->MRDNO}}</td></tr>
                    <tr><td>Adm Date:</td ><td>{{$first[0]->PatientAdmtDate}}</td></tr>
                    <tr><td>Patient Name:</td ><td>{{$first[0]->PatientName}}</td></tr>
                    <tr><td>Room/Bed:</td><td>{{$first[0]->Room}}/{{$first[0]->Bed}}</td></tr>
                    <tr><td>Security:</td><td>{{$first[0]->Security}}</td></tr>
                    <tr><td>SSID:</td><td>{{$first[0]->SSID}}</td></tr>
                    <tr><td>Unique Booking No:</td ><td>{{$first[0]->BookingID}}</td></tr>
                    <tr><td>Extra Notes:</td><td colspan="2">_ __ __ __ __ __ __ __ __ __ __ __ __ __ __ __ __ __ __ __ </td></tr>
                    <tr><td colspan=3>&nbsp;</td></tr>
                </table>
		</div>
        <div class="col-md-1">
        </div>	
	</div>
	<div class="row">
		<div class="col-md-12">
            <table width="98%" align="center">
                <tr><td>
                <div class="card-body">
                    <div style="float:left;border-style: solid;width:100%;border-width: medium;">
                        <h4 align="center" style="color:#f00;"><b>SHRI RAM SHARNAM SEWA SADAN</b></h4>
                        <h6 align="center" style="color:#f00;margin-top:-9px;"><b>A Unit Of Ram Sewa Swami Satyanand Trust</b></h6>
                            <table align="center" style="width:91%;height:auto;padding:2px;">
                                <tr><td width="20%">Date:</td><td width="35%">{{ \Carbon\Carbon::parse($first[0]->CheckinDate)->format('d/M/Y')}}</td><td rowspan="6" width="45%"><img align="right" src="{{$first[0]->Photo}}" height="125px" width="auto"></td></tr>
                                <tr><td width="20%">Slip No:</td><td>{{$first[0]->SlipNo}}</td></tr>
                                <tr><td width="20%">Att Name:</td><td>{{$first[0]->GuestName}}</td></tr>
                                <tr><td width="20%">F.N/W/o:</td><td>{{$first[0]->FatherName}}</td ></tr>
                                <tr><td width="20%">Mobile:</td><td>{{$first[0]->Mobile}}</td></tr>
                                <tr><td width="20%">Room/Bed:</td><td>{{$first[0]->Room}}/{{$first[0]->Bed}}</td ></tr>
                                <tr><td colspan="3"><center>Valid For {{$Ren_Period}} Days Only.</center></td ></tr>
                            </table>
                    </div>
				</div>
                </td><td>
                <div class="card-body">
                    <div style="float:left;border-style: solid;width:100%;border-width: medium;">
                        <h4 align="center" style="color:#f00;"><b>SHRI RAM SHARNAM SEWA SADAN</b></h4>
                        <h6 align="center" style="color:#f00;margin-top:-9px;"><b>A Unit Of Ram Sewa Swami Satyanand Trust</b></h6>
                            <table align="center" style="width:91%;height:auto;padding:2px;">
                                <tr><td width="20%">Date:</td><td width="35%">{{ \Carbon\Carbon::parse($second[0]->CheckinDate)->format('d/M/Y')}}</td><td rowspan="6" width="45%"><img align="right" src="{{$first[0]->Photo}}" height="125px" width="auto"></td></tr>
                                <tr><td width="20%">Slip No:</td><td>{{$FinYear}}/{{$second[0]->SlipNo}}</td></tr>
                                <tr><td width="20%">Att Name:</td><td>{{$second[0]->GuestName}}</td></tr>
                                <tr><td width="20%">F.N/W/o:</td><td>{{$second[0]->FatherName}}</td ></tr>
                                <tr><td width="20%">Mobile:</td><td>{{$second[0]->Mobile}}</td></tr>
                                <tr><td width="20%">Room/Bed:</td><td>{{$second[0]->Room}}/{{$second[0]->Bed}}</td ></tr>
                                <tr><td colspan="3"><center>Valid For  {{$Ren_Period}}  Days Only.</center></td ></tr>
                            </table>
                    </div>
				</div>

                </td></tr>
            </table>
		
		</div>
	
	</div>
	<div class="row">
		<div class="col-md-12">
			<div class="row">
				<div class="col-md-3">
				</div>
				<div class="col-md-6">
					<div class="card">
						
						<div class="card-body">
                            <table border="1" cellpadding="0" cellspacing="0" width="600" >
                                <tbody>
                                    <tr>
                                        <td colspan="7" height="10" class="rw">&nbsp;&nbsp;&nbsp;&nbsp;</td>
                                    </tr>
                                    
                                    <tr>
                                        <td colspan="7" height="80" class="rw"><center><img src=" {{asset('assets/images/head.jpg')}}" width="500px" height="auto"></center></td>
                                    </tr>
                                    <tr height="4">
                                        <td width="38"></td>
                                        <td width="70"></td>
                                        <td width="64"></td>
                                        <td width="44"></td>
                                        <td width="95"></td>
                                        <td width="47"></td>
                                        <td width="99"></td>
                                    </tr>
                                    <tr height="20"  class="rw">
                                        <td height="20" width="38" class="titles">No:&nbsp;</td>
                                        <td class="baseb" width="64" colspan="2"> {{$first[0]->SlipNo}} </td>
                                        <td colspan="4"></td>
                                    </tr>
                                    <tr height="20" class="rw">
                                        <td colspan="2" height="20" class="titles">Room/Bed</td>
                                        <td class="baseb">{{$first[0]->Room}}/{{$first[0]->Bed}}</td>
                                        <td class="titles">Time</td>
                                        <td class="baseb" > </td>
                                        <td class="titles">Dated</td>
                                        <td class="baseb" > </td>
                                    </tr>
                                    <tr height="20" class="rw">
                                        <td colspan="4" height="20" style="" class="titles">Received with thanks from</td>
                                        <td colspan="3" class="baseb" >{{$first[0]->GuestName}}</td>
                                    </tr>
                                    <tr height="20" class="rw">
                                        <td colspan="4" height="20" class="titles">Father&#39;s Husband Name</td>
                                        <td colspan="3" class="baseb" >{{$first[0]->FatherName}}</td>
                                    </tr>
                                    <tr height="20" class="rw">
                                        <td colspan="2" height="20" class="titles">Admn/Ref No</td>
                                        <td colspan="3" class="baseb" >{{$first[0]->MRDNO}}</td>
                                        <td>Dated</td>
                                        <td class="baseb" >{{$first[0]->PatientAdmtDate}}</td>
                                    </tr>
                                    <tr height="20" class="rw">
                                        <td colspan="3" height="20" class="titles">the sum of Rupees</td>
                                        <td colspan="4" class="baseb" style="text-transform:capitalize;">
                                        <?php   echo displaywords($first[0]->Security);?>
                                    </td>
                                    </tr>
                                    <tr height="20" class="rw">
                                        <td colspan="4" height="20"  class="baseb" ></td>
                                        <td colspan="3" style="padding-bottom: 5px;padding-top: 5px;font-size: 14px;color:#f00; font-weight:bold;">ON A/C OF SECURITY DEPOSIT</td>
                                    </tr>
                                    <tr height="20" class="rw">
                                        <td height="20" class="titles">Rs.</td>
                                        <td colspan="2" class="baseb" >  {{$first[0]->Security}} </td>
                                        <td class="titles">(M):</td>
                                        <td colspan="2" class="baseb" >{{$first[0]->Mobile}}</td>
                                        <td class="titles" align="right">Cashier</td>
                                    </tr>
                                </tbody>
                            </table>
						</div>
						
					</div>
				</div>
				<div class="col-md-3">
				</div>
			</div>
		</div>
	</div>                 
                    </div>
                    <button onclick="printDiv('PrintMe')">Print only the above div</button>
                </div>

                        <div class="tab-pane show" id="passonly">
                            <div id="PrintMyPass" class="print" style="border: 1px solid #a1a1a1; background: white; padding: 10px; margin: 0 auto; text-align: center;">     
                                <div class="row">
                                    <div class="col-md-12">
                                        <table width="98%" align="center">
                                            <tr><td>
                                            <div class="card-body">
                                                <div style="float:left;border-style: solid;width:100%;border-width: medium;">
                                                    <h4 align="center" style="color:#f00;"><b>SHRI RAM SHARNAM SEWA SADAN</b></h4>
                                                    <h6 align="center" style="color:#f00;margin-top:-9px;"><b>A Unit Of Ram Sewa Swami Satyanand Trust</b></h6>
                                                        <table align="center" style="width:91%;height:auto;padding:2px;">
                                                            <tr><td width="20%">Date:</td><td width="35%">{{ \Carbon\Carbon::parse($first[0]->CheckinDate)->format('d/M/Y')}}</td><td rowspan="6" width="45%"><img align="right" src="{{$first[0]->Photo}}" height="125px" width="auto"></td></tr>
                                                            <tr><td width="20%">Slip No:</td><td>{{$first[0]->SlipNo}}</td></tr>
                                                            <tr><td width="20%">Att Name:</td><td>{{$first[0]->GuestName}}</td></tr>
                                                            <tr><td width="20%">F.N/W/o:</td><td>{{$first[0]->FatherName}}</td ></tr>
                                                            <tr><td width="20%">Mobile:</td><td>{{$first[0]->Mobile}}</td></tr>
                                                            <tr><td width="20%">Room/Bed:</td><td>{{$first[0]->Room}}/{{$first[0]->Bed}}</td ></tr>
                                                            <tr><td colspan="3"><center>Valid For {{$Ren_Period}} Days Only.</center></td ></tr>
                                                        </table>
                                                </div>
                                            </div>
                                            </td><td>
                                            <div class="card-body">
                                                <div style="float:left;border-style: solid;width:100%;border-width: medium;">
                                                    <h4 align="center" style="color:#f00;"><b>SHRI RAM SHARNAM SEWA SADAN</b></h4>
                                                    <h6 align="center" style="color:#f00;margin-top:-9px;"><b>A Unit Of Ram Sewa Swami Satyanand Trust</b></h6>
                                                    <table align="center" style="width:91%;height:auto;padding:2px;">
                                                        <tr><td width="20%">Date:</td><td width="35%">{{ \Carbon\Carbon::parse($second[0]->CheckinDate)->format('d/M/Y')}}</td><td rowspan="6" width="45%"><img align="right" src="{{$first[0]->Photo}}" height="125px" width="auto"></td></tr>
                                                        <tr><td width="20%">Slip No:</td><td>{{$FinYear}}/{{$second[0]->SlipNo}}</td></tr>
                                                        <tr><td width="20%">Att Name:</td><td>{{$second[0]->GuestName}}</td></tr>
                                                        <tr><td width="20%">F.N/W/o:</td><td>{{$second[0]->FatherName}}</td ></tr>
                                                        <tr><td width="20%">Mobile:</td><td>{{$second[0]->Mobile}}</td></tr>
                                                        <tr><td width="20%">Room/Bed:</td><td>{{$second[0]->Room}}/{{$second[0]->Bed}}</td ></tr>
                                                        <tr><td colspan="3"><center>Valid For  {{$Ren_Period}}  Days Only.</center></td ></tr>
                                                    </table>
                                                </div>
                                            </div>

                                            </td></tr>
                                        </table>
                                    
                                    </div>
                                
                                </div>
                            </div>    
                            <button onclick="printDiv('PrintMyPass')">Print only the above div</button>      
                        </div>
                                        
                </div>



                

                </div> 
            </div>
        
        </div><!-- end col -->

    </div>
    <!-- end row -->       
    
</div> <!-- container-fluid -->

</div> <!-- content -->
@endsection



@section('scripts')
<script>
		function printDiv(PrintMe){
			var printContents = document.getElementById(PrintMe).innerHTML;
			var originalContents = document.body.innerHTML;

			document.body.innerHTML = printContents;

			window.print();

			document.body.innerHTML = originalContents;
		}
	
		function printDiv(PrintMyPass){
			var printContents = document.getElementById(PrintMyPass).innerHTML;
			var originalContents = document.body.innerHTML;

			document.body.innerHTML = printContents;

			window.print();

			document.body.innerHTML = originalContents;
		}
	</script>
@endsection
