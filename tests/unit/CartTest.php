<?php

use App\Models\Cart;

class CartTest extends \Codeception\TestCase\Test
{
    protected $tester;

    public function testAddToCartProductNotYetInCart() {
        $cart = new Cart();
        $cart->addToCart(1, 2);
        $products = $cart->getCart();
        $this->assertCount(1, $products);
        $this->assertEquals(1, $products['1_0']['product_id']);
        $this->assertEquals(2, $products['1_0']['quantity']);
    }

    public function testAddToCartProductExistInCartIncreaseQuantity() {
        $cart = new Cart();
        $cart->addToCart(1, 2);
        $cart->addToCart(1, 1);
        $products = $cart->getCart();
        $this->assertCount(1, $products);
        $this->assertEquals(1, $products['1_0']['product_id']);
        $this->assertEquals(3, $products['1_0']['quantity']);
    }

    public function testAddToCartCanAcceptSizeAndOption() {
        $cart = new Cart();
        $cart->addToCart(1, 2, 2, 2);
        $products = $cart->getCart();
        $key = $cart->getKey(1, 2);
        $this->assertCount(1, $products);
        $this->assertEquals(1, $products[$key]['product_id']);
        $this->assertEquals(2, $products[$key]['quantity']);
        $this->assertEquals(2, $products[$key]['size_id']);
        $this->assertEquals(2, $products[$key]['option_id']);
    }

    public function testGetKey() {
        $cart = new Cart();
        $key = $cart->getKey(1, 2);
        $this->assertEquals('1_2', $key);
    }

    public function testCheckout() {
        $cart = new Cart();
        $cart->addToCart(2, 2);
        $products = $cart->checkOut();
        $key = $cart->getKey(2, 0);
        $product = $products[$key];

        $this->assertEquals("Addiction Salmon Bleu", $product->name);
        $this->assertEquals(2, $product->quantity);
        $this->assertEquals(39.1, $product->price);
        $this->assertEquals("addiction-salmon-bleu.jpg", $product->image);
        $this->assertEquals(35.19, $product->discounted_price);
    }
}