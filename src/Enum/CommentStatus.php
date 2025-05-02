<?php

namespace App\Enum;

enum CommentStatus: string
{
    case PENDING = 'pending';
    case APPROVED = 'approved';
    case REJECTED = 'rejected';
    case SPAM = 'spam';
    case DELETED = 'deleted';

    public function getLabel(): string
    {
        return match ($this) {
            self::PENDING => 'En attente',
            self::APPROVED => 'Approuvé',
            self::REJECTED => 'Rejeté',
            self::SPAM => 'Spam',
            self::DELETED => 'Supprimé',
        };
    }
}
