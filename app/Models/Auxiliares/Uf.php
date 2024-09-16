<?php

namespace App\Models\Auxiliares;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ControleAcordo;

class Uf extends Model
{
    use HasFactory;

    public $table = 'uf_aux';

    protected $fillable = ['sigla', 'estado'];

    public function controleAcordo()
    {
        return $this->hasMany(ControleAcordo::class);
    }
}
