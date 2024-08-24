<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('pedidos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_user')->constrained('users')->cascadeOnDelete();
            $table->decimal('valor_total', 10, 2)->nullable();
            $table->string('metodo_de_pagamento');
            $table->string('status_de_pagamento');
            $table->enum('status', ['novo', 'processando', 'enviado', 'entregue', 'cancelado'])->default('novo');
            $table->string('moeda')->nullable();
            $table->decimal('custo_de_envio', 10, 2)->nullable();
            $table->string('metodo_de_envio')->nullable();
            $table->text('notas')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pedidos');
    }
};
