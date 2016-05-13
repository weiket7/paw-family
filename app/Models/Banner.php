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
    $this->link = $input['link'];
    $this->save();
    return true;
  }


  public function getValidation() {
    return $this->validation;
  }
}