<?php

namespace App\Filament\Resources\FormInputResource\Pages;

use App\Filament\Resources\FormInputResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListFormInputs extends ListRecords
{
    protected static string $resource = FormInputResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
