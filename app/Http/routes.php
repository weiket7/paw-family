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

use App\Models\Cart;
use App\Models\Enums\PaymentType;
use App\Models\Sale;

Route::get('/', 'SiteController@index');
Route::get('brands', 'SiteController@brand');
Route::get('contact', 'SiteController@contact');

Route::get('product/category/{slug}', 'ProductController@category');
Route::get('product/view/{slug}', 'ProductController@view');
Route::get('product/search', 'ProductController@search');
Route::get('product/autocomplete', 'ProductController@autocomplete');

Route::post('login', 'SiteController@login');
Route::get('forgot-password', 'SiteController@forgotPassword');
Route::get('logout', 'SiteController@logout');
Route::get('register', 'SiteController@register');
Route::post('register', 'SiteController@register');

Route::group(['middleware'=>'auth'], function() {
  Route::get('account', 'SiteController@account');
  Route::post('account', 'SiteController@account');
  Route::get('order/{sale_no}', 'SiteController@order');
  Route::post('order/{sale_no}', 'SiteController@order');
});

Route::post('add-to-cart', 'SaleController@addToCart');
Route::get('checkout', 'SaleController@checkout');

Route::get('admin', 'Admin\AdminController@login');
Route::post('admin', 'Admin\AdminController@login');

Route::group(['middleware'=>'auth_operator'], function() {
  Route::get('admin/dashboard', 'Admin\AdminController@dashboard');

  Route::get('admin/customer', 'Admin\CustomerController@index');
  Route::post('admin/customer', 'Admin\CustomerController@index');
  Route::get('admin/customer/save/{customer_id}', 'Admin\CustomerController@save');
  Route::post('admin/customer/save/{customer_id}', 'Admin\CustomerController@save');

  Route::get('admin/product', 'Admin\ProductController@index');
  Route::post('admin/product', 'Admin\ProductController@index');
  Route::get('admin/product/save', 'Admin\ProductController@save');
  Route::post('admin/product/save', 'Admin\ProductController@save');
  Route::get('admin/product/save/{product_id}', 'Admin\ProductController@save');
  Route::post('admin/product/save/{product_id}', 'Admin\ProductController@save');

  Route::get('admin/product/size/save', 'Admin\SizeController@save');
  Route::post('admin/product/size/save', 'Admin\SizeController@save');
  Route::get('admin/product/size/save/{size_id}', 'Admin\SizeController@save');
  Route::post('admin/product/size/save/{size_id}', 'Admin\SizeController@save');

  Route::get('admin/product/desc/save', 'Admin\ProductController@saveDesc');
  Route::post('admin/product/desc/save', 'Admin\ProductController@saveDesc');
  Route::get('admin/product/desc/save/{product_desc_id}', 'Admin\ProductController@saveDesc');
  Route::post('admin/product/desc/save/{product_desc_id}', 'Admin\ProductController@saveDesc');

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

  Route::get('admin/product/option', 'Admin\OptionController@index');
  Route::get('admin/product/option/save', 'Admin\OptionController@save');
  Route::post('admin/product/option/save', 'Admin\OptionController@save');
  Route::get('admin/product/option/save/{option_id}', 'Admin\OptionController@save');
  Route::post('admin/product/option/save/{option_id}', 'Admin\OptionController@save');
});

Route::get('test2', function() {
  var_dump(Session::get("cart"));
});

Route::get("cart2", function() {
  $cart = new Cart();
  $cart->addToCart(1, 1, 2, 2);
  $cart->addToCart(2, 2);
  $products = $cart->getCart();
  var_dump($products);

  $sale_service = new Sale();
  $customer_id = 1;
  $payment_type = PaymentType::Bank;
  $sale = $sale_service->checkoutCart($customer_id, $payment_type, $products);
  var_dump($sale);
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
  Session::flush("cart");
  return "Cache cleared";
});
