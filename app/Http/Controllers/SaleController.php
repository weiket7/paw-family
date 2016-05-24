<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Customer;
use App\Models\DeliveryOption;
use App\Models\Enums\PaymentType;
use App\Models\Sale;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Symfony\Component\Routing\Tests\Fixtures\RedirectableUrlMatcher;

class SaleController extends Controller
{
  public function checkout(Request $request) {
    $products = $this->getCartFromSession();

    if ($request->isMethod('post')) {
      $sale = new Sale();
      $customer_id = Auth::id();
      $input = $request->all();
      $delivery_option = $this->makeDeliveryOption($input);
      var_dump($delivery_option);
      $sale->checkoutCart($customer_id, $delivery_option, $products);
    }
    $data['products'] = $products;

    $customer_id = Auth::id();
    $data['customer'] = Customer::find($customer_id);
    return view('checkout', $data);
  }

  private function makeDeliveryOption($input) {
    $delivery_option = new DeliveryOption();
    $delivery_option->payment_type = $input['payment_type'];
    $delivery_option->delivery_choice = $input['delivery_choice'];
    $delivery_option->address_other = $input['address_other'];
    $delivery_option->customer_remark = $input['customer_remark'];
    $delivery_option->delivery_time = $input['delivery_time'];
    $delivery_option->gift_wrap = isset($input['gift_wrap']) ? "Y" : "N";
    $delivery_option->leave_outside_door = isset($input['leave_outside_door']) ? "Y" : "N";
    return $delivery_option;
  }

  public function updateCart(Request $request) {
    $products = $this->getCartFromSession();
    $cart = new Cart();
    $cart->setCart($products);
    $input = $request->all();
    $size_id = isset($input['size_id']) ? $input['size_id'] : 0;
    $option_id = isset($input['option_id']) ? $input['option_id'] : 0;
    $cart->updateCart($input['product_id'], $input['quantity'], $size_id, $option_id);
    $this->setCartToSession($cart->getCart());
  }

  public function addToCart(Request $request) {
    $products = $this->getCartFromSession();
    $cart = new Cart();
    $cart->setCart($products);
    $input = $request->all();
    $size_id = isset($input['size_id']) ? $input['size_id'] : 0;
    $option_id = isset($input['option_id']) ? $input['option_id'] : 0;
    $cart->addToCart($input['product_id'], $input['quantity'], $size_id, $option_id);
    $this->setCartToSession($cart->getCart());
  }

  public function removeFromCart(Request $request) {
    $products = $this->getCartFromSession();
    $cart = new Cart();
    $cart->setCart($products);
    $input = $request->all();
    $cart->removeFromCart($input['product_id'], $input['size_id']);
    $this->setCartToSession($cart->getCart());
  }

  public function getCart() {
    $products = $this->getCartFromSession();
    return $products;
  }

  private function getCartFromSession() {
    return Session::has('cart') ? Session::get('cart') : [];
  }

  private function setCartToSession($products) {
    Session::put('cart', $products);
  }

}