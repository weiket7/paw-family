<?php namespace App\Models;

use App\Models\Enums\DiscountType;
use CommonHelper;
use Eloquent, DB, Validator;

class ProductSize extends Eloquent
{
  public $table = 'product_size';
  protected $primaryKey = 'size_id';
  protected $validation;
  public $timestamps = false;

  private $rules = [
    'name'=>'required',
    'quantity'=>'required|numeric',
    'price'=>'required|numeric',
    'discount_amt'=>'numeric',
    'weight_lb'=>'numeric',
    'weight_kg'=>'numeric',
  ];

  private $messages = [
    'name.required'=>'Name is required',
    'quantity.required'=>'Quantity is required',
    'quantity.numeric'=>'Quantity must be numeric',
    'price.required'=>'Price is required',
    'price.numeric'=>'Price must be numeric',
    'discount_amt.numeric'=>'Discount amount must be numeric',
    'weight_lb.numeric'=>'Weight (lbs) must be numeric',
    'weight_kg.numeric'=>'Weight (kbs) must be numeric',
  ];

  public function getSize($size_id) {
    $s = "SELECT size_id, s.name, p.name as product_name, s.price, s.quantity, s.weight_lb, s.weight_kg, s.discount_amt, s.discount_type
    from product_size as s
    inner join product as p on s.product_id = p.product_id
    where size_id = :size_id";
    $p['size_id'] = $size_id;
    $data = DB::select($s, $p);
    return $data[0];
  }

  public function saveSize($input)
  {
    $this->validation = Validator::make($input, $this->rules, $this->messages );
    if ( $this->validation->fails() ) {
      return false;
    }

    if (isset($input['product_id']))
      $this->product_id = $input['product_id'];
    $this->name = $input['name'];
    $this->quantity = $input['quantity'];
    $this->price = $input['price'];
    if ($this->discount_percentage > 0) {
      $this->discount_type = DiscountType::Percentage;
      $this->discount_amt = CommonHelper::getDiscountAmtPercentage($this->price, $this->discount_percentage);
    } else {
      $this->discount_type = DiscountType::Amount;
      $this->discount_amt = $input['discount_amt'];
    }
    $this->discounted_price = $this->price - $this->discount_amt;
    $this->weight_lb = $input['weight_lb'];
    $this->weight_kg = $input['weight_kg'];
    $this->updated_on= date('Y-m-d H:i:s');
    $this->save();
    return true;
  }

  public function getValidation() {
    return $this->validation;
  }

  public function getSizeName($size_id)  {
    $size_name = DB::table("product_size")->where("size_id", $size_id)->value("name");
    return $size_name;
  }
}