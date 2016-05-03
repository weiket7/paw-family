<?php namespace App\Models\Enums;

abstract class PetType {
    const Dog = 'Dog';
    const Cat = 'Cat';
    const Rabbit = 'Rabbit';
    const Hamster = 'Hamster';
    const GuineaPig = 'GuineaPig';
    const Chinchilla = 'Chinchilla';
    const Fish = 'Fish';
    const Terrapin = 'Terrapin';

    static $values = [
        ''=>'',
        self::Dog => 'Dog',
        self::Cat => 'Cat',
        self::Rabbit => 'Rabbit',
        self::Hamster => 'Hamster',
        self::GuineaPig => 'GuineaPig',
        self::Chinchilla => 'Chinchilla',
        self::Fish => 'Fish',
        self::Terrapin => 'Terrapin',
    ];
}


