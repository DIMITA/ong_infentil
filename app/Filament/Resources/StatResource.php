<?php
namespace App\Filament\Resources;

use App\Filament\Resources\StatResource\Pages;
use App\Models\Stat;
use Filament\Forms;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables;
use Filament\Tables\Table;

class StatResource extends Resource
{
    protected static ?string $model = Stat::class;
    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-chart-bar';
    protected static string|\UnitEnum|null $navigationGroup = 'Configuration';

    public static function form(Schema $schema): Schema
    {
        return $schema->schema([
            Forms\Components\TextInput::make('key')->label('Clé unique')->required()->maxLength(100),
            Forms\Components\TextInput::make('value')->label('Valeur')->numeric()->required(),
            Forms\Components\TextInput::make('label_fr')->label('Libellé (FR)')->required()->maxLength(255),
            Forms\Components\TextInput::make('label_en')->label('Label (EN)')->maxLength(255),
            Forms\Components\TextInput::make('icon')->label('Icône Heroicon')->maxLength(100)->placeholder('heroicon-o-heart'),
            Forms\Components\TextInput::make('order')->label('Ordre')->numeric()->default(0),
        ])->columns(3);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            Tables\Columns\TextColumn::make('key')->label('Clé')->sortable(),
            Tables\Columns\TextColumn::make('value')->label('Valeur')->sortable(),
            Tables\Columns\TextColumn::make('label_fr')->label('Libellé'),
            Tables\Columns\TextColumn::make('order')->label('Ordre')->sortable(),
        ])
        ->reorderable('order')
        ->actions([Tables\Actions\EditAction::make()])
        ->bulkActions([]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListStats::route('/'),
            'create' => Pages\CreateStat::route('/create'),
            'edit' => Pages\EditStat::route('/{record}/edit'),
        ];
    }
}
