<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Facades\Input;

class ProductController extends Controller
{
  public function category($slug) {
    $category_service = new Category();
    $category = $category_service->getCategoryBySlug($slug);
    $product_service = new Product();
    $data['products'] = $product_service->getProductByCategoryId($category->category_id);
    $data['category'] = $category;
    return view("category", $data);
  }

  public function view($slug) {
    $product_service = new Product();
    $product = $product_service->getProductBySlug($slug);
    $data['product'] = $product;
    return view("product-view", $data);
  }

  public function search() {
    $term = Input::get("query");
    $product_service = new Product();
    $data = $product_service->searchProduct($term);

    $res = [];
    foreach($data as $d) {
      $res["options"][] = $d->name;
    }
    return $res;
  }
}