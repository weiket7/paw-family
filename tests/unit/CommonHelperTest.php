<?php

class CommonHelperTest extends \Codeception\TestCase\Test
{
    public function testGetDiscountAmt() {
        $discount_amt = CommonHelper::getDiscountAmtPercentage(195.55, 10);
        $this->assertEquals($discount_amt, 19.55);
    }

}