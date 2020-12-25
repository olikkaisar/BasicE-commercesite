<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Http\Requests;
use Session;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Str;
session_start();

class ProductController extends Controller
{
    function index()
    {
        $this->AdminAuthCheck();
    	return view('admin.add_product');
    }


    public function add_product (Request $request)
    {
        $data=array();
    	 $data['product_name']=$request->product_name;
         $data['category_id'] = $request->category_id;
         $data['brand_id'] = $request->brand_id;
         $data['product_short_description']=$request->product_short_description;
         $data['product_long_description']=$request->product_long_description;
         $data['product_price']=$request->product_price;
         $data['product_size']=$request->product_size;
         $data['product_color']=$request->product_color;
         $data['publication_status']=$request->publication_status;
         $image=$request->file('product_image');

         if($image){
         	$image_name=str_random(20);
         	$ext=strtolower($image->getClientOriginalExtension());
         	$image_full_name=$image_name. '.' .$ext;
         	$upload_path='image/';
         	$image_url=$upload_path.$image_full_name;
         	$succes=$image->move($upload_path,$image_full_name);

         	if ($succes){
         		$data['product_image']=$image_url;
         		DB::table('tbl_products')->insert($data);
         		Session::put('messege','product add successfully with image');
                return Redirect::to('/add_product');
         	}
         }

         $data['product_image']='';

         DB::table('tbl_products')->insert($data);
         Session::put('messege','product add successfully with out image');
         return Redirect::to('/add_product');
    }

    function all_product()
    {
        $this->AdminAuthCheck();
    	$all_product_info=DB::table('tbl_products')
                ->join('tbl_category','tbl_products.category_id','=','tbl_category.category_id')
                ->join('tbl_brands','tbl_products.brand_id','=','tbl_brands.brand_id')
                ->select('tbl_products.*', 'tbl_category.category_name','tbl_brands.brand_name')
                ->get();



        $manage_product=view('admin.all_product')
        ->with('all_product_info',$all_product_info);

        return view('admin_layout')
         ->with('admin.all_product',$manage_product);
    }

    function active_product($product_id)

    {
       DB::table('tbl_products')
         ->where('product_id',$product_id)
         ->update(['publication_status' => 1]);
         return Redirect ('/all_product');
    }

    public function inactive_product($product_id)

    {
        // echo $product_id;
       DB::table('tbl_products')
         ->where('product_id',$product_id)
         ->update(['publication_status' => 0]);
         return Redirect ('/all_product');
    }

    function delete_product($product_id)

    {
        DB::table('tbl_products')
            ->where('product_id',$product_id)
            ->delete();

        Session::put('messege','Product deleted sussesfully! ');
        return Redirect ('/all_product');
    }

    function edit_product($product_id)

     {
        return view ('admin.edit_product');
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
