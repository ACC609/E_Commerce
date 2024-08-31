<?php

namespace App\Livewire\Partials;

use App\Helpers\carrinho_gerenciamento;
use App\Models\Categoria;
use Livewire\Attributes\On;
use Livewire\Component;

class Navbar extends Component
{
    public $valor_total = 0;

    public function mount()
    {
        $itens_carrinho = carrinho_gerenciamento::obterItens(); // Obtém os itens do carrinho
        $this->valor_total = count($itens_carrinho); // Conta o número de itens
    }

    #[On('atualizar-contagem-carrinho')]
    public function updateCart($valor_total)
    {
        $this->valor_total = $valor_total;
    }





    public function render()
    {
        return view('livewire.partials.navbar');
    }
}
