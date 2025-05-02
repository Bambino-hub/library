<?php

namespace App\Enum;

enum BookStatus: string
{
    case AVAILABLE = 'available';
    case BORROWED = 'borrowed';
    case RESERVED = 'reserved';
    case LOST = 'lost';

    // public function getLabel(): string
    // {
    //     return match ($this) {
    //         self::AVAILABLE => 'Disponible',
    //         self::BORROWED => 'Emprunté',
    //         self::RESERVED => 'Réservé',
    //         self::LOST => 'Perdu',
    //     };
    // }
}
