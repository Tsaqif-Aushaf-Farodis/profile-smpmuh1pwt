<?php

namespace App\Filament\ProgramTemplates;

use Beier\FilamentPages\Contracts\FilamentPageTemplate;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\FileUpload;

final class DefaultTemplate
{
    public static function title(): string
    {
        return 'Default Page';
    }

    public static function schema(): array
    {
        return [
            Card::make()
                ->schema([
                    FileUpload::make('icon')
                        ->label('Ikon')
                        ->image()
                        ->imageResizeTargetWidth('70')
                        ->imageResizeTargetHeight('70')
                        ->disk('public')
                        ->directory('homepage'),
                    RichEditor::make('detail')
                        ->label(__('Detail Program')),                    
                ]),
        ];
    }
}
