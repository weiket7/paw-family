<?php namespace App\Models\Enums;

abstract class ProductOptionType {
  const Repack = 'R';

  static $values = array(
    self::Repack=>'Repack',
  );
}


