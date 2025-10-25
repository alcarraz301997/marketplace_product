<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::insert([
            [
                'name' => 'Junior Alcarraz',
                'email' => 'junior@tumisoft.com',
                'password' => Hash::make('123456'),
                'created_at' => now()
            ],
            [
                'name' => 'Guillermo Montes',
                'email' => 'memo@tumisoft.com',
                'password' => Hash::make('123456'),
                'created_at' => now()
            ],
            [
                'name' => 'Alexander Ramirez',
                'email' => 'alex@tumisoft.com',
                'password' => Hash::make('123456'),
                'created_at' => now()
            ]
        ]);
    }
}
