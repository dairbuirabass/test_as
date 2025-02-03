<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use App\Models\Product;
use App\Models\CountryTax;

class PriceCalculatorTest extends TestCase
{
    public function it_correctly_calculates_final_price()
    {
        $product = new Product(['price' => 100]);
        $countryTax = new CountryTax(['tax_rate' => 24]);

        $taxAmount = $product->price * ($countryTax->tax_rate / 100);
        $finalPrice = $product->price + $taxAmount;

        $this->assertEquals(124.00, $finalPrice);
    }
}

