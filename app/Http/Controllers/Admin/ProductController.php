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

  public function save($product_id = null) {
    $product_service = new Product();
    $data['product'] = $product_service->getProduct((int)$product_id);
    $category_service = new Category();
    $data['categories'] = $category_service->getCategoryAllForMenu();
    $brand_service = new Brand();
    $data['brands'] = $brand_service->getBrandForDropdown();
    return view("admin.product.form", $data);
  }
}