<?php
namespace App\Http\Controllers;
use DB;
use Illuminate\Http\Request;
use App\Models\Guests;
use App\Models\IVault;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;


class GuestMaster extends Controller
{

    public function CreateGuest(Request $request)
    {
        $request->validate([
            'guestname' => 'required',
            'fnwo' => 'required',
            'mobile' => 'required|min:10|max:10',
            'address' => 'required',
            'photo' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048'
        ]);
        $image = $request->file('photo');

        $RandomName =date('mdYHis').uniqid().".".$image->extension();
        $photoname = $request->file('photo')->getClientOriginalName();
        //$photopath = $request->file('photo')->store('public/images/guests');
        $path = public_path('/assets/images/uploads/guests/');
        $filename = $photoname;

        $img = Image::make($image->getRealPath());
            $img->resize(300, 400)->save($path.$RandomName);

        $gcheck = DB::table('guests')->orderBy('id', 'desc')->first();
        
        if($gcheck==null)
        {
            $ssid=1;
        }
        else
        {
            $ssid =$gcheck->SSID;
            $ssid++;  
        }

        $guest =new Guests();
        $guest ->SSID = $ssid;
        $guest->Name = $request->guestname;
        $guest->FatherName = $request->fnwo;
        $guest->Mobile	 = $request->mobile;
        $guest->Address = $request->address;
        $guest->City ="";
        $guest->Photo = "/assets/images/uploads/guests/".$RandomName;
        $res = $guest->save();

        $guestid =new IVault();
        $guestid ->SSID = $ssid;
        $guestid->Name = $request->guestname;
        $guestid->Mobile = $request->mobile;
        $guestid->DrivingLicence = Null;
        $guestid->VoterCard = Null;
        $guestid->AadharCard =Null;
        $guestid->RationCard = Null;
        $guestid->Passport = Null;
        $guestid->GovtID = Null;
        $guestid->Others = Null;
        $res = $guestid->save();
        $urls="checkin/".$ssid;
        return redirect($urls);
        
                						
    }

    public function CreateSecondGuest(Request $request)
    {
        $request->validate([
            'secondguestname' => 'required',
            'secondfnwo' => 'required',
            'secondmobile' => 'required|min:10|max:10',
            'secondaddress' => 'required',
            'secondphoto' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048'
        ]);
        $image = $request->file('secondphoto');

        $RandomName =date('dmYHis').uniqid().".".$image->extension();
        $photoname = $request->file('secondphoto')->getClientOriginalName();
        //$photopath = $request->file('photo')->store('public/images/guests');
        $path = public_path('/assets/images/uploads/guests/');
        $filename = $photoname;

        $img = Image::make($image->getRealPath());
            $img->resize(300, 400)->save($path.$RandomName);
        $gcheck = DB::table('guests')->orderBy('id', 'desc')->first();
        if($gcheck==null)
        {
            $ssid=1;
        }
        else
        {
            $ssid =$gcheck->SSID;
            $ssid++;  
        }

        $guest =new Guests();
        $guest ->SSID = $ssid;
        $guest->Name = $request->secondguestname;
        $guest->FatherName = $request->secondfnwo;
        $guest->Mobile	 = $request->secondmobile;
        $guest->Address = $request->secondaddress;
        $guest->City ="";
        $guest->Photo = "/assets/images/uploads/guests/".$RandomName;
        $res = $guest->save();

        $guestid =new IVault();
        $guestid ->SSID = $ssid;
        $guestid->Name = $request->secondguestname;
        $guestid->Mobile = $request->secondmobile;
        $guestid->DrivingLicence = Null;
        $guestid->VoterCard = Null;
        $guestid->AadharCard = Null;
        $guestid->RationCard = Null;
        $guestid->Passport = Null;
        $guestid->GovtID = Null;
        $guestid->Others = Null;
        $res = $guestid->save();
        if($res)
              {
                
                Alert::success('Second Person Saved!', 'Page Is Refreshed Please Select ID Type Again');
                  return back()->with('SecondSsid',$ssid)->with('success','Second Person Info Saved!!!');
              }
              else
              {
                  return back()->with('fail','Second Person Not Saved!!!');
              }
        
                						
    }
       
        public function UpdateIDV(request $request)
        { 
            if($request->DrivingLicence==""){ $DrivingLicence=NULL;} else{ $DrivingLicence = $request->DrivingLicence; }
            if($request->VoterCard==""){ $VoterCard=NULL;} else{ $VoterCard = $request->VoterCard; }
            if($request->AadharCard==""){ $AadharCard=NULL;} else{ $AadharCard = $request->AadharCard; }
            if($request->RationCard==""){ $RationCard=NULL;} else{ $RationCard = $request->RationCard; }
            if($request->Passport==""){ $Passport=NULL;} else{ $Passport = $request->Passport; }
            if($request->GovtID==""){ $GovtID=NULL;} else{ $GovtID = $request->GovtID; }
            if($request->Others==""){ $Others=NULL;} else{ $Others = $request->Others; }
            $newvault = IVault::where('SSID','=',$request->ssid)->first();
            $newvault->DrivingLicence = $DrivingLicence;
            $newvault->VoterCard = $VoterCard;
            $newvault->AadharCard = $AadharCard;
            $newvault->RationCard = $RationCard;
            $newvault->Passport = $Passport;
            $newvault->GovtID = $GovtID;
            $newvault->Others = $Others;
            $res = $newvault->save();
           
              if($res)
              {
                  return back()->with('success','New IDs Saved');
              }
              else
              {
                  return back()->with('fail','New IDs Not Saved');
              }
        }

        public function EditIDV($id)
        { 
            $selectedid = IVault::where('SSID','=',$id)->first();
            return response()->json([ 'status' => 200 , 'selected' => $selectedid ]);
        }
        public function GetGuestDetails(request $request)
        {
            $ssid = request('ssid');
            $mobile = request('mobile');
            $idnumber = request('idnumber');

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
