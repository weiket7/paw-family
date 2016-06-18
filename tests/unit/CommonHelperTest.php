<?php

use App\Models\Entities\SaleProduct;

class CommonHelperTest extends \Codeception\TestCase\Test
{
  public function testCalcDiscountAmtByPercentage() {
    $discount_amt = CommonHelper::calcDiscountAmtByPercentage(195.55, 10);
    $this->assertEquals(19.55, $discount_amt);

    $discount_amt = CommonHelper::calcDiscountAmtByPercentage(35.19, 10);
    $this->assertEquals(3.51, $discount_amt);
  }

  public function testRoundUpToFirstDecimal() {
    $res = CommonHelper::roundUpToFirstDecimal(35.19);
    $this->assertEquals(35.2, $res);

    $res = CommonHelper::roundUpToFirstDecimal(35.20);
    $this->assertEquals(35.2, $res);

    $res = CommonHelper::roundUpToFirstDecimal(155.44);
    $this->assertEquals(155.5, $res);

    $res = CommonHelper::roundUpToFirstDecimal(126.55);
    $this->assertEquals(126.6, $res);

    $res = CommonHelper::roundUpToFirstDecimal(27.93);
    $this->assertEquals(28, $res);
  }

  public function testFormatNumber_WholeNumber() {
    $res = CommonHelper::formatNumber(2);
    $this->assertEquals(2, $res);
  }

  public function testFormatNumber_DecimalNumber() {
    $res = CommonHelper::formatNumber(28.5);
    $this->assertEquals(28.50, $res);
  }

  public function testShowDiscountAmtPassInAmtZeroPercentReturnAmt() {
    $discount_amt = CommonHelper::showDiscountAmt(195.55, 0);
    $this->assertEquals("$195.55", $discount_amt);
  }

  public function testShowDiscountAmtPassInAmtTenPercentReturnTenPercentBracketAmt() {
    $discount_amt = CommonHelper::showDiscountAmt(195.55, 10);
    $this->assertEquals("$195.55 (10%)", $discount_amt);
  }

  public function testGetCartCount() {
    $product1 = new SaleProduct();
    $product1->quantity = 2;
    $product2 = new SaleProduct();
    $product2->quantity = 3;
    $products = [$product1, $product2];
    $count = CommonHelper::getCartCount($products);
    $this->assertEquals(5, $count);
  }

  public function testGetCartTotal() {
    $product1 = new SaleProduct();
    $product1->subtotal = 10.2;
    $product2 = new SaleProduct();
    $product2->subtotal = 30.66;
    $products = [$product1, $product2];
    $count = CommonHelper::getCartTotal($products);
    $this->assertEquals(40.86, $count);
  }
}