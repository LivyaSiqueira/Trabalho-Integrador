<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ContentsSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('contents')->insert([
            [
                'id' => 1,
                'subjects_id' => 1,
                'title' => 'Identação',
                'description' => 'Para o código ficar mais interpretável',
                'status' => true,
            ],
            [
                'id' => 2,
                'subjects_id' => 1,
                'title' => 'Funções',
                'description' => 'Funções Matemáticas',
                'status' => false,
            ],
            [
                'id' => 3,
                'subjects_id' => 2,
                'title' => 'Vezes',
                'description' => 'Multiplicação',
                'status' => true,
            ],
            [
                'id' => 4,
                'subjects_id' => 2,
                'title' => 'Flutter',
                'description' => '',
                'status' => false,
            ],
            [
                'id' => 5,
                'subjects_id' => 3,
                'title' => 'Lei 1',
                'description' => 'Ação e Reação',
                'status' => true,
            ],
        ]);
    }
}