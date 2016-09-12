<?php namespace App\Models;

use App\Models\Entities\CheckoutOption;
use App\Models\Entities\PaypalField;
use App\Models\Entities\SaleProduct;
use App\Models\Enums\DeliveryChoice;
use App\Models\Enums\DeliveryTime;
use App\Models\Enums\PaymentType;
use App\Models\Enums\SaleStat;
use Carbon\Carbon;
use Eloquent, DB, Validator;
use Illuminate\Support\Facades\App;

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
    'delivery_date'=>'required',
    'delivery_time'=>'required',
    'payment_type'=>'required',
  ];

  private $checkout_messages = [
    'delivery_choice.required'=>'Delivery address is required',
    'delivery_date.required'=>'Delivery date is required',
    'delivery_time.required'=>'Delivery time is required',
    'payment_type.required'=>'Payment type is required',
  ];

  public function validateDeliveryOption($input) {
    $result = true;
    $this->validation = Validator::make($input, $this->checkout_rules, $this->checkout_messages );
    if ( $this->validation->fails() ) {
      return false;
    }

    if ($input['delivery_choice'] == DeliveryChoice::OtherAddress) {
      if (empty($input['address_other'])) {
        $this->validation->errors()->add("address_other", "Address is required");
        $result = false;
      }
      if (empty($input['postal_other'])) {
        $this->validation->errors()->add("postal_other", "Postal is required");
        $result = false;
      }
    }

    if ($input['payment_type'] == PaymentType::Bank && empty($input['bank_ref'])) {
      $this->validation->errors()->add("bank_ref", "Bank reference number required");
      $result = false;
    }

    return $result;
  }

  public function checkoutCart($customer_id, CheckoutOption $checkout_option, $products) {
    $this->customer_id = $customer_id;
    $this->stat = SaleStat::Pending;
    $this->redeemed_points = $checkout_option->redeemed_points;
    $redeem_point_to_amt = $this->getRedeemPointToAmt();
    $this->redeemed_amt = $checkout_option->redeemed_points ? $redeem_point_to_amt[$checkout_option->redeemed_points] : 0;
    $this->payment_type = $checkout_option->payment_type;
    $this->delivery_choice = $checkout_option->delivery_choice;
    $this->delivery_date = $checkout_option->delivery_date;
    $this->delivery_time = DeliveryTime::$values[$checkout_option->delivery_time];
    $this->customer_remark = $checkout_option->customer_remark;
    $this->bank_ref = $checkout_option->bank_ref;
    $this->sale_on = date("Y-m-d H:i:s");
    $this->sale_no = $this->getSaleNoAndIncrement();
    $this->setDeliveryAddress($checkout_option, $customer_id);
    $this->setErpSurcharge();
    $this->save();

    /* @var $product SaleProduct */
    foreach($products as $product) {
      unset($product->slug);
      unset($product->image);
      $product->sale_id = $this->sale_id;
      $product->sale_no = $this->sale_no;

      DB::table("sale_product")->insert((array)$product);
    }

    $this->setSaleTotal($products);
    $this->earned_points = $this->calcPoints($this->nett_total);
    $this->save();
    return $this;
  }

  public function setSaleTotal($products) {
    $gross_total = 0;
    $product_discount = 0;
    $cost_total = 0;
    foreach($products as $product) {
      //echo 'price='.$product->price . ' discounted_price='.$product->discounted_price.' discount_amt='.$product->discount_amt.'<br>';
      $gross_total += $product->price * $product->quantity + $product->option_price * $product->quantity;
      $product_discount += $product->discount_amt * $product->quantity;
      $cost_total += $product->cost_price * $product->quantity;
    }

    $this->gross_total = $gross_total;
    $this->product_discount = $product_discount;
    $this->bulk_discount = $this->getBulkDiscount($products);
    $this->delivery_fee = $this->getDeliveryFee($gross_total, $product_discount, $this->redeemed_amt);
    $this->nett_total = $gross_total - $product_discount - $this->redeemed_amt + $this->erp_surcharge + $this->delivery_fee - $this->bulk_discount;
    $this->cost_total = $cost_total;
  }

  public function getNettTotalBySaleNo($sale_no) {
    return DB::table('sale')->where('sale_no', $sale_no)->value('nett_total');
  }

  public function searchSale($input) {
    $s = "SELECT sale_id, s.stat, c.name, s.customer_id, payment_type, product_discount, promo_discount, gross_total, nett_total, sale_on
    from sale as s 
    inner join customer as c on s.customer_id = c.customer_id where 1 ";
    if($input['name'] != '') {
      $s .= " and name LIKE '%".$input['name']."%'";
    }
    if (isset($input['stat']) && $input['stat'] != '') {
      $s .= " and s.stat = '$input[stat]'";
    }
    if (isset($input['payment_type']) && $input['payment_type'] != '') {
      $s .= " and payment_type = '$input[payment_type]'";
    }
    if (isset($input['start']) && isset($input['end'])
      && $input['start'] != '' && $input['end'] != '') {
      $start = date('Y-m-d', strtotime($input['start']));
      $end = Carbon::createFromFormat('d M y', $input['end'])->addDay(1)->format('Y-m-d');
      $s .= " and (sale_on >= '".$start."' and sale_on < '".$end."')";
    }
    $s .= " order by sale_on desc";
    $sales = DB::select($s);
    return $sales;
  }

  public function getSaleIdByNo($sale_no) {
    return DB::table('sale')->where('sale_no', $sale_no)->value('sale_id');
  }

  public function getSale($sale_id)   {
    $s = "SELECT bulk_discount, customer_id, sale_id, sale_no, stat, payment_type, product_discount, promo_discount, redeemed_points, redeemed_amt, earned_points,
    delivery_choice, address, postal, building, lift_lobby, erp_surcharge, delivery_time, customer_remark, operator_remark, bank_ref,
    gross_total, nett_total, sale_on, paid_on, delivered_on, delivery_fee
    FROM sale where sale_id = :sale_id";
    $p['sale_id'] = $sale_id;
    $sale = DB::select($s, $p)[0];

    $s = "SELECT sp.product_id, sp.name, p.image, sp.bulk_discount_applicable,
    size_id, ifnull(size_name, '') as size_name,
    option_id, ifnull(option_name, '') as option_name, ifnull(option_price, '') as option_price,
    sp.quantity, sp.price, sp.discounted_price, subtotal from sale_product as sp
    inner join product as p
    on sp.product_id = p.product_id
    where sale_id = :sale_id";
    $sale->products = DB::select($s, $p);

    return $sale;
  }

  public function getSaleProduct($sale_id) {

  }

  public function getPaypalField($sale_no, $nett_total) {
    $paypal_field = new PaypalField();
    $paypal_field->sale_no = $sale_no;
    $paypal_field->amount = $nett_total;

    if (App::environment("production")) {
      $paypal_field->business = "ACL4RTAUWHR9G";
      $paypal_field->paypal_url = "https://www.paypal.com/cgi-bin/webscr";
    } else { //local
      $paypal_field->business = "ACL4RTAUWHR9G";
      $paypal_field->paypal_url = "https://www.sandbox.paypal.com/cgi-bin/webscr";
    }
    $paypal_field->return = url("checkout-success?custom=".$sale_no);

    return $paypal_field;
  }

  public function getLatestSale()
  {
    $s = "SELECT sale_id, s.stat, c.name, s.customer_id, payment_type, product_discount, promo_discount, gross_total, nett_total, sale_on
    from sale as s 
    inner join customer as c on s.customer_id = c.customer_id
    order by sale_on desc limit 100";
    $data = DB::select($s);
    return $data;
  }

  public function setDeliveryAddress(CheckoutOption $checkout_option, $customer_id) {
    if ($checkout_option->delivery_choice == DeliveryChoice::OtherAddress) {
      $this->address = $checkout_option->address_other;
      $this->postal = $checkout_option->postal_other;
      $this->building = $checkout_option->building_other;
      $this->lift_lobby = $checkout_option->lift_lobby_other;
    } else if ($checkout_option->delivery_choice == DeliveryChoice::CurrentAddress) {
      $customer = Customer::find($customer_id);
      $this->address = $customer->address;
      $this->postal = $customer->postal;
      $this->building = $customer->building;
      $this->lift_lobby = $customer->lift_lobby;
    }
  }

  public function calcPoints($nett_total) {
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

  public function paypalSuccess($sale_no, $session_customer_id)
  {
    return DB::table('sale')
      ->where('sale_no', $sale_no)
      ->where('stat', SaleStat::Pending)
      ->where('customer_id', $session_customer_id)
      ->update([
        'stat'=>SaleStat::Paid,
        'paid_on'=>date('Y-m-d H:i:s'),
      ]);
  }

  public function getRedeemPointToAmt() {
    $setting_service = new Setting();
    $settings = $setting_service->getSettingAllWithNameKey();

    $data[$settings['redeemfirstpoint']] = $settings['redeemfirstamt'];
    $data[$settings['redeemsecondpoint']] = $settings['redeemsecondamt'];
    $data[$settings['redeemthirdpoint']] = $settings['redeemthirdamt'];

    return $data;
  }

  public function getPostalCBD() {
    $s = "SELECT postal from district_postal where CBD = 1";
    $data = DB::select($s);

    $res = [];
    foreach($data as $d) {
      $res[] = $d->postal;
    }
    return $res;
  }

  public function getBulkDiscount($products) {
    $total_applicable_for_bulk_discount = 0;
    foreach($products as $product) {
      if ($product->bulk_discount_applicable) {
        $total_applicable_for_bulk_discount += $product->discounted_price * $product->quantity + $product->option_price * $product->quantity;
      }
    }

    $bulk_discount = 0;
    if ($total_applicable_for_bulk_discount >= 1000) {
      $bulk_discount = $total_applicable_for_bulk_discount * 0.08;
    } else if ($total_applicable_for_bulk_discount >= 800) {
      $bulk_discount = $total_applicable_for_bulk_discount * 0.07;
    } else if ($total_applicable_for_bulk_discount >= 300) {
      $bulk_discount = $total_applicable_for_bulk_discount * 0.06;
    }
    return round($bulk_discount, 2);
  }

  public function getDeliveryFee($gross_total, $product_discount, $redeemed_amt) {
    $delivery_fee = 0;
    $total = $gross_total - $product_discount - $redeemed_amt;
    if ($total < 80) {
      $delivery_fee = 10;
    }
    return $delivery_fee;
  }

  public function postalIsCbd($postal) {
    $postal_cbd = $this->getPostalCBD();
    $postal = substr($postal, 0, 2);
    return in_array($postal, $postal_cbd);
  }

  public function setErpSurcharge()
  {
    $postal_is_cbd = $this->postalIsCbd($this->postal);
    $erp_surcharge = 0;
    if ($postal_is_cbd) {
      $erp_surcharge = 5;
    }
    $this->erp_surcharge = $erp_surcharge;
  }

  public function getSaleForPrint($sale_ids) {
    $res = [];
    foreach($sale_ids as $sale_id) {
      $res[] = $this->getSale($sale_id);
    }
    return $res;
  }

  public function getCustomerForPrint($sale_ids) {
    $sale_ids = implode(',', $sale_ids);
    $s = "SELECT s.customer_id, name, mobile, email from sale as s
    inner join customer as c on s.customer_id = c.customer_id
    where s.sale_id in ($sale_ids)";
    $data = DB::select($s);

    $res = [];
    foreach($data as $d) {
      $res[$d->customer_id] = $d;
    }
    return $res;
  }

  public function updateSale($input) {
    $sale_products = DB::table('sale_product')->where('sale_id', $this->sale_id)->get();

    foreach($sale_products as $product) {
      $sale_product['quantity'] = $input['quantity'.$product->product_id];
      $sale_product['subtotal'] = $sale_product['quantity'] * $product->discounted_price;
      DB::table('sale_product')->where('sale_id', $this->sale_id)->where('product_id', $product->product_id)->update($sale_product);
    }

    $sale_products = DB::table('sale_product')->where('sale_id', $this->sale_id)->get();

    $this->stat = $input['stat'];
    $this->payment_type = $input['payment_type'];
    $this->bank_ref = $input['bank_ref'];
    $this->setSaleTotal($sale_products);
    $this->save();
  }
  
}