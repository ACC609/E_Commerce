<?php

namespace App\Livewire;

use App\Models\Categoria;
use App\Models\Marca;
use App\Models\Produto;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Pagina Inicial-ACC FASSHION')]
class HomePage extends Component
{
    public $slug;
    public $imagens = [];

    public function mount($slug = null)
    {
        $this->slug = $slug;

        if ($this->slug) {
            $produto = Produto::where('slug', $this->slug)->firstOrFail();
            $this->imagens = json_decode($produto->imagens, true);
        }
    }

    public function render()
    {
        $categorias = Categoria::where('status', 1)->get();
        $marcas = Marca::where('status', 1)->get();
        $produtos = Produto::where('status', 1)->paginate(50);
        return view('livewire.home-page', [
            'marcas' => $marcas,
            'produtos' => $produtos,
            'categorias' => $categorias,
            'imagens' => $this->imagens,
        ]);
    }
}
