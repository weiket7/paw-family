<?php namespace App\Models\Enums;

abstract class SubscribeEmailStat {
  const Yes = 'Y';
  const No = 'N';
  const Unsubscribed = 'U';

  static $values = [
    ''=>'',
    self::Yes=>'Yes',
    self::No=>'No',
    self::Unsubscribed=>'Unsubscribed',
  ];
}