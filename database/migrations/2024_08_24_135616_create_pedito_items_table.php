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
        Schema::create('pedito_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_pedido')->constrained('pedidos')->cascadeOnDelete();
            $table->foreignId('id_produto')->constrained('produtos')->cascadeOnDelete();
            $table->integer('quantidade')->default(1);
            $table->decimal('preco', 10, 2)->nullable();
            $table->decimal('valor_total', 10, 2)->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pedito_items');
    }
};
