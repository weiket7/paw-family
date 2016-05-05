<?php

use App\Models\Cart;
use App\Models\Enums\PaymentType;
use App\Models\Sale;
use App\Models\Size;

class SaleTest extends \Codeception\TestCase\Test
{
    protected $tester;

    public function testGetSaleUsingIdSuccess() {
        $sale_service = new Sale();
        $sale = $sale_service->getSale(1);
        $this->assertEquals(1, $sale->customer_id);
    }

    public function testGetSaleUsingCodeSuccess() {
        $sale_service = new Sale();
        $sale = $sale_service->getSale("123456");
        $this->assertEquals(1, $sale->customer_id);
    }

    public function testCheckoutCart() {
        $cart = new Cart();
        $cart->addToCart(1, 1, 2, 2);
        $cart->addToCart(2, 2);
        $products = $cart->getCart();

        $sale_service = new Sale();
        $customer_id = 1;
        $payment_type = PaymentType::Bank;
        $sale_service->checkoutCart($customer_id, $payment_type, $products);

        $product1_size2_price = 39.10;
        $product1_size2_discounted_price = 29.10;
        $product2_price = 39.10;
        $product2_discounted_price = 35.19;
        //$product1_subtotal = $product1_size2_discounted_price * 1;
        //$product2_subtotal = $product2_discounted_price * 2;
        $gross_total = $product1_size2_price * 1 + $product2_price * 2;
        $nett_total = $product1_size2_discounted_price * 1 + $product2_discounted_price * 2;

        $this->tester->seeRecord('sale', ['gross_total'=>$gross_total, 'nett_total'=>$nett_total]);
    }


}