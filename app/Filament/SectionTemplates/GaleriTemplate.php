<?php

namespace App\Filament\SectionTemplates;

use Beier\FilamentPages\Contracts\FilamentPageTemplate;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Toggle;

final class GaleriTemplate
{
    public static function title()
    {
        return 'Galeri';
    }

    public static function schema()
    {
        return [
            Repeater::make('galeri')
                ->schema([
                    Toggle::make('aktif')
                        ->onColor('success')
                        ->offColor('danger'),
                    TextInput::make('featured')
                        ->label(__('Jumlah Galeri Tampil di Homepage'))
                        ->required()
                        ->numeric()
                        ->minValue(1)
                        ->maxValue(6),
                ])
                ->disableItemCreation()
                ->disableItemDeletion()
                ->disableItemMovement()
     
        ];
    }
}