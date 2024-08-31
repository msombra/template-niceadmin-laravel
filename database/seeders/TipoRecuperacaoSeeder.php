<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Auxiliares\TipoRecuperacao;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class TipoRecuperacaoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        TipoRecuperacao::insert([
            ['nome' => 'ACORDO'],
            ['nome' => 'ASSUNÇÃO'],
            ['nome' => 'CESSÃO DE CRÉDITOS'],
            ['nome' => 'VIA FORÇADA']
        ]);
    }
}
