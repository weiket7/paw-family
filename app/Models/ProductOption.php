<?php namespace App\Models;

use App\Models\Enums\ProductOptionType;
use CommonHelper;
use Eloquent, DB, Validator, Input;

class ProductOption extends Eloquent
{
  public $table = 'product_option';
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
    if (isset($input['size_id'])) {
      $this->size_id = $input['size_id'];
    }
    $this->price = $input['price'];
    $this->type = ProductOptionType::Repack;
    $this->updated_on = date("Y-m-d H:i:s");
    $this->save();
    return true;
  }


  public function getValidation() {
    return $this->validation;
  }
}