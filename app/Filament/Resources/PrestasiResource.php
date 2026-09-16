<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PrestasiResource\Pages;
use App\Filament\Resources\PrestasiResource\RelationManagers;
use App\Models\Prestasi;
use Closure;
use Filament\Forms;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\Component;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules\Exists;
use SplFileInfo;

class PrestasiResource extends Resource
{
    protected static ?string $model = Prestasi::class;

    protected static ?string $slug = 'prestasi-setting';

    protected static ?string $recordTitleAttribute = 'Prestasi';

    protected static ?string $navigationGroup = 'Konten';

    protected static ?int $navigationSort = 7;

    protected static ?string $navigationLabel = 'Prestasi';

    protected static ?string $navigationIcon = 'heroicon-o-star';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Group::make()
                    ->schema([
                        static::getPrimaryColumnSchema(),
                        ...static::getTemplateSchemas(),
                    ])
                    ->columnSpan(['lg' => 7]),

                static::getSecondaryColumnSchema(),

            ])
            ->columns([
                'sm' => 9,
                'lg' => null,
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')->searchable(),
                Tables\Columns\ImageColumn::make('image')::make('data.content.image')->label('Foto'),
                Tables\Columns\TextColumn::make('juara')::make('data.content.juara')->label('Prestasi'),
                Tables\Columns\TextColumn::make('date')::make('data.content.date')->label('Tanggal')->date() ,
                Tables\Columns\TextColumn::make('lomba')::make('data.content.lomba')->label('Kejuaraan'),
                
            ])            
            ->defaultSort('id', 'desc')

            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
            
            ]);
    }

    public static function getPrimaryColumnSchema(): Component
    {
        return Card::make()
            ->columns(2)
            ->schema([
                ...static::insertBeforePrimaryColumnSchema(),
            TextInput::make('title')
                ->label('Nama Prestasi')
                ->columnSpan(1)
                ->required()
                ->lazy()
                ->afterStateUpdated(fn (string $context, $state, callable $set) => $context === 'create' ? $set('slug', Str::slug($state)) : null),

            TextInput::make('slug')
                ->label('Slug Link *otomatis')
                ->columnSpan(1)
                ->required()
                ->unique(Prestasi::class, 'slug', ignoreRecord: true),  
                      
                ...static::insertAfterPrimaryColumnSchema(),
            ]);
    }

    public static function getSecondaryColumnSchema(): Component
    {
        return Card::make()
            ->schema([
                ...static::insertBeforeSecondaryColumnSchema(),
                Select::make('data.template')
                    ->reactive()                   
                    ->options(static::getTemplates()),
    
                ...static::insertAfterSecondaryColumnSchema(),
            ])
            ->columnSpan(['lg' => 2]);
    }
   
    public static function insertBeforePrimaryColumnSchema(): array
    {
        return [];
    }

    public static function insertAfterPrimaryColumnSchema(): array
    {
        return [];
    }

    public static function insertBeforeSecondaryColumnSchema(): array
    {
        return [];
    }

    public static function insertAfterSecondaryColumnSchema(): array
    {
        return [];
    }

    /**
     * @return Collection<FilamentPageTemplate>
     */
    public static function getTemplateClasses(): Collection
    {
        $filesystem = app(Filesystem::class);

        return collect($filesystem->allFiles(app_path('Filament/PrestasiTemplates')))
            ->map(function (SplFileInfo $file): string {
                return (string) Str::of('App\\Filament\\PrestasiTemplates')
                    ->append('\\', $file->getRelativePathname())
                    ->replace(['/', '.php'], ['\\', '']);
            });
    }

    /**
     * @return Collection<FilamentPageTemplate>
     */
    public static function getTemplates(): Collection
    {
        return static::getTemplateClasses()
            ->mapWithKeys(fn ($class) => [$class => $class::title()]);
    }

    public static function getTemplateName($class): string
    {
        return Str::of($class)->afterLast('\\')->snake()->toString();
    }

    public static function getTemplateSchemas(): array
    {
        return static::getTemplateClasses()
            ->map(fn ($class) => Group::make($class::schema())
                ->afterStateHydrated(fn ($component, $state) => $component->getChildComponentContainer()->fill($state))
                ->statePath('data.content')
                ->visible(fn ($get) => $get('data.template') === $class)
            )
            ->toArray();
    }

    protected function mutateFormDataBeforeFill(array $data): array
    {
        $data['data.content'] = $data['temp_content'][static::getTemplateName($data['template'])];
        unset($data['temp_content']);

        return $data;
    }

    protected function mutateFormDataBeforeSave(array $data): array
    {
        $data['data.content'] = $data['temp_content'][static::getTemplateName($data['template'])];
        unset($data['temp_content']);

        return $data;
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
            'index' => Pages\ListPrestasis::route('/'),
            'create' => Pages\CreatePrestasi::route('/create'),
            'edit' => Pages\EditPrestasi::route('/{record}/edit'),
        ];
    }    
}
