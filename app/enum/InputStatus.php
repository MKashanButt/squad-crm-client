<?php

namespace App\Enum;

use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasLabel;

enum InputStatus: string implements HasLabel, HasColor
{
    case DENIED = 'denied';
    case ERROR = 'error';
    case PAYABLE = 'payable';
    case APPROVED = 'approved';
    case WRONG_DOC = 'wrong doc';
    case PAID = 'paid';
    case TRANSFERED = 'transfered';
    case NOT_TRANSFERED = 'not transfered';

    public function getLabel(): ?string
    {
        return match ($this) {
            self::DENIED => 'denied',
            self::ERROR => 'error',
            self::PAYABLE => 'payable',
            self::APPROVED => 'approved',
            self::WRONG_DOC => 'wrong doc',
            self::PAID => 'paid',
            self::TRANSFERED => 'transfered',
            self::NOT_TRANSFERED => 'not transfered',
        };
    }
    public function getColor(): string|array|null
    {
        return match ($this) {
            self::DENIED => 'danger',
            self::ERROR => 'warning',
            self::PAYABLE => 'orange',
            self::APPROVED => 'success',
            self::WRONG_DOC => 'pink',
            self::PAID => 'cyan',
            self::TRANSFERED => 'primary',
            self::NOT_TRANSFERED => 'danger',
        };
    }
}
