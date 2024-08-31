<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Auxiliares\Andamento;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class AndamentoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Andamento::insert([
            ['nome' => 'ACORDO ATIVO'],
            ['nome' => 'ACORDO QUITADO'],
            ['nome' => 'LEVANTAMENTO DEFERIDO'],
            ['nome' => 'LEVANTAMENTO DEVOLVIDO'],
        ]);
    }
}
