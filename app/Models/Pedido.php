<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    use HasFactory;
    protected $fillable = ['id_user', 'valor_total', 'metodo_de_pagamento', 'status_de_pagamento', 'status', 'novo', 'moeda', 'custo_de_envio', 'metodo_de_envio', 'notas'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function itens()
    {
        return $this->hasMany(PeditoItem::class);
    }

    public function endereco()
    {
        return $this->hasOne(Endereco::class);
    }
}
