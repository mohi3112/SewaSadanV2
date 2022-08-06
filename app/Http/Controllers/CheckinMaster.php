<?php

namespace App\Http\Controllers;
use DB;
use Illuminate\Http\Request;
use App\Models\Guests;
use App\Models\IVault;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;

class CheckinMaster extends Controller
{
    public function ChekinMain($id="")
    {
        $currentguest = Guests::where('SSID','=',$id)->first();
        $idVault = IVault::where('SSID','=',$id)->first();
        $logeduser = auth()->user();

        if($currentguest == null)
        {
            return view("checkin.NewGuest");
        }
        else
        {
            return view("checkin.NewGuest")->with('currentguest', $currentguest)->with('idvault',$idVault)->with('logeduser',$logeduser);
        }
        
    }
}
