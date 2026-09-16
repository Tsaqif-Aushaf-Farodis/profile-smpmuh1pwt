<?php

namespace App\Filament\Resources\GaleriResource\Pages;

use App\Filament\Resources\GaleriResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListGaleris extends ListRecords
{
    protected static string $resource = GaleriResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
