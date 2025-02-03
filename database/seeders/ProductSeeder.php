<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Product::insert([
            ['name' => 'Наушники', 'price' => 100.00],
            ['name' => 'Чехол для телефона', 'price' => 20.00]
        ]);
    }
}
