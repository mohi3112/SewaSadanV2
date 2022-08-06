<?php

namespace App\Http\Controllers;
use Auth;
use Illuminate\Http\Request;
use App\Models\Users;
use Hash;
use Session;

class CustomAuthController extends Controller
{
    public function Test()
   {
    return view("auth.Registration");
   }
   public function Login()
   {
        return view("auth.Login");
   }
   public function Registeration()
   {
    return view("auth.Registration");
   }
   public function UserLogin(Request $request)
   {
   
    $user = Users::where('UserName','=',$request->UserName)->first();
        if($user)
        {
           if(Hash::check($request->password,$user->Password))
           {
            $request->session()->put('loginId',$user->id);
            return redirect('dashboard');
           }
           else
           {
            return back()->with('fail','Check Your Password Again');
           }
        }
        else
        {
            return back()->with('fail','UserName Not Found');
        }

   }
   public function Logout()
   {
    if(Session::has('loginId'))
    {
        Session::pull('loginId');
        return redirect('login');
    }
   
   }
   public function dashboard()
   {
    return view("dashboard");
   }
   public function RegisterUser(Request $request)
   {
        $request->validate([
            'name' => 'required',
            'UserName' => 'required|unique:users',
            'password' => 'required|min:4|max:12',
            'phone' => 'required'
        ]);

        $user =new Users();
        $user->name = $request->name;
        $user->UserName = $request->UserName;
        $user->Password = Hash::make($request->password);
        $user->Phone = $request->phone;
        $res = $user->save();
        
        if($res)
        {
            return back()->with('success','Saved');
        }
        else
        {
            return back()->with('fail',' Not Saved');
        }
        
   }
   static function checkinfo()
   {
    $data=array();
    if(Session::has('loginId'))
    {
            $data= Users::where('id','=',Session::get('loginId'))->first();
            
    }
    return $data;
   }

}
