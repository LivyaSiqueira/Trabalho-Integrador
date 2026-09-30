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
                'name' => config('auth.admin.name'),
                'email' => config('auth.admin.email'),
                'password' => Hash::make(config('auth.admin.password')),
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