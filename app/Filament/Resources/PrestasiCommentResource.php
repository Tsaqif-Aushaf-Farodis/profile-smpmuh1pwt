<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PrestasiCommentResource\Pages;
use App\Models\PrestasiComment;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;

class PrestasiCommentResource extends Resource
{
    protected static ?string $model = PrestasiComment::class;

    protected static ?string $slug = 'prestasi-comments';

    protected static ?string $recordTitleAttribute = 'name';

    protected static ?string $navigationGroup = 'Blog';

    protected static ?int $navigationSort = 71;

    protected static ?string $navigationLabel = 'Komentar Prestasi';

    protected static ?string $navigationIcon = 'heroicon-o-chat-alt-2';

    public static function canCreate(): bool
    {
        return false;
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('prestasi.title')
                    ->label('Prestasi')
                    ->limit(40)
                    ->searchable(),
                Tables\Columns\TextColumn::make('name')
                    ->label('Nama'),
                Tables\Columns\TextColumn::make('content')
                    ->label('Komentar')
                    ->limit(60),
                Tables\Columns\ToggleColumn::make('is_approved')
                    ->label('Tampilkan'),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Dikirim')
                    ->dateTime('d M Y, H:i')
                    ->sortable(),
            ])
            ->filters([
                Tables\Filters\TernaryFilter::make('is_approved')
                    ->label('Status'),
            ])
            ->actions([
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ])
            ->defaultSort('created_at', 'desc');
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPrestasiComments::route('/'),
        ];
    }
}
