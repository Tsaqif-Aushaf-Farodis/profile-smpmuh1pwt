<?php

namespace App\Filament\SectionTemplates;

use Beier\FilamentPages\Contracts\FilamentPageTemplate;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\FileUpload;

final class NewsTemplate
{
    public static function title()
    {
        return 'News';
    }

    public static function schema()
    {
        return [
            Repeater::make('news')
                ->schema([
                    Toggle::make('aktif')
                    ->onColor('success')
                    ->offColor('danger'),
                    FileUpload::make('banner')
                    ->label('Banner')
                    ->image()
                    ->imageResizeTargetWidth('452')
                    ->imageResizeTargetHeight('788')
                    ->disk('public')
                    ->directory('homepage'),
                ])
                ->disableItemCreation()
                ->disableItemDeletion()
                ->disableItemMovement()
     
        ];
    }
}