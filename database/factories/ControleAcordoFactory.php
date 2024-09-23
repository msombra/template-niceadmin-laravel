<?php

namespace Database\Factories;

use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ControleAcordo>
 */
class ControleAcordoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'localizador_npj' => $this->faker->unique()->numberBetween(10000000000, 99999999999),
            'adverso_principal' => $this->faker->name,
            'cpf_cnpj' => $this->faker->cpf(),
            'mci' => $this->faker->numberBetween(100000000, 999999999),
            'uf' => $this->faker->numberBetween(1, 27),
            'fase_processual' => $this->faker->randomElement(['PRÉ-PROCESSUAL', 'PROCESSUAL']),
            'gecor' => $this->faker->numberBetween(1000, 9999),
            'prefixo_dependencia' => $this->faker->numberBetween(1000, 9999),
            'tipo_recuperacao' => $this->faker->numberBetween(1, 4),
            'classificacao' => $this->faker->numberBetween(1, 15),
            'rastreamento' => $this->faker->numberBetween(10000000000000, 99999999999999),
            'documentos_classificados' => $this->faker->boolean ? 1 : 0,
            'num_compromisso' => $this->faker->numberBetween(100000000000, 999999999999),
            'condutor' => $this->faker->numberBetween(1, 5),
            'forma_pagamento' => $this->faker->numberBetween(1, 4),
            'valor_honorarios' => $this->faker->randomFloat(2, 0, 10000),
            'valor_recuperacao' => $this->faker->randomFloat(2, 0, 10000),
            'status' => $this->faker->numberBetween(1, 7),
            'data_vencimento' => $this->faker->date,
            'data_pagamento' => $this->faker->date,
            'data_protocolo' => $this->faker->date,
            'data_final_vencimento' => $this->faker->date,
            'data_envio_subsidio' => $this->faker->date,
            'dependencia_receptora' => $this->faker->numberBetween(10000000000000, 99999999999999),
            'formulario_rateio' => $this->faker->numberBetween(10000000000000, 99999999999999),
            'periodicidade' => $this->faker->randomElement(['MENSAL', 'ANUAL']),
            'qtd_parcelas' => $this->faker->numberBetween(2, 99),
            'valor_parcela' => $this->faker->randomFloat(2, 0, 10000),
            'vencimento_primeira_parcela' => $this->faker->date,
            'valor_entrada' => $this->faker->randomFloat(2, 0, 10000),
            'saldo_devedor_atualizado' => $this->faker->randomFloat(2, 0, 10000),
            'percentual_honorarios' => $this->faker->randomFloat(2, 0, 100) . '%',
            'andamento' => $this->faker->numberBetween(1, 4),
            'observacao' => $this->faker->text,
            'responsavel' => $this->faker->name
        ];
    }
}
