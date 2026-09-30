<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SubjectsSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('subjects')->insert([
            [
                'id' => 1,
                'users_id' => 1,
                'name' => 'DW',
                'description' => 'Laravel',
            ],
            [
                'id' => 2,
                'users_id' => 1,
                'name' => 'Matemática',
                'description' => 'Equações e números',
            ],
            [
                'id' => 3,
                'users_id' => 2,
                'name' => 'Física',
                'description' => 'Leis de Newton',
            ],
        ]);
    }
}