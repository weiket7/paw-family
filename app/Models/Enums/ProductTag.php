<?php namespace App\Models\Enums;

abstract class ProductTag {
  const Fresh = 'N';
  const Hot = 'H';
  const Sale = 'S';

  static $values = [
    ''=>'',
    self::Fresh=>'New',
    self::Hot=>'Hot', //will still be shown
    self::Sale=>'Sale',
  ];
}


