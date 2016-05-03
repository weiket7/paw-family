<?php namespace App\Models\Enums;

abstract class BannerType {
    const Product = 'P';
    const Brand = 'B';
    const Category = 'C';
    const Promo = 'O';

    static $values = [
        ''=>'',
        self::Product=>'Product',
        self::Brand => 'Brand',
        self::Category=>'Category',
        self::Promo=>'Promo',
    ];
}