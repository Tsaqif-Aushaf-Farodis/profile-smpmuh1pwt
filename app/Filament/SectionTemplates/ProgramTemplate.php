<?php

namespace App\Filament\SectionTemplates;

use Beier\FilamentPages\Contracts\FilamentPageTemplate;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Repeater;

final class ProgramTemplate
{
    public static function title()
    {
        return 'Program';
    }

    public static function schema()
    {
        return [
            Repeater::make('program')
                ->schema([
                    TextInput::make('title'),
                    TextInput::make('detail'),
                ])
                ->disableItemCreation()
                ->disableItemDeletion()
                ->disableItemMovement()
     
        ];
    }
}