<?php namespace App\Models;

use CommonHelper;
use Eloquent, DB, Validator, Input;

class Banner extends Eloquent
{
  public $table = 'banner';
  protected $primaryKey = 'banner_id';
  protected $validation;
  public $timestamps = false;

  private $rules = [
  ];

  private $messages = [
  ];

  public function saveBanner($input, $image = null) {
    if ($image) {
      $this->image = CommonHelper::uploadImage('banners', $this->attributes['name'], $image);
    }
    $this->name = $input['name'];
    $this->slug = str_slug($input['name']);
    $this->link = $input['link'];
    if (isset($input['stat'])) {
      $this->stat = $input['stat'];
    }
    $this->save();
    return true;
  }


  public function getValidation() {
    return $this->validation;
  }

  public function getBannerAllForHome()
  {
    $data = Banner::all();
    $res = [];
    foreach($data as $d) {
      $res[$d->banner_id] = $d;
    }
    return $res;
  }
}