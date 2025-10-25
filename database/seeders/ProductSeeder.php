<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Product::insert([
            [
                'name' => 'Laptop',
                'price' => 3500.99,
                'stock' => 20,
                'created_at' => now()
            ],
            [
                'name' => 'PC Gamer',
                'price' => 2200.50,
                'stock' => 5,
                'created_at' => now()
            ],
            [
                'name' => 'Monitor',
                'price' => 250.00,
                'stock' => 12,
                'created_at' => now()
            ],
            [
                'name' => 'Celular',
                'price' => 800.00,
                'stock' => 13,
                'created_at' => now()
            ]
        ]);
    }
}
