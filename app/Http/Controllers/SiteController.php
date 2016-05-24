<?php

namespace App\Http\Controllers;

use App;
use App\Models\Banner;
use App\Models\Contact;
use App\Models\Featured;
use App\Models\Testimonial;
use App\User;
use Auth;
use Mail;
use App\Models\Brand;
use App\Models\Customer;
use Illuminate\Http\Request;

class SiteController extends Controller
{

  public function login(Request $request) {
    if($request->isMethod('post')) {
      $referrer = $request->get("referrer");

      $email = $request->get("email");
      $password = trim($request->get("password"));
      if (! Auth::attempt(['email'=>$email, 'password'=>$password])) {
        if ($referrer == 'checkout') {
          return redirect('checkout')->withErrors(['login'=>'Wrong username/password'], 'login');
        }
        return "fail";
      }
      if ($referrer == 'checkout') {
        return redirect('checkout')->with('login', true);
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
      $customer_id = $customer->registerCustomer($input);

      $referrer = $request->get("referrer");
      if ($customer_id == false) {
        if ($referrer == 'checkout') {
          return redirect('checkout#tab-register')->withErrors($customer->getValidation(), 'register')->withInput($input);
        }

        return redirect("register")->withErrors($customer->getValidation(), 'register')->withInput($input);
      }
      Auth::login(User::find($customer_id));
      if ($referrer == 'checkout') {
        return redirect('checkout')->with('login', true);
      }
      return redirect("account")->with('login', true);
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

      $contact = new Contact();
      if (! $contact->validateContact($input)) {
        return redirect()->back()->withErrors($contact->getValidation())->withInput($input);
      }

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
    return redirect("/")->with('msg-info', 'You have logged out');
  }

  public function forgotPassword(Request $request) {
    if ($request->isMethod('post')) {
      $customer_service = new Customer();
      $input = $request->all();
      $data = $customer_service->resetPassword($input);
      if ($data == false) {
        return redirect("forgot-password")->withErrors($customer_service->getValidation())->withInput($input);
      }

      $data['recipient'] = $this->getRecipient();
      Mail::send('emails/reset-password', $data, function ($message) use ($data) {
        $message->from($data['email'], $data['name'])
          ->to($data['recipient'])
          ->subject("Enquiry from ".$data['name']);
      });
      return redirect('forgot-password')->with('msg', 'A new password has been emailed to you shortly');
    }
    return view('forgot-password');
  }

  public function termsAndConditions() {
    return view('termsandconditions');
  }
  /*public function resetPassword() {
    $data['name'] = 'Wei Ket';
    $data['email'] = 'wei_ket@hotmail.com';
    $data['new_password'] = 'test168';
    return view('emails/reset-password', $data);
  }*/

}