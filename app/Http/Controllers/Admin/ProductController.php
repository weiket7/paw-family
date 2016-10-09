<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductDesc;
use App\Models\ProductSize;
use App\Models\Supplier;
use Illuminate\Http\Request;

class ProductController extends Controller
{
  public function index(Request $request) {
    $product_service = new Product();
    $msg = '';
    if($request->isMethod('post') && $request->get('submit') == 'Delete') {
      $product_ids = $request->get('product_id');
      $product_service->deleteProducts($product_ids);
      $msg .= 'Products were deleted. ';
    }
    if($request->isMethod('post')) {
      $input = $request->all();
      $products = $product_service->searchProduct($input);
      $request->flash();
      $msg .= "Showing ".count($products)." products";
    } else {
      $products = $product_service->getProductAll();
      $msg .= "Showing last updated ".count($products)." products";
    }
    $request->session()->flash('search_result', $msg);

    $category_service = new Category();
    $data['categories'] = $category_service->getCategoryForDropdown();
    $supplier_service = new Supplier();
    $data['suppliers'] = $supplier_service->getSupplierForDropdown();
    $brand_service = new Brand();
    $data['brands'] = $brand_service->getBrandForDropdown();
    $data['products'] = $products;
    return view("admin.product.index", $data);
  }

  public function save(Request $request, $product_id = null) {
    $action = $product_id == null ? 'create' : 'update';
    if($request->isMethod('post')) {
      $input = $request->all();
      $product = Product::findOrNew($product_id);

      if (isset($input['delete']) && $input['delete'] == 'true') {
        $product->delete();
        $product->updateProductCount($product->product_id); //delete then update product count
        return redirect('admin/product')->with('msg', 'Product deleted');
      }

      $prev_supplier_id = $product->supplier_id;
      $prev_category_id = $product->category_id;
      $prev_brand_id = $product->brand_id;

      $product_size_service = new ProductSize();
      $product_size_service->saveSizePos($product_id, $input);

      if (! $product->saveProduct($input, $request->file('image'))) {
        return redirect()->back()->withErrors($product->getValidation())->withInput($input);
      }
      $product->updateProductCount($product->product_id, $prev_brand_id, $prev_category_id, $prev_supplier_id); //update then update product count

      return redirect('admin/product/save/'.$product->product_id)->with('msg', 'Product ' . $action . "d");
    }

    $product_service = new Product();

    if ($action == 'create') {
      $product = new Product();
      $product->sizes = [];
      $product->descs = [];
    } else {
      $product = $product_service->getProduct((int)$product_id);
    }
    $data['product'] = $product;
    $category_service = new Category();
    $data['categories'] = $category_service->getCategoryForDropdown();
    $supplier_service = new Supplier();
    $data['suppliers'] = $supplier_service->getSupplierForDropdown();
    $brand_service = new Brand();
    $data['brands'] = $brand_service->getBrandForDropdown();
    $data['action'] = $action;
    return view("admin.product.form", $data);
  }

  public function saveDesc(Request $request, $desc_id = null) {
    $product_desc = ProductDesc::findOrNew($desc_id);
    $action = $desc_id == null ? 'create' : 'update';

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
      return redirect('admin/product/desc/save/'.$product_desc->desc_id)->with('msg', 'Description ' . $action . "d");
    }
    $data['action'] = $action;
    $data['product'] = Product::find($product_desc->product_id);
    $data['product_desc'] = $product_desc;
    return view('admin.product.desc-form', $data);
  }
}