<?php namespace App\Models;

use Eloquent, DB, Validator;

class Size extends Eloquent
{
  public $table = 'size';
  protected $primaryKey = 'size_id';
  protected $validation;

  private $rules = [
    'name'=>'required',
    'quantity'=>'required',
    'price'=>'required',
  ];

  private $messages = [
    'name.required'=>'Name is required',
    'quantity.required'=>'Quantity is required',
    'price.required'=>'Price is required',
  ];

  public function getSize($size_id) {
    $s = "SELECT size_id, s.name, p.name as product_name, s.price, s.quantity, s.weight_lb, s.weight_kg, s.discount_amt, s.discount_type
    from size as s
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

    $this->name = $input['name'];
    $this->quantity = $input['quantity'];
    $this->price = $input['price'];
    $this->discount_amt = $input['discount_amt'];
    $this->discount_type = $input['discount_type'];
    $this->weight_lb = $input['weight_lb'];
    $this->weight_kg = $input['weight_kg'];
    $this->save();
    return true;
  }

  public function getValidation() {
    return $this->validation;
  }
}