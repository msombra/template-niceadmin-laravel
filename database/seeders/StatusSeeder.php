<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Auxiliares\Status;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Status::insert([
            ['nome' => 'ACORDO DESFEITO'],
            ['nome' => 'AGUARDANDO PAGAMENTO'],
            ['nome' => 'MINUTA VALIDADA/AGUARDANDO RETORNO'],
            ['nome' => 'PAGO'],
            ['nome' => 'PAGO/ENTRADA'],
            ['nome' => 'PAGO/PARCELA INICIAL'],
            ['nome' => 'PROPOSTA APROVADA'],
        ]);
    }
}
