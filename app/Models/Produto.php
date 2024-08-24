<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Produto extends Model
{
    use HasFactory;
    protected $fillable = ['id_categoria', 'id_marca', 'nome', 'slug', 'imagem', 'descricao', 'preco', 'status', 'destaque', 'em_estoque', 'a_venda'];

    protected $casts = [
        'imagem' => 'array',
    ];

    public function categorias()
    {
        return $this->BelongsTo(Categoria::class);
    }
    public function marca()
    {
        return $this->BelongsTo(Marca::class);
    }
    public function pedidoItem()
    {
        return $this->hasMany(PeditoItem::class);
    }
}
