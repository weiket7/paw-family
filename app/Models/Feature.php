<?php namespace App\Models;

use App\Models\Enums\DiscountType;
use CommonHelper;
use Eloquent, DB, Validator;

class Feature extends Eloquent
{
  public $table = 'feature';
  protected $primaryKey = 'feature_id';
  protected $validation;
  public $timestamps = false;

  private $rules = [
    'name' => 'required',
    'quantity' => 'required|numeric',
    'price' => 'required|numeric',
    'discount_amt' => 'numeric',
    'weight_lb' => 'numeric',
    'weight_kg' => 'numeric',
  ];

  private $messages = [
    'name.required' => 'Name is required',
    'quantity.required' => 'Quantity is required',
    'quantity.numeric' => 'Quantity must be numeric',
    'price.required' => 'Price is required',
    'price.numeric' => 'Price must be numeric',
    'discount_amt.numeric' => 'Discount amount must be numeric',
    'weight_lb.numeric' => 'Weight (lbs) must be numeric',
    'weight_kg.numeric' => 'Weight (kbs) must be numeric',
  ];

  public function saveFeature() {
    
  }

  public function getValidation()
  {
    return $this->validation;
  }
}