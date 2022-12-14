<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use App\Models\Locations;
use App\Models\Vendors;
use App\Models\StoreCategory;
use App\Models\StockAssets;
use App\Models\VisitsMaster;
use App\Models\Beddings;
use App\Models\Rooms;
use App\Models\Visits;
use Session;

class VisitMaster extends Controller
{
    public function VisitEntry(Request $request)
    {
        $prefrences = (new Preferences)->GetAllConfigs();
        $data = json_decode($prefrences->content());
        $renew_period = $data->FinYear[0]->values;
        $FinYear = $data->FinYear[1]->values; 
        //dd($person);


        $slipcheck = DB::table('visits')->where('SlipNo','!=','')->orderBy('id', 'desc')->first();
        $SlipNo = substr($slipcheck->SlipNo, 8);
        $SlipNo++;  
                            
        $BookingId=uniqid();
        $NewSlip=$FinYear."/".$SlipNo;
        $CheckinDate = date('d-m-Y h:i',time());
        $Dlimit="+ ".$renew_period." days";
        $ValidTill = date('d-m-Y h:i', strtotime($CheckinDate. $Dlimit));


        $vardate=  $request->patientadmitdate;
        $admitdate = date('d-m-Y', strtotime($vardate));
        $visit = new Visits;
        $visit->SSID = $request->SSID;
        $visit->BookingId = $BookingId;
        $visit->GuestName = $request->GuestName;
        $visit->FatherName = $request->FatherName;
        $visit->Mobile = $request->Mobile;
        $visit->IDNumber = $request->IDNumber;
        $visit->PatientName = $request->patientname;
        $visit->MRDNO = $request->mrdno;
        $visit->PatientAdmtDate = $admitdate;
        $visit->Room = $request->RoomNo;
        $visit->Bed = $request->BedNo;
        $visit->RoomType = $request->RoomType;
        $visit->CheckinDate = $CheckinDate;
        $visit->CheckinBy = $request->CreatedBy;
        $visit->SlipNo = $NewSlip;
        $visit->Security = $request->Security;
        $visit->Status = "Checked-In";
        $visit->BeddingStatus = "Pending";
        //dd($visit);
        $person1=$visit->save();

        $RoomStatus = Rooms::where('RoomNo','=',$request->RoomNo)->where('BedNo','=','1')->first();
        $RoomStatus->CurrentStatus = "Occupied";
        $RoomStatus->CurrentGuest = $request->GuestName;
        $RoomStatus->BookingId = $BookingId;
        $RoomStatus->ArrivalTime = $CheckinDate;
        $RoomStatus->ValidUpto = $ValidTill;
        $res = $RoomStatus->save();

        if(isset($request->SecSSID))
        {
            $Second = DB::table('guests')->where('SSID','=',$request->SecSSID)->orderBy('SSID', 'desc')->first();
            $CheckinDate = date('d-m-Y h:i',time());
            $vardate=  $request->PatientAdmtDate;
            $admitdate = date('d-m-Y', strtotime($vardate));
            $visit = new Visits;
            $visit->SSID = $request->SecSSID;
            $visit->BookingId = $BookingId."-2";
            $visit->GuestName = $Second->Name;
            $visit->FatherName = $Second->FatherName;
            $visit->Mobile = $Second->Mobile;
            $visit->PatientName = $request->patientname;
            $visit->MRDNO = $request->mrdno;
            $visit->PatientAdmtDate = $admitdate;
            $visit->Room = $request->RoomNo;
            $visit->Bed = "2" ;
            $visit->RoomType = $request->RoomType;
            $visit->CheckinDate = $CheckinDate;
            $visit->CheckinBy = $request->CreatedBy;
            $visit->SlipNo = $NewSlip;
            $visit->Security = "0";
            $visit->Status = "Checked-In";
            $visit->BeddingStatus = "Pending";
            $Person2=$visit->save();

            $RoomStatus = Rooms::where('RoomNo','=',$request->RoomNo)->where('BedNo','=','2')->first();
            $RoomStatus->CurrentStatus = "Occupied";
            $RoomStatus->CurrentGuest = $Second->Name;
            $RoomStatus->BookingId = $BookingId;
            $RoomStatus->ArrivalTime = $CheckinDate;
            $RoomStatus->ValidUpto = $ValidTill;
            $res = $RoomStatus->save();

        }

    $printurl="print-slips?bookingid=".$BookingId."&slipno=".$NewSlip."&ssid1=".$request->SSID."&ssid2=".$request->SecSSID;
    return redirect($printurl);


    }
      
    
    public function GetVisitDetails(Request $request)
    {
        $booking = request('bookingid');
        $mobile = request('mobile');
        $slip = request('slipno');
        $voucher = request('voucher');
        $from = request('from');
        $to = request('to');
        

        $query = Visits::query();
        $query = $query->select('id','BookingID','SSID','GuestName','FatherName','Mobile','IDNumber','PatientName','MRDNO','PatientAdmtDate','Room','Bed','RoomType','CheckinDate','CheckinBy','SlipNo','Security','Status','VoucherNo','Refund','CheckoutDate','CheckoutBy','Donation','DonationNo','BeddingStatus','BeddingIssueDate','BeddingIssuedBy','BeddingReturnDate','BeddingRetunedBy');
        if($booking!="") { $query = $query->where('BookingID','=',$booking);}
        if($mobile!="") { $query = $query->where('Mobile','=',$mobile);}
        if ($from!="") {$query = $query->where('CheckinDate', '=',$from);}
        if ($to!="") { $query = $query->where('CheckoutDate', '=',$to);}  
        if ($slip!="") {$query = $query->where('SlipNo', '=',$slip);}
        if ($voucher!="") { $query = $query->where('VoucherNo', '=',$voucher);}    
        // if ($groupby!="") { $query = $query->groupBy($groupby);}
        $getvisit = $query->get();

        return response()->json([ 'status' => 200 , 'VisitDetails' => $getvisit , 'preferences' => 'test' ]);

        
    }
}
