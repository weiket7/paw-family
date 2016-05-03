<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
  public function index() {
    $data['customers'] = Customer::all();
    return view("admin/customer/index", $data);
  }

  public function save(Request $request, $customer_id = null) {
    $customer_service = new Customer();
    $customer = $customer_service->getCustomer($customer_id);
    $action = $customer_id == null ? 'create' : 'update';
    if($request->isMethod('post')) {
      $input = $request->all();
      if (isset($input['delete']) && $input['delete'] == 'true') {
        $customer->delete();
        return redirect('admin/customer/save/'.$customer->product_id)->with('msg', 'Customer deleted');
      }
      if (! $customer->saveCustomer($input)) {
        return redirect()->back()->withErrors($customer->getValidation())->withInput($input);
      }

      return redirect('admin/customer/save/'.$customer->customer_id)->with('msg', 'Customer ' . $action . "d");
    }
    $data['customer'] = $customer;
    return view("admin/customer/form", $data);
  }
}