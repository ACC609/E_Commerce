<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProdutoResource\Pages;
use App\Filament\Resources\ProdutoResource\RelationManagers;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\IconColumn;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\ActionsGroup;
use Illuminate\Support\Str;
use App\Models\Produto;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Mail\Markdown;

class ProdutoResource extends Resource
{
    protected static ?string $model = Produto::class;

    protected static ?string $navigationIcon = 'heroicon-o-squares-2x2';

    public static function form(Forms\Form $form): Forms\Form
    {
        return $form->schema([
            Group::make([
                Section::make('Detalhes do Produto')
                    ->schema([
                        TextInput::make('nome')
                            ->required()
                            ->live(onBlur: true)
                            ->afterStateUpdated(fn(string $operation, $state, $set) => $operation === 'create' ? $set('slug', Str::slug($state)) : null)
                            ->maxLength(255),
                        TextInput::make('slug')
                            ->maxLength(255)
                            ->disabled()
                            ->required()
                            ->dehydrated()
                            ->unique(Produto::class, 'slug', ignoreRecord: true),
                        MarkdownEditor::make('descricao')
                            ->columnSpanFull()
                            ->fileAttachmentsDirectory('produtos')

                    ])->columns(2),
                FileUpload::make('imagem')
                    ->directory('produtos')
                    ->image()
                    ->multiple()
                    ->maxFiles(5)
                    ->enableReordering()
                    ->enableOpen()
                    ->hint('Adicione até 5 imagens do produto. Clique no botão abaixo para adicionar cada imagem individualmente ou seleciona-las.')
                    ->dehydrateStateUsing(fn($state) => json_encode($state))
            ])->columnSpan(2),

            Group::make([
                Section::make('Preco')
                    ->schema([
                        TextInput::make('preco')
                            ->numeric()
                            ->required()
                            ->prefix('kzs')
                    ]),
                Section::make('Associação')
                    ->schema([
                        Select::make('id_categoria')
                            ->required()
                            ->searchable()
                            ->preload()
                            ->relationship('categorias', 'nome'),
                        Select::make('id_marca')
                            ->required()
                            ->searchable()
                            ->preload()
                            ->relationship('marca', 'nome')
                    ]),
                Section::make('Status')
                    ->schema([
                        Toggle::make('status')
                            ->required()
                            ->default(true),
                        Toggle::make('destaque')
                            ->required(),

                        Toggle::make('em_estoque')
                            ->required()
                            ->default(true),
                        Toggle::make('a_venda')
                            ->required()

                    ])
            ])->columnSpan(1),

        ])->columns(3);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('categorias.nome')
                    ->label('Categoria')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('marca.nome')
                    ->label('Marca')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('nome')
                    ->searchable(),
                TextColumn::make('slug')
                    ->searchable(),
                TextColumn::make('preco')
                    ->numeric()
                    ->sortable(),
                IconColumn::make('status')
                    ->boolean(),
                IconColumn::make('destaque')
                    ->boolean(),
                IconColumn::make('em_estoque')
                    ->boolean(),
                IconColumn::make('a_venda')
                    ->boolean(),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ActionGroup::make([
                    Tables\Actions\EditAction::make(),
                    Tables\Actions\DeleteAction::make(),
                    Tables\Actions\ViewAction::make(),
                ])

            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListProdutos::route('/'),
            'create' => Pages\CreateProduto::route('/create'),
            'edit' => Pages\EditProduto::route('/{record}/edit'),
        ];
    }
}
