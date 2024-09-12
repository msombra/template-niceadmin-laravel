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
        Schema::create('controle_acordos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('localizador_npj')->unique();
            $table->string('adverso_principal');
            $table->string('cpf_cnpj', 18);
            $table->string('mci', 9);
            $table->unsignedBigInteger('uf');
            $table->foreign('uf')->references('id')->on('uf_aux');
            $table->string('fase_processual', 14)->nullable();
            $table->string('gecor', 4)->nullable();
            $table->string('prefixo_dependencia', 4)->nullable();
            $table->unsignedBigInteger('tipo_recuperacao');
            $table->foreign('tipo_recuperacao')->references('id')->on('controle_acordos_tipo_recuperacao_aux');
            $table->unsignedBigInteger('classificacao');
            $table->foreign('classificacao')->references('id')->on('controle_acordos_classificacao_aux');
            $table->string('rastreamento', 14);
            $table->boolean('documentos_classificados');
            $table->string('num_compromisso', 12)->nullable();
            $table->unsignedBigInteger('condutor')->nullable();
            $table->foreign('condutor')->references('id')->on('controle_acordos_condutor_aux');
            $table->unsignedBigInteger('forma_pagamento')->nullable();
            $table->foreign('forma_pagamento')->references('id')->on('controle_acordos_forma_pagamento_aux');
            $table->decimal('valor_honorarios', 10, 2)->nullable();
            $table->decimal('valor_recuperacao', 10, 2);
            $table->unsignedBigInteger('status')->nullable();
            $table->foreign('status')->references('id')->on('controle_acordos_status_aux');
            $table->date('data_vencimento')->nullable();
            $table->date('data_pagamento')->nullable();
            $table->date('data_protocolo')->nullable();
            $table->date('data_final_vencimento')->nullable();
            $table->date('data_envio_subsidio')->nullable();
            $table->string('dependencia_receptora', 14)->nullable();
            $table->string('formulario_rateio', 14)->nullable();
            $table->string('periodicidade', 6)->nullable();
            $table->integer('qtd_parcelas')->nullable();
            $table->decimal('valor_parcela', 10, 2)->nullable();
            $table->date('vencimento_primeira_parcela')->nullable();
            $table->decimal('valor_entrada', 10, 2)->nullable();
            $table->decimal('saldo_devedor_atualizado', 10, 2)->nullable();
            $table->string('percentual_honorarios', 7)->nullable();
            $table->unsignedBigInteger('andamento')->nullable();
            $table->foreign('andamento')->references('id')->on('controle_acordos_andamento_aux');
            $table->text('observacao')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('controle_acordos');
    }
};
