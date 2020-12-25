<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;

class HomeController extends Controller
{
    function index()
    {
    	$all_published_product=DB::table('tbl_products')
                ->join('tbl_category','tbl_products.category_id','=','tbl_category.category_id')
                ->join('tbl_brands','tbl_products.brand_id','=','tbl_brands.brand_id')
                ->select('tbl_products.*', 'tbl_category.category_name','tbl_brands.brand_name')
                ->where('tbl_products.publication_status',1)
                ->limit(6)
                ->get();
        $manage_published_product=view('pages.home_content')
        ->with('all_published_product',$all_published_product);

        return view('layout')
         ->with('pages.home_content',$manage_published_product); 
        //return view('pages.home_content');
    }

    public function show_product_by_category($category_id)
    {
        $product_by_category=DB::table('tbl_products')
                ->join('tbl_category','tbl_products.category_id','=','tbl_category.category_id')
                ->join('tbl_brands','tbl_products.brand_id','=','tbl_brands.brand_id')
                ->select('tbl_products.*', 'tbl_category.category_name','tbl_brands.brand_name')
                ->where('tbl_category.category_id', $category_id)
                ->where('tbl_products.publication_status',1)
                ->limit(18)
                ->get();
        $manage_product_by_category=view('pages.category_by_product')
        ->with('product_by_category',$product_by_category);

        return view('layout')
         ->with('pages.category_by_product',$manage_product_by_category);
    }

    public function show_product_by_brand($brand_id)
    {
        $product_by_brand=DB::table('tbl_products')
                ->join('tbl_category','tbl_products.category_id','=','tbl_category.category_id')
                ->join('tbl_brands','tbl_products.brand_id','=','tbl_brands.brand_id')
                ->select('tbl_products.*', 'tbl_category.category_name','tbl_brands.brand_name')
                ->where('tbl_brands.brand_id', $brand_id)
                ->where('tbl_products.publication_status',1)
                ->limit(18)
                ->get();
        $manage_product_by_brand=view('pages.product_by_brand')
        ->with('product_by_brand',$product_by_brand);

        return view('layout')
         ->with('pages.product_by_brand',$manage_product_by_brand);
    }

    public function product_details_by_id($product_id)
    {
        $product_by_details=DB::table('tbl_products')
                ->join('tbl_category','tbl_products.category_id','=','tbl_category.category_id')
                ->join('tbl_brands','tbl_products.brand_id','=','tbl_brands.brand_id')
                ->select('tbl_products.*', 'tbl_category.category_name','tbl_brands.brand_name')
                ->where('tbl_products.product_id', $product_id)
                ->where('tbl_products.publication_status',1)
                ->first();
        $manage_product_by_details=view('pages.product_details')
        ->with('product_by_details',$product_by_details);

        return view('layout')
         ->with('pages.product_details',$manage_product_by_details);
    }
}
