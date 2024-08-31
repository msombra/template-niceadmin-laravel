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
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',

        //     'email' => 'test@example.com',
        // ]);
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
