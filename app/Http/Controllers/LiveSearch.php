<?php

namespace App\Http\Controllers;
use DB;
use Illuminate\Http\Request;

class LiveSearch extends Controller
{
    function GetGuestDetails(Request $request)
    {
     if($request->ajax())
     {
      $output = '';
      $query = $request->get('query');
      
       $data = DB::table('i_vaults')
         ->where('SSID', 'like', '%'.$query.'%')
         ->orWhere('Mobile', 'like', '%'.$query.'%')
         ->orWhere('DrivingLicence', 'like', '%'.$query.'%')
         ->orWhere('VoterCard', 'like', '%'.$query.'%')
         ->orWhere('AadharCard', 'like', '%'.$query.'%')
         ->orWhere('RationCard', 'like', '%'.$query.'%')
         ->orWhere('Passport', 'like', '%'.$query.'%')
         ->orWhere('Others', 'like', '%'.$query.'%')
         ->orWhere('GovtID', 'like', '%'.$query.'%')
         ->orderBy('id', 'desc')
         ->limit('4')
         ->get();
        
    
      $total_row = $data->count();
  
      if($total_row > 0)
      {
       foreach($data as $row)
       { 
        $ssid= DB::table('guests')->where('SSID', '=', $row->SSID)->orderBy('id', 'desc')->first();

        $output .= '

            <a href="/checkin/'.$row->SSID.'" class="dropdown-item notify-item">
            <div class="d-flex align-items-start">
                <img class="d-flex me-2 rounded-circle" src="'.$ssid->Photo.'" alt="Generic placeholder image" height="32">
                <div class="w-100">
                    <h5 class="m-0 font-14">'.$row->Name.'</h5>
                    <span class="font-12 mb-0">Mobile -> '.$row->Mobile.'</span>
                </div>
            </div>
            </a>
            ';
       }
      }
      else
      {
       $output = '
       <h2>No Data Found</h2>
       ';
      }
      $data = array(
       'table_data'  => $output,
       'total_data'  => $total_row
      );

      echo json_encode($data);
     }
    }
    
    function GetGuestPhone(Request $request)
    {
     if($request->ajax())
     {
      $output = '';
      $query = $request->get('query');
      
       $data = DB::table('guests')
         ->Where('Mobile', 'like', '%'.$query.'%')
         ->orderBy('id', 'desc')
         ->limit('1')
         ->get();
         foreach($data as $row)
         { 
            $output .= '

            <a href="/checkin/'.$row->SSID.'" class="dropdown-item notify-item">
           <h3>'.$row->Mobile.'</h3>
           </a>
            ';
         }
        

      $data = array('table_data'  => $output);
      echo json_encode($data);
     }
    }
    
}
