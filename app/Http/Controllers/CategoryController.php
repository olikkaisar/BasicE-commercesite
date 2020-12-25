<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Http\Requests;
use Session;
use Illuminate\Support\Facades\Redirect;
session_start();

class CategoryController extends Controller
{
    function index()
    {
        $this->AdminAuthCheck();

        return view('admin.addd_category');
        
    }
    function all_category()
    {
        $this->AdminAuthCheck();

        $all_category_info=DB::table('tbl_category')->get();
        $manage_category=view('admin.all_category')
        ->with('all_category_info',$all_category_info);

        return view('admin_layout')
         ->with('admin.all_category',$manage_category);

        // return view('admin.all_category');
    }
     function save_category(Request $request)
    {
       $data=array();
         $data['product_id']=$request->product_id;
         $data['product_name']=$request->product_name;
         $data['product_description']=$request->product_description;
         $data['publication_status']=$request->publication_status;
         
        DB::table('tbl_category')->insert($data);
         Session::put('messege','Category add successfully');
         return Redirect::to('/add_category');
    }

     function inactive_category($category_id)

    {
       DB::table('tbl_category')
         ->where('category_id',$category_id)
         ->update(['publication_status' => 0]);
         return Redirect ('/all_category');
    }

     function active_category($category_id)

    {
       DB::table('tbl_category')
         ->where('category_id',$category_id)
         ->update(['publication_status' => 1]);
         return Redirect ('/all_category');
    }

     function edit_category($category_id)

     {
        return view ('admin.edit_category');
     }

     function delete_category($category_id)

    {
        DB::table('tbl_category')
            ->where('category_id',$category_id)
            ->delete();

        Session::put('messege','Category deleted sussesfully! ');
        return Redirect ('/all_category');
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
