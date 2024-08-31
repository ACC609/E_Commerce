<?php

namespace App\Filament\Resources\UserResource\RelationManagers;

use App\Filament\Resources\PedidoResource;
use Filament\Forms;
use Filament\Forms\Components\Actions;
use Filament\Tables\Actions\Action;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PedidosRelationManager extends RelationManager
{
    protected static string $relationship = 'pedidos';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('id')
            ->columns([
                TextColumn::make('id')
                    ->label('Id do Pedido'),

                TextColumn::make('valor_total')
                    ->label('valor total')
                    ->money('kzs'),
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

            ->filters([
                //
            ])
            ->headerActions([
                // Tables\Actions\CreateAction::make(),
            ])
            ->actions([

                Action::make('ver Pedido')
                    ->url(fn(\App\Models\Pedido $record): string => PedidoResource::getUrl('view', ['record' => $record]))

                    ->color('info')
                    ->icon('heroicon-m-eye'),
                Tables\Actions\DeleteAction::make(),

            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
