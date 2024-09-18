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
        Schema::create('controle_acordos_historico', function (Blueprint $table) {
            $table->id();
            $table->string('model'); // O nome do modelo que sofreu alteração
            $table->unsignedBigInteger('model_id'); // O ID do modelo alterado
            $table->string('campo'); // Nome do campo alterado
            $table->text('valor_antigo')->nullable(); // Valor antigo
            $table->text('valor_novo')->nullable(); // Novo valor
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('controle_acordos_historico');
    }
};
