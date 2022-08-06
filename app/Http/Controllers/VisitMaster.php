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
        $result = (new Preferences)->GetAllConfigs();
        $person = json_decode($result->content());
        $renew_period = $person->FinYear[0]->values;
        $FinYear = $person->FinYear[1]->values; 
        //dd($person);


        $slipcheck = DB::table('visits_masters')->where('SlipNo','!=','')->orderBy('SlipNo', 'desc')->first();
        if($slipcheck==null)
        {
            $SlipNo=1;
        }
        else
        {
            $SlipNo = substr($slipcheck->SlipNo, 8);
            //$SlipNo =$slipcheck->SlipNo;
            $SlipNo++;  
        }
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

            $store = new Beddings;
            $store->BookingID = $BookingId;
            $store->SSID = $CheckinDate;
            $store->SlipNo = $SlipNo;
            $store->GuestName = $request->GuestName;
            $store->FatherName = $request->FatherName;
            $store->Room =  $request->RoomNo;
            $store->Bed = $request->BedNo;
            $store->RoomType =  $request->RoomType;
            $personbedding=$store->save();

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
                $visit->BookingId = $BookingId."/2";
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

                $store2 = new Beddings;
                $store2->BookingID = $BookingId."/2";
                $store2->SSID = $CheckinDate;
                $store2->SlipNo = $SlipNo;
                $store2->GuestName = $Second->Name;
                $store2->FatherName = $Second->FatherName;
                $store2->Room =  $request->RoomNo;
                $store2->Bed = $request->BedNo;
                $store2->RoomType =  $request->RoomType;
                $person2bedding=$store2->save();

                $RoomStatus = Rooms::where('RoomNo','=',$request->RoomNo)->where('BedNo','=','2')->first();
                $RoomStatus->CurrentStatus = "Occupied";
                $RoomStatus->CurrentGuest = $Second->Name;
                $RoomStatus->BookingId = $BookingId;
                $RoomStatus->ArrivalTime = $CheckinDate;
                $RoomStatus->ValidUpto = $ValidTill;
                $res = $RoomStatus->save();

            }




    }
      
    
}
