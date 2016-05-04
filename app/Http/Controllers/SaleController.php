<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class SaleController extends Controller
{
  public function checkout() {
    $cart = $this->getCartFromSession();
    $data['products'] = $cart->checkOut();
    return view('cart', $data);
  }

  public function cart() {
    $cart = $this->getCartFromSession();
    $data['products'] = $cart->checkOut();
    return view('cart', $data);
  }

  public function addToCart(Request $request) {
    $products = $this->getCartFromSession();
    $cart = new Cart();
    $input = $request->all();
    $cart->addToCart($input['product_id'], $input['quantity'], $input['size_id'], $input['option_id']);
    $this->setCartToSession($products);
  }

  private function getCartFromSession() {
    return Session::has('cart') ? Session::get('cart') : [];
  }

  private function setCartToSession($products) {
    Session::put('cart', $products);
  }

}