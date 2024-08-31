<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Auxiliares\Classificacao;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ClassificacaoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Classificacao::insert([
            ['nome' => 'AÇÃO DE FALÊNCIA'],
            ['nome' => 'AÇÃO DE RECUPERAÇÃO JUDICIAL'],
            ['nome' => 'ACORDO JUDICIAL A PRAZO - DEMAIS'],
            ['nome' => 'ACORDO JUDICIAL A PRAZO - RAO'],
            ['nome' => 'ACORDO JUDICIAL À VISTA - DEMAIS'],
            ['nome' => 'ACORDO JUDICIAL À VISTA - RAO'],
            ['nome' => 'ADJUDICAÇÃO OU ARREMATAÇÃO'],
            ['nome' => 'ALVARÁ/M.L.J'],
            ['nome' => 'ASSUNÇÃO'],
            ['nome' => 'CESSÃO ATIVOS'],
            ['nome' => 'CESSÃO ENTE PÚBLICO'],
            ['nome' => 'CESSÃO TERCEIROS'],
            ['nome' => 'PAGAMENTO ESPONT NEO'],
            ['nome' => 'TRANSFERÊNCIA CONTA BB'],
            ['nome' => 'OUTROS'],
        ]);
    }
}
