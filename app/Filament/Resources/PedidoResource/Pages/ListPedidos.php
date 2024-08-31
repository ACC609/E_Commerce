<?php

namespace App\Filament\Resources\PedidoResource\Pages;

use App\Filament\Resources\PedidoResource;
use App\Filament\Resources\PedidoResource\Widgets\PedidoStatus;
use Filament\Actions;
use Filament\Forms\Components\Tabs\Tab;
use Filament\Resources\Pages\ListRecords;

class ListPedidos extends ListRecords
{
    protected static string $resource = PedidoResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    protected function getHeaderWidgets(): array
    {
        return [
            PedidoStatus::class
        ];
    }

    /* public function getTabs(): array
    {
        return [
            null => Tab::make('All'),
            'new' => Tab::make('Novo')->query(fn($query) => $query->where('status', 'novo')),
        ];
    } */
}
