<?php

use App\Models\Cart;

class CartTest extends \Codeception\TestCase\Test
{
  protected $tester;

  public function testAddToCart_ProductNoSize_NotYetInCart() {
    $cart = new Cart();
    $cart->addToCart(2, 2);
    $products = $cart->getCart();
    $key = $cart->getKey(2, 0);
    $product = $products[$key];

    $this->assertCount(1, $products);
    $this->assertEquals(2, $product->product_id);
    $this->assertEquals(2, $product->quantity);
    $this->assertEquals("Addiction Salmon Bleu", $product->name);
    $this->assertEquals(39.1, $product->price);
    $this->assertEquals("addiction-salmon-bleu.jpg", $product->image);
    $this->assertEquals(3.91, $product->discount_amt);
    $this->assertEquals(35.19, $product->discounted_price);
    $this->assertEquals(70.38, $product->subtotal);
  }

  public function testAddToCart_ProductHasSizeAndOption_NotYetInCart() {
    $cart = new Cart();
    $product_id = 1; $quantity = 2; $size_id = 2; $option_id = 2;
    $cart->addToCart($product_id, $quantity, $size_id, $option_id);
    $products = $cart->getCart();
    $key = $cart->getKey($product_id, $size_id);
    $product = $products[$key];

    $this->assertCount(1, $products);
    $this->assertEquals($product_id, $product->product_id);
    $this->assertEquals($quantity, $product->quantity);
    $this->assertEquals("Addiction Viva La Venison", $product->name);
    $this->assertEquals(142.90, $product->price);
    $this->assertEquals("Medium", $product->size_name);
    $this->assertEquals("3 packs", $product->option_name);
    $this->assertEquals(1, $product->option_price);
    //$this->assertEquals(3.91, $product->discount_amt);
    $this->assertEquals(132.90, $product->discounted_price);
    $this->assertEquals(267.80, $product->subtotal);
  }

  public function testAddToCartProductExistInCartIncreaseQuantity() {
    $cart = new Cart();
    $product_id = 2;
    $size_id = 0;
    $cart->addToCart($product_id, 2);
    $cart->addToCart($product_id, 1);
    $products = $cart->getCart();
    $key = $cart->getKey($product_id, $size_id);
    $product = $products[$key];

    $this->assertCount(1, $products);
    $this->assertEquals($product_id, $product->product_id);
    $this->assertEquals(3, $product->quantity);
    $this->assertEquals(105.57, $product->subtotal);
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

  public function testRemoveFromCart() {
    $cart = new Cart();
    $cart->addToCart(1, 2);
    $products = $cart->getCart();
    $this->assertCount(1, $products);

    $cart->removeFromCart(1, 0);
    $products = $cart->getCart();
    $this->assertCount(0, $products);
  }

  public function testUpdateCart() {
    $cart = new Cart();
    $cart->addToCart(1, 2);
    $cart->updateCart(1, 5);
    $products = $cart->getCart();
    $key = $cart->getKey(1, 0);
    $this->assertCount(1, $products);
    $product = $products[$key];
    $this->assertEquals(5, $product->quantity);
  }
}