<?php namespace App\Models;

use Eloquent, DB, Validator, Input;

class Setting extends Eloquent {
  public $table = 'setting';
  protected $primaryKey = 'setting_id';
  protected $validation;

  public function getSettingAllWithNameKey() {
    $settings = Setting::all();
    $res = [];
    foreach($settings as $setting) {
      $res[$setting->name] = $setting->value;
    }
    return $res;
  }
  
  public function getDeliveryDayAll()
  {
    $s = "SELECT * from delivery_day";
    $data = DB::select($s);
    $res = [];
    foreach($data as $d) {
      $res[$d->day] = $d->area;
    }
    return $res;
  }
  
  public function saveDeliveryDay() {

  }
}