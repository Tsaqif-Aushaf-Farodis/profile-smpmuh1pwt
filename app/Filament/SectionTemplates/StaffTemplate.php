<?php

namespace App\Filament\SectionTemplates;

use Beier\FilamentPages\Contracts\FilamentPageTemplate;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\Repeater;


final class StaffTemplate
{
    public static function title()
    {
        return 'Staff';
    }

    public static function schema()
    {
        return [
            Repeater::make('staff')->label('Staff')
                ->schema([
                    Toggle::make('aktif')
                        ->onColor('success')
                        ->offColor('danger'),
                ])
                ->disableItemCreation()
                ->disableItemDeletion()
                ->disableItemMovement()
            ];
    }
}