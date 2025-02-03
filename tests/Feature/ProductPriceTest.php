<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Product;
use App\Models\CountryTax;

class ProductPriceTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        // Создаем тестовые данные
        Product::create(['name' => 'Наушники', 'price' => 100]);
        Product::create(['name' => 'Чехол для телефона', 'price' => 20]);

        CountryTax::create(['country_code' => 'DE', 'tax_rate' => 19]);
        CountryTax::create(['country_code' => 'IT', 'tax_rate' => 22]);
        CountryTax::create(['country_code' => 'GR', 'tax_rate' => 24]);
    }

    public function it_calculates_price_correctly_for_germany()
    {
        $response = $this->post('/calculate', [
            'product_id' => 1,  // Наушники (100€)
            'tax_number' => 'DE123456789'
        ]);

        $response->assertSessionHas('result', 'Цена продукта: Наушники, Окончательная цена: €119.00');
    }

    public function it_rejects_invalid_tax_number()
    {
        $response = $this->post('/calculate', [
            'product_id' => 1,
            'tax_number' => 'INVALID123'
        ]);

        $response->assertSessionHasErrors(['tax_number']);
    }

    public function it_returns_422_if_product_not_found()
    {
        $response = $this->post('/calculate', [
            'product_id' => 999,  // Несуществующий продукт
            'tax_number' => 'GR123456789'
        ]);

        $response->assertStatus(302);
        $response->assertSessionHasErrors(['product_id']);
    }
}
