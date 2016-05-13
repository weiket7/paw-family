<?php namespace App\Models\Enums;

abstract class ProductStat {
  const Available = 'A';
  const OutOfStock = 'O';
  const Hidden = 'H';

  static $values = [
    ''=>'',
    self::Available=>'Available',
    self::OutOfStock=>'Out Of Stock', //will still be shown
    self::Hidden=>'Hidden',
  ];
}


