<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Endereco extends Model
{
    use HasFactory;
    protected $fillable = ['id_pedido', 'primeiro_nome', 'ultimo_nome', 'telefone', 'endereco_rua', 'cidade', 'pais', 'caixa_postal'];

    public function pedidos()
    {
        return $this->belongsTo(Pedido::class);
    }

    public function getFullNameAtributes()
    {
        return "{$this->primeiro_nome} {$this->ultimo_nome}";
    }
}
