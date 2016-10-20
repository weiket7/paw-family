<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Enums\MainCategory;
use App\Models\Product;
use CommonHelper;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Input;

class ProductController extends Controller
{
  public function category($main_category, $slug) {
    $category_service = new Category();
    $category = Category::where('main_category', $main_category)->where('slug', $slug)->first();

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
    $data['current_main_category'] = $main_category;
    $data['current_category'] = $category->slug; //only in category
    $data['brands'] = $brand_service->getDistinctBrandByCategory($category->category_id);
    $data['selected_brand_ids'] = $selected_brand_ids;
    $data['breadcrumbs'] = ['Categories', $category->main_category, $category->name];

    return view("grid", $data)->withInput('input', Input::all());
  }

  public function brand($slugs) {
    $brand_service = new Brand();
    $brands = $brand_service->getBrandWithProductCountBySlug($slugs);
    $data['meta_desc'] = $brand_service->getBrandMetaDesc($slugs);
    $data['meta_keyword'] = $brand_service->getBrandMetaKeyword($slugs);
    $selected_brand_ids = CommonHelper::getIdFromArr($brands, 'brand_id');
    $product_service = new Product();
    $data['products'] = $product_service->getProductByBrand($selected_brand_ids);
    $category_service = new Category();

    $data['categories'] = $category_service->getCategoryAllForMenu();
    $data['current_main_category'] = "";
    $data['brands'] = $brands;
    $data['selected_brand_ids'] = $selected_brand_ids;
    $breadcrumb2 = implode(", ", array_pluck($brands, 'name'));
    $data['breadcrumbs'] = ['Brands', $breadcrumb2];
    return view("grid", $data);
  }

  public function view($slug) {
    $product_service = new Product();
    $product = $product_service->getProduct($slug);
    $data['product'] = $product;
    $data['products_you_may_like'] = $product_service->getProductsYouMayLike();
    return view("view", $data);
  }

  public function autocomplete() {
    $term = Input::get("query");

    $brand_service = new Brand();
    $data = $brand_service->searchBrandByTerm($term);

    $product_service = new Product();
    $data = array_merge($data, $product_service->searchProductByTerm($term));

    $res = [];
    foreach($data as $d) {
      $res[] = ['name'=>$d->name, 'link'=>$d->link];
    }
    return $res;
  }

}