<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Enums\MainCategory;
use App\Models\Product;
use CommonHelper;
use Illuminate\Support\Facades\Input;

class ProductController extends Controller
{
  public function category($slug) {
    $category_service = new Category();
    $category = $category_service->getCategoryBySlug($slug);

    $brand_service = new Brand();
    $product_service = new Product();
    $selected_brand_ids = [];
    if (Input::has("brands")) {
      $selected_brand_slugs = Input::get("brands");
      $brands = Brand::whereIn("slug", explode(",", $selected_brand_slugs))->get();
      $selected_brand_ids = CommonHelper::getIdFromArr($brands, 'brand_id');
      $data['products'] = $product_service->getProductByCategoryAndBrand($category->category_id, $selected_brand_ids);
    } else {
      $data['products'] = $product_service->getProductByCategory($category->category_id);
    }
    $data['categories'] = $category_service->getCategoryAllForMenu();
    $data['current_main_category'] = MainCategory::$values[$category->main_category];
    $data['breadcrumbs'] = ['Categories', MainCategory::$values[$category->main_category], $category->name];
    $data['brands'] = $brand_service->getDistinctBrandByCategory($category->category_id);
    $data['selected_brand_ids'] = $selected_brand_ids;

    return view("product-category", $data);
  }

  public function brand($slug) {
    $product_service = new Product();
    if (Input::has("brands")) {
      $selected_brand_slugs = Input::get("brands");
      $brands = Brand::whereIn("slug", explode(",", $selected_brand_slugs))->get();
      $selected_brand_ids = CommonHelper::getIdFromArr($brands, 'brand_id');
      $data['products'] = $product_service->getProductByBrand($selected_brand_ids);
      $data['breadcrumbs'] = ['Brands', '123'];
      $data['selected_brand_ids'] = $selected_brand_ids;
    } else {
      $brand = Brand::where("slug", $slug)->first();
      $data['selected_brand_ids'] = [$brand->brand_id];
      $data['products'] = $product_service->getProductByBrand($brand->brand_id);
      $data['breadcrumbs'] = [$brand->name];
    }
    $data['brands'] = CommonHelper::arrayForDropdown(Brand::all(), 'brand_id', 'name', false);
    return view("product-brand", $data);
  }

  public function view($slug) {
    $product_service = new Product();
    $product = $product_service->getProduct($slug);
    $data['product'] = $product;
    return view("view", $data);
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