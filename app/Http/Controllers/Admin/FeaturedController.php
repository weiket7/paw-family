<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Featured;
use App\Models\Product;
use Illuminate\Http\Request;

class FeaturedController extends Controller
{
  public function index(Request $request) {
    $featured_service = new Featured();
    $data['featured'] =$featured_service->getFeaturedAll();
    return view('admin/featured/index', $data);
  }


  public function save(Request $request, $featured_id = null) {
    $featured = Featured::findOrNew($featured_id);
    $action = $featured_id == null ? 'create' : 'update';
    if($request->isMethod('post')) {
      $input = $request->all();
      if (! $featured->saveFeatured($input, $request->file('image'))) {
        return redirect()->back()->withErrors($featured->getValidation())->withInput($input);
      }
      return redirect('admin/featured/save/'.$featured->featured_id)->with('msg', 'Featured ' . $action . "d");
    }
    $product_service = new Product();
    $data['products'] = $product_service->getProductForDropown();
    $data['action'] = $action;
    $data['featured'] = $featured;
    return view('admin/featured/form', $data);
  }
}