<?php namespace App\Models\Enums;

abstract class MainCategory {
  const Dogs = 'D';
  const Cats = 'C';
  //const SmallAnimals = 'S';

  static $values = array(
    self::Dogs=>'Dogs',
    self::Cats=>'Cats',
    //self::SmallAnimals=>'Small Animals',
  );
}


