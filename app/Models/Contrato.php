<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contrato extends Model
{
    use HasFactory;

    public $table = 'controle_acordos_contratos';

    protected $fillable = ['localizador_npj', 'contrato'];
}
