<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Product;

class IndexController extends Controller
{
  public function index() {
    $product_service = new Product();
    $data['products'] = $product_service->getProductFeatured();
    return view("index", $data);
  }

  public function brand() {
    $data['brands'] = Brand::all();
    return view("brand");
  }

  public function contact() {
    return view("contact");
  }

  public function login() {
    return view("login");
  }

  public function register() {
    return view("register");
  }
}