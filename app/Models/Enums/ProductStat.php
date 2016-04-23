<?php namespace App\Models\Enums;

abstract class ProductStat {
  const Available = 'A';
  const Hidden = 'H';

  static $values = array(
    self::Available=>'Available',
    self::Hidden=>'Hidden',
  );
}


