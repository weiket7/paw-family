<?php namespace App\Models\Enums;

abstract class SaleStat {
  const Pending = 'P';
  const Processing = 'R';
  const Paid = 'A';
  const Delivered = 'D';
  const Void = 'V';

  static $values = [
    self::Pending=>'Pending Payment',
    self::Paid=>'Paid',
    self::Processing=>'Processing',
    self::Delivered=>'Delivered',
    self::Void=>'Void',
  ];
}