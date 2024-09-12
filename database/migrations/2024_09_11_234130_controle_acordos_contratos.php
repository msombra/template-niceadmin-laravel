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
        Schema::create('controle_acordos_contratos', function (Blueprint $table) {
            $table->id();
            // ínicio do relacionamento
            $table
                ->unsignedBigInteger('localizador_npj_id');
            $table
                ->foreign('localizador_npj_id')
                ->references('localizador_npj')
                ->on('controle_acordos')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            // fim do relacionamento
            $table->string('contrato', 10);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('controle_acordos_contratos');
    }
};
