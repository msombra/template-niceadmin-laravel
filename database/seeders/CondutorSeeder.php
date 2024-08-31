<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Auxiliares\Condutor;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CondutorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Condutor::insert([
            ['nome' => 'ESC'],
            ['nome' => 'ESC/GECOR'],
            ['nome' => 'GECOR'],
            ['nome' => 'RMS'],
            ['nome' => 'RMS/GECOR'],
        ]);
    }
}
