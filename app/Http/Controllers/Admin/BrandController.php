<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use Illuminate\Http\Request;

class BrandController extends Controller
{
  public function index(Request $request) {
    $brands = Brand::all();
    if($request->isMethod('post')) {
      $brand_service = new Brand();
      $input = $request->all();
      $brand_service->updateBrandPos($brands, $input);
      return redirect('admin/brand')->with('msg', 'Brand positions updated');
    }
    $data['brands'] = $brands;
    return view("admin.brand.index", $data);
  }

  public function save(Request $request, $brand_id = null) {
    $brand = Brand::findOrNew($brand_id);
    $action = $brand_id == null ? 'create' : 'update';
    if($request->isMethod('post')) {
      $input = $request->all();
      if (isset($input['delete']) && $input['delete'] == 'true') {
        /*if ($brand->product_count > 0) {
          return redirect()->back()->withErrors(['product_count'=>'Brand cannot be deleted because there are products'])->withInput($input);
        }*/
        $brand->deleteBrand();
        return redirect('admin/brand')->with('msg', 'Brand deleted');
      }
      if (! $brand->saveBrand($input, $request->file('image'))) {
        return redirect()->back()->withErrors($brand->getValidation())->withInput($input);
      }

      return redirect('admin/brand/save/'.$brand->brand_id)->with('msg', 'Brand ' . $action . "d");
    }
    $data['action'] = $action;
    $data['brand'] = $brand;
    return view('admin/brand/form', $data);
  }
}