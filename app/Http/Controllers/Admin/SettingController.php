<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DistrictPostal;
use App\Models\Setting;
use Hamcrest\Core\Set;
use Illuminate\Http\Request;
use App;

class SettingController extends Controller
{
  public function index(Request $request) {
    $data['settings'] = Setting::all();
    return view("admin.setting.index", $data);
  }

  public function config() {
    $app = App::getFacadeApplication();
    $data['laravel'] = $app::VERSION;
    $data['php'] = phpversion();
    $data['env'] = App::environment();
    $data['email'] = env("APP_EMAIL");
    $data['timezone'] = date_default_timezone_get();
    return view("admin/setting/config", $data);
  }

  public function districtPostal() {
    $data['district_postals'] = DistrictPostal::all();
    return view('admin/setting/district-postal', $data);
  }
}
