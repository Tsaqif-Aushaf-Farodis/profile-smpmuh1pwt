<?php

namespace App\Filament\Resources\GaleriResource\Pages;

use App\Filament\Resources\GaleriResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditGaleri extends EditRecord
{
    protected static string $resource = GaleriResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
