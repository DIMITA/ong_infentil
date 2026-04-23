<?php
namespace App\Filament\Resources;

use App\Filament\Resources\EventResource\Pages;
use App\Models\Event;
use Filament\Forms;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Str;

class EventResource extends Resource
{
    protected static ?string $model = Event::class;
    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-calendar';
    protected static string|\UnitEnum|null $navigationGroup = 'Contenus';
    protected static ?int $navigationSort = 1;

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
                Forms\Components\TextInput::make('slug')->label('Slug')->maxLength(255),
                Forms\Components\DateTimePicker::make('date')->label('Date & heure')->required(),
                Forms\Components\TextInput::make('location')->label('Lieu')->maxLength(255),
                Forms\Components\Select::make('status')->label('Statut')
                    ->options(['upcoming' => 'À venir', 'completed' => 'Terminé'])
                    ->default('upcoming')->required(),
                Forms\Components\Toggle::make('is_active')->label('Actif')->default(true),
            ])->columnSpan(1),
            Forms\Components\SpatieMediaLibraryFileUpload::make('cover')
                ->label('Image de couverture')
                ->collection('cover')
                ->image()->imageEditor()
                ->columnSpanFull(),
        ])->columns(3);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            Tables\Columns\SpatieMediaLibraryImageColumn::make('cover')->collection('cover')->label('')->circular(),
            Tables\Columns\TextColumn::make('title_fr')->label('Titre')->searchable()->sortable(),
            Tables\Columns\TextColumn::make('date')->label('Date')->dateTime('d/m/Y H:i')->sortable(),
            Tables\Columns\TextColumn::make('location')->label('Lieu'),
            Tables\Columns\TextColumn::make('status')->label('Statut')->badge()
                ->color(fn(string $state): string => match($state) {
                    'upcoming' => 'warning',
                    'completed' => 'success',
                    default => 'gray',
                }),
            Tables\Columns\IconColumn::make('is_active')->label('Actif')->boolean(),
        ])
        ->filters([
            Tables\Filters\SelectFilter::make('status')->options(['upcoming' => 'À venir', 'completed' => 'Terminé']),
        ])
        ->actions([Tables\Actions\EditAction::make()])
        ->bulkActions([Tables\Actions\BulkActionGroup::make([Tables\Actions\DeleteBulkAction::make()])]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListEvents::route('/'),
            'create' => Pages\CreateEvent::route('/create'),
            'edit' => Pages\EditEvent::route('/{record}/edit'),
        ];
    }
}
