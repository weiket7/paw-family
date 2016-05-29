<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProductOption;
use App\Models\Product;
use App\Models\ProductSize;
use CommonHelper;
use Illuminate\Http\Request;

class OptionController extends Controller
{
  public function save(Request $request, $option_id = null) {
    $option = ProductOption::findOrNew($option_id);
    $action = $option_id == null ? 'create' : 'update';
    if ($action == 'create') {
      $option->product_id = $_GET['product_id'];
    }

    if($request->isMethod('post')) {
      $input = $request->all();
      if (isset($input['delete']) && $input['delete'] == 'true') {
        $option->delete();
        return redirect('admin/product/save/'.$option->product_id)->with('msg', 'Repack deleted');
      }
      if (! $option->saveOption($input)) {
        return redirect()->back()->withErrors($option->getValidation())->withInput($input);
      }
      return redirect('admin/product/option/save/'.$option->option_id)->with('msg', 'Repack ' . $action . "d");
    }
    $data['action'] = $action;
    $size_service = new ProductSize();
    $data['size_name'] = $size_service->getSizeName($option->size_id);
    //var_dump($option);
    $product_service = new Product();
    $data['product_name'] = $product_service->getProductName($option->product_id);
    $data['sizes'] = CommonHelper::arrayForDropdown($product_service->getProductSize($option->product_id), 'size_id', 'name');
    $data['option'] = $option;
    return view('admin/product/option-form', $data);
  }
}