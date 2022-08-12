<?php

namespace App\Http\Controllers;
use App\Models\Beddings;
use App\Models\Rooms;
use App\Models\Visits;
use App\Models\Guests;
use Illuminate\Http\Client\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

use Illuminate\Support\Facades\DB;
use Route;

class PrintMaster extends Controller
{
    public function PrintSlips(Request $request)
    {

        $prefrences = (new Preferences)->GetAllConfigs();
        $data = json_decode($prefrences->content());
        $renew_period = $data->FinYear[0]->values;
        $FinYear = $data->FinYear[1]->values; 

        $ssid1 = request('ssid1');
        $ssid2 = request('ssid2');
        if(isset($ssid2))
        {
            ///////////////////////////////////////////////////
            //////////////////Second Person////////////////////
            ///////////////////////////////////////////////////
           
            $booking = request('bookingid');
            $bookingsecond= $booking."-2";
            $slipno = request('slipno');
            $ssid1 = request('ssid1');
            $ssid2 = request('ssid2');
            $secperson =  DB::table('guests')
                      ->join('visits', 'guests.id', '=', 'visits.SSID')
                      ->join('beddings', 'guests.id', '=', 'beddings.SSID')
                      ->select('guests.*', 'visits.*', 'beddings.*')
                      ->where('visits.BookingID','=',$bookingsecond)
                      ->where('visits.Security','=','0')
                      ->get();

        }

        if(isset($ssid1))
        {
            //////////////////////////////////////////////////
            //////////////////First Person////////////////////
            //////////////////////////////////////////////////
           
            $booking = request('bookingid');
            $slipno = request('slipno');
            $ssid1 = request('ssid1');
            $ssid2 = request('ssid2');
            $firstperson =  DB::table('guests')
                      ->join('visits', 'guests.id', '=', 'visits.SSID')
                      ->join('beddings', 'guests.id', '=', 'beddings.SSID')
                      ->select('guests.*', 'visits.*')
                      ->where('visits.BookingID','=',$booking)
                      ->where('visits.Security','!=','0')
                      ->get();
        }

        
        if(isset($secperson)) 
        { 
            return view('PrintMaster')->with('first' , $firstperson)
            ->with('second' , $secperson)
            ->with('FinYear' , $FinYear)
            ->with('Ren_Period' , $renew_period); 
        }
        else
        {
            return view('PrintMaster')->with('first' , $firstperson)
            ->with('FinYear' , $FinYear)
            ->with('Ren_Period' , $renew_period); 
        }
        // $query = Visits::query();
        // $query = $query->select('id','BookingID','SSID','GuestName','FatherName','Mobile','IDNumber','PatientName','MRDNO','PatientAdmtDate','Room','Bed','RoomType','CheckinDate','CheckinBy','SlipNo','Security','Status','VoucherNo','Refund','CheckoutDate','CheckoutBy','Donation','DonationNo','BeddingStatus','BeddingIssueDate','BeddingIssuedBy','BeddingReturnDate','BeddingRetunedBy');
        // if($booking!="") { $query = $query->where('BookingID','=',$booking);}
        // if($slipno!="") { $query = $query->where('SlipNo','=',$slipno);}
        // // if ($groupby!="") { $query = $query->groupBy($groupby);}
        // $getvisit = $query->get();

        
        
    }

}
