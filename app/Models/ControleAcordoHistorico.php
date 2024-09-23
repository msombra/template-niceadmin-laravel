<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ControleAcordoHistorico extends Model
{
    use HasFactory;

    protected $fillable = [
        'model',
        'model_id',
        'campo',
        'valor_antigo',
        'valor_novo',
        'responsavel'
    ];

    public $table = 'controle_acordos_historico';
}
