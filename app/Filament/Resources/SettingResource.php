<?php
namespace App\Filament\Resources;

use App\Filament\Resources\SettingResource\Pages;
use App\Models\Setting;
use Filament\Forms;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables;
use Filament\Tables\Table;

class SettingResource extends Resource
{
    protected static ?string $model = Setting::class;
    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-cog-6-tooth';
    protected static string|\UnitEnum|null $navigationGroup = 'Configuration';
    protected static ?string $label = 'Paramètre';
    protected static ?string $pluralLabel = 'Paramètres';

    public static function form(Schema $schema): Schema
    {
        return $schema->schema([
            Forms\Components\TextInput::make('key')->label('Clé')->required()->maxLength(100),
            Forms\Components\Textarea::make('value')->label('Valeur')->rows(4)->columnSpanFull(),
        ])->columns(2);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            Tables\Columns\TextColumn::make('key')->label('Clé')->searchable()->sortable(),
            Tables\Columns\TextColumn::make('value')->label('Valeur')->limit(60),
            Tables\Columns\TextColumn::make('updated_at')->label('Modifié le')->dateTime('d/m/Y')->sortable(),
        ])
        ->actions([Tables\Actions\EditAction::make()])
        ->bulkActions([]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListSettings::route('/'),
            'create' => Pages\CreateSetting::route('/create'),
            'edit' => Pages\EditSetting::route('/{record}/edit'),
        ];
    }
}
