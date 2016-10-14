<?php
use App\Models\Entities\ProductDiscount;
use App\Models\Enums\DiscountType;

class ProductDiscountTest extends \Codeception\TestCase\Test
{
  protected $tester;

  public function testProductDiscountWithDiscountAmt()
  {
    $price = 39.10;
    $discount_percentage = 0;
    $discount_amt = 5;
    $product_discount = new ProductDiscount($price, 'A', $discount_percentage, $discount_amt, false);

    $this->assertEquals(5, $product_discount->discount_amt);
    $this->assertEquals(0, $product_discount->discount_percentage);
    $this->assertEquals(DiscountType::Amount, $product_discount->discount_type);
    $this->assertEquals(34.10, $product_discount->discounted_price);
  }

  public function testProductDiscountWithDiscountPercentage()
  {
    $price = 39.10;
    $discount_percentage = 10;
    $discount_amt = 3.91;
    $product_discount = new ProductDiscount($price, 'P', $discount_percentage, $discount_amt, false);

    $this->assertEquals(3.91, $product_discount->discount_amt);
    $this->assertEquals(10, $product_discount->discount_percentage);
    $this->assertEquals(DiscountType::Percentage, $product_discount->discount_type);
    $this->assertEquals(35.19, $product_discount->discounted_price);
  }

  public function testProductDiscountWithDiscountPercentageAndRoundUpToFirstDecimal()
  {
    $price = 39.10;
    $discount_percentage = 10;
    $discount_amt = 3.91;
    $product_discount = new ProductDiscount($price, 'P', $discount_percentage, $discount_amt, true);

    $this->assertEquals(3.90, $product_discount->discount_amt);
    $this->assertEquals(10, $product_discount->discount_percentage);
    $this->assertEquals(DiscountType::Percentage, $product_discount->discount_type);
    $this->assertEquals(35.20, $product_discount->discounted_price);
  }

}