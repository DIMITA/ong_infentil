<?php
namespace App\Filament\Resources;

use App\Filament\Resources\PartnerResource\Pages;
use App\Models\Partner;
use Filament\Forms;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables;
use Filament\Tables\Table;

class PartnerResource extends Resource
{
    protected static ?string $model = Partner::class;
    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-building-office';
    protected static string|\UnitEnum|null $navigationGroup = 'Contenus';

    public static function form(Schema $schema): Schema
    {
        return $schema->schema([
            Forms\Components\TextInput::make('name')->label('Nom du partenaire')->required()->maxLength(255),
            Forms\Components\TextInput::make('url')->label('Site web')->url()->maxLength(255),
            Forms\Components\TextInput::make('order')->label('Ordre')->numeric()->default(0),
            Forms\Components\Toggle::make('is_active')->label('Actif')->default(true),
            Forms\Components\SpatieMediaLibraryFileUpload::make('logo')
                ->label('Logo')->collection('logo')->image()->columnSpanFull(),
        ])->columns(2);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            Tables\Columns\SpatieMediaLibraryImageColumn::make('logo')->collection('logo')->label('Logo'),
            Tables\Columns\TextColumn::make('name')->label('Nom')->searchable(),
            Tables\Columns\TextColumn::make('url')->label('Site')->url(),
            Tables\Columns\IconColumn::make('is_active')->label('Actif')->boolean(),
        ])
        ->reorderable('order')
        ->actions([Tables\Actions\EditAction::make()])
        ->bulkActions([Tables\Actions\BulkActionGroup::make([Tables\Actions\DeleteBulkAction::make()])]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPartners::route('/'),
            'create' => Pages\CreatePartner::route('/create'),
            'edit' => Pages\EditPartner::route('/{record}/edit'),
        ];
    }
}
