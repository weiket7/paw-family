<?php namespace App\Models\Enums;

abstract class ProductStat {
  const Available = 'A';
  const Hidden = 'H';
  const OutOfStock = 'O';

  static $values = array(
    self::Available=>'Available',
    self::Hidden=>'Hidden',
    self::OutOfStock=>'Out Of Stock',
  );
}


