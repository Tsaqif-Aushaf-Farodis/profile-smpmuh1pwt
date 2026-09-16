<?php

namespace App\Filament\Resources\PrestasiResource\Pages;

use App\Filament\Resources\PrestasiResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPrestasis extends ListRecords
{
    protected static string $resource = PrestasiResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
