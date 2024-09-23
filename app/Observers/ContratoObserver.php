<?php

namespace App\Observers;

use App\Models\Contrato;
use Illuminate\Support\Facades\Auth;
use App\Models\ControleAcordoHistorico;

class ContratoObserver
{
    public function updating(Contrato $model)
    {
        $dirty = $model->getDirty(); // Pega os campos alterados

        foreach ($dirty as $campo => $valorNovo) {
            $valorAntigo = $model->getOriginal($campo);

            // dd($valorNovo, $valorAntigo); // debug

            // Salva no log
            if($campo !== 'responsavel') {
                ControleAcordoHistorico::create([
                    'model'         => Contrato::class, // Nome do modelo
                    'model_id'      => $model->localizador_npj, // ID do registro alterado
                    'campo'         => 'Contrato', // Nome do campo
                    'valor_antigo'  => $valorAntigo, // Valor antigo
                    'valor_novo'    => $valorNovo, // Novo valor
                    'responsavel'   => Auth::user()->name,
                ]);
            }
        }
    }
}
