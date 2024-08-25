<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PedidoResource\Pages;
use App\Filament\Resources\PedidoResource\RelationManagers;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Set;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Columns\SelectColumn;
use Filament\Forms\Components\ActionsGroup;
use Filament\Forms\Components\Textarea;
use Filament\Tables\Columns\IconColumn;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\ToggleButtons;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Get;
use Filament\Forms\Components\Placeholder;
use App\Models\Pedido;
use App\Models\Produto;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\Group;

class PedidoResource extends Resource
{
    protected static ?string $model = Pedido::class;

    protected static ?string $navigationIcon = 'heroicon-o-shopping-bag';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Group::make()->schema([
                    Section::make('Pedidos')->schema([
                        Select::make('id_user')
                            ->label('Clientes')
                            ->relationship('user', 'name')
                            ->searchable()
                            ->preload()
                            ->required(),
                        Select::make('metodo_de_pagamento')
                            ->label('Método de Pagamento')
                            ->options([
                                'stripe' => 'stripe',
                                'pde' => 'Pagamentos depois da entrega'
                            ])
                            ->required(),
                        Select::make('status_de_pagamento')
                            ->options([
                                'pendente' => 'Pendente',
                                'pago' => 'Pago',
                                'falhado' => 'Falhado',
                                'falhado' => 'Falhado',
                            ])
                            ->default('pendente')
                            ->required(),
                        ToggleButtons::make('status')
                            ->inline()
                            ->default('novo')
                            ->required()
                            ->options([
                                'novo' => 'Novo',
                                'processando' => 'Processando',
                                'enviado' => 'Enviado',
                                'entregue' => 'Entregue',
                                'cancelado' => 'Cancelado'
                            ])
                            ->colors([
                                'novo' => 'info',
                                'processando' => 'warning',
                                'enviado' => 'info',
                                'entregue' => 'success',
                                'cancelado' => 'danger'
                            ])
                            ->icons([
                                'novo' => 'heroicon-m-sparkles',
                                'processando' => 'heroicon-m-arrow-path',
                                'enviado' => 'heroicon-m-truck',
                                'entregue' => 'heroicon-m-check-badge',
                                'cancelado' => 'heroicon-m-x-circle',
                            ]),
                        Select::make('moeda')
                            ->options([
                                'kwanza' => 'Kwanza',
                                'dolar' => 'Dólar',
                                'euro' => 'euro',
                            ])
                            ->default('kwanza')
                            ->required(),
                        Select::make('metodo_de_envio')
                            ->options([
                                'carro' => 'Carro',
                                'mota' => 'Mota',
                            ]),
                        Textarea::make('notas')
                            ->label('Texto a acrescentar')
                            ->columnSpanFull()

                    ])->columns(2),
                    Section::make('Itens do Pedido')->schema([
                        Repeater::make('itens')
                            ->relationship()
                            ->schema([
                                Select::make('id_produto')
                                    ->relationship('produto', 'nome')
                                    ->searchable()
                                    ->preload()
                                    ->required()
                                    ->columnSpan(4)
                                    ->reactive()
                                    ->afterStateUpdated(fn($state, Set $set) => $set('preco', Produto::find($state)?->preco ?? 0))
                                    ->afterStateUpdated(fn($state, Set $set) => $set('valor_total', Produto::find($state)?->preco ?? 0))
                                    ->distinct(),
                                TextInput::make('quantidade')
                                    ->numeric()
                                    ->required()
                                    ->default(1)
                                    ->columnSpan(2)
                                    ->reactive()
                                    ->afterStateUpdated(fn($state, Set $set, Get $get) => $set('valor_total', $state * $get('preco')))
                                    ->minValue(1),
                                TextInput::make('preco')
                                    ->numeric()
                                    ->required()
                                    ->columnSpan(3)
                                    ->dehydrated(),
                                TextInput::make('valor_total')
                                    ->numeric()
                                    ->dehydrated()
                                    ->columnSpan(3)
                                    ->required()
                            ])->columns(12),
                        Placeholder::make('calculo_total_placeholder')
                            ->label('Valor Total')
                            ->content(function (Get $get, Set $set) {
                                $total = 0;
                                if (!$repeaters = $get('itens')) {
                                    return $total;
                                }
                                foreach ($repeaters as $key => $repeaters) {
                                    $total += $get("itens.{$key}.valor_total");
                                }
                                $set('valor_total', $total);
                                return number_format($total, 2, ',', '.') . ' Kzs';
                            }),
                        Hidden::make('valor_total')
                            ->default(0),

                    ])

                ])->columnSpanFull()
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('user.name')
                    ->label('Nome do Cliente')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('valor_total')
                    ->label('Total')
                    ->numeric()
                    ->sortable()
                    ->money('kzs'),
                TextColumn::make('metodo_de_pagamento')
                    ->label('Metodo de Pagamento')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('status_de_pagamento')
                    ->label('Status de Pagamento')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('moeda')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('metodo_de_envio')
                    ->sortable()
                    ->searchable(),
                SelectColumn::make('status')
                    ->options([
                        'novo' => 'Novo',
                        'processando' => 'Processando',
                        'enviado' => 'Enviado',
                        'entregue' => 'Entregue',
                        'cancelado' => 'Cancelado'
                    ])
                    ->searchable(),
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
                    Tables\Actions\ViewAction::make(),
                    Tables\Actions\EditAction::make(),
                    Tables\Actions\DeleteAction::make(),
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

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }

    public static function getNavigationBadgeColor(): string|array|null
    {
        return static::getModel()::count() > 10 ? 'success' : 'danger';
    }


    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPedidos::route('/'),
            'create' => Pages\CreatePedido::route('/create'),
            'view' => Pages\ViewPedido::route('/{record}'),
            'edit' => Pages\EditPedido::route('/{record}/edit'),
        ];
    }
}
