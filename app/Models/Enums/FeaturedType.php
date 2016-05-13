<?php namespace App\Models\Enums;

abstract class FeaturedType {
  const Hot = 'H';
  const New2 = 'N';
  const Sale = 'S';
  const Featured = 'F';

  static $values = [
    self::Hot=>'Hot',
    self::New2=>'New',
    self::Sale=>'Sale',
    self::Featured=>'Featured',
  ];
}


