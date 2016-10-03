<?php namespace App\Models;

use App\Models\Entities\ProductDiscount;
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
    'weight'=>'numeric',
  ];

  private $messages = [
    'name.required'=>'Name is required',
    'quantity.required'=>'Quantity is required',
    'quantity.numeric'=>'Quantity must be numeric',
    'price.required'=>'Price is required',
    'price.numeric'=>'Price must be numeric',
    'discount_amt.numeric'=>'Discount amount must be numeric',
    'weight.numeric'=>'Weight (lbs) must be numeric',
  ];

  public function getSize($size_id) {
    $s = "SELECT size_id, s.name, p.name as product_name, s.price, s.quantity, s.weight, s.weight_uom, s.discount_amt, s.discount_type
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
    $this->cost_price = $input['cost_price'];
    $this->price = $input['price'];
    $this->weight = $input['weight'];
    $this->weight_uom = $input['weight_uom'];
    $this->sku = $input['sku'];
    $this->updated_on= date('Y-m-d H:i:s');

    $round_up_to_first_decimal = isset($input['round-up-to-first-decimal']);
    $product_discount = new ProductDiscount($input['price'], $input['discount_percentage'], $input['discount_amt'], $round_up_to_first_decimal);
    $this->discount_percentage = $product_discount->discount_percentage;
    $this->discount_type = $product_discount->discount_type;
    $this->discount_amt = $product_discount->discount_amt;
    $this->discounted_price = $product_discount->discounted_price;

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