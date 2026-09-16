<?php

namespace App\Filament\Resources;

use App\Filament\Resources\StaffResource\Pages;
use App\Filament\Resources\StaffResource\RelationManagers;
use App\Models\Staff;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class StaffResource extends Resource
{
    protected static ?string $model = Staff::class;

    protected static ?string $slug = 'staff-setting';

    protected static ?string $recordTitleAttribute = 'Guru & Staff';

    protected static ?string $navigationGroup = 'Konten';

    protected static ?int $navigationSort = 9;

    protected static ?string $navigationLabel = 'Guru & Staff';

    protected static ?string $navigationIcon = 'heroicon-o-user-group';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->label('Nama')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('phone')
                    ->label('No. Handphone')
                    ->tel()
                    ->maxLength(100),
                Forms\Components\TextInput::make('motto')
                    ->maxLength(255)
                    ->hiddenOn('create'),
                Forms\Components\Textarea::make('address')
                    ->hiddenOn('create'),
                Forms\Components\TextInput::make('position')
                    ->label('Jabatan')
                    ->maxLength(100),
                Forms\Components\TextInput::make('mapel')
                    ->label('Mata Pelajaran')
                    ->maxLength(200),              
                Forms\Components\FileUpload::make('photo')
                    ->label('Foto')
                    ->image()
                    ->imageResizeTargetWidth('575')
                    ->imageResizeTargetHeight('575')
                    ->disk('public')
                    ->directory('staff'),
                Forms\Components\TextInput::make('facebook')
                    ->maxLength(100)
                    ->hiddenOn('create'),
                Forms\Components\TextInput::make('instagram')
                    ->maxLength(100)
                    ->hiddenOn('create'),
                Forms\Components\TextInput::make('twitter')
                    ->maxLength(100)
                    ->hiddenOn('create'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name'),             
                Tables\Columns\TextColumn::make('position'),
                Tables\Columns\TextColumn::make('mapel'),
                Tables\Columns\TextColumn::make('phone'),
                Tables\Columns\ImageColumn::make('photo')->height(100),              
             
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }
    
    public static function getRelations(): array
    {
        return [
            //
        ];
    }
    
    public static function getPages(): array
    {
        return [
            'index' => Pages\ListStaff::route('/'),
            'create' => Pages\CreateStaff::route('/create'),
            'edit' => Pages\EditStaff::route('/{record}/edit'),
        ];
    }    
}
