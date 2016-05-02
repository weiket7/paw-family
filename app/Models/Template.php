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

  public function saveBrand($input) {
    $this->validation = Validator::make($input, $this->rules, $this->messages );
    if ( $this->validation->fails() ) {
      return false;
    }
  
    $this->name = $input['name'];
    $this->save();
    return true;
  }


  public function getValidation() {
    return $this->validation;
  }
}