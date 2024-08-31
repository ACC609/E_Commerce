<?php

namespace App\Livewire\Partials;

use App\Models\Endereco;
use App\Models\Pedido;
use App\Models\PeditoItem;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Detalhes do Pedido')]
class MeuPedidoDetalhesPage extends Component
{
    public $pedido_id;

    public function mount($pedido_id)
    {
        //dd($pedido_id);
        $this->pedido_id = $pedido_id;
    }
    public function render()
    {
        $itens_pedido = PeditoItem::with('Produto')->where('id_pedido', $this->pedido_id)->get();
        $endereco = Endereco::where('id_pedido', $this->pedido_id)->first();
        $pedido = Pedido::where('id', $this->pedido_id)->first();

        return view('livewire.partials.meu-pedido-detalhes-page', [
            'pedido_itens' => $itens_pedido,
            'endereco' => $endereco,
            'pedido' => $pedido,
        ]);
    }
}
