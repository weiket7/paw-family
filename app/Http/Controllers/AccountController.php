<?php

namespace App\Http\Controllers;

use App;
use App\Models\Banner;
use App\Models\Enums\FeaturedType;
use App\Models\Featured;
use App\Models\Testimonial;
use App\User;
use Auth;
use Mail;
use App\Models\Brand;
use App\Models\Customer;
use App\Models\Product;
use App\Models\Sale;
use Illuminate\Http\Request;

class AccountController extends Controller
{
  public function account(Request $request) {
    $customer_id = Auth::id();
    $customer = Customer::find($customer_id);
    if($request->isMethod('post')) {
      $input = $request->all();
      $action = $input['action'];
      if ($action == "account") {
        if (! $customer->saveCustomer($input)) {
          return redirect("account")->withErrors($customer->getValidation())->withInput($input);
        }
        return redirect('account')->with('msg', 'Account updated');
      } else if ($action == "change_password") {
        if (! $customer->changePassword($input, $customer_id)) {
          return redirect("account#tab-password")->withErrors($customer->getValidation())->withInput($input);
        }
        return redirect('account#tab-password')->with('msg', 'Password changed');
      }
    }
    $sale_service = new Sale();
    $data['sales'] = $sale_service->getSalesByCustomer($customer_id);
    $data['customer'] = $customer;

    return view('account', $data);
  }


  public function order(Request $request, $sale_no) {
    $sale_service = new Sale();
    $sale_id = $sale_service->getSaleIdByNo($sale_no);
    $data['sale'] = $sale_service->getSale($sale_id);
    return view('order', $data);
  }
  
}