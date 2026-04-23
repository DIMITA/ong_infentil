<?php
namespace App\Filament\Resources;

use App\Filament\Resources\TestimonialResource\Pages;
use App\Models\Testimonial;
use Filament\Forms;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables;
use Filament\Tables\Table;

class TestimonialResource extends Resource
{
    protected static ?string $model = Testimonial::class;
    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-chat-bubble-left-right';
    protected static string|\UnitEnum|null $navigationGroup = 'Contenus';
    protected static ?int $navigationSort = 4;

    public static function form(Schema $schema): Schema
    {
        return $schema->schema([
            Forms\Components\TextInput::make('name')->label('Nom')->required()->maxLength(255),
            Forms\Components\TextInput::make('role')->label('Rôle / Fonction')->maxLength(255),
            Forms\Components\TextInput::make('order')->label('Ordre')->numeric()->default(0),
            Forms\Components\Toggle::make('is_active')->label('Actif')->default(true),
            Forms\Components\Textarea::make('text_fr')->label('Témoignage (FR)')->required()->rows(4)->columnSpanFull(),
            Forms\Components\Textarea::make('text_en')->label('Testimonial (EN)')->rows(4)->columnSpanFull(),
            Forms\Components\SpatieMediaLibraryFileUpload::make('photo')
                ->label('Photo')->collection('photo')->image()->avatar()->columnSpanFull(),
        ])->columns(2);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            Tables\Columns\SpatieMediaLibraryImageColumn::make('photo')->collection('photo')->label('')->circular(),
            Tables\Columns\TextColumn::make('name')->label('Nom')->searchable(),
            Tables\Columns\TextColumn::make('role')->label('Rôle'),
            Tables\Columns\TextColumn::make('order')->label('Ordre')->sortable(),
            Tables\Columns\IconColumn::make('is_active')->label('Actif')->boolean(),
        ])
        ->reorderable('order')
        ->actions([Tables\Actions\EditAction::make()])
        ->bulkActions([Tables\Actions\BulkActionGroup::make([Tables\Actions\DeleteBulkAction::make()])]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListTestimonials::route('/'),
            'create' => Pages\CreateTestimonial::route('/create'),
            'edit' => Pages\EditTestimonial::route('/{record}/edit'),
        ];
    }
}
