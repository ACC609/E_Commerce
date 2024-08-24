<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PeditoItem extends Model
{
    use HasFactory;

    protected $fillable = ['id_pedido', 'id_produto', 'quantidade', 'preco', 'valor_total'];

    public function pedidos()
    {
        return $this->belongsTo(Pedido::class);
    }
    public function produto()
    {
        return $this->belongsTo(Pedido::class);
    }
}
