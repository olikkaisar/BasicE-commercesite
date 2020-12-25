<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Http\Requests;
use Session;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Str;
session_start();

class SliderController extends Controller
{
    public function index()
    {
    	return view ('admin.add_slider');
    }

    public function save_slider(Request $request)
    {
    	$data=array();
         $data['publication_status']=$request->publication_status;
         $image=$request->file('slider_image');

         if($image){
         	$image_name=str_random(20);
         	$ext=strtolower($image->getClientOriginalExtension());
         	$image_full_name=$image_name. '.' .$ext;
         	$upload_path='slider/';
         	$image_url=$upload_path.$image_full_name;
         	$succes=$image->move($upload_path,$image_full_name);

         	if ($succes){
         		$data['slider_image']=$image_url;
         		DB::table('tbl_slider')->insert($data);
         		Session::put('messege','slider add successfully with image');
                return Redirect::to('/add_slider');
         	}
         }

         $data['slider_image']='';

         DB::table('tbl_slider')->insert($data);
         Session::put('messege','slider add successfully with out image');
         return Redirect::to('/add_slider');
    }

    public function all_slider()
    {


        $all_slider_info=DB::table('tbl_slider')->get();
        $manage_slider=view('admin.all_slider')
        ->with('all_slider_info',$all_slider_info);

        return view('admin_layout')
         ->with('admin.all_slider',$manage_slider);
    }

    function inactive_slider($slider_id)

    {
       DB::table('tbl_slider')
         ->where('slider_id',$slider_id)
         ->update(['publication_status' => 0]);
         return Redirect ('/all_slider');
    }

    function active_slider($slider_id)

    {
       DB::table('tbl_slider')
         ->where('slider_id',$slider_id)
         ->update(['publication_status' => 1]);
         return Redirect ('/all_slider');
    }

    function delete_slider($slider_id)

    {
        DB::table('tbl_slider')
            ->where('slider_id',$slider_id)
            ->delete();

        Session::put('messege','slider deleted sussesfully! ');
        return Redirect ('/all_slider');
    }
}
