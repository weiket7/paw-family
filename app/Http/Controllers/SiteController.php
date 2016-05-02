<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Auth;
use Illuminate\Http\Request;

class SiteController extends Controller
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

  public function login(Request $request) {
    if($request->isMethod('post')) {
      $email = $request->get("email");
      $password = $request->get("password");
      if (! Auth::attempt(['email'=>$email, 'password'=>$password])) {
        //TODO login_log
        return redirect()->back()->with('msg', "Wrong username and/or password");
      }
      return redirect()->intended("account");
    }
    return view("login");
  }

  public function register(Request $request) {
    if($request->isMethod('post')) {
      $input = $request->all();
      $customer = new Customer();
      if (! $customer->registerCustomer($input)) {
        return redirect("register#tab-2")->withErrors($customer->getValidation())->withInput($input);
      }
      return redirect()->intended("account");
    }
    return view("register");
  }

  public function account() {
    return view('account');
  }
}