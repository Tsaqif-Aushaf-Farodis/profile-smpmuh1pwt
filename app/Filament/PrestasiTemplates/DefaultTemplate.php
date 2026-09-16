<?php

namespace App\Filament\PrestasiTemplates;

use Beier\FilamentPages\Contracts\FilamentPageTemplate;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\DatePicker;

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
                    FileUpload::make('image')
                        ->label('Foto')
                        ->image()
                        ->imageResizeTargetWidth('452')
                        ->imageResizeTargetHeight('788')
                        ->disk('public')
                        ->directory('homepage'),                    
                    TextInput::make('juara'), 
                    TextInput::make('lomba')
                        ->label(__('Kejuaraan'))
                        ->maxLength(20),  
                    DatePicker::make('date')
                        ->label(__('Tanggal Kejuaraan')),      
                    RichEditor::make('detail')
                        ->label(__('Detail Prestasi')),              
                ]),
        ];
    }
}
