<?php

use App\Models\Cart;

class CartTest extends \Codeception\TestCase\Test
{
    protected $tester;

    public function testAddToCartProductNotYetInCart() {
        $cart = new Cart();
        $cart->addToCart(2, 1);
        $products = $cart->getCart();
        $key = $cart->getKey(2, 0);
        $product = $products[$key];

        $this->assertCount(1, $products);
        $this->assertEquals(2, $product->product_id);
        $this->assertEquals(1, $product->quantity);
        $this->assertEquals("Addiction Salmon Bleu", $product->name);
        $this->assertEquals(39.1, $product->price);
        $this->assertEquals("addiction-salmon-bleu.jpg", $product->image);
        $this->assertEquals(35.19, $product->discounted_price);
    }

    public function testAddToCartProductExistInCartIncreaseQuantity() {
        $cart = new Cart();
        $cart->addToCart(1, 2);
        $cart->addToCart(1, 1);
        $products = $cart->getCart();
        $key = $cart->getKey(1, 0);
        $product = $products[$key];

        $this->assertCount(1, $products);
        $this->assertEquals(1, $product->product_id);
        $this->assertEquals(3, $product->quantity);
    }

    public function testAddToCartCanAcceptSizeAndOption() {
        $cart = new Cart();
        $cart->addToCart(1, 2, 2, 2);
        $products = $cart->getCart();
        $key = $cart->getKey(1, 2);
        $product = $products[$key];
        $this->assertCount(1, $products);
        $this->assertEquals(1, $product->product_id);
        $this->assertEquals(2, $product->quantity);
        $this->assertEquals(2, $product->size_id);
        $this->assertEquals(2, $product->option_id);
    }

    public function testGetKey() {
        $cart = new Cart();
        $key = $cart->getKey(1, 2);
        $this->assertEquals('1_2', $key);
    }
}