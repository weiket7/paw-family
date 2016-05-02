<?php namespace App\Models\Enums;

abstract class FeaturedStat {
  const Hot = 'H';
  const New2 = 'N';
  const Sale = 'S';
  const Normal = 'O';

  static $values = [
    self::Hot=>'Hot',
    self::New2=>'New',
    self::Sale=>'Sale',
    self::Normal=>'Normal',
  ];
}


