<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', 'IndexController@index');
Route::get('brands', 'IndexController@brand');
Route::get('contact', 'IndexController@contact');
Route::get('login', 'IndexController@login');
Route::get('register', 'IndexController@register');
Route::get('login', 'IndexController@login');

Route::get('product/category/{slug}', 'ProductController@category');
Route::get('product/view/{slug}', 'ProductController@view');
Route::get('product/search', 'ProductController@search');
Route::get('product/autocomplete', 'ProductController@autocomplete');

Route::get('cart', 'SaleController@cart');
Route::get('checkout', 'SaleController@checkout');

Route::get('admin', 'Admin\AdminController@login');
Route::post('admin', 'Admin\AdminController@login');

Route::group(['middleware'=>'auth_operator'], function() {
  Route::get('admin/dashboard', 'Admin\AdminController@dashboard');

  Route::get('admin/customer', 'Admin\CustomerController@index');
  Route::get('admin/customer/save/{customer_id}', 'Admin\CustomerController@save');
  Route::post('admin/customer/save/{customer_id}', 'Admin\CustomerController@save');

  Route::get('admin/product', 'Admin\ProductController@index');
  Route::get('admin/product/save', 'Admin\ProductController@save');
  Route::post('admin/product/save', 'Admin\ProductController@save');
  Route::get('admin/product/save/{product_id}', 'Admin\ProductController@save');
  Route::post('admin/product/save/{product_id}', 'Admin\ProductController@save');

  Route::get('admin/size/save', 'Admin\SizeController@save');
  Route::post('admin/size/save', 'Admin\SizeController@save');
  Route::get('admin/size/save/{size_id}', 'Admin\SizeController@save');
  Route::post('admin/size/save/{size_id}', 'Admin\SizeController@save');

  Route::get('admin/brand', 'Admin\BrandController@index');
  Route::get('admin/brand/save', 'Admin\BrandController@save');
  Route::post('admin/brand/save', 'Admin\BrandController@save');
  Route::get('admin/brand/save/{brand_id}', 'Admin\BrandController@save');
  Route::post('admin/brand/save/{brand_id}', 'Admin\BrandController@save');

  Route::get('admin/category', 'Admin\CategoryController@index');
  Route::get('admin/category/save', 'Admin\CategoryController@save');
  Route::post('admin/category/save', 'Admin\CategoryController@save');
  Route::get('admin/category/save/{category_id}', 'Admin\CategoryController@save');
  Route::post('admin/category/save/{category_id}', 'Admin\CategoryController@save');

  Route::get('admin/option', 'Admin\OptionController@index');
  Route::get('admin/option/save', 'Admin\OptionController@save');
  Route::post('admin/option/save', 'Admin\OptionController@save');
  Route::get('admin/option/save/{option_id}', 'Admin\OptionController@save');
  Route::post('admin/option/save/{option_id}', 'Admin\OptionController@save');
});

Route::get('test', function() {
  $pass = "test168";
  $salt = "Gq";
  $encryptedPass = md5($salt.$pass).":".$salt;
  echo $encryptedPass;
  $expectedPass = "4bb6c925ec104715a2ca6ec85e79e66d:Gq";
  echo "<br>";
  echo $expectedPass;
  echo "<br>";
  $str = "password";
  $salt="Dr";
  $pass= md5($salt.$str).":".$salt;
  echo $pass; // the out put will be  fa23eb07d1c851f81707f4f649cb2c42:Dr
  //return Hash::make("Pawpaw168");
  //return str_slug("Addiction Raw Dehydrated - Figlicious Venison Feast (Grain Free)");
});

Route::get('clear-cache', function() {
  Cache::forget("categories_cache");
  Cache::forget("settings_cache");
  return "Cache cleared";
});
