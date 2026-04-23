<?php
namespace App\Filament\Resources;

use App\Filament\Resources\ActionResource\Pages;
use App\Models\Action;
use Filament\Forms;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Str;

class ActionResource extends Resource
{
    protected static ?string $model = Action::class;
    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-hand-raised';
    protected static string|\UnitEnum|null $navigationGroup = 'Contenus';
    protected static ?int $navigationSort = 2;

    public static function form(Schema $schema): Schema
    {
        return $schema->schema([
            Forms\Components\Tabs::make()->tabs([
                Forms\Components\Tabs\Tab::make('Français')->schema([
                    Forms\Components\TextInput::make('title_fr')->label('Titre (FR)')->required()->maxLength(255)
                        ->live(onBlur: true)
                        ->afterStateUpdated(fn($state, Forms\Set $set) => $set('slug', Str::slug($state))),
                    Forms\Components\Textarea::make('description_fr')->label('Description (FR)')->rows(5),
                ]),
                Forms\Components\Tabs\Tab::make('English')->schema([
                    Forms\Components\TextInput::make('title_en')->label('Title (EN)')->maxLength(255),
                    Forms\Components\Textarea::make('description_en')->label('Description (EN)')->rows(5),
                ]),
            ])->columnSpan(2),
            Forms\Components\Section::make()->schema([
                Forms\Components\TextInput::make('slug')->maxLength(255),
                Forms\Components\Select::make('category')->label('Catégorie')
                    ->options(['sante' => 'Santé', 'education' => 'Éducation', 'nutrition' => 'Nutrition', 'protection' => 'Protection', 'urgence' => 'Urgence']),
                Forms\Components\DatePicker::make('date')->label('Date'),
                Forms\Components\Toggle::make('is_active')->label('Actif')->default(true),
            ])->columnSpan(1),
            Forms\Components\SpatieMediaLibraryFileUpload::make('cover')
                ->label('Image principale')->collection('cover')->image()->imageEditor()->columnSpan(1),
            Forms\Components\SpatieMediaLibraryFileUpload::make('gallery')
                ->label('Galerie')->collection('gallery')->image()->multiple()->reorderable()->columnSpan(2),
        ])->columns(3);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            Tables\Columns\SpatieMediaLibraryImageColumn::make('cover')->collection('cover')->label(''),
            Tables\Columns\TextColumn::make('title_fr')->label('Titre')->searchable()->sortable(),
            Tables\Columns\TextColumn::make('category')->label('Catégorie')->badge(),
            Tables\Columns\TextColumn::make('date')->label('Date')->date('d/m/Y')->sortable(),
            Tables\Columns\IconColumn::make('is_active')->label('Actif')->boolean(),
        ])
        ->actions([Tables\Actions\EditAction::make()])
        ->bulkActions([Tables\Actions\BulkActionGroup::make([Tables\Actions\DeleteBulkAction::make()])]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListActions::route('/'),
            'create' => Pages\CreateAction::route('/create'),
            'edit' => Pages\EditAction::route('/{record}/edit'),
        ];
    }
}
