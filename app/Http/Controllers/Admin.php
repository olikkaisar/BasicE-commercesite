<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Http\Requests;
use Session;
use Illuminate\Support\Facades\Redirect;
session_start();

class Admin extends Controller
{
   function index()
   {
       return view('admin.admin_login');
   }
    

    
   function dashboard(Request $request)
   {
       $Admin_email=$request->Admin_email;
       $Admin_password=md5($request->Admin_password);
       $result=DB::table('tbl_admin')
           ->where('admin_email',$Admin_email)
           ->where('admin_password',$Admin_password)
           ->first();
           
            if ($result){
               Session::put('admin_name',$result->admin_name);
               Session::put('admin_id',$result->admin_id);
               return Redirect::to('/dashboard');
           }
            else{
               Session::put('message','Email or password Invalid');
               return Redirect::to('/admin');
           }
       
   }

}
