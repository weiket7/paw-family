<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductDesc;
use App\Models\Supplier;
use Illuminate\Http\Request;

class ProductController extends Controller
{
  public function index(Request $request)
  {
    $product_service = new Product();
    $category_service = new Category();
    $data['categories'] = $category_service->getCategoryForDropdown();
    $supplier_service = new Supplier();
    $data['suppliers'] = $supplier_service->getSupplierForDropdown();
    $brand_service = new Brand();
    $data['brands'] = $brand_service->getBrandForDropdown();
    $data['products'] = $product_service->getProductAll();
    return view("admin.product.index", $data);
  }

  public function save(Request $request, $product_id = null) {
    $product = Product::findOrNew($product_id);
    $action = $product_id == null ? 'create' : 'update';
    $category_service = new Category();
    if($request->isMethod('post')) {
      $input = $request->all();
      if (isset($input['delete']) && $input['delete'] == 'true') {
        $product->delete();
        $category_service->updateProductCount($product->category_id);
        return redirect('admin/product')->with('msg', 'Product deleted');
      }
      if (! $product->saveProduct($input, $request->file('image'))) {
        return redirect()->back()->withErrors($product->getValidation())->withInput($input);
      }
      if ($action == 'create') {
        $category_service->updateProductCount($product->category_id);
      }
      return redirect('admin/product/save/'.$product->product_id)->with('msg', 'Product ' . $action . "d");
    }

    $product_service = new Product();
    $data['product'] = $product_service->getProduct((int)$product_id);
    $data['categories'] = $category_service->getCategoryForDropdown();
    $supplier_service = new Supplier();
    $data['suppliers'] = $supplier_service->getSupplierForDropdown();
    $brand_service = new Brand();
    $data['brands'] = $brand_service->getBrandForDropdown();
    $data['action'] = $action;
    return view("admin.product.form", $data);
  }

  public function saveDesc(Request $request, $product_desc_id = null) {
    $product_desc = ProductDesc::findOrNew($product_desc_id);
    $action = $product_desc_id == null ? 'create' : 'update';

    if ($action == 'create')
      $product_desc->product_id = $_GET['product_id'];

    if($request->isMethod('post')) {
      $input = $request->all();
      if (isset($input['delete']) && $input['delete'] == 'true') {
        $product_desc->delete();
        return redirect('admin/product/save/'.$product_desc->product_id)->with('msg', 'Description deleted');
      }
      if (! $product_desc->saveProductDesc($input)) {
        return redirect()->back()->withErrors($product_desc->getValidation())->withInput($input);
      }
      return redirect('admin/product/desc/save/'.$product_desc->product_desc_id)->with('msg', 'Description ' . $action . "d");
    }
    $data['action'] = $action;
    $product_service = new Product();
    $data['product_name'] = $product_service->getProductName($product_desc->product_id);
    $data['product_desc'] = $product_desc;
    return view('admin.product.desc-form', $data);
  }
}