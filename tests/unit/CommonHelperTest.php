<?php

class CommonHelperTest extends \Codeception\TestCase\Test
{
  public function testGetDiscountAmt() {
    $discount_amt = CommonHelper::getDiscountAmtPercentage(195.55, 10);
    $this->assertEquals(19.55, $discount_amt);
  }

  public function testGetDiscountAmt2() {
    $discount_amt = CommonHelper::getDiscountAmtPercentage(35.19, 10);
    $this->assertEquals(3.51, $discount_amt);
  }

  public function testShowDiscountAmtPassInAmtZeroPercentReturnAmt() {
    $discount_amt = CommonHelper::showDiscountAmt(195.55, 0);
    $this->assertEquals("$195.55", $discount_amt);
  }

  public function testShowDiscountAmtPassInAmtTenPercentReturnTenPercentBracketAmt() {
    $discount_amt = CommonHelper::showDiscountAmt(195.55, 10);
    $this->assertEquals("10% ($195.55)", $discount_amt);
  }
}