<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Facades\Input;

class ProductController extends Controller
{
  public function category($slug) {
    $category_service = new Category();
    $category = $category_service->getCategoryBySlug($slug);

    $brand_service = new Brand();
    $product_service = new Product();
    if (Input::has("brands")) {
      $selected_brand_slugs = Input::get("brands");
      $selected_brand_slugs = explode(",", $selected_brand_slugs);
      $selected_brand_ids = $brand_service->getBrandIdBySlug($selected_brand_slugs);
      $data['products'] = $product_service->getProductByCategoryAndBrand($category->category_id, $selected_brand_ids);
      $data['selected_brand_ids'] = $selected_brand_ids;
    } else {
      $data['products'] = $product_service->getProductByCategory($category->category_id);
    }

    $data['category'] = $category;
    $data['brands'] = $brand_service->getDistinctBrandByCategory($category->category_id);
    return view("category", $data);
  }

  public function view($slug) {
    $product_service = new Product();
    $product = $product_service->getProduct($slug);
    $data['product'] = $product;
    return view("view", $data);
  }

  public function search() {
    $data = [];
    return view("search", $data);
  }

  public function autocomplete() {
    $term = Input::get("query");
    $product_service = new Product();
    $data = $product_service->searchProduct($term);

    $res = [];
    foreach($data as $d) {
      $res[] = ['name'=>$d->name, 'slug'=>$d->slug];
    }
    return $res;
  }
}