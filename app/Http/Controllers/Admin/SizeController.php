<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductSize;
use Illuminate\Http\Request;

class SizeController extends Controller
{
  public function save(Request $request, $size_id = null) {
    $size = ProductSize::findOrNew($size_id);
    $action = $size_id == null ? 'create' : 'update';
    if ($action == 'create')
      $size->product_id = $_GET['product_id'];

    if($request->isMethod('post')) {
      $input = $request->all();
      if (isset($input['delete']) && $input['delete'] == 'true') {
        $size->delete();
        return redirect('admin/product/save/'.$size->product_id)->with('msg', 'Size deleted');
      }
      if (! $size->saveSize($input)) {
        return redirect()->back()->withErrors($size->getValidation())->withInput($input);
      }
      return redirect('admin/product/size/save/'.$size->size_id)->with('msg', 'Size ' . $action . "d");
    }
    $data['action'] = $action;
    $product_service = new Product();
    $data['product_name'] = $product_service->getProductName($size->product_id);
    $data['size'] = $size;
    return view('admin.product.size-form', $data);
  }
}