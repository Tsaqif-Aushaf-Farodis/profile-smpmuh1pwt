<?php

namespace App\Filament\SectionTemplates;

use Beier\FilamentPages\Contracts\FilamentPageTemplate;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Components\FileUpload;

final class ProfileTemplate
{
    public static function title()
    {
        return 'Profile';
    }

    public static function schema()
    {
        return [
            Repeater::make('profile')
                ->schema([
                    FileUpload::make('image')
                        ->label('Gambar Tentang')
                        ->image()
                        ->imageResizeTargetWidth('460')
                        ->imageResizeTargetHeight('560')
                        ->disk('public')
                        ->directory('homepage'),
                    RichEditor::make('profile'),
                    TextInput::make('visi'),
                    RichEditor::make('misi'),  
                ])
                ->disableItemCreation()
                ->disableItemDeletion()
                ->disableItemMovement()
     
        ];
        
    }
}