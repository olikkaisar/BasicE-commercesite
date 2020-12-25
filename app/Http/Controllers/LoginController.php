<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Http\Requests;
use Session;
use Illuminate\Support\Facades\Redirect;
use Auth;
session_start();

class LoginController extends Controller
{
    public function log_out()
    {
    	Auth::logout();
	    Session::flush();
	    return Redirect::to('/');
    }

    public function customer_login(Request $request)
   {
       $customer_email=$request->customer_email;
       $password=md5($request->password);
       $login_result=DB::table('tbl_customer')
           ->where('customer_email',$customer_email)
           ->where('password',$password)
           ->first();

           // echo "<pre>";
           // print_r($login_result);
           // echo "</pre>";
           
            if ($login_result){
               Session::put('customer_name',$login_result->customer_name);
               Session::put('customer_id',$login_result->customer_id);
               return Redirect::to('/');
           }
            else{
               Session::put('message','Email or password Invalid');
               return Redirect::to('/login_check');
           }
       
   }
}
