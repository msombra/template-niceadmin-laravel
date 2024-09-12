<?php

namespace App\Models\Auxiliares;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ControleAcordo;

class Classificacao extends Model
{
    use HasFactory;

    public $table = 'controle_acordos_classificacao_aux';

    protected $fillable = ['nome'];

    public function controleAcordo()
    {
        return $this->hasMany(ControleAcordo::class);
    }
}
