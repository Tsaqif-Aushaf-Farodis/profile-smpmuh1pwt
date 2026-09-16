<?php

namespace App\Filament\SectionTemplates;

use Beier\FilamentPages\Contracts\FilamentPageTemplate;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Repeater;

final class HeroTemplate
{
    public static function title()
    {
        return 'Hero';
    }

    public static function schema()
    {
        return [
            Repeater::make('hero')->label('Hero')->schema([

            TextInput::make('title'),
            TextInput::make('detail'),
            TextInput::make('video'),
            FileUpload::make('image')
                ->label('Gambar Hero')
                ->image()
                ->imageResizeTargetWidth('575')
                ->imageResizeTargetHeight('575')
                ->disk('public')
                ->directory('homepage')

            ])
            ->minItems(1)
            ->maxItems(1)
        ];
    }
}