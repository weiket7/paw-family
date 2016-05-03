<?php namespace App\Models\Enums;

abstract class ProductDescType {
  const Description = 'D';
  const Ingredient = 'I';
  const Video = 'V';

  static $values = [
    ''=>'',
    self::Description=>'Description',
    self::Ingredient => 'Ingredients',
    self::Video=>'Video',
  ];
}