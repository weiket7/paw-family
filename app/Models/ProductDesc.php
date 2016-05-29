<?php namespace App\Models;

use App\Models\Enums\DiscountType;
use App\Models\Enums\ProductOptionType;
use CommonHelper;
use Eloquent, DB, Validator;

class ProductDesc extends Eloquent
{
  public $table = 'product_desc';
  protected $primaryKey = 'desc_id';
  protected $validation;
  public $timestamps = false;

  protected $product_desc_id;
  protected $product_id;
  protected $type;
  protected $value;
  protected $updated_by;
  protected $updated_on;

  private $rules = [
    'type' => 'required',
    'value' => 'required',
  ];

  private $messages = [
    'type.required' => 'Type is required',
    'value.required' => 'Value is required',
  ];

  public function getValidation()
  {
    return $this->validation;
  }

  public function saveProductDesc($input) {
    if (isset($input['product_id']))
      $this->attributes['product_id'] = $input['product_id'];
    $this->attributes['type'] = $input['type'];
    $this->attributes['value'] = $input['value'];
    $this->save();
    return true;
  }
}
