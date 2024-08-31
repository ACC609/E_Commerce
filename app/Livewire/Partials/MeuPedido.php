<?php

namespace App\Livewire\Partials;

use App\Models\Pedido;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;

#[Title(' Meu Pedido')]
class MeuPedido extends Component
{
    use WithPagination;
    public function render()
    {
        $meu_pedido = Pedido::where('id_user', Auth::id())->latest()->paginate(10);
        return view('livewire.partials.meu-pedido', [
            'pedido' => $meu_pedido,
        ]);
    }
}
