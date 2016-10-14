<?php

namespace App\Models\Entities;

use App\Models\Enums\DiscountType;
use CommonHelper;

class ProductDiscount
{
  public $discount_percentage;
  public $discount_type;
  public $discount_amt;
  public $discounted_price;
  
  public function __construct($price, $discount_type, $discount_percentage, $discount_amt, $round_up_ten_cent)
  {
    $this->discount_type = $discount_type;
    if ($discount_type == DiscountType::Percentage) {
      $this->discount_percentage = $discount_percentage;
      $this->discount_amt = CommonHelper::calcDiscountAmtByPercentage($price, $discount_percentage);
    } else {
      $this->discount_percentage = 0;
      $this->discount_amt = $discount_amt;
    }
    $this->discounted_price = $price - $this->discount_amt;
    if ($round_up_ten_cent) {
      $this->discounted_price = CommonHelper::roundUpToFirstDecimal($this->discounted_price);
      $this->discount_amt = $price - $this->discounted_price;
    }
  }
}