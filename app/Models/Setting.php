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

  public function getCbdSurcharge()
  {
    return DB::table('setting')->where('name', 'cbdsurcharge')->value('value');
  }

  private function return_bytes($val) {
    //http://stackoverflow.com/questions/2840755/how-to-determine-the-max-file-upload-limit-in-php
    $val = trim($val);
    $last = strtolower($val[strlen($val)-1]);
    switch($last)
    {
      case 'g':
        $val *= 1024;
      case 'm':
        $val *= 1024;
      case 'k':
        $val *= 1024;
    }
    return $val;
  }

  public function file_upload_max_size() {
    //select maximum upload size
    $max_upload = ini_get('upload_max_filesize');
    //select post limit
    $max_post = ini_get('post_max_size');
    //select memory limit
    $memory_limit = ini_get('memory_limit');
    // return the smallest of them, this defines the real limit
    return min($max_upload, $max_post, $memory_limit);
  }
  
}