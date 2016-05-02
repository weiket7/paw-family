<?php namespace App\Models\Enums;

abstract class CustomerStat {
  const Active = 'A';
  const Blacklisted = 'B';
  const Deleted = 'D';

  static $values = [
    ''=>'',
    self::Active=>'Active',
    self::Blacklisted => 'Blacklisted',
    self::Deleted=>'Deleted',
  ];
}