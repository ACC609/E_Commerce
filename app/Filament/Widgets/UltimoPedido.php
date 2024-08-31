<?php

namespace App\Filament\Widgets;

use App\Filament\Resources\PedidoResource;
use App\Models\Pedido;
use Filament\Forms\Components\Actions;
use Filament\Tables\Actions\Action;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

class UltimoPedido extends BaseWidget
{
    protected int | string | array $columnSpan = 'full';
    protected static ?int $sort = 2;
    public function table(Table $table): Table
    {
        return $table
            ->query(PedidoResource::getEloquentQuery())
            ->defaultPaginationPageOption(5)
            ->defaultSort('created_at', 'desc')
            ->columns([
                TextColumn::make('id')
                    ->label('Id do Pedido'),

                TextColumn::make('valor_total')
                    ->label('valor total')
                    ->money('kzs'),
                TextColumn::make('user.name')
                    ->searchable(),
                TextColumn::make('status')
                    ->badge()
                    ->color(fn(string $state): string => match ($state) {
                        'novo' => 'info',
                        'processando' => 'warning',
                        'entregue' => 'success',
                        'enviado' => 'success',
                        'cancelado' => 'danger'
                    })
                    ->icon(fn(string $state): string => match ($state) {
                        'novo' => 'heroicon-m-sparkles',
                        'processando' => 'heroicon-m-arrow-path',
                        'entregue' => 'heroicon-m-truck',
                        'enviado' => 'heroicon-m-check-badge',
                        'cancelado' => 'heroicon-m-x-circle'
                    })
                    ->sortable(),
                TextColumn::make('metodo_de_pagamento')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('status_de_pagamento')
                    ->sortable()
                    ->badge(),
                TextColumn::make('created_at')
                    ->label('Pedido feito em')
                    ->dateTime()
            ])
            ->actions([
                Action::make('ver Pedido')
                    ->url(fn(\App\Models\Pedido $record): string => PedidoResource::getUrl('view', ['record' => $record]))

                    ->color('info')
                    ->icon('heroicon-m-eye'),
            ]);
    }
}
