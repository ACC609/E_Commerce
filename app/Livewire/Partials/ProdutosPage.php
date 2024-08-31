<?php

namespace App\Livewire\Partials;

use App\Helpers\carrinho_gerenciamento;
use App\Models\Categoria;
use App\Models\Marca;
use App\Models\Produto;
use Livewire\Component;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\WithPagination;

#[Title('PRODUTOS-ACC FASSHION')]

class ProdutosPage extends Component
{
    #[Url()]
    public $selected_categoria = [];

    #[Url()]
    public $selected_marca = [];

    #[Url()]
    public $selected_destaques = [];
    #[Url()]
    public $selected_estoque = [];
    #[Url()]
    public $selected_venda = [];

    //add ao carrinho
    public function addToCart($id_produto)
    {
        //dd($id_produto);
        $valor_total = carrinho_gerenciamento::addItens($id_produto);
        $this->dispatch('atualizar-contagem-carrinho', valor_total: $valor_total)->to(Navbar::class);
    }

    public function render()
    {
        // Inicia a consulta base
        $produtos = Produto::query()->where('status', 1);

        // Verifica se há categorias selecionadas e aplica o filtro
        if (!empty($this->selected_categoria)) {
            $produtos->whereIn('id_categoria', $this->selected_categoria);
        }

        // Verifica se há marcas selecionadas e aplica o filtro
        if (!empty($this->selected_marca)) {
            $produtos->whereIn('id_marca', $this->selected_marca);
        }
        if (!empty($this->selected_destaques)) {

            $produtos->where('destaque', 1);
        }

        if (!empty($this->selected_estoque)) {

            $produtos->where('em_estoque', 1);
        }
        if (!empty($this->selected_venda)) {

            $produtos->where('a_venda', 1);
        }

        // Paginando os resultados após aplicar os filtros
        $produtos = $produtos->paginate(20);

        // Obtém as categorias e marcas
        $categorias = Categoria::where('status', 1)->get(['id', 'nome', 'slug']);
        $marcas = Marca::where('status', 1)->get(['id', 'nome', 'slug']);

        // Retorna a view com os dados
        return view('livewire.partials.produtos-page', [
            'produtos' => $produtos,
            'marcas' => $marcas,
            'categorias' => $categorias,
        ]);
    }
}
