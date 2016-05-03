<?php namespace App\Models\Enums;

abstract class BannerStat {
    const Active = 'A';
    const Inactive = 'I';
    const Expired = 'E';

    static $values = [
        ''=>'',
        self::Active=>'Active',
        self::Inactive => 'Inactive',
        self::Expired=>'Expired',
    ];
}