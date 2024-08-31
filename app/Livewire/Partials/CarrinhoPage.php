<?php

namespace App\Livewire\Partials;

use App\Helpers\carrinho_gerenciamento;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Carrinho')]
class CarrinhoPage extends Component
{
    public $itens_carrinho = [];
    public $valor_total;


    public function mount()
    {
        $itens_carrinho = carrinho_gerenciamento::obterItens();
        carrinho_gerenciamento::addItensCarrinho($itens_carrinho);
        $this->itens_carrinho = carrinho_gerenciamento::calcularValorTotal($this->itens_carrinho);
    }
    public function removeItens($id_produto)
    {
        $this->itens_carrinho = carrinho_gerenciamento::removerItens($id_produto);
    }
    public function incrementarQTY($id_produto)
    {
        $this->itens_carrinho = carrinho_gerenciamento::incrementarQuantidade($id_produto);
    }
    public function decrementarQTY($id_produto)
    {
        $this->itens_carrinho = carrinho_gerenciamento::decrementarQuantidade($id_produto);
    }
    public function render()
    {
        return view('livewire.partials.carrinho-page');
    }
}
