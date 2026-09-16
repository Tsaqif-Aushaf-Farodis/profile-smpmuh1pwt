<?php

namespace App\Filament\SectionTemplates;

use Beier\FilamentPages\Contracts\FilamentPageTemplate;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Repeater;

final class PrestasiTemplate
{
    public static function title()
    {
        return 'Prestasi';
    }

    public static function schema()
    {
        return [
            Repeater::make('prestasi')
                ->schema([
                    TextInput::make('title'),
                ])
                ->disableItemCreation()
                ->disableItemDeletion()
                ->disableItemMovement()
     
        ];
    }
}