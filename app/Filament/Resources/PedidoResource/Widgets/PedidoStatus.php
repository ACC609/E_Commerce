<?php

namespace App\Filament\Resources\PedidoResource\Widgets;

use App\Models\Pedido;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Number;

class PedidoStatus extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('novos pedidos', Pedido::query()->where('status', 'novo')->count()),
            Stat::make('Pedidos Entregues', Pedido::query()->where('status', 'entregue')->count()),

            Stat::make('Valor total dos pedidos', Number::currency(Pedido::query()->sum('valor_total'), 'Kzs'))
        ];
    }
}
