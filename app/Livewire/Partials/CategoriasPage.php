<?php

namespace App\Livewire\Partials;

use App\Models\Categoria;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('ACC FASHION-CATEGORIAS')]
class CategoriasPage extends Component
{
    public function render()
    {
        $categorias = Categoria::where('status', 1)->get();
        return view('livewire.partials.categorias-page', [
            'categorias' => $categorias
        ]);
    }
}
