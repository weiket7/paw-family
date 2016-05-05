<?php namespace App\Models;

use App\Models\Enums\SaleStat;
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
    $s = "SELECT sale_id, sale_code, stat, payment_type, product_discount, gross_total, nett_total, point, sale_on
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

  public function checkoutCart($customer_id, $payment_type, $products) {
    $this->customer_id = $customer_id;
    $this->stat = SaleStat::Submitted;
    $this->payment_type = $payment_type;
    $this->sale_on = date("Y-m-d H:i:s");
    $this->save();

    $gross_total = 0;
    $product_discount = 0;
    /* @var $product SaleProduct */
    foreach($products as $product) {
      $sale_product = [
        'sale_id'=>$this->sale_id,
        'product_id'=>$product->product_id,
        'size_id'=>$product->size_id,
        'option_id'=>$product->option_id,
        'price'=>$product->price,
        'discount_amt'=> isset($product->discount_amt) ? $product->discount_amt : 0,
        'discount_percentage'=>isset($product->discount_percentage) ? $product->discount_percentage : 0,
        'discounted_price'=>$product->discounted_price,
        'quantity'=>$product->quantity,
        'subtotal'=>$product->subtotal,
      ];
      DB::table("sale_product")->insert($sale_product);

      $gross_total += $product->price * $product->quantity;
      $product_discount += $product->discount_amt * $product->quantity;
    }
    $this->gross_total = $gross_total;
    $this->product_discount = $product_discount;
    $this->nett_total = $gross_total - $product_discount;
    $this->point = round($this->nett_total / 100, PHP_ROUND_HALF_DOWN);
    $this->save();
    return $this;
  }

  public function getSale($sale_id_or_code)
  {
    $s = "SELECT customer_id, sale_id, sale_code, stat, payment_type, promo_discount, gross_total, nett_total, point, sale_on
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