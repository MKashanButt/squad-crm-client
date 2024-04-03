<?php

namespace App\Enum;

use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasLabel;

enum InputStatus: string implements HasLabel, HasColor
{
    case DENIED = 'Denied';
    case ERROR = 'Error';
    case PAYABLE = 'Payable';
    case APPROVED = 'Approved';
    case WRONG_DOC = 'Wrong doc';
    case PAID = 'Paid';
    case AWAITING = 'Awaiting';
    case TRANSFERED = 'Transfered';
    case NOT_TRANSFERED = 'Not transfered';

    public function getLabel(): ?string
    {
        return match ($this) {
            self::DENIED => 'Denied',
            self::ERROR => 'Error',
            self::PAYABLE => 'Payable',
            self::APPROVED => 'Approved',
            self::WRONG_DOC => 'Wrong doc',
            self::PAID => 'Paid',
            self::AWAITING => 'Awaiting',
            self::TRANSFERED => 'Transfered',
            self::NOT_TRANSFERED => 'Not transfered',
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
            self::AWAITING => '',
            self::TRANSFERED => 'primary',
            self::NOT_TRANSFERED => 'danger',
        };
    }
}
