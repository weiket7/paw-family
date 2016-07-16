<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DeliveryDate;
use Illuminate\Http\Request;

class DeliveryController extends Controller
{
  public function index(Request $request) {
    $delivery_date_service = new DeliveryDate();
    if ($request->isMethod('post')) {
      $input = $request->all();

      if (! $delivery_date_service->saveDeliveryDate($input)) {
        return redirect()->back()->withErrors($delivery_date_service->getValidation())->withInput($input);
      }

    }
    $data['dates'] = $delivery_date_service->getDeliveryDate(30);
    return view('admin/delivery/index', $data);
  }
}