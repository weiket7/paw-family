<?php namespace App\Models\Enums;

abstract class MainCategory {
  const Dogs = 'dogs';
  const Cats = 'cats';
  const SmallAnimals = 'smallanimals';

  static $values = [
    ''=>'',
    self::Dogs=>'Dogs',
    self::Cats=>'Cats',
    self::SmallAnimals=>'Small Animals',
  ];
}
