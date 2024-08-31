<?php

namespace App\Filament\Resources\PedidoResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\Textarea;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class EnderecoRelationManager extends RelationManager
{
    protected static string $relationship = 'Endereco';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('primeiro_nome')
                    ->required(),
                TextInput::make('ultimo_nome')
                    ->required(),
                TextInput::make('telefone')
                    ->tel()
                    ->required(),
                TextInput::make('cidade')
                    ->required(),
                TextInput::make('estado')
                    ->required(),
                TextInput::make('caixa_postal')
                    ->required()
                    ->numeric(),
                Textarea::make('endereco_rua')
                    ->required()
                    ->columnSpanFull()
                    ->maxLength(255),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('endereco_rua')
            ->columns([
                TextColumn::make('primeiro_nome')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('ultimo_nome')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('telefone')
                    ->sortable(),
                TextColumn::make('cidade')
                    ->sortable(),
                TextColumn::make('estado')
                    ->sortable(),
                TextColumn::make('caixa_postal')
                    ->sortable(),
                TextColumn::make('endereco_rua')
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
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
}
