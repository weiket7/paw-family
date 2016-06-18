<?php namespace App\Models\Enums;

abstract class PointType {
  const Award = 'A';
  const Spend = 'S';

  static $values = [
    self::Award=>'Award',
    self::Spend=>'Spend',
  ];
}


