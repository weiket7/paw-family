<?php namespace App\Models;

use CommonHelper;
use Eloquent, DB, Validator, Input;

class Brand extends Eloquent
{
  public $table = 'brand';
  protected $primaryKey = 'brand_id';
  protected $validation;
  public $timestamps = false;

  private $rules = [
    'name'=>'required',
  ];

  private $messages = [
    'name.required'=>'Name is required',
  ];

  public function saveBrand($input, $image) {
    $this->name = $input['name'];
    if ($image) {
      $this->image = CommonHelper::uploadImage('products', $input['name'], $image);
    }
    $this->save();
    return true;
  }


  public function getValidation() {
    return $this->validation;
  }
}