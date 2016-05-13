<?php namespace App\Models;

use App\Models\Enums\DiscountType;
use CommonHelper;
use Eloquent, DB, Validator;

class Featured extends Eloquent
{
  public $table = 'featured';
  protected $primaryKey = 'featured_id';
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

  public function getFeaturedAll() {
    $s = "SELECT p.name, p.desc_short, p.stat as product_stat, p.image, f.type as featured_type
      FROM product AS p
      inner join featured as f on f.product_id = p.product_id";
    $products = DB::select($s);
    return $products;
  }

  public function saveFeature() {
    
  }

  public function getValidation()
  {
    return $this->validation;
  }
}