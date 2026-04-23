<?php
namespace App\Filament\Resources;

use App\Filament\Resources\NewsletterSubscriberResource\Pages;
use App\Models\NewsletterSubscriber;
use Filament\Forms;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables;
use Filament\Tables\Table;

class NewsletterSubscriberResource extends Resource
{
    protected static ?string $model = NewsletterSubscriber::class;
    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-envelope';
    protected static string|\UnitEnum|null $navigationGroup = 'Dons';
    protected static ?string $label = 'Abonné newsletter';
    protected static ?string $pluralLabel = 'Abonnés newsletter';

    public static function form(Schema $schema): Schema
    {
        return $schema->schema([
            Forms\Components\TextInput::make('name')->label('Nom')->maxLength(255),
            Forms\Components\TextInput::make('email')->label('Email')->email()->required()->maxLength(255),
            Forms\Components\DateTimePicker::make('confirmed_at')->label('Confirmé le'),
            Forms\Components\DateTimePicker::make('unsubscribed_at')->label('Désabonné le'),
        ])->columns(2);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            Tables\Columns\TextColumn::make('name')->label('Nom')->searchable(),
            Tables\Columns\TextColumn::make('email')->label('Email')->searchable(),
            Tables\Columns\IconColumn::make('confirmed_at')->label('Confirmé')
                ->boolean()->getStateUsing(fn($record) => !is_null($record->confirmed_at)),
            Tables\Columns\IconColumn::make('unsubscribed_at')->label('Désabonné')
                ->boolean()->getStateUsing(fn($record) => !is_null($record->unsubscribed_at)),
            Tables\Columns\TextColumn::make('created_at')->label('Inscrit le')->date('d/m/Y')->sortable(),
        ])
        ->defaultSort('created_at', 'desc')
        ->actions([Tables\Actions\DeleteAction::make()])
        ->bulkActions([Tables\Actions\BulkActionGroup::make([Tables\Actions\DeleteBulkAction::make()])]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListNewsletterSubscribers::route('/'),
        ];
    }
}
