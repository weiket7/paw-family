<?php namespace App\Models\Enums;

abstract class PaymentType {
  const Cash = 'A';
  const Credit = 'C';
  const Bank = 'B';
  const Cheque = 'Q';
  const Paypal = 'P';

  static $values = [
    ''=>'',
    self::Cash=>'Cash',
    self::Credit=>'Credit',
    self::Bank=>'Bank',
    self::Cheque=>'Cheque',
    self::Paypal=>'Paypal',
  ];
}