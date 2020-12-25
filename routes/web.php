<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//frontend route.....
Route::get('/', 'HomeController@index');






//backend route..............
Route::get('logout','SuperAdminController@logout');
Route::get('admin', 'Admin@index');
Route::get('dashboard', 'SuperAdminController@index');
Route::post('dashboard', 'Admin@dashboard');


//Category route...............

Route::get('add_category','CategoryController@index');
Route::get('all_category','CategoryController@all_category');
Route::post('save-category','CategoryController@save_category');
Route::get('inactive_category/{category_id}','CategoryController@inactive_category');
Route::get('active_category/{category_id}','CategoryController@active_category');
Route::get('edit_category/{category_id}','CategoryController@edit_category');
Route::get('delete_category/{category_id}','CategoryController@delete_category');


//Brands route.................

Route::get('add_brands','BrandsController@index');
Route::post('save-brand','BrandsController@save_brand');
Route::get('all_brands','BrandsController@all_brands');
Route::get('inactive_brand/{brand_id}','BrandsController@inactive_brand');
Route::get('active_brand/{brand_id}','BrandsController@active_brand');
Route::get('delete_brand/{brand_id}','BrandsController@delete_brand');
Route::get('edit_brand/{brand_id}','BrandsController@edit_brand');


//Product route.................

Route::get('add_product','ProductController@index');
Route::post('save-product','ProductController@add_product');
Route::get('all_product','ProductController@all_product');
Route::get('inactive_product/{product_id}','productController@inactive_product');
Route::get('active_product/{product_id}','productController@active_product');
Route::get('delete_product/{product_id}','productController@delete_product');
Route::get('edit_product/{product_id}','productController@edit_product');

//slider route are here...........

Route::get('add_slider','SliderController@index');
Route::post('save-slider','SliderController@save_slider');
Route::get('all_slider','SliderController@all_slider');
Route::get('active_slider/{slider_id}','sliderController@active_slider');
Route::get('inactive_slider/{slider_id}','sliderController@inactive_slider');
Route::get('delete_slider/{slider_id}','sliderController@delete_slider');


//frontend route...............

Route::get('product_by_category/{category_id}','HomeController@show_product_by_category');
Route::get('product_by_brand/{brand_id}','HomeController@show_product_by_brand');
Route::get('/product_details/{product_id}','HomeController@product_details_by_id');

//cart route

Route::post('/add_to_cart','CartController@add_to_cart');
Route::get('/show_cart','CartController@show_cart');
Route::get('/delet_to_cart/{rowId}','CartController@delet_to_cart');
Route::post('/update_cart','CartController@update_cart');


//login route.............

Route::get('/login_check','CheckoutController@login_check');
Route::post('/customer_registration','CheckoutController@customer_registration');
Route::get('/checkout','CheckoutController@checkout');
Route::post('/save_shipping_details','CheckoutController@save_shipping_details');
Route::get('/payment','CheckoutController@payment');
Route::post('/order_place','CheckoutController@order_place');



//login route............

Route::get('/log_out','LoginController@log_out');
Route::post('/customer_login', 'LoginController@customer_login');


//manage order route

Route::get('/manage_order','OrderController@manage_order');
Route::get('/view_order/{order_id}','OrderController@view_order');
Route::get('/delete_order/{order_id}','OrderController@delete_order');

