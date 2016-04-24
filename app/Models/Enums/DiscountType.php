<?php namespace App\Models\Enums;

abstract class DiscountType {
  const Amount = 'A';
  const Percentage = 'P';

  static $values = array(
    self::Amount=>'Amount',
    self::Percentage=>'Percentage',
  );
}