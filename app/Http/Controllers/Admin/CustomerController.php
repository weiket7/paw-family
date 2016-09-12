<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
  public function index(Request $request) {
    $customer_service = new Customer();
    if($request->isMethod('post')) {
      $input = $request->all();
      $customers = $customer_service->searchCustomer($input);
      $request->flash();
      $request->session()->flash('search_result', "Showing ".count($customers)." customers");
    } else {
      $customers = $customer_service->getCustomerAll();
      $request->session()->flash('search_result', "Showing last joined ".count($customers)." customers");
    }
    $data['customers'] = $customers;
    return view("admin/customer/index", $data);
  }

  public function save(Request $request, $customer_id = null) {
    $action = $customer_id == null ? 'create' : 'update';
    if($request->isMethod('post')) {
      $input = $request->all();
      $customer = Customer::findOrNew($customer_id);

      if (isset($input['delete']) && $input['delete'] == 'true') {
        $customer->delete();
        return redirect('admin/customer')->with('msg', 'Customer deleted');
      }
      if (! $customer->saveCustomer($input)) {
        return redirect()->back()->withErrors($customer->getValidation())->withInput($input);
      }

      return redirect('admin/customer/save/'.$customer->customer_id)->with('msg', 'Customer ' . $action . "d");
    }
    
    $customer_service = new Customer();
    $customer = $customer_service->getCustomer($customer_id);
    $data['customer'] = $customer;
    return view("admin/customer/form", $data);
  }
}