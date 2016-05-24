<?php namespace App\Models\Enums;

abstract class DeliveryTime {
  const AnyTime = 'A';
  const Oneto430 = '1';
  const Four30to8 = '4';

  static $values = [
    ''=>'',
    self::AnyTime=>'Any time',
    self::Oneto430=>'1pm - 4.30pm',
    self::Four30to8=>'4.30pm - 8pm',
  ];
}