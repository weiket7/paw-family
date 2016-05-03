<?php namespace App\Models\Enums;

abstract class PromoType {
    const All = 'A';
    const Product = 'P';

    static $values = [
        self::All=>'All',
        self::Product=>'Product',
    ];
}
