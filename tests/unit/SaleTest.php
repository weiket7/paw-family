<?php

use App\Models\Cart;
use App\Models\DeliveryOption;
use App\Models\Enums\DeliveryChoice;
use App\Models\Enums\DeliveryTime;
use App\Models\Enums\PaymentType;
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
    $cart->addToCart(1, 1, 2, 2);
    $cart->addToCart(2, 2);
    $products = $cart->getCart();

    $sale_service = new Sale();
    $customer_id = 1;
    $delivery_option = new DeliveryOption();
    $delivery_option->delivery_choice = DeliveryChoice::OtherAddress;
    $delivery_option->address_other = $this->address_other;
    $delivery_option->delivery_time = DeliveryTime::AnyTime;
    $delivery_option->payment_type = PaymentType::Bank;
    $sale_service->checkoutCart($customer_id, $delivery_option, $products);

    $product1_size2_price = 142.90;
    $product1_size2_discounted_price = 132.90;
    $product2_price = 39.10;
    $product2_discounted_price = 35.19;
    $gross_total = $product1_size2_price * 1 + $product2_price * 2;
    $nett_total = $product1_size2_discounted_price * 1 + $product2_discounted_price * 2;

    $this->tester->seeRecord('sale', ['gross_total'=>$gross_total, 'nett_total'=>$nett_total]);
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
    $sale_no = $sale_service->getSaleNoAndIncrement();
    $this->assertEquals(100018620, $sale_no);
    $this->tester->seeRecord('sale_running_no', ['value'=>100018620]);
  }

  public function testGetSaleIdByNo() {
    $sale_service = new Sale();
    $sale_id = $sale_service->getSaleIdByNo(123456);
    $this->assertEquals(1, $sale_id);
  }

}