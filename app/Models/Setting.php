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
  
}