<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Enums\SaleStat;
use App\Models\Sale;
use Illuminate\Http\Request;

class SaleController extends Controller
{
  public function index(Request $request) {
    $sale_service = new Sale();
    if($request->isMethod('post')) {
      $action = $request->get('action');
      if ($action == 'search') {
        $input = $request->all();
        $sales = $sale_service->searchSale($input);
      } else if($action == 'print') {
        $data = [];
        return view('admin/sale/print', $data);
      }
    } else {
      $sales = $sale_service->getLatestSale();
    }
    $data['sales'] = $sales;
    return view('admin/sale/index', $data);
  }

  public function view(Request $request, $sale_id) {
    $sale_service = new Sale();

    if($request->isMethod('post')) {
      $stat = $request->get('sale_stat');
      $sale_service->updateSaleStat($sale_id, $stat);
    }
    $sale = $sale_service->getSale($sale_id);
    $data['customer'] = Customer::find($sale->customer_id);
    $data['sale'] = $sale;
    return view('admin/sale/view', $data);
  }

  public function save(Request $request, $sale_id) {
    $sale_service = new Sale();
    $sale = $sale_service->getSale($sale_id);

    if($request->isMethod('post')) {
      $input = $request->all();
      $sale = Sale::find($sale_id);
      $sale->updateSale($input);
      return redirect('admin/sale/save/'.$sale->sale_id)->with('msg', 'Sale updated');
    }
    $data['customer'] = Customer::find($sale->customer_id);
    $data['sale'] = $sale;
    return view('admin/sale/form', $data);
  }
}