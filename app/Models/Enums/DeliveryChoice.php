<?php namespace App\Models\Enums;

abstract class DeliveryChoice {
  const CurrentAddress = 'C';
  const OtherAddress = 'O';
  const SelfCollect = 'S';

  static $values = [
    ''=>'',
    self::CurrentAddress=>'Current address',
    self::OtherAddress=>'Other address',
    self::SelfCollect=>'Self collect',
  ];
}