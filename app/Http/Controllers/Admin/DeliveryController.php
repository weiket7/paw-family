<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DeliveryDate;
use Illuminate\Http\Request;

class DeliveryController extends Controller
{
  public function index(Request $request) {
    $delivery_date_service = new DeliveryDate();
    $data['dates'] = $delivery_date_service->getDeliveryDate(30);
    return view('admin/delivery/index', $data);
  }
}