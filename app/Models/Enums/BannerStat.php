<?php namespace App\Models\Enums;

abstract class BannerStat {
    const Active = 'A';
    const Hidden = 'I';

    static $values = [
        ''=>'',
        self::Active=>'Active',
        self::Hidden => 'Hidden',
    ];
}