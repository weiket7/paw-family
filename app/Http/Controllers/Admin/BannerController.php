<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use Illuminate\Http\Request;

class BannerController extends Controller
{
  public function index(Request $request) {
    $data['banners'] = Banner::all();
    return view("admin/banner.index", $data);
  }

  public function save(Request $request, $banner_id = null) {
    $banner = Banner::findOrNew($banner_id);
    $action = $banner_id == null ? 'create' : 'update';
    if($request->isMethod('post')) {
      $input = $request->all();
      if (! $banner->saveBanner($input, $request->file('image'))) {
        return redirect()->back()->withErrors($banner->getValidation())->withInput($input);
      }
      return redirect('admin/banner/save/'.$banner->banner_id)->with('msg', 'Banner ' . $action . "d");
    }
    $data['action'] = $action;
    $data['banner'] = $banner;
    return view('admin/banner/form', $data);
  }
}