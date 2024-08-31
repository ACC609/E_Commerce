<?php

namespace App\Livewire\Partials;

use App\Helpers\carrinho_gerenciamento;
use App\Models\Produto;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('DETALHES')]

class ProdutoDetailPage extends Component
{
    public $slug;
    public $imagens = [];
    public $quantidade = 1;

    public function mount($slug)
    {
        $this->slug = $slug;
        $produto = Produto::where('slug', $this->slug)->firstOrFail();

        // Decodifica o JSON para um array associativo
        $this->imagens = json_decode($produto->imagens, true);
    }

    public function incrementarQTY($id_produto)
    {
        $this->quantidade = carrinho_gerenciamento::incrementarQuantidade($id_produto);
    }
    public function decrementarQTY($id_produto)
    {
        if ($this->quantidade > 1) {
            $this->quantidade = carrinho_gerenciamento::decrementarQuantidade($id_produto);
        }
    }

    public function addToCart($id_produto)
    {
        //dd($id_produto);
        $valor_total = carrinho_gerenciamento::addItens($id_produto);
        $this->dispatch('atualizar-contagem-carrinho', valor_total: $valor_total)->to(Navbar::class);
    }

    public function render()
    {
        return view('livewire.partials.produto-detail-page', [
            'produto' => Produto::where('slug', $this->slug)->firstOrFail(),
            'imagens' => $this->imagens,
        ]);
    }
}
