<?php namespace App\Models\Enums;

abstract class PointType {
  const Earn = 'E';
  const Spend = 'S';
  const Redeem = 'R';

  static $values = [
    self::Earn=>'Earn',
    self::Redeem=>'Redeem',
    self::Spend=>'Spend',
  ];
}


