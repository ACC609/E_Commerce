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
        return $this->belongsTo(Categoria::class, 'id_categoria');
    }

    public function marca()
    {
        return $this->belongsTo(Marca::class, 'id_marca');
    }
    public function pedidoItem()
    {
        return $this->hasMany(PeditoItem::class);
    }
}
