<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Report;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ReportController extends Controller
{
  public function sales(Request $request) {
    if ($request->isMethod("post")) {
      $report_service = new Report();
      $from_date = $request->get("from_date");
      $to_date = $request->get("to_date");
      $data['rows'] = $report_service->getSales($from_date, $to_date);

      $data['from_date'] = $from_date;
      $data['to_date'] = $to_date;
    } else {
      $today = Carbon::create();
      $data['to_date'] = $today->format('d-m-Y');
      $data['from_date'] = $today->addDay(-7)->format('d-m-Y');
      
    }

    return view('admin/report/sales', $data);
  }
}