<?php

use App\Models\Cart;
use App\Models\Entities\DeliveryOption;
use App\Models\Entities\SaleProduct;
use App\Models\Enums\DeliveryChoice;
use App\Models\Enums\DeliveryTime;
use App\Models\Enums\PaymentType;
use App\Models\Enums\SaleStat;
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
    $product1_quantity = 3;
    $cart->addToCart(1, $product1_quantity, $size_id, $option_id);
    $product2_quantity = 2;
    $cart->addToCart(2, $product2_quantity);
    $products = $cart->getCart();

    $sale_service = new Sale();
    $customer_id = 1;
    $delivery_option = new DeliveryOption();
    $delivery_option->delivery_choice = DeliveryChoice::OtherAddress;
    $delivery_option->address_other = $this->address_other;
    $delivery_option->delivery_time = DeliveryTime::AnyTime;
    $delivery_option->payment_type = PaymentType::Bank;
    $sale_no = $sale_service->checkoutCart($customer_id, $delivery_option, $products);

    $product1_size2_price = 142.90;
    $product1_size2_discounted_price = 132.90;
    $product1_size2_discount_amt = 10;
    $product1_size2_option2_price = 1;
    $product1_subtotal = $product1_size2_discounted_price * $product1_quantity + $product1_size2_option2_price * $product1_quantity;

    $product2_price = 39.10;
    $product2_discounted_price = 35.19;
    $product2_discount_amt = 3.91;
    $product2_subtotal = $product2_discounted_price * $product2_quantity;

    $gross_total = $product1_size2_price * $product1_quantity + $product1_size2_option2_price * $product1_quantity + $product2_price * $product2_quantity;
    $product_discount = $product1_size2_discount_amt * $product1_quantity + $product2_discount_amt * $product2_quantity;
    $nett_total = $gross_total - $product_discount;

    $this->tester->seeRecord('sale', ['gross_total'=>$gross_total, 'nett_total'=>$nett_total]);

    $sale_id = $sale_service->getSaleIdByNo($sale_no);
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

  public function testGetDeliveryAddress_SelfCollect() {
    $sale_service = new Sale();
    $delivery_address = $sale_service->getDeliveryAddress(DeliveryChoice::SelfCollect, $this->address_other, 1);
    $this->assertEquals(DeliveryChoice::$values[DeliveryChoice::SelfCollect], $delivery_address);
  }

  public function testGetDeliveryAddress_OtherAddress() {
    $sale_service = new Sale();
    $delivery_address = $sale_service->getDeliveryAddress(DeliveryChoice::OtherAddress, $this->address_other, 1);
    $this->assertEquals($this->address_other, $delivery_address);
  }

  public function testGetDeliveryAddress_CurrentAddress() {
    $sale_service = new Sale();
    $delivery_address = $sale_service->getDeliveryAddress(DeliveryChoice::CurrentAddress, $this->address_other, 1);
    $this->assertEquals("Blk 134, Bedok Reservoir Rd", $delivery_address);
  }

  public function testCalculatePoint() {
    $sale_service = new Sale();
    $point = $sale_service->calculatePoint(94.9);
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

  public function testCalcSaleTotal() {
    $product1 = new SaleProduct();
    $product1->price = 142.90;
    $product1->discounted_price = 132.90;
    $product1->discount_amt = 10;
    $product1->quantity = 3;

    $product2 = new SaleProduct();
    $product2->price = 39.10;
    $product2->discounted_price = 35.19;
    $product2->discount_amt = 3.91;
    $product2->quantity = 2;

    $products[] = $product1;
    $products[] = $product2;

    $sale_service = new Sale();
    $sale_total = $sale_service->calcSaleTotal($products);
    $this->assertEquals(506.9, $sale_total->gross_total);
    $this->assertEquals(37.82, $sale_total->product_discount);
    $this->assertEquals(469.08, $sale_total->nett_total);
  }

  public function testSalePaypalSuccess() {
    $sale_no = '123457';
    $this->tester->seeRecord('sale', [
      'sale_no'=>$sale_no, 'stat'=> SaleStat::Pending, 'payment_type'=>PaymentType::Paypal
    ]);

    $sale_service = new Sale();
    $result = $sale_service->paypalSuccess($sale_no);

    $this->assertEquals(1, $result);
    $this->tester->seeRecord('sale', [
      'sale_no'=>$sale_no, 'stat'=> SaleStat::Paid, 'payment_type'=>PaymentType::Paypal
    ]);
  }

}