<?php
namespace App\Filament\Resources;

use App\Filament\Resources\DocumentResource\Pages;
use App\Models\Document;
use Filament\Forms;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables;
use Filament\Tables\Table;

class DocumentResource extends Resource
{
    protected static ?string $model = Document::class;
    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-document-text';
    protected static string|\UnitEnum|null $navigationGroup = 'Contenus';
    protected static ?int $navigationSort = 3;

    public static function form(Schema $schema): Schema
    {
        return $schema->schema([
            Forms\Components\TextInput::make('title')->label('Titre')->required()->maxLength(255)->columnSpanFull(),
            Forms\Components\Textarea::make('description')->label('Description')->rows(3)->columnSpanFull(),
            Forms\Components\Select::make('category')->label('Catégorie')->required()
                ->options(['rapport_annuel' => 'Rapport annuel', 'bilan' => 'Bilan', 'communique' => 'Communiqué', 'presentation' => 'Présentation', 'autre' => 'Autre']),
            Forms\Components\TextInput::make('year')->label('Année')->numeric()->required()->default(date('Y')),
            Forms\Components\Select::make('visibility')->label('Visibilité')
                ->options(['public' => 'Public', 'private' => 'Privé'])->default('public')->required(),
            Forms\Components\TagsInput::make('tags')->label('Tags'),
            Forms\Components\SpatieMediaLibraryFileUpload::make('file')
                ->label('Fichier (PDF/DOCX)')->collection('file')
                ->acceptedFileTypes(['application/pdf', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document'])
                ->columnSpanFull(),
        ])->columns(3);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            Tables\Columns\TextColumn::make('title')->label('Titre')->searchable()->sortable(),
            Tables\Columns\TextColumn::make('category')->label('Catégorie')->badge(),
            Tables\Columns\TextColumn::make('year')->label('Année')->sortable(),
            Tables\Columns\TextColumn::make('visibility')->label('Visibilité')->badge()
                ->color(fn(string $state): string => match($state) {
                    'public' => 'success',
                    'private' => 'danger',
                    default => 'gray',
                }),
            Tables\Columns\TextColumn::make('created_at')->label('Ajouté le')->date('d/m/Y')->sortable(),
        ])
        ->filters([
            Tables\Filters\SelectFilter::make('category')->options(['rapport_annuel' => 'Rapport annuel', 'bilan' => 'Bilan', 'communique' => 'Communiqué']),
            Tables\Filters\SelectFilter::make('visibility')->options(['public' => 'Public', 'private' => 'Privé']),
        ])
        ->actions([Tables\Actions\EditAction::make()])
        ->bulkActions([Tables\Actions\BulkActionGroup::make([Tables\Actions\DeleteBulkAction::make()])]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListDocuments::route('/'),
            'create' => Pages\CreateDocument::route('/create'),
            'edit' => Pages\EditDocument::route('/{record}/edit'),
        ];
    }
}
