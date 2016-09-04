<?php namespace App\Models\Enums;

abstract class PointType {
  const Earn = 'E';
  const Spend = 'S';
  const Redeem = 'R';
  const Overwrite = 'O';

  static $values = [
    self::Earn=>'Earn',
    self::Redeem=>'Redeem',
    self::Spend=>'Spend',
    self::Overwrite=>'Overwrite',
  ];
}


