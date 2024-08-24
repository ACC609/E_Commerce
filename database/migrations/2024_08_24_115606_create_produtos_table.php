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
        Schema::create('produtos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_categoria')->constrained('categorias')->cascadeOnDelete();
            $table->foreignId('id_marca')->constrained('marcas')->cascadeOnDelete();
            $table->string('nome');
            $table->string('slug')->unique();
            $table->json('imagem')->nullable();
            $table->longText('descricao')->nullable();
            $table->decimal('preco', 10, 2)->nullable();
            $table->boolean('status')->default(true);
            $table->boolean('destaque')->default(false);
            $table->boolean('em_estoque')->default(true);
            $table->boolean('a_venda')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('produtos');
    }
};
