<?php

class CommonHelperTest extends \Codeception\TestCase\Test
{
  public function testGetDiscountAmt() {
    $discount_amt = CommonHelper::getDiscountAmtPercentage(195.55, 10);
    $this->assertEquals($discount_amt, 19.55);
  }

  public function testShowDiscountAmtPassInAmtZeroPercentReturnAmt() {
    $discount_amt = CommonHelper::showDiscountAmt(195.55, 0);
    $this->assertEquals($discount_amt, "$195.55");
  }

  public function testShowDiscountAmtPassInAmtTenPercentReturnTenPercentBracketAmt() {
    $discount_amt = CommonHelper::showDiscountAmt(195.55, 10);
    $this->assertEquals($discount_amt, "10% ($195.55)");
  }
}