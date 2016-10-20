<?php

namespace App\Http\Controllers;

use App;
use App\Models\Banner;
use App\Models\Contact;
use App\Models\Entities\MailRequest;
use App\Models\Featured;
use App\Models\MailService;
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
      $customer_service = new Customer();
      $login = $customer_service->login($email, $password);

      if ($login == true) {
        $customer = Customer::where('email', $email)->first();
        Auth::loginUsingId($customer->customer_id);
      }

      if ($referrer == 'checkout') {
        if ($login == false) {
          return redirect('checkout')->withErrors(['login' => 'Wrong username/password'], 'login');
        }
        return redirect('checkout')->with('login', true);
      }

      if ($login == false) {
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
      $customer_id = $customer->registerCustomer($input);

      $referrer = $request->get("referrer");
      if ($customer_id == false) {
        if ($referrer == 'checkout') {
          return redirect('checkout#tab-register')->withErrors($customer->getValidation(), 'register')->withInput($input);
        }

        return redirect("register")->withErrors($customer->getValidation(), 'register')->withInput($input);
      }
      $customer = User::find($customer_id);
      Auth::login($customer);
      $mail_request = new MailRequest();
      $mail_request->to_email = $customer->email;
      $mail_request->subject = "Paw Family - Registration Success";
      $mail_request->view_name = 'emails/register';
      $data['name'] = $customer->name;
      $data['email'] = $customer->email;
      $mail_request->data = $data;
      $mail_service = new MailService();
      $mail_service->sendEmail($mail_request);

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
    $data['brands'] = Brand::orderBy('pos')->get();
    return view("brand", $data);
  }

  public function contact(Request $request) {
    if($request->isMethod('post')) {
      $input = $request->all();

      $contact = new Contact();
      if (! $contact->validateContact($input)) {
        return redirect()->back()->withErrors($contact->getValidation())->withInput($input);
      }

      $mail_request = new MailRequest();
      $mail_request->from_email = $input['email'];
      $mail_request->from_name = $input['name'];
      $mail_request->to_email = env("APP_EMAIL");
      $mail_request->subject = "Enquiry from " . $input['name'];
      $mail_request->view_name = 'emails/contact';
      $data['name'] = $input['name'];
      $data['email'] = $input['email'];
      $data['mobile'] = $input['mobile'];
      $data['content'] = $input['content'];
      $mail_request->data = $data;

      $mail_service = new MailService();
      $mail_service->sendEmail($mail_request);
      return redirect()->back()->with('msg', 'Thank you for your email, we will get back to you shortly.');
    }
    return view("contact");
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
        if (count($customer_service->getValidation()->errors()->all()) > 0) {
          return redirect("forgot-password")->withErrors($customer_service->getValidation())->withInput($input);
        }
        return redirect('forgot-password')->with('msg', 'If the email is valid, a new password will be emailed to you shortly')->withInput($input);
      }

      $mail_request = new MailRequest();
      $mail_request->from_email = env("APP_EMAIL");
      $mail_request->from_name = "Paw Family";
      $mail_request->to_email = $data['email'];
      $mail_request->view_name = 'emails/reset-password';
      $mail_request->data = $data;
      $mail_request->subject = "Paw Family - Forgot Password";
      $mail_service = new MailService();
      $mail_service->sendEmail($mail_request);

      return redirect('forgot-password')->with('msg', 'If the email is valid, a new password will be emailed to you shortly')->withInput($input);
    }
    return view('forgot-password');
  }

  public function termsAndConditions() {
    return view('terms-and-conditions');
  }

  public function cbdArea() {
    return view('cbd-area');
  }

  /*public function resetPassword() {
    $data['name'] = 'Wei Ket';
    $data['email'] = 'wei_ket@hotmail.com';
    $data['new_password'] = 'test168';
    return view('emails/reset-password', $data);
  }*/

}