<?php

use App\Models\Cart;
use App\Models\Entities\CheckoutOption;
use App\Models\Entities\SaleProduct;
use App\Models\Enums\DeliveryChoice;
use App\Models\Enums\DeliveryTime;
use App\Models\Enums\PaymentType;
use App\Models\Enums\SaleStat;
use App\Models\Product;
use App\Models\Sale;
use App\Models\ProductSize;

class SaleTest extends \Codeception\TestCase\Test
{
  protected $tester;
  protected $address_other = "my other address";

  public function testGetSaleUsingIdSuccess() {
    $sale_service = new Sale();
    $sale = $sale_service->getSale(1);
    $this->assertEquals(1, $sale->customer_id);
  }

  public function testGetSale_Success() {
    $sale_service = new Sale();
    $sale = $sale_service->getSale(1);
    $this->assertEquals(1, $sale->customer_id);
  }

  public function testCheckoutCart() {
    $cart = new Cart();
    $size_id = 2;
    $option_id = 2;
    $product1_quantity = 1;
    $cart->addToCart(1, $product1_quantity, $size_id, $option_id);
    $product2_quantity = 2;
    $cart->addToCart(2, $product2_quantity);
    $products = $cart->getCart();

    $sale_service = new Sale();
    $customer_id = 1;
    $checkout_option = new CheckoutOption();
    $checkout_option->delivery_choice = DeliveryChoice::CurrentAddress;
    $checkout_option->delivery_time = DeliveryTime::AnyTime;
    $checkout_option->payment_type = PaymentType::Bank;
    $checkout_option->bank_ref = "1234-5678";
    $checkout_option->delivery_date = date('Y-m-d');
    $checkout_option->redeemed_points = 1200;
    $sale = $sale_service->checkoutCart($customer_id, $checkout_option, $products);

    $product1_size2_cost_price = 126.90;
    $product1_size2_price = 142.90;
    $product1_size2_discounted_price = 132.90;
    $product1_size2_discount_amt = 10;
    $product1_size2_option2_price = 1;
    $product1_subtotal = $product1_size2_discounted_price * $product1_quantity + $product1_size2_option2_price * $product1_quantity;

    $product2_cost_price = 30.19;
    $product2_price = 39.10;
    $product2_discounted_price = 35.19;
    $product2_discount_amt = 3.91;
    $product2_subtotal = $product2_discounted_price * $product2_quantity;

    $gross_total = $product1_size2_price * $product1_quantity + $product1_size2_option2_price * $product1_quantity + $product2_price * $product2_quantity;
    $product_discount = $product1_size2_discount_amt * $product1_quantity + $product2_discount_amt * $product2_quantity;
    $redeemed_amt = 10;
    $nett_total = $gross_total - $product_discount - $redeemed_amt;
    $cost_total = $product1_size2_cost_price * $product1_quantity + $product2_cost_price * $product2_quantity;

    $this->tester->seeRecord('sale', [
      'sale_no'=>$sale->sale_no, 'cost_total'=>$cost_total, 'gross_total'=>$gross_total, 'nett_total'=>$nett_total,
      'redeemed_points'=>1200, 'redeemed_amt'=>10, 'delivery_date'=>date('Y-m-d'), 'bank_ref'=>'1234-5678',
      'address'=>'Blk 134, Bedok Reservoir Rd', 'postal'=>'470134',
    ]);

    $sale_id = $sale_service->getSaleIdByNo($sale->sale_no);
    $this->tester->seeRecord('sale_product', [
      'sale_id'=>$sale_id, 'product_id'=>1, 'name'=>'Addiction Viva La Venison',
      'size_id'=>$size_id, 'size_name'=>'Medium',
      'option_id'=>$option_id, 'option_name'=>'3 packs', 'option_price'=>1.00,
      'price'=>$product1_size2_price, 'discounted_price'=>$product1_size2_discounted_price,
      'subtotal'=>$product1_subtotal,
    ]);
    $this->tester->seeRecord('sale_product', [
      'sale_id'=>$sale_id, 'product_id'=>2, 'name'=>'Addiction Salmon Bleu',
      'size_id'=>0, 'size_name'=>null,
      'option_id'=>0, 'option_name'=>null, 'option_price'=>null,
      'price'=>$product2_price, 'discounted_price'=>$product2_discounted_price,
      'subtotal'=>$product2_subtotal,
    ]);
  }

  public function testCheckoutCart_OtherAddress_PostalIsCbd_WithDeliveryFee() {
    $cart = new Cart();
    $product_id = 24;
    $cart->addToCart($product_id, 4);
    $products = $cart->getCart();

    $sale_service = new Sale();
    $customer_id = 1;
    $checkout_option = new CheckoutOption();
    $checkout_option->delivery_choice = DeliveryChoice::OtherAddress;
    $checkout_option->address_other = 'Blk 134';
    $checkout_option->postal_other = '250134';
    $checkout_option->building_other = '';
    $checkout_option->lift_lobby_other = '';
    $checkout_option->delivery_time = DeliveryTime::Four30to8;
    $checkout_option->payment_type = PaymentType::Cheque;
    $checkout_option->delivery_date = 2;
    $sale = $sale_service->checkoutCart($customer_id, $checkout_option, $products);

    $this->tester->seeRecord('sale', [
      'sale_no'=>$sale->sale_no, 'gross_total'=>21, 'nett_total'=>35, 'erp_surcharge'=>5, 'delivery_fee'=>'10',
    ]);
  }

  public function testCheckoutCart_BulkDiscount() {
    $cart = new Cart();
    $product_id = 1;
    $cart->addToCart($product_id, 12);
    $products = $cart->getCart();

    $sale_service = new Sale();
    $customer_id = 1;
    $checkout_option = new CheckoutOption();
    $checkout_option->delivery_choice = DeliveryChoice::CurrentAddress;
    $checkout_option->delivery_time = DeliveryTime::Four30to8;
    $checkout_option->payment_type = PaymentType::Bank;
    $checkout_option->delivery_date = 2;
    $sale = $sale_service->checkoutCart($customer_id, $checkout_option, $products);

    $this->tester->seeRecord('sale', [
      'sale_no'=>$sale->sale_no, 'gross_total'=>469.2, 'product_discount'=>120.00,
      'bulk_discount'=>20.95, 'nett_total'=>328.25, 'cost_total'=>349.20, 'erp_surcharge'=>0, 'delivery_fee'=>'0',
    ]);
  }

  public function testGetDeliveryAddress_CurrentAddress() {
    $checkout_option = new CheckoutOption();
    $checkout_option->delivery_choice = DeliveryChoice::CurrentAddress;

    $sale = new Sale();
    $sale->setDeliveryAddress($checkout_option, 1);
    $this->assertEquals("Blk 134, Bedok Reservoir Rd", $sale->address);
    $this->assertEquals("470134", $sale->postal);
    $this->assertEquals("A", $sale->lift_lobby);
  }

  public function testGetDeliveryAddress_OtherAddress() {
    $checkout_option = new CheckoutOption();
    $checkout_option->address_other = "Blk 134";
    $checkout_option->postal_other = "250134";
    $checkout_option->lift_lobby_other = "A";
    $checkout_option->delivery_choice = DeliveryChoice::OtherAddress;

    $sale = new Sale();
    $sale->setDeliveryAddress($checkout_option, 1);
    $this->assertEquals("Blk 134", $sale->address);
    $this->assertEquals("250134", $sale->postal);
    $this->assertEquals("A", $sale->lift_lobby);
  }

  public function testGetDeliveryAddress_SelfCollect() {
    $checkout_option = new CheckoutOption();
    $checkout_option->delivery_choice = DeliveryChoice::SelfCollect;

    $sale = new Sale();
    $sale->setDeliveryAddress($checkout_option, 1);
    $this->assertEquals("", $sale->address);
    $this->assertEquals("", $sale->postal);
    $this->assertEquals("", $sale->lift_lobby);
  }

  public function testCalculatePoint() {
    $sale_service = new Sale();
    $point = $sale_service->calcPoints(94.9);
    $this->assertEquals(94, $point);
  }

  public function testGetSaleNoAndIncrement() {
    $sale_service = new Sale();
    $current_sale_no = DB::table('sale_running_no')->value('value');

    $sale_no = $sale_service->getSaleNoAndIncrement();

    $new_sale_no = $current_sale_no+1;
    $this->assertEquals($new_sale_no, $sale_no);
    $this->tester->seeRecord('sale_running_no', ['value'=>$new_sale_no]);
  }

  public function testGetSaleIdByNo() {
    $sale_service = new Sale();
    $sale_id = $sale_service->getSaleIdByNo(123456);
    $this->assertEquals(1, $sale_id);
  }

  public function testSetSaleTotal() {
    $product1 = new SaleProduct();
    $product1->price = 142.90;
    $product1->discounted_price = 132.90;
    $product1->discount_amt = 10;
    $product1->quantity = 3;
    $product1->cost_price = 126.9;
    $product1->bulk_discount_applicable = 1;

    $product2 = new SaleProduct();
    $product2->price = 39.10;
    $product2->discounted_price = 35.19;
    $product2->discount_amt = 3.91;
    $product2->quantity = 2;
    $product2->cost_price = 30.19;
    $product2->bulk_discount_applicable = 1;

    $products[] = $product1;
    $products[] = $product2;

    $sale = new Sale();
    $sale->setSaleTotal($products);
    $this->assertEquals(506.9, $sale->gross_total);
    $this->assertEquals(37.82, $sale->product_discount);
    $this->assertEquals(28.14, $sale->bulk_discount);
    $this->assertEquals(440.94, $sale->nett_total);
    $this->assertEquals(441.08, $sale->cost_total);
  }

  public function testSetSaleTotal_RedeemAmt_ErpSurcharge_DeliveryFee() {
    $product = new SaleProduct();
    $product->price = 5.25;
    $product->discounted_price = 5;
    $product->discount_amt = 0.25;
    $product->quantity = 4;
    $product->cost_price = 4;
    $product->bulk_discount_applicable = 1;
    $products[] = $product;

    //20 - 10 redeem amt + 10 delivery charge + 5 erp surcharge = 25
    $sale = new Sale();
    $sale->redeemed_amt = 10;
    $sale->erp_surcharge = 5;
    $sale->setSaleTotal($products);
    $this->assertEquals(21, $sale->gross_total);
    $this->assertEquals(1, $sale->product_discount);
    $this->assertEquals(10, $sale->delivery_fee);
    $this->assertEquals(25, $sale->nett_total);
    $this->assertEquals(16, $sale->cost_total);
  }

  public function testCheckoutCart_GrossMinusProductDiscount_ExcludeRedeemAmt_NotBelow300_NoBulkDiscount() {
    $product = new SaleProduct();
    $product->price = 39.1;
    $product->discounted_price = 29.1;
    $product->discount_amt = 10;
    $product->quantity = 10;
    $product->cost_price = 25;
    $product->bulk_discount_applicable = 1;
    $products[] = $product;

    //29.1*10=291, no bulk discount
    $sale = new Sale();
    $sale->redeemed_amt = 25;
    $sale->setSaleTotal($products);
    $this->assertEquals(391, $sale->gross_total);
    $this->assertEquals(100, $sale->product_discount);
    $this->assertEquals(0, $sale->bulk_discount);
    $this->assertEquals(0, $sale->delivery_fee);
    $this->assertEquals(266, $sale->nett_total);
    $this->assertEquals(250, $sale->cost_total);
  }

  public function testCheckoutCart_GrossMinusProductDiscount_ExcludeRedeemAmt_Above300_BulkDiscount() {
    $product = new SaleProduct();
    $product->price = 39.1;
    $product->discounted_price = 29.1;
    $product->discount_amt = 10;
    $product->quantity = 12;
    $product->cost_price = 25;
    $product->bulk_discount_applicable = 1;
    $products[] = $product;
//37.45
    //29.1*12=349.2, bulk discount 349.2*0.06=20.95, 324.2-20.95=303.25
    $sale = new Sale();
    $sale->redeemed_amt = 25;
    $sale->setSaleTotal($products);
    $this->assertEquals(469.2, $sale->gross_total);
    $this->assertEquals(120, $sale->product_discount);
    $this->assertEquals(20.95, $sale->bulk_discount);
    $this->assertEquals(0, $sale->delivery_fee);
    $this->assertEquals(303.25, $sale->nett_total);
    $this->assertEquals(300, $sale->cost_total);
  }

  public function testSalePaypalSuccess() {
    $sale_no = '123457';
    $this->tester->seeRecord('sale', [
      'sale_no'=>$sale_no, 'stat'=> SaleStat::Pending, 'payment_type'=>PaymentType::Paypal
    ]);

    $sale_service = new Sale();
    $session_customer_id = 1;
    $result = $sale_service->paypalSuccess($sale_no, $session_customer_id);

    $this->assertEquals(1, $result);
    $this->tester->seeRecord('sale', [
      'sale_no'=>$sale_no, 'stat'=> SaleStat::Paid, 'payment_type'=>PaymentType::Paypal
    ]);
  }

  public function testGetPaypalField() {
    $sale_service = new Sale();
    $sale_no = 45678;
    $nett_total = 20;
    $paypal_field = $sale_service->getPaypalField($sale_no, $nett_total);
    $this->assertEquals($sale_no, $paypal_field->sale_no);
    $this->assertEquals($nett_total, $paypal_field->amount);
    $this->assertEquals(url("checkout-success?custom=".$sale_no), $paypal_field->return);
    $this->assertEquals("https://www.sandbox.paypal.com/cgi-bin/webscr", $paypal_field->paypal_url);
    $this->assertEquals("ACL4RTAUWHR9G", $paypal_field->business);
  }

  public function testSetErpSurcharge_IsCbd() {
    $sale = new Sale();
    $sale->postal = '250134';
    $sale->setErpSurcharge();
    $this->assertEquals(5, $sale->erp_surcharge);
  }

  public function testSetErpSurcharge_IsNotCbd() {
    $sale = new Sale();
    $sale->postal = '470134';
    $sale->setErpSurcharge();
    $this->assertEquals(0, $sale->erp_surcharge);
  }

  public function testGetDeliveryFee_80AndAbove_NoDeliveryFee() {
    $sale = new Sale();
    $delivery_fee = $sale->getDeliveryFee(100, 10, 10);
    $this->assertEquals(0, $delivery_fee);
  }

  public function testGetDeliveryFee_Below80_DeliveryFeeIs10() {
    $sale = new Sale();
    $delivery_fee = $sale->getDeliveryFee(90, 12, 0);
    $this->assertEquals(10, $delivery_fee);
  }

  public function testPostalIsCbdTrue() {
    $sale = new Sale();
    $postal_is_cbd = $sale->postalIsCbd("23000");
    $this->assertTrue($postal_is_cbd);
  }

  public function testPostalIsCbdFalse() {
    $sale = new Sale();
    $postal_is_cbd = $sale->postalIsCbd("470134");
    $this->assertFalse($postal_is_cbd);
  }

  public function testGetBulkDiscount() {
    $sale = new Sale();

    $product1 = new Product();
    $product1->bulk_discount_applicable = 1;
    $product1->discounted_price = 132.90;
    $product1->quantity = 3;

    $product2 = new Product();
    $product2->bulk_discount_applicable = 0;
    $product2->discounted_price = 5.25;
    $product2->quantity = 90;

    $products = [$product1, $product2];

    $bulk_discount = $sale->getBulkDiscount($products);
    $this->assertEquals(23.92, $bulk_discount);
  }

}