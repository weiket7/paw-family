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
Route::get('product/category/{slug}', 'ProductController@category');
Route::get('product/view/{slug}', 'ProductController@view');

Route::group(array('before'=>'admin'), function() {
  Route::get('adopt/admin', 'AdoptController@admin');
  Route::get('adopt/last_update', 'AdoptController@lastUpdate');

});

Route::get('test', function() {
  return str_slug("Addiction Raw Dehydrated - Figlicious Venison Feast (Grain Free)");
});

Route::get('clear-cache', function() {
  Cache::forget("categories_cache");
  Cache::forget("settings_cache");
  return "Cache cleared";
});
