<?php

namespace App\Observers;

use App\Models\Auxiliares\Uf;
use App\Models\ControleAcordo;
use Illuminate\Support\Carbon;
use App\Models\Auxiliares\Status;
use App\Models\Auxiliares\Condutor;
use App\Models\Auxiliares\Andamento;
use Illuminate\Support\Facades\Auth;
use App\Models\ControleAcordoHistorico;
use App\Models\Auxiliares\Classificacao;
use App\Models\Auxiliares\FormaPagamento;
use App\Models\Auxiliares\TipoRecuperacao;

class ControleAcordoObserver
{
    public function updating(ControleAcordo $model)
    {
        $dirty = $model->getDirty(); // Pega os campos alterados

        $campos = [
            'localizador_npj'               => 'Localizador (NPJ)',
            'adverso_principal'             => 'Adverso Principal',
            'cpf_cnpj'                      => 'CPF/CNPJ',
            'mci'                           => 'MCI',
            'uf'                            => 'UF',
            'fase_processual'               => 'Fase Processual',
            'gecor'                         => 'GECOR',
            'prefixo_dependencia'           => 'Prefixo (Dep.)',
            'tipo_recuperacao'              => 'Tipo Recuperação',
            'classificacao'                 => 'Classificação',
            'rastreamento'                  => 'Rastreamento',
            'documentos_classificados'      => 'Documentos Classificados',
            'num_compromisso'               => 'Nº Compromisso',
            'condutor'                      => 'Condutor',
            'forma_pagamento'               => 'Forma Pagamento',
            'valor_honorarios'              => 'Valor Honorários',
            'valor_recuperacao'             => 'Valor Recuperação',
            'status'                        => 'Status',
            'data_vencimento'               => 'Data Vencimento',
            'data_pagamento'                => 'Data Pagamento',
            'data_protocolo'                => 'Data Protocolo',
            'data_final_vencimento'         => 'Data Final Vencimento',
            'data_envio_subsidio'           => 'Data Envio Subsídio',
            'dependencia_receptora'         => 'Dependência Receptora',
            'formulario_rateio'             => 'Formulário Rateio',
            'periodicidade'                 => 'Periodicidade',
            'qtd_parcelas'                  => 'Quantidade de Parcelas',
            'valor_parcela'                 => 'Valor Parcela',
            'vencimento_primeira_parcela'   => 'Vencimento 1º Parcela',
            'valor_entrada'                 => 'Valor Entrada',
            'saldo_devedor_atualizado'      => 'Saldo Devedor Atualizado',
            'percentual_honorarios'         => 'Percentual Honorários',
            'andamento'                     => 'Andamento',
            'observacao'                    => 'Observação'
        ];

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

            // Formatando valores de tabelas auxiliares
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

            // Formatando valores no formato data
            $camposData = [
                'data_vencimento',
                'data_pagamento',
                'data_protocolo',
                'data_final_vencimento',
                'data_envio_subsidio',
                'vencimento_primeira_parcela'
            ];

            if(in_array($campo, $camposData)) {
                $valorAntigo = Carbon::parse($valorAntigo)->format('d/m/Y');
                $valorNovo = Carbon::parse($valorNovo)->format('d/m/Y');
            }

            // Formatando valores no formato monetário
            $camposMoney = [
                'valor_honorarios',
                'valor_recuperacao',
                'valor_parcela',
                'valor_entrada',
                'saldo_devedor_atualizado'
            ];

            if(in_array($campo, $camposMoney)) {
                $valorAntigo = 'R$ ' . number_format($valorAntigo, 2, ',', '.');
                $valorNovo = 'R$ ' . number_format($valorNovo, 2, ',', '.');
            }

            // Formatando os nomes dos campos
            foreach ($campos as $campoAntigo => $campoNovo) {
                if($campo === $campoAntigo) {
                    $campo = $campoNovo;
                }
            }

            // dd($valorNovo, $valorAntigo); // debug

            // Salva no log
            if($campo !== 'responsavel') {
                ControleAcordoHistorico::create([
                    'model'         => ControleAcordo::class, // Nome do modelo
                    'model_id'      => $model->id, // ID do registro alterado
                    'campo'         => $campo, // Nome do campo
                    'valor_antigo'  => $valorAntigo, // Valor antigo
                    'valor_novo'    => $valorNovo, // Novo valor
                    'responsavel'   => Auth::user()->name,
                ]);
            }
        }
    }
}
