<?php
namespace App\Filament\Resources;

use App\Filament\Resources\DonationResource\Pages;
use App\Models\Donation;
use Filament\Forms;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables;
use Filament\Tables\Table;

class DonationResource extends Resource
{
    protected static ?string $model = Donation::class;
    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-heart';
    protected static string|\UnitEnum|null $navigationGroup = 'Dons';
    protected static ?int $navigationSort = 1;

    public static function form(Schema $schema): Schema
    {
        return $schema->schema([
            Forms\Components\TextInput::make('reference')->label('Référence')->required()->maxLength(255),
            Forms\Components\TextInput::make('amount')->label('Montant')->numeric()->required(),
            Forms\Components\TextInput::make('currency')->label('Devise')->default('XOF')->maxLength(3),
            Forms\Components\TextInput::make('donor_name')->label('Nom donateur'),
            Forms\Components\TextInput::make('donor_email')->label('Email donateur')->email(),
            Forms\Components\TextInput::make('donor_phone')->label('Téléphone'),
            Forms\Components\Select::make('status')->label('Statut')
                ->options(['pending' => 'En attente', 'completed' => 'Complété', 'failed' => 'Échoué', 'refunded' => 'Remboursé']),
            Forms\Components\TextInput::make('payment_method')->label('Méthode')->default('kkiapay'),
            Forms\Components\TextInput::make('transaction_id')->label('ID transaction'),
        ])->columns(3);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            Tables\Columns\TextColumn::make('reference')->label('Référence')->searchable(),
            Tables\Columns\TextColumn::make('amount')->label('Montant')->suffix(' XOF')->sortable(),
            Tables\Columns\TextColumn::make('donor_name')->label('Donateur'),
            Tables\Columns\TextColumn::make('status')->label('Statut')->badge()
                ->color(fn(string $state): string => match($state) {
                    'pending' => 'warning',
                    'completed' => 'success',
                    'failed' => 'danger',
                    'refunded' => 'gray',
                    default => 'gray',
                }),
            Tables\Columns\TextColumn::make('payment_method')->label('Méthode')->badge(),
            Tables\Columns\TextColumn::make('created_at')->label('Date')->dateTime('d/m/Y H:i')->sortable(),
        ])
        ->defaultSort('created_at', 'desc')
        ->filters([
            Tables\Filters\SelectFilter::make('status')->options(['pending' => 'En attente', 'completed' => 'Complété', 'failed' => 'Échoué']),
        ])
        ->actions([Tables\Actions\ViewAction::make()])
        ->bulkActions([]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListDonations::route('/'),
            'view' => Pages\ViewDonation::route('/{record}'),
        ];
    }
}
