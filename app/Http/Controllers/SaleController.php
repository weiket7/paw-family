<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Customer;
use App\Models\DeliveryDate;
use App\Models\Entities\CheckoutOption;
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
    $customer_id = Auth::id();
    $customer = Customer::find($customer_id);

    if ($request->isMethod('post')) {
      $input = $request->all();
      $sale = new Sale();
      if (! $sale->validateDeliveryOption($input)) {
        return redirect('checkout')->withErrors($sale->getValidation(), 'checkout')->withInput($input);
      }

      $checkout_option = $this->makeCheckoutOption($input);
      $sale = $sale->checkoutCart($customer_id, $checkout_option, $products);
      $customer->earnPointAndLog($sale->earned_points, $sale->sale_id, $sale->sale_no);
      if ($checkout_option->redeemed_points > 0) {
        $customer->redeemPointAndLog($checkout_option->redeemed_points, $sale->sale_id, $sale->sale_no);
      }
      $customer->updateSpentTotalOrderCountSpentAvg($sale);

      if ($checkout_option->payment_type == PaymentType::Paypal) {
        $paypal_field = (array)$sale->getPaypalField($sale->sale_no, $sale->nett_total);
        return view('paypal-process', $paypal_field);
      }
      $this->clearCartInSession();
      return redirect('checkout-success')->with('sale_no', $sale->sale_no);
    }
    $data['products'] = $products;
    $delivery_date_service = new DeliveryDate();
    $data['delivery_dates'] = $delivery_date_service->getAvailableDeliveryDate();
    $data['customer'] = $customer;
    $sale_service = new Sale();
    $data['postal_cbd'] = $sale_service->getPostalCBD();
    $data['postal_is_cbd'] = $customer_id > 0 ? $sale_service->postalIsCbd($customer->postal) : false;
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
      $data['sale'] = $sale_service->getSale($sale_id);
      $data['customer'] = $customer;
      $mail_request->data = $data;
      $mail_service = new MailService();
      $mail_service->sendEmail($mail_request);
    } else {
      $data['sale_no'] = '';
      $data['email'] = '';
    }

    return view("checkout-success", $data);
  }

  public function emailView($sale_id) {
    if (env('APP_ENV') == 'local') {
      $sale_service = new Sale();
      $sale = $sale_service->getSale($sale_id);
      $customer = Customer::find($sale->customer_id);
      $data['sale'] = $sale;
      $data['customer'] = $customer;
      return view('emails/order', $data);
    }
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

  private function makeCheckoutOption($input) {
    $checkout_option = new CheckoutOption();
    $checkout_option->payment_type = $input['payment_type'];
    $checkout_option->redeemed_points = isset($input['redeemed_points']) ? $input['redeemed_points'] : 0;
    $checkout_option->delivery_choice = $input['delivery_choice'];
    $checkout_option->address_other = isset($input['address_other']) ? $input['address_other'] : '';
    $checkout_option->postal_other = isset($input['postal_other']) ? $input['postal_other'] : '';
    $checkout_option->building_other = isset($input['building_other']) ? $input['building_other'] : '';
    $checkout_option->lift_lobby_other = isset($input['lift_lobby_other']) ? $input['lift_lobby_other'] : '';
    $checkout_option->contact_person_other = isset($input['contact_person_other']) ? $input['contact_person_other'] : '';
    $checkout_option->contact_number_other = isset($input['contact_number_other']) ? $input['contact_number_other'] : '';
    $checkout_option->customer_remark = $input['customer_remark'];
    $checkout_option->delivery_time = $input['delivery_time'];
    $checkout_option->delivery_date = $input['delivery_date'];
    $checkout_option->bank_ref = $input['bank_ref'];
    $checkout_option->gift_wrap = isset($input['gift_wrap']) ? true : false;
    $checkout_option->leave_outside_door = isset($input['leave_outside_door']) ? true : false;
    return $checkout_option;
  }


}