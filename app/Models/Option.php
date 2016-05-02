<?php namespace App\Models;

use App\Models\Enums\ProductOptionType;
use CommonHelper;
use Eloquent, DB, Validator, Input;

class Option extends Eloquent
{
  public $table = 'option';
  protected $primaryKey = 'option_id';
  protected $validation;
  public $timestamps = false;

  private $rules = [
    'name'=>'required',
    'price'=>'required|numeric',
  ];

  private $messages = [
    'name.required'=>'Name is required',
    'price.required'=>'Price is required',
    'price.numeric'=>'Price must be numeric',
  ];

  public function saveOption($input) {
    $this->validation = Validator::make($input, $this->rules, $this->messages );
    if ( $this->validation->fails() ) {
      return false;
    }

    $this->name = $input['name'];
    $this->price = $input['price'];
    $this->type = ProductOptionType::Repack;
    $this->save();
    return true;
  }


  public function getValidation() {
    return $this->validation;
  }
}