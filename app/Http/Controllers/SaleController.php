<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
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
      $product = $product_service->getProduct((int)$c['product_id']);
      $products[] = (object)[
        'name'=>$product->name,
        'quantity'=>$c['quantity'],
        'price'=>$product->price,
        'image'=>$product->image,
        'discounted_price'=>$product->discounted_price,
      ];
    }
    $data['products'] = $products;
    //var_dump($cart);
    return view('cart', $data);
  }

  public function addToCart(Request $request) {
    $input = $request->all();
    $cart = $this->getCart();
    $cart[] = [
      'product_id'=>$input['product_id'],
      'quantity'=>$input['quantity']
    ];
    if (isset($input['size_id']))
      $cart['size_id']=$input['size_id'];
    if (isset($input['option_id']))
      $cart['option_id']=$input['option_id'];

    $request->session()->put('cart', $cart);
  }

  private function getCart() {
    return Session::has('cart') ? Session::get('cart') : [];
  }

}