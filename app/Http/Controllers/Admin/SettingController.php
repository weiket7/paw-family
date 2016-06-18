<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Hamcrest\Core\Set;
use Illuminate\Http\Request;
use App;

class SettingController extends Controller
{
  public function index(Request $request) {
    $data['settings'] = Setting::all();
    $setting_service = new Setting();
    $data['delivery_days'] = $setting_service->getDeliveryDayAll();
    return view("admin.setting.index", $data);
  }

  public function deliveryDay() {

  }

  public function config() {
    $app = App::getFacadeApplication();
    $data['laravel'] = $app::VERSION;
    $data['php'] = phpversion();
    $data['env'] = App::environment();
    $data['email'] = env("APP_EMAIL");
    return view("admin/setting/config", $data);
  }
}