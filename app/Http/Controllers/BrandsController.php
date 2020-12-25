<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Http\Requests;
use Session;
use Illuminate\Support\Facades\Redirect;
session_start();

class BrandsController extends Controller
{
	function index()
	{
        $this->AdminAuthCheck();
		return view ('admin.add_brands');
	}

	function save_brand(Request $request)
	{
		 $data=array();
         $data['brand_id']=$request->_id;
         $data['brand_name']=$request->brand_name;
         $data['brand_description']=$request->brand_description;
         $data['publication_status']=$request->publication_status;
         
         DB::table('tbl_brands')->insert($data);
         Session::put('messege','brand add successfully');
         return Redirect::to('/add_brands');
	}

	function all_brands()
	{
        $this->AdminAuthCheck();
		$all_brand_info=DB::table('tbl_brands')->get();
        $manage_brand=view('admin.all_brands')
        ->with('all_brand_info',$all_brand_info);

        return view('admin_layout')
         ->with('admin.all_brands',$manage_brand);

		
	}

	  function inactive_brand($brand_id)

    {
       DB::table('tbl_brands')
         ->where('brand_id',$brand_id)
         ->update(['publication_status' => 0]);
         return Redirect ('/all_brands');
    }

         function active_brand($brand_id)

    {
       DB::table('tbl_brands')
         ->where('brand_id',$brand_id)
         ->update(['publication_status' => 1]);
         return Redirect ('/all_brands');
    }

       function delete_brand($brand_id)

    {
        DB::table('tbl_brands')
            ->where('brand_id',$brand_id)
            ->delete();

        Session::put('messege','brand deleted sussesfully! ');
        return Redirect ('/all_brands');
    }


     function edit_brand($brand_id)

     {
        return view ('admin.edit_brand');
     }

    public function AdminAuthCheck()
    {
        $admin_id=Session::get('admin_id');
        if ($admin_id) {
            return;
        }else
        {
            return Redirect::to('/admin')->send();
        }
    }
}
