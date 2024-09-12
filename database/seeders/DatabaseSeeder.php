<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            ControleAcordoSeeder::class,
            // UfSeeder::class,
            // TipoRecuperacaoSeeder::class,
            // AndamentoSeeder::class,
            // ClassificacaoSeeder::class,
            // CondutorSeeder::class,
            // FormaPagamentoSeeder::class,
            // StatusSeeder::class
        ]);
    }
}
