<?php

namespace App\Http\Controllers;

use App;
use App\Models\Banner;
use App\Models\Enums\FeaturedType;
use App\Models\Featured;
use App\Models\Testimonial;
use Auth;
use Mail;
use App\Models\Brand;
use App\Models\Customer;
use App\Models\Product;
use App\Models\Sale;
use Illuminate\Http\Request;

class SiteController extends Controller
{
  public function account(Request $request) {
    $customer_id = Auth::id();
    $customer = Customer::find($customer_id);
    if($request->isMethod('post')) {
      $input = $request->all();
      if (! $customer->saveCustomer($input)) {
        return redirect("account")->withErrors($customer->getValidation())->withInput($input);
      }
      return redirect('account')->with('msg', 'Account updated');
    }
    $sale_service = new Sale();
    $data['sales'] = $sale_service->getSalesByCustomer($customer_id);
    $data['customer'] = $customer;

    return view('account', $data);
  }

  public function order(Request $request, $sale_no) {
    $sale_service = new Sale();
    $data['sale'] = $sale_service->getSale($sale_no);
    return view('order', $data);
  }

  public function login(Request $request) {
    if($request->isMethod('post')) {
      $email = $request->get("email");
      $password = $request->get("password");
      if (! Auth::attempt(['email'=>$email, 'password'=>$password])) {
        return "fail";
      }
      $request->session()->flash("login", true);
      return "success";
    }
    return "error";
  }

  public function register(Request $request) {
    if($request->isMethod('post')) {
      $input = $request->all();
      $customer = new Customer();
      if (! $customer->registerCustomer($input)) {
        return redirect("register")->withErrors($customer->getValidation())->withInput($input);
      }
      return redirect()->intended("account");
    }
    return view("register");
  }

  public function index() {
    $featured_service = new Featured();
    $banner_service = new Banner();
    $data['banners'] = $banner_service->getBannerAllForHome();
    $data['products'] = $featured_service->getFeaturedAll();
    $data['brands'] = Brand::all();
    $data['testimonials'] = Testimonial::all();
    return view("index", $data);
  }

  public function brand() {
    $data['brands'] = Brand::all();
    return view("brand", $data);
  }

  public function contact(Request $request) {
    if($request->isMethod('post')) {
      $input = $request->all();

      $data = [
        'name'=>$input['name'],
        'email'=>$input['email'],
        'mobile'=>$input['mobile'],
        'content'=>$input['content'],
        'recipient'=>$this->getRecipient(),
      ];
      Mail::send('emails/contact', $data, function ($message) use ($data) {
        $message->from($data['email'], $data['name'])
          //->to('admin@pawfamily.sg')
          ->to($data['recipient'])
          ->subject("Enquiry from ".$data['name']);
      });
      return redirect()->back()->with('msg', 'Thank you for your email, we will get back to you shortly.');
    }
    return view("contact");
  }

  private function getRecipient() {
    if (! App::environment('production')) {
      return 'wei_ket@hotmail.com';
    }
    return 'admin@pawfamily.sg';
  }

  public function logout() {
    Auth::logout();
    //TODO redirect
  }

  public function forgotPassword() {
    return view('forgot-password');
  }

}