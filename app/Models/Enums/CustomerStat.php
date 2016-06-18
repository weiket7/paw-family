<?php namespace App\Models\Enums;

abstract class CustomerStat {
  const Active = 'A';
  const Blacklisted = 'B';

  static $values = [
    ''=>'',
    self::Active=>'Active',
    self::Blacklisted => 'Blacklisted',
  ];
}