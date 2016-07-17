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
use App\Models\Customer;
use App\Models\Entities\CheckoutOption;
use App\Models\Entities\SaleProduct;
use App\Models\Enums\CustomerStat;
use App\Models\Enums\DeliveryChoice;
use App\Models\Enums\DeliveryTime;
use App\Models\Enums\PaymentType;
use App\Models\ProductSize;
use App\Models\Sale;

Route::get('/', 'SiteController@index');
Route::get('brands', 'SiteController@brand');
Route::get('contact', 'SiteController@contact');
Route::post('contact', 'SiteController@contact');
Route::get('terms-and-conditions', 'SiteController@termsandconditions');
Route::get('cbd-area', 'SiteController@cbdArea');

Route::get('product/category/{main_category}/{slug}', 'ProductController@category');
Route::get('product/brand/{slug}', 'ProductController@brand');
Route::get('product/view/{slug}', 'ProductController@view');
Route::get('product/search', 'ProductController@search');
Route::get('product/autocomplete', 'ProductController@autocomplete');

Route::post('login', 'SiteController@login');
Route::get('reset-password', 'SiteController@resetPassword');
Route::get('forgot-password', 'SiteController@forgotPassword');
Route::post('forgot-password', 'SiteController@forgotPassword');
Route::get('logout', 'SiteController@logout');
Route::get('register', 'SiteController@register');
Route::post('register', 'SiteController@register');

Route::group(['middleware'=>'auth'], function() {
  Route::get('account', 'AccountController@account');
  Route::get('paypal-process', 'SaleController@paypalProcess');
  Route::get('paypal-cancel', 'SaleController@paypalCancel');
  Route::get('paypal-success', 'SaleController@paypalSuccess');
  Route::post('account', 'AccountController@account');
  Route::get('order/{sale_no}', 'AccountController@order');
  Route::post('order/{sale_no}', 'AccountController@order');
});

Route::get('get-cart', 'SaleController@getCart');
Route::post('add-to-cart', 'SaleController@addToCart');
Route::get('update-cart', 'SaleController@updateCart');
Route::post('update-cart', 'SaleController@updateCart');
Route::post('remove-from-cart', 'SaleController@removeFromCart');
Route::post('test', 'SaleController@test');

Route::get('checkout', 'SaleController@checkout');
Route::post('checkout', 'SaleController@checkout');
Route::get('checkout-success', 'SaleController@checkoutSuccess');

Route::get('admin', 'Admin\AdminController@login');
Route::post('admin', 'Admin\AdminController@login');

Route::group(['middleware'=>'auth_operator'], function() {
  Route::get('admin/dashboard', 'Admin\AdminController@dashboard');

  Route::get('admin/sale', 'Admin\SaleController@index');
  Route::post('admin/sale', 'Admin\SaleController@index');
  Route::get('admin/sale/save/{sale_id}', 'Admin\SaleController@save');
  Route::post('admin/sale/save/{sale_id}', 'Admin\SaleController@save');

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
  Route::get('admin/product/desc/save/{desc_id}', 'Admin\ProductController@saveDesc');
  Route::post('admin/product/desc/save/{desc_id}', 'Admin\ProductController@saveDesc');

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

  Route::get('admin/supplier', 'Admin\SupplierController@index');
  Route::get('admin/supplier/save', 'Admin\SupplierController@save');
  Route::post('admin/supplier/save', 'Admin\SupplierController@save');
  Route::get('admin/supplier/save/{supplier_id}', 'Admin\SupplierController@save');
  Route::post('admin/supplier/save/{supplier_id}', 'Admin\SupplierController@save');

  Route::get('admin/product/option', 'Admin\OptionController@index');
  Route::get('admin/product/option/save', 'Admin\OptionController@save');
  Route::post('admin/product/option/save', 'Admin\OptionController@save');
  Route::get('admin/product/option/save/{option_id}', 'Admin\OptionController@save');
  Route::post('admin/product/option/save/{option_id}', 'Admin\OptionController@save');

  Route::get('admin/featured', 'Admin\FeaturedController@index');
  Route::get('admin/featured/save', 'Admin\FeaturedController@save');
  Route::post('admin/featured/save', 'Admin\FeaturedController@save');
  Route::get('admin/featured/save/{featured_id}', 'Admin\FeaturedController@save');
  Route::post('admin/featured/save/{featured_id}', 'Admin\FeaturedController@save');

  Route::get('admin/banner', 'Admin\BannerController@index');
  Route::get('admin/banner/save/{banner_id}', 'Admin\BannerController@save');
  Route::post('admin/banner/save/{banner_id}', 'Admin\BannerController@save');

  Route::get('admin/setting', 'Admin\SettingController@index');
  Route::get('admin/setting/save/{setting_id}', 'Admin\SettingController@save');
  Route::post('admin/setting/save/{setting_id}', 'Admin\SettingController@save');
  Route::get('admin/setting/config', 'Admin\SettingController@config');

  Route::get('admin/delivery', 'Admin\DeliveryController@index');
  Route::post('admin/delivery', 'Admin\DeliveryController@index');
  Route::get('admin/district-postal', 'Admin\SettingController@districtPostal');
  Route::post('admin/district-postal', 'Admin\SettingController@districtPostal');

  Route::get('admin/report/sales', 'Admin\ReportController@sales');
  Route::post('admin/report/sales', 'Admin\ReportController@sales');
});

Route::get('test', function() {
  $postal = '250134';
  $postal = substr($postal, 0, 2);
  
  echo $postal;
  //echo 'gross_total='.$gross_total.' nett_total='.$nett_total.' cost_total='.$cost_total;
});

Route::get('hash', function() {
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
