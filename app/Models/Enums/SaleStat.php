<?php namespace App\Models\Enums;

abstract class SaleStat {
  const Submitted = 'S';
  const Paid = 'P';
  const Processing = 'R';
  const Delivered = 'D';
  const Void = 'V';

  static $values = [
    ''=>'',
    self::Submitted=>'Submitted',
    self::Paid=>'Paid',
    self::Processing=>'Processing',
    self::Delivered=>'Delivered',
    self::Void=>'Void',
  ];
}


