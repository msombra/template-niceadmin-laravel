<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Auxiliares\FormaPagamento;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class FormaPagamentoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        FormaPagamento::insert([
            ['nome' => 'A PRAZO - DEMAIS'],
            ['nome' => 'A PRAZO - RAO'],
            ['nome' => 'À VISTA - DEMAIS'],
            ['nome' => 'À VISTA - RAO'],
        ]);
    }
}
