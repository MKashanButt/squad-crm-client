<?php

namespace App\Filament\Resources\FormInputResource\Pages;

use App\Filament\Resources\FormInputResource;
use Filament\Actions;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\CreateRecord;

class CreateFormInput extends CreateRecord
{
    protected static string $resource = FormInputResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
    
}
