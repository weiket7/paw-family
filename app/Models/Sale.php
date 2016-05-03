<?php namespace App\Models;

use CommonHelper;
use Eloquent, DB, Validator, Input;

class Sale extends Eloquent
{
  public $table = 'sale';
  protected $primaryKey = 'sale_id';
  protected $validation;
  public $timestamps = false;

  public function saveSale($input) {
    $this->validation = Validator::make($input, $this->rules, $this->messages );
    if ( $this->validation->fails() ) {
      return false;
    }

    $this->name = $input['name'];
    $this->save();
    return true;
  }

  public function getSalesByCustomer($customer_id)
  {
    $s = "SELECT sale_id, sale_code, stat, payment_type, discount_total, gross_total, nett_total, point, sale_on
    FROM sale where customer_id = :customer_id";
    $p['customer_id'] = $customer_id;
    $data = DB::select($s, $p);
    return $data;
  }

  private $rules = [
    'name'=>'required',
  ];

  private $messages = [
    'name.required'=>'Name is required',
  ];

  public function getValidation() {
    return $this->validation;
  }

  public function getSale($sale_id_or_code)
  {
    $s = "SELECT customer_id, sale_id, sale_code, stat, payment_type, discount_total, gross_total, nett_total, point, sale_on
    FROM sale ";
    if (is_int($sale_id_or_code)) {
      $s .= " where sale_id = :sale_id";
      $p['sale_id'] = $sale_id_or_code;
    } else {
      $s .= " where sale_code = :sale_code";
      $p['sale_code'] = $sale_id_or_code;
    }

    $sale = DB::select($s, $p)[0];
    $s = "SELECT product_id, quantity, price, subtotal from sale_product ";
    if (is_int($sale_id_or_code)) {
      $s .= " where sale_id = :sale_id";
      $p['sale_id'] = $sale_id_or_code;
    } else {
      $s .= " where sale_code = :sale_code";
      $p['sale_code'] = $sale_id_or_code;
    }
    $sale->products = DB::select($s, $p);

    return $sale;
  }

}