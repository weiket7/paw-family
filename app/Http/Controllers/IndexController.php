<?php

namespace App\Http\Controllers;

use App\Models\Product;

class IndexController extends Controller
{
  public function index() {
    $product_service = new Product();
    $data['products'] = $product_service->getProductFeatured();
    return view("index", $data);
  }
}