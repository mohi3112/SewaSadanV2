<?php

namespace App\Http\Controllers;
use DB;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;

class Preferences extends Controller
{
    public function GetAllConfigs()
    {
        $FinYear = DB::table('preferences')->get();
        $renew_period = DB::table('preferences')->where('options' ,'=' ,'renew_period')->get();
        // $FinYear = DB::table('preferences')->where('options' ,'=' ,'FinYear')->get();
        // $FinYear = DB::table('preferences')->where('options' ,'=' ,'FinYear')->get();
        return response()->json(['FinYear' => $FinYear]);

        //return back()->with('FinYear',$FinYear)->with('renew_period',$renew_period);

    }
}





 