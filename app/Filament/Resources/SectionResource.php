<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SectionResource\Pages;
use App\Filament\Resources\SectionResource\RelationManagers;
use App\Models\Section;
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


class SectionResource extends Resource

{   
   
    protected static ?string $model = Section::class;
    
    protected static ?string $slug = 'home-setting';

    protected static ?string $recordTitleAttribute = 'title';

    protected static ?string $navigationGroup = 'Konten';

    protected static ?int $navigationSort = 1;

    protected static ?string $navigationLabel = 'Halaman Depan';

    protected static ?string $navigationIcon = 'heroicon-o-document-duplicate';
    
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
                Tables\Columns\TextColumn::make('name')->searchable(),
                Tables\Columns\ToggleColumn::make('active')
            ])
            ->reorderable('ordering')
            ->defaultSort('ordering')

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
                TextInput::make('name')                   
                    ->label(__('Nama Section'))
                    ->reactive()                    
                    ->required(),                                                  
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
                    ->afterStateUpdated(fn (string $context, $state, callable $set) => $set('data.templateName', Str::snake(self::getTemplateName($state))))
                    ->afterStateHydrated(fn (string $context, $state, callable $set) => $set('data.templateName', Str::snake(self::getTemplateName($state))))
                    ->afterStateUpdated(fn (string $context, $state, callable $set) => $set('type', Str::snake(self::getTemplateName($state))))
                    ->afterStateHydrated(fn (string $context, $state, callable $set) => $set('type', Str::snake(self::getTemplateName($state))))
                    ->options(static::getTemplates()),

                Hidden::make('data.templateName')
                    ->reactive(),  
                    
                Hidden::make('type')                  
                    ->disabled(),        
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

        return collect($filesystem->allFiles(app_path('Filament/SectionTemplates')))
            ->map(function (SplFileInfo $file): string {
                return (string) Str::of('App\\Filament\\SectionTemplates')
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

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListSections::route('/'),  
            'create' => Pages\CreateSection::route('/create'),        
            'edit' => Pages\EditSection::route('/{record}/edit'),
        ];
    }
}
