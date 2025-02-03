<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\CountryTax;

class CountryTaxSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        CountryTax::insert([
            ['country_code' => 'DE', 'tax_rate' => 19.00],
            ['country_code' => 'IT', 'tax_rate' => 22.00],
            ['country_code' => 'GR', 'tax_rate' => 24.00]
        ]);
    }
}
