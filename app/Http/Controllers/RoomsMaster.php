<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Rooms;
use App\Models\RoomRents;
use DB;
class RoomsMaster extends Controller
{
    public function AddRoom()
    {
        return view("Rooms.AddRoom");
    }
    public function CreateRoom(Request $request)
    {
        $request->validate([
             'RoomNo' => 'required',
             'RoomType' => 'required',
         ]);
         if($request->RoomType == 'PrivateRoom')
         {
            $private = RoomRents::where('RoomType','=','PrivateRoom')->first();
            $rooms =new Rooms();
            $rooms->RoomNo = $request->RoomNo;
            $rooms->BedNo = 1;
            $rooms->RoomType = $request->RoomType;
            $rooms->RoomRent = $private->RoomRent;
            $rooms->CurrentStatus = "Vacant";
            $rooms->CurrentGuest = "";
            $rooms->BookingId = "";
            $rooms->ArrivalTime = "";
            $rooms->ValidUpto = "";
            $rooms->RoomAssets = "";
            $res = $rooms->save();
   
            $roomssec =new Rooms();
            $roomssec->RoomNo = $request->RoomNo;
            $roomssec->BedNo = 2;
            $roomssec->RoomType = $request->RoomType;
            $roomssec->RoomRent = 0;
            $roomssec->CurrentStatus = "Vacant";
            $roomssec->CurrentGuest = "";
            $roomssec->BookingId = "";
            $roomssec->ArrivalTime = "";
            $roomssec->ValidUpto = "";
            $roomssec->RoomAssets = "";
            $res = $roomssec->save();

            if($res)
            {
                return back()->with('success','Saved');
            }
            else
            {
                return back()->with('fail',' Not Saved');
            }
         }
         if($request->RoomType == 'ExtraBed')
         {
            for($i=1;$i<=20;$i++)
            {
                $extra = RoomRents::where('RoomType','=','ExtraBed')->first();
                $roomex =new Rooms();
                $roomex ->RoomNo = $request->RoomNo;
                $roomex->BedNo = $i ;
                $roomex->RoomType = $request->RoomType;
                $roomex->RoomRent = $extra->RoomRent;
                $roomex->CurrentStatus = "Vacant";
                $roomex->CurrentGuest = "";
                $roomex->BookingId = "";
                $roomex->ArrivalTime = "";
                $roomex->ValidUpto = "";
                $roomex->RoomAssets = "";
                $res = $roomex->save();
            }
            if($res)
            {
                return back()->with('success','Saved');
            }
            else
            {
                return back()->with('fail',' Not Saved');
            }
         }

         
    }
    public function ChangeRent()
    {
        return view("Rooms.ChangeRent");
    }
    public function UpdateRent(Request $request)
    {
        $private = RoomRents::where('RoomType','=','PrivateRoom')->first();
        $extra = RoomRents::where('RoomType','=','ExtraBed')->first();
        $private->RoomRent = $request->Room;
        $extra->RoomRent = $request->Extra;
        $res = $private->save();
        $res = $extra->save();

        // $request->validate([
        //     'Room' => 'required',
        //     'Extra' => 'required' ]);

        //    DB::table('room_rents')
        //     ->where('RoomType', 'Private')
        //     ->update(['RoomRent' => $request->Room]);

        //     DB::table('room_rents')
        //     ->where('RoomType', 'Extra')
        //     ->update(['RoomRent' => $request->Extra]);
            
        // return view("Rooms.ChangeRent");
 
        if($res)
        {
            return back()->with('success','Saved');
        }
        else
        {
            return back()->with('fail',' Not Saved');
        }

    }

    public function GetVacantRooms(Request $request)
    {
        $status = request('status');
        $roomno = request('roomno');
        $type = request('type');
        $groupby = request('groupby');
        $bedno = request('bedno');
      
        $query = Rooms::query();
        $query = $query->select('id','RoomNo','BedNo','RoomType','RoomRent','CurrentStatus','CurrentGuest','BookingId','ArrivalTime','ValidUpto','RoomAssets','created_at','updated_at');
        if($status!="") { $query = $query->where('CurrentStatus','=',$status);}
        if($bedno!="") { $query = $query->where('BedNo','=',$bedno);}
        if ($roomno!="") {$query = $query->where('RoomNo', '=',$roomno);}
        if ($type!="") { $query = $query->where('RoomType', '=',$type);}    
        if ($groupby!="") { $query = $query->groupBy($groupby);}

        $gtrooms = $query->get();
       
        $preferences = DB::table('preferences')->where('options','=','renew_period')->get();
        return response()->json([ 'status' => 200 , 'VacantRooms' => $gtrooms , 'preferences' => $preferences ]);

        
    }
}
