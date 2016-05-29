<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Sale;
use Illuminate\Http\Request;

class SaleController extends Controller
{
  public function index(Request $request) {
    $sale_service = new Sale();
    if($request->isMethod('post')) {
      $input = $request->all();
      $sales = $sale_service->searchSale($input);
    } else {
      $sales = $sale_service->getLatest();
    }
    $data['sales'] = $sales;
    return view('admin/sale/index', $data);
  }

  public function save(Request $request, $sale_id) {
    $sale_service = new Sale();
    $sale = $sale_service->getSale($sale_id);
    $data['customer'] = Customer::find($sale->customer_id);
    $data['sale'] = $sale;
    return view('admin/sale/form', $data);
  }
}