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
        Schema::create('enderecos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_pedido')->constrained('pedidos')->cascadeOnDelete();
            $table->string('primeiro_nome')->nullable();
            $table->string('ultimo_nome')->nullable();
            $table->string('telefone')->nullable();
            $table->text('endereco_rua')->nullable();
            $table->string('cidade')->nullable();
            $table->string('pais')->nullable();
            $table->string('caixa_postal')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('enderecos');
    }
};
