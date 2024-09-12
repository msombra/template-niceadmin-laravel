<?php

namespace Database\Seeders;

use App\Models\ControleAcordo;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ControleAcordoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ControleAcordo::factory(25)->create();
    }
}
