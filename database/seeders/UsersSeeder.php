<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'id' => 1,
                'name' => 'Administrador',
                'email' => 'admin@studyfy.com',
                'password' => Hash::make('admin123'),
            ],
            [
                'id' => 2,
                'name' => 'Livya Siqueira',
                'email' => 'livya@gmail.com',
                'password' => Hash::make('123456'),
            ],
            [
                'id' => 3,
                'name' => 'Ana Siqueira',
                'email' => 'ana@gmail.com',
                'password' => Hash::make('123456'),
            ],
        ]);
    }
}