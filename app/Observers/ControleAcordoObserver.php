<?php

namespace App\Observers;

use App\Models\ControleAcordo;
use App\Models\ControleAcordoHistorico;
use App\Models\Auxiliares\Uf;
use App\Models\Auxiliares\TipoRecuperacao;
use App\Models\Auxiliares\Status;
use App\Models\Auxiliares\Condutor;
use App\Models\Auxiliares\Andamento;
use App\Models\Auxiliares\Classificacao;
use App\Models\Auxiliares\FormaPagamento;

class ControleAcordoObserver
{
    public function updating(ControleAcordo $model)
    {
        $dirty = $model->getDirty(); // Pega os campos alterados

        /**
         * Carrega os nomes dos métodos das tabelas auxiliares
         * que foram definidas na model ControleAcordo
         */
        $model->load([
            'ufAux',
            'tipoRecuperacaoAux',
            'statusAux',
            'condutorAux',
            'andamentoAux',
            'classificacaoAux',
            'formaPagamentoAux'
        ]);

        foreach ($dirty as $campo => $valorNovo) {
            $valorAntigo = $model->getOriginal($campo);

            switch ($campo) {
                case 'uf':
                    $ufAntigo = Uf::where('id', $valorAntigo)->first();

                    $valorAntigo = $ufAntigo->sigla;
                    $valorNovo = $model->ufAux->sigla;
                    break;
                case 'tipo_recuperacao':
                    $tipoRecuperacaoAntigo = TipoRecuperacao::where('id', $valorAntigo)->first();

                    $valorAntigo = $tipoRecuperacaoAntigo->nome;
                    $valorNovo = $model->tipoRecuperacaoAux->nome;
                    break;
                case 'status':
                    $statusAntigo = Status::where('id', $valorAntigo)->first();

                    $valorAntigo = $statusAntigo->nome;
                    $valorNovo = $model->statusAux->nome;
                    break;
                case 'condutor':
                    $condutorAntigo = Condutor::where('id', $valorAntigo)->first();

                    $valorAntigo = $condutorAntigo->nome;
                    $valorNovo = $model->condutorAux->nome;
                    break;
                case 'andamento':
                    $andamentoAntigo = Andamento::where('id', $valorAntigo)->first();

                    $valorAntigo = $andamentoAntigo->nome;
                    $valorNovo = $model->andamentoAux->nome;
                    break;
                case 'classificacao':
                    $classificacaoAntigo = Classificacao::where('id', $valorAntigo)->first();

                    $valorAntigo = $classificacaoAntigo->nome;
                    $valorNovo = $model->classificacaoAux->nome;
                    break;
                case 'forma_pagamento':
                    $formaPagamentoAntigo = FormaPagamento::where('id', $valorAntigo)->first();

                    $valorAntigo = $formaPagamentoAntigo->nome;
                    $valorNovo = $model->formaPagamentoAux->nome;
                    break;
                case 'documentos_classificados':
                    $valorAntigo = $valorAntigo == 1 ? 'SIM' : 'NÃO';
                    $valorNovo = $valorNovo == 1 ? 'SIM' : 'NÃO';
                    break;
            }

            // dd($valorNovo, $valorAntigo);

            // Salva no log
            ControleAcordoHistorico::create([
                'model'         => ControleAcordo::class, // Nome do modelo
                'model_id'      => $model->id, // ID do registro alterado
                'campo'         => $campo, // Nome do campo
                'valor_antigo'  => $valorAntigo, // Valor antigo
                'valor_novo'    => $valorNovo, // Novo valor
            ]);
        }
    }
}
