<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
  public function index(Request $request)
  {
    $product_service = new Product();
    $data['products'] = $product_service->getProductAll();
    return view("admin.product.index", $data);
  }

  public function save(Request $request, $product_id = null) {
    $product = Product::findOrNew($product_id);
    $action = $product_id == null ? 'create' : 'update';
    if($request->isMethod('post')) {
      $input = $request->all();
      if (isset($input['delete']) && $input['delete'] == 'true') {
        $product->delete();
        return redirect('admin/product')->with('msg', 'Product deleted');
      }
      if (! $product->saveProduct($input, $request->file('image'))) {
        return redirect()->back()->withErrors($product->getValidation())->withInput($input);
      }
      return redirect('admin/product/save/'.$product->product_id)->with('msg', 'Product ' . $action . "d");
    }

    $product_service = new Product();
    $data['product'] = $product_service->getProduct((int)$product_id);
    $category_service = new Category();
    $data['categories'] = $category_service->getCategoryAllForMenu();
    $brand_service = new Brand();
    $data['brands'] = $brand_service->getBrandForDropdown();
    $data['action'] = ($product_id == null || $product_id == 0) ? "create" : "update";
      return view("admin.product.form", $data);
  }
}