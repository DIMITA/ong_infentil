<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PostResource\Pages;
use App\Models\Post;
use Filament\Forms;
use Filament\Forms\Components\RichEditor;
use Filament\Schemas\Schema;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Str;

class PostResource extends Resource
{
    protected static ?string $model = Post::class;

    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-pencil-square';

    protected static string|\UnitEnum|null $navigationGroup = 'Contenus';

    protected static ?int $navigationSort = 0;

    protected static ?string $label = 'Article';

    protected static ?string $pluralLabel = 'Blog & Articles';

    public static function form(Schema $schema): Schema
    {
        return $schema->components([
            // ── Colonne principale (2/3)
            Forms\Components\Group::make()->schema([

                Forms\Components\Tabs::make('Contenu')
                    ->tabs([
                        // ── Onglet Français
                        Forms\Components\Tabs\Tab::make('Français')
                            ->icon('heroicon-m-flag')
                            ->schema([
                                Forms\Components\TextInput::make('title_fr')
                                    ->label('Titre')
                                    ->required()
                                    ->maxLength(255)
                                    ->live(onBlur: true)
                                    ->afterStateUpdated(function (string $state, Forms\Set $set, string $operation) {
                                        if ($operation === 'create') {
                                            $set('slug', Str::slug($state));
                                        }
                                    }),

                                Forms\Components\Textarea::make('excerpt_fr')
                                    ->label('Résumé (accroche affiché en liste)')
                                    ->rows(3)
                                    ->maxLength(300)
                                    ->helperText('Laissez vide pour générer automatiquement depuis le contenu.'),

                                Forms\Components\RichEditor::make('content_fr')
                                    ->label('Contenu')
                                    ->toolbarButtons([
                                        'attachFiles',
                                        'blockquote',
                                        'bold',
                                        'bulletList',
                                        'codeBlock',
                                        'h2',
                                        'h3',
                                        'italic',
                                        'link',
                                        'orderedList',
                                        'redo',
                                        'strike',
                                        'table',
                                        'underline',
                                        'undo',
                                    ])
                                    ->fileAttachmentsDisk('r2')
                                    ->fileAttachmentsDirectory('blog/attachments')
                                    ->fileAttachmentsVisibility('public')
                                    ->extraAttributes([
                                        'style' => 'min-height: 500px',
                                    ])
                                    ->columnSpanFull(),

                                Forms\Components\TextInput::make('meta_description_fr')
                                    ->label('Meta description SEO (FR)')
                                    ->maxLength(160)
                                    ->helperText('160 caractères max pour Google.'),
                            ]),

                        // ── Onglet English
                        Forms\Components\Tabs\Tab::make('English')
                            ->icon('heroicon-m-language')
                            ->schema([
                                Forms\Components\TextInput::make('title_en')
                                    ->label('Title (EN)')
                                    ->maxLength(255),

                                Forms\Components\Textarea::make('excerpt_en')
                                    ->label('Excerpt (displayed in list)')
                                    ->rows(3)
                                    ->maxLength(300),

                                Forms\Components\RichEditor::make('content_en')
                                    ->label('Content')
                                    ->toolbarButtons([
                                        'attachFiles',
                                        'blockquote',
                                        'bold',
                                        'bulletList',
                                        'codeBlock',
                                        'h2',
                                        'h3',
                                        'italic',
                                        'link',
                                        'orderedList',
                                        'redo',
                                        'strike',
                                        'table',
                                        'underline',
                                        'undo',
                                    ])
                                    ->fileAttachmentsDisk('r2')
                                    ->fileAttachmentsDirectory('blog/attachments')
                                    ->fileAttachmentsVisibility('public')
                                    ->extraAttributes([
                                        'style' => 'min-height: 500px',
                                    ])
                                    ->columnSpanFull(),

                                Forms\Components\TextInput::make('meta_description_en')
                                    ->label('Meta description SEO (EN)')
                                    ->maxLength(160),
                            ]),
                    ])
                    ->columnSpanFull(),

            ])->columnSpan(2),

            // ── Sidebar droite (1/3)
            Forms\Components\Group::make()->schema([

                Forms\Components\Section::make('Publication')
                    ->schema([
                        Forms\Components\Toggle::make('is_published')
                            ->label('Publié')
                            ->default(false)
                            ->reactive(),

                        Forms\Components\DateTimePicker::make('published_at')
                            ->label('Date de publication')
                            ->default(now())
                            ->helperText('Peut être dans le futur (publication programmée).'),
                    ]),

                Forms\Components\Section::make('Informations')
                    ->schema([
                        Forms\Components\TextInput::make('slug')
                            ->label('Slug URL')
                            ->required()
                            ->maxLength(255)
                            ->unique(Post::class, 'slug', ignoreRecord: true)
                            ->helperText('/blog/{slug}'),

                        Forms\Components\Select::make('category')
                            ->label('Catégorie')
                            ->options(Post::CATEGORIES)
                            ->searchable(),

                        Forms\Components\TextInput::make('author_name')
                            ->label('Auteur')
                            ->maxLength(255)
                            ->placeholder('Graines de vie'),
                    ]),

                Forms\Components\Section::make('Image à la une')
                    ->schema([
                        Forms\Components\SpatieMediaLibraryFileUpload::make('cover')
                            ->label('Photo de couverture')
                            ->collection('cover')
                            ->image()
                            ->imageEditor()
                            ->imageEditorAspectRatios(['16:9', '4:3', '1:1'])
                            ->helperText('Recommandé : 1200×630px'),
                    ]),

            ])->columnSpan(1),

        ])->columns(3);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\SpatieMediaLibraryImageColumn::make('cover')
                    ->collection('cover')
                    ->label('')
                    ->width(80)
                    ->height(50)
                    ->extraImgAttributes(['class' => 'rounded-lg object-cover']),

                Tables\Columns\TextColumn::make('title_fr')
                    ->label('Titre')
                    ->searchable()
                    ->sortable()
                    ->weight('semibold')
                    ->limit(55),

                Tables\Columns\TextColumn::make('category')
                    ->label('Catégorie')
                    ->badge()
                    ->color(fn (?string $state): string => match($state) {
                        'sante'       => 'success',
                        'education'   => 'info',
                        'terrain'     => 'warning',
                        'partenariat' => 'gray',
                        'rapport'     => 'danger',
                        default       => 'primary',
                    })
                    ->formatStateUsing(fn (?string $state) => Post::CATEGORIES[$state] ?? $state),

                Tables\Columns\TextColumn::make('author_name')
                    ->label('Auteur')
                    ->placeholder('Graines de vie'),

                Tables\Columns\IconColumn::make('is_published')
                    ->label('Publié')
                    ->boolean()
                    ->trueColor('success')
                    ->falseColor('danger'),

                Tables\Columns\TextColumn::make('published_at')
                    ->label('Date')
                    ->dateTime('d/m/Y')
                    ->sortable(),
            ])
            ->defaultSort('published_at', 'desc')
            ->filters([
                Tables\Filters\SelectFilter::make('category')
                    ->label('Catégorie')
                    ->options(Post::CATEGORIES),

                Tables\Filters\TernaryFilter::make('is_published')
                    ->label('Statut')
                    ->trueLabel('Publiés')
                    ->falseLabel('Brouillons'),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index'  => Pages\ListPosts::route('/'),
            'create' => Pages\CreatePost::route('/create'),
            'edit'   => Pages\EditPost::route('/{record}/edit'),
        ];
    }
}
