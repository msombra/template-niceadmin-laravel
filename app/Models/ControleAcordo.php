<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Auxiliares\Uf;
use App\Models\Auxiliares\TipoRecuperacao;
use App\Models\Auxiliares\Status;
use App\Models\Auxiliares\Condutor;
use App\Models\Auxiliares\Andamento;
use App\Models\Auxiliares\Classificacao;
use App\Models\Auxiliares\FormaPagamento;

class ControleAcordo extends Model
{
    use HasFactory;

    protected $fillable = [
        'localizador_npj',
        'adverso_principal',
        'cpf_cnpj',
        'mci',
        'uf',
        'fase_processual',
        'gecor',
        'prefixo_dependencia',
        'tipo_recuperacao',
        'classificacao',
        'rastreamento',
        'documentos_classificados',
        'num_compromisso',
        'condutor',
        'forma_pagamento',
        'valor_honorarios',
        'valor_recuperacao',
        'status',
        'data_vencimento',
        'data_pagamento',
        'data_protocolo',
        'data_final_vencimento',
        'data_envio_subsidio',
        'dependencia_receptora',
        'formulario_rateio',
        'periodicidade',
        'qtd_parcelas',
        'valor_parcela',
        'vencimento_primeira_parcela',
        'valor_entrada',
        'saldo_devedor_atualizado',
        'percentual_honorarios',
        'andamento',
        'observacao',
        'responsavel'
    ];

    // RELACIONAMENTOS
    public function ufAux()
    {
        return $this->belongsTo(Uf::class, 'uf');
    }

    public function tipoRecuperacaoAux()
    {
        return $this->belongsTo(TipoRecuperacao::class, 'tipo_recuperacao');
    }

    public function statusAux()
    {
        return $this->belongsTo(Status::class, 'status');
    }

    public function condutorAux()
    {
        return $this->belongsTo(Condutor::class, 'condutor');
    }

    public function andamentoAux()
    {
        return $this->belongsTo(Andamento::class, 'andamento');
    }

    public function classificacaoAux()
    {
        return $this->belongsTo(Classificacao::class, 'classificacao');
    }

    public function formaPagamentoAux()
    {
        return $this->belongsTo(FormaPagamento::class, 'forma_pagamento');
    }

    public function setAdversoPrincipalAttribute($value)
    {
        $this->attributes['adverso_principal'] = strtoupper($value);
    }

    // FORMATANDO CAMPOS MONETÁRIOS
    public function setAttribute($key, $value)
    {
        $attributes = [
            'valor_honorarios',
            'valor_recuperacao',
            'valor_parcela',
            'valor_entrada',
            'saldo_devedor_atualizado'
        ];

        if(in_array($key, $attributes)) {
            if (!empty($value)) {
                $value = str_replace(['.', ','], ['', '.'], $value);
            }
        }

        return parent::setAttribute($key, $value);
    }
}
