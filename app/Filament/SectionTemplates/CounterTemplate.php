<?php

namespace App\Filament\SectionTemplates;

use Beier\FilamentPages\Contracts\FilamentPageTemplate;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Repeater;

final class CounterTemplate
{
    public static function title()
    {
        return 'Counter';
    }

    public static function schema()
    {
        return [
            Repeater::make('counter')->label('Counter')->schema([
                FileUpload::make('icon')
                        ->label('Ikon')
                        ->image()
                        ->imageResizeTargetWidth('70')
                        ->imageResizeTargetHeight('70')
                        ->disk('public')
                        ->directory('homepage'),
                TextInput::make('title'),
                TextInput::make('count')
                    ->numeric()
                    ->minValue(1),
                ])
                ->minItems(1)
                ->maxItems(8)
            ];
    }
}