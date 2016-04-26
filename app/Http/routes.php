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

Route::get('product/category/{slug}', 'ProductController@category');
Route::get('product/view/{slug}', 'ProductController@view');
Route::get('product/search', 'ProductController@search');
Route::get('product/autocomplete', 'ProductController@autocomplete');

Route::get('cart', 'SaleController@cart');
Route::get('checkout', 'SaleController@checkout');

Route::group(array('before'=>'admin'), function() {
  Route::get('admin', 'Admin\AdminController@index');
  Route::get('adopt/admin', 'AdoptController@admin');
  Route::get('adopt/last_update', 'AdoptController@lastUpdate');
});

Route::get('test', function() {
  return Hash::make("Pawpaw168");
  return str_slug("Addiction Raw Dehydrated - Figlicious Venison Feast (Grain Free)");
});

Route::get('clear-cache', function() {
  Cache::forget("categories_cache");
  Cache::forget("settings_cache");
  return "Cache cleared";
});
