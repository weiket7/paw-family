<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Customer;
use App\Models\DeliveryDate;
use App\Models\Entities\DeliveryOption;
use App\Models\Entities\MailRequest;
use App\Models\Enums\PaymentType;
use App\Models\MailService;
use App\Models\Sale;
use App\Models\Setting;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class SaleController extends Controller
{
  public function checkout(Request $request) {
    $products = $this->getCartFromSession();

    if ($request->isMethod('post')) {
      $sale = new Sale();
      $customer_id = Auth::id();
      $input = $request->all();
      if (! $sale->validateDeliveryOption($input)) {
        return redirect('checkout')->withErrors($sale->getValidation(), 'checkout')->withInput($input);
      }
      $delivery_option = $this->makeDeliveryOption($input);
      $sale_no = $sale->checkoutCart($customer_id, $delivery_option, $products);
      if ($delivery_option->payment_type == PaymentType::Paypal) {
        $sale_service = new Sale();
        $nett_total = $sale_service->getNettTotalBySaleNo($sale_no);
        $paypal_field = (array)$sale_service->getPaypalField($sale_no, $nett_total);
        return view('paypal-process', $paypal_field);
      }
      $this->clearCartInSession();
      return redirect('checkout-success')->with('sale_no', $sale_no);
    }
    $data['products'] = $products;
    $delivery_date_service = new DeliveryDate();
    $data['delivery_dates'] = $delivery_date_service->getAvailableDeliveryDate();
    $customer_id = Auth::id();
    $data['customer'] = Customer::find($customer_id);
    return view('checkout', $data);
  }

  public function checkoutSuccess(Request $request) {
    $customer_id = Auth::id();
    $valid = false;
    $sale_service = new Sale();

    if ($request->session()->has('sale_no')) {
      $valid = true;
      $sale_no = $request->session()->get('sale_no');
    } else if ($request->has('custom')) { //paypal
      $valid = true;
      $sale_no = $request->get('custom');
      $sale_service->paypalSuccess($sale_no, $customer_id);
    }
    if ($valid) {
      $data['sale_no'] = $sale_no;
      $customer = Customer::find($customer_id);
      $data['email'] = $customer->email;

      $mail_request = new MailRequest();
      $mail_request->to_email = $customer->email;
      $mail_request->view_name = 'emails/order';
      $mail_request->subject = 'Paw Family - Order #'.$sale_no;
      $sale_id = $sale_service->getSaleIdByNo($sale_no);
      $data['name'] = $customer->name;
      $data['sale'] = $sale_service->getSale($sale_id);
      $mail_request->data = $data;
      $mail_service = new MailService();
      $mail_service->sendEmail($mail_request);
    } else {
      $data['sale_no'] = '';
      $data['email'] = '';
    }

    return view("checkout-success", $data);

  }

  public function paypalProcess() {
    return view('paypal-process ');
  }

  public function paypalCancel() {
    return view('paypal-cancel');
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

  private function clearCartInSession() {
    $this->setCartToSession([]);
  }

  private function setCartToSession($products) {
    Session::put('cart', $products);
  }

  private function emptyCart() {
    Session::put('cart', []);
  }

  private function makeDeliveryOption($input) {
    $delivery_option = new DeliveryOption();
    $delivery_option->payment_type = $input['payment_type'];
    $delivery_option->delivery_choice = $input['delivery_choice'];
    $delivery_option->address_other = $input['address_other'];
    $delivery_option->customer_remark = $input['customer_remark'];
    $delivery_option->delivery_time = $input['delivery_time'];
    $delivery_option->delivery_date = $input['delivery_date'];
    $delivery_option->gift_wrap = isset($input['gift_wrap']) ? "Y" : "N";
    $delivery_option->leave_outside_door = isset($input['leave_outside_door']) ? "Y" : "N";
    return $delivery_option;
  }


}