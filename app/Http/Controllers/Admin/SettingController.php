<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
  public function index(Request $request) {
    $data['settings'] = Setting::all();
    return view("admin.setting.index", $data);
  }
}