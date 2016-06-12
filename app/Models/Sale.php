<?php namespace App\Models;

use App\Models\Entities\DeliveryOption;
use App\Models\Entities\SaleProduct;
use App\Models\Entities\SaleTotal;
use App\Models\Enums\DeliveryChoice;
use App\Models\Enums\DeliveryTime;
use App\Models\Enums\SaleStat;
use Carbon\Carbon;
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

  private $rules = [
    'delivery_choice'=>'required',
    'delivery_time'=>'required',
    'payment_type'=>'required',
  ];

  private $messages = [
    'delivery_choice.required'=>'Required',
    'delivery_time.required'=>'Required',
    'payment_type.required'=>'Required',
  ];

  private $checkout_rules = [
    'delivery_choice'=>'required',
    'delivery_time'=>'required',
    'payment_type'=>'required',
  ];

  private $checkout_messages = [
    'delivery_choice.required'=>'Delivery address is required',
    'delivery_time.required'=>'Delivery time is required',
    'payment_type.required'=>'Payment type is required',
  ];

  public function getSalesByCustomer($customer_id) {
    $s = "SELECT sale_id, sale_no, stat, payment_type, product_discount, gross_total, nett_total, point, sale_on
    FROM sale where customer_id = :customer_id order by sale_on desc";
    $p['customer_id'] = $customer_id;
    $data = DB::select($s, $p);
    return $data;
  }

  public function validateDeliveryOption($input) {
    $this->validation = Validator::make($input, $this->checkout_rules, $this->checkout_messages );
    if ( $this->validation->fails() ) {
      return false;
    }

    if ($input['delivery_choice'] == DeliveryChoice::OtherAddress && empty($input['address_other'])) {
      $this->validation->errors()->add("address_other", "Other address is required");
      return false;
    }

    return true;
  }

  public function checkoutCart($customer_id, DeliveryOption $delivery_option, $products) {
    $this->customer_id = $customer_id;
    $this->stat = SaleStat::Pending; //TODO
    $this->payment_type = $delivery_option->payment_type;
    $this->delivery_choice = $delivery_option->delivery_choice;
    $this->delivery_address = $this->getDeliveryAddress($delivery_option->delivery_choice, $delivery_option->address_other, $customer_id);
    $this->delivery_time = DeliveryTime::$values[$delivery_option->delivery_time];
    $this->customer_remark = $delivery_option->customer_remark;
    $this->sale_on = date("Y-m-d H:i:s");
    $this->sale_no = $this->getSaleNoAndIncrement();
    $this->save();

    /* @var $product SaleProduct */
    foreach($products as $product) {
      unset($product->slug);
      unset($product->image);
      $product->sale_id = $this->sale_id;

      DB::table("sale_product")->insert((array)$product);
    }

    $sale_total = $this->calcSaleTotal($products);
    $this->gross_total = $sale_total->gross_total;
    $this->product_discount = $sale_total->product_discount;
    $this->nett_total = $sale_total->nett_total;
    $this->point = $this->calculatePoint($this->nett_total);
    $this->save();
    return $this->sale_no;
  }

  public function calcSaleTotal($products) {
    $gross_total = 0;
    $product_discount = 0;
    foreach($products as $product) {
      //echo 'price='.$product->price . ' discounted_price='.$product->discounted_price.' discount_amt='.$product->discount_amt.'<br>';
      $gross_total += $product->price * $product->quantity + $product->option_price * $product->quantity;
      $product_discount += $product->discount_amt * $product->quantity;
    }

    $sale_total = new SaleTotal();
    $sale_total->gross_total = $gross_total;
    $sale_total->product_discount = $product_discount;
    $sale_total->nett_total = $gross_total - $product_discount;
    return $sale_total;
  }

  public function getNettTotalBySaleNo($sale_no) {
    return DB::table('sale')->where('sale_no', $sale_no)->value('nett_total');
  }

  public function searchSale($input)
  {
    $s = "SELECT * from sale where 1 ";
    /*if($input['name'] != '') {
      $s .= " and name LIKE '%".$input['name']."%'";
    }*/
    if (isset($input['stat']) && $input['stat'] != '') {
      $s .= " and stat = $input[stat]";
    }
    if (isset($input['payment_type']) && $input['payment_type'] != '') {
      $s .= " and payment_type = $input[payment_type]";
    }
    $sales = DB::select($s);
    return $sales;
  }

  public function getSaleIdByNo($sale_no) {
    return DB::table('sale')->where('sale_no', $sale_no)->value('sale_id');
  }

  public function getSale($sale_id)   {
    $s = "SELECT customer_id, sale_id, sale_no, stat, payment_type, product_discount, promo_discount, 
    delivery_choice, delivery_address, delivery_time, customer_remark, operator_remark, gross_total, nett_total, point, sale_on, paid_on, delivered_on
    FROM sale where sale_id = :sale_id";
    $p['sale_id'] = $sale_id;
    $sale = DB::select($s, $p)[0];

    $s = "SELECT product_id, name, 
    size_id, ifnull(size_name, '') as size_name,
    option_id, ifnull(option_name, '') as option_name, ifnull(option_price, '') as option_price,
    product_id, quantity, price, discounted_price, subtotal from sale_product 
    where sale_id = :sale_id";
    $sale->products = DB::select($s, $p);

    return $sale;
  }

  public function getLatest()
  {
    $s = "SELECT sale_id, s.stat, c.name, s.customer_id, payment_type, product_discount, promo_discount, gross_total, nett_total, sale_on
    from sale as s 
    inner join customer as c on s.customer_id = c.customer_id
    order by sale_on desc limit 100";
    $data = DB::select($s);
    return $data;
  }

  public function getDeliveryAddress($delivery_choice, $address_other, $customer_id) {
    if ($delivery_choice == DeliveryChoice::OtherAddress) {
      return $address_other;
    } else if ($delivery_choice == DeliveryChoice::CurrentAddress) {
      $customer = Customer::find($customer_id);
      return $customer->address;
    } else if ($delivery_choice == DeliveryChoice::SelfCollect) {
      return DeliveryChoice::$values[DeliveryChoice::SelfCollect];
    }
    return "error";
  }

  public function calculatePoint($nett_total) {
    return floor($nett_total);
  }

  public function getSaleNoAndIncrement() {
    $current_sale_no = DB::table('sale_running_no')->value('value');
    $next_sale_no = $current_sale_no+1;
    DB::table('sale_running_no')->update(['value'=>$next_sale_no]);
    return $next_sale_no;
  }

  public function getValidation() {
    return $this->validation;
  }

  public function updateSaleStat($sale_id, $stat)
  {
    $sale = Sale::find($sale_id);
    if ($stat == SaleStat::Paid) {
      $sale->paid_on = new Carbon();
      $sale->stat = SaleStat::Paid;
      $sale->save();
    } elseif ($stat == SaleStat::Delivered) {
      $sale->delivered_on = new Carbon();
      $sale->stat = SaleStat::Delivered;
      $sale->save();
    }
  }

  public function paypalSuccess($sale_no)
  {
    return DB::table('sale')->where('sale_no', $sale_no)->where('stat', SaleStat::Pending)->update(['stat'=>SaleStat::Paid]);
  }

}