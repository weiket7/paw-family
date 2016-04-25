<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;

class SaleController extends Controller
{
  public function checkout() {

  }

  public function cart() {
    $cart = $this->getCart();
    $products = [];
    $product_service = new Product();
    foreach($cart as $c) {
      $products[] = $product_service->getProduct($c['product_id']);
    }
    $data['products'] = $products;
    //var_dump($cart);
    return view('cart', $data);
  }

  public function addToCart($product_id, $quantity, $size_id=0, $option_id=0) {
    $cart = $this->getCart();
    $cart[] = [
      'product_id'=>$product_id,
      'quantity'=>$quantity,
      'size_id'=>$size_id,
      'option_id'=>$option_id,
    ];
    Session::put('cart', $cart);
  }

  private function getCart() {
    return Session::has('cart') ? Session::get('cart') : [];
  }

}