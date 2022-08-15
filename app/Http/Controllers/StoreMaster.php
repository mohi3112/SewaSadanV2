<?php

namespace App\Http\Controllers;
use DB;
use Illuminate\Http\Request;
use App\Models\Locations;
use App\Models\Vendors;
use App\Models\StoreCategory;
use App\Models\StockAssets;
use Session;

class StoreMaster extends Controller
{
    public function AddNewAsset(Request $request)
    {
        $entrydate = date('d-m-Y h:i' , time());
        $quantity = $request->Quantity;

        for($i=1;$i<=$quantity;$i++)
        {
            $asset = new StockAssets();
            $asset->AssetName = $request->ItemName;
            $asset->CategoryID = $request->CategoryId;
            $asset->CategoryName = $request->CategoryName;
            $asset->LocationID = $request->LocationId;
            $asset->LocationName = $request->LocationName;
            $asset->VendorID = $request->VendorId;
            $asset->VendorName = $request->VendorName;
            $asset->Status = "Active";
            $asset->StockType = $request->StockType;
            $asset->AssignedTo = $request->AssignedTo;
            $asset->Rate = $request->Rate;
            $asset->Measures = $request->Measures;
            $asset->Quality = $request->Quality;
            $asset->Color = $request->Color;
            $asset->EntryDate = $entrydate;
            $asset->EntryBy = $request->CreatedBy;
            $asset->discontinued = "";
            $asset->discontinuedReason = "";
            $asset->discontinuedDate = "";
            $asset->discontinuedBy = "";
            $res = $asset->save();
        }
        if($res)
        {
            return back()->with('success','Asset Items Has Been Saved!!!');
        }
        else
        {
            return back()->with('fail','Asset Items Not Saved.');
        }
    }
    public function AddCategory(Request $request)
    {
        if($request->ParentId != 0){$pname=$request->ParentCategory;}else{$pname="None";}
        
        $category =new StoreCategory();
        $category->Category = $request->Category;
        $category->ParentID = $request->ParentId;
        $category->ParentCategory = $pname;
        $category->Type = $request->Type;
        $category->CreatedBy = $request->CreatedBy;
        $res = $category->save();
        if($res)
         {
             return back()->with('success','Category Has Been Saved!!!');
         }
         else
         {
             return back()->with('fail','Category Not Saved.');
         }

    }
    public function AddLocationVendor()
    {
        $location = DB::table('locations')->where('id','>','0')->get();
        $vendor = DB::table('vendors')->where('id','>','0')->get();
        return view("Store.CreateLocationVendor")
        ->with('location', $location)
        ->with('vendor',$vendor);
    }
    public function AddStockAsset()
    {
        $AllCat = DB::table('store_categories')->where('id','>','0')->get();
        $locations = DB::table('locations')->where('id','>','0')->get();
        $vendors = DB::table('vendors')->where('id','>','0')->get();
        return view("Store.AddStockAssets")
        ->with('location', $locations)
        ->with('allcat', $AllCat)
        ->with('vendor',$vendors);
    }
    public function AddStockCat()
    {
        $AllCat = DB::table('store_categories')->where('id','>','0')->get();
        $Assets = DB::table('store_categories')->where('Type','=','Assets')->get();
        $Consumable = DB::table('store_categories')->where('Type','=','Consumables')->get();
        //dd($AllCat);
        return view("Store.AddStockCategory")
        ->with('AllCat',$AllCat)
        ->with('Assets',$Assets)
        ->with('Consumable',$Consumable);
    }

    public function AddLocation(Request $request)
    {
        $request->validate(['LocationName' => 'required',]);
        
         $vendors =new Locations();
         $vendors->LocationName = $request->LocationName;
         $vendors->CreatedBy = $request->CreatedBy;
         $res = $vendors->save();
         if($res)
         {
             return back()->with('successLocation','Location Has Been Saved!!!');
         }
         else
         {
             return back()->with('failLocation',' Location Not Saved.');
         }
    }
    public function AddVendor(Request $request)
    {
        $request->validate(['VendorName' => 'required',]);
       
        $vendors =new Vendors();
        $vendors->VendorName = $request->VendorName;
        $vendors->CreatedBy = $request->CreatedBy;
        $res = $vendors->save();
        if($res)
        {
            return back()->with('successVendor','Vendor Has Been Saved!!!');
        }
        else
        {
            return back()->with('failVendor',' Location Not Saved.');
        }

    }
    public function StoreBedding(Request $request)
    {
        $sid = request('slip');
        //if(isset($sid)){}
        if(isset($sid))
        {
            $slipdata = DB::table('beddings')->where('SlipNo','>',$sid)->groupBy('SlipNo')->get();
            return view("Store.Issubeddings")->with('SlipData',$slipdata);
        }
        else
        {
            $pending = DB::table('beddings')->groupBy('SlipNo')->get();
            return view("Store.Issubeddings")->with('pending',$pending);
        }
       
    }
    

}
