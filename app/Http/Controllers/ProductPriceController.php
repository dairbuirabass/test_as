<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\CountryTax;

class ProductPriceController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return view('product_price', compact('products'));
    }

    public function calculate(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'tax_number' => ['required', 'regex:/^(DE|IT|GR)\d{9,11}$/'],
        ]);

        // Определяем код страны по tax номеру
        $countryCode = substr($request->tax_number, 0, 2);

        // Получаем продукт и налоговую ставку
        $product = Product::findOrFail($request->product_id);
        $countryTax = CountryTax::where('country_code', $countryCode)->first();

        if (!$countryTax) {
            return back()->withErrors(['tax_number' => 'Налоговая ставка для данной страны не найдена.']);
        }

        // Рассчитываем финальную цену
        $taxAmount = $product->price * ($countryTax->tax_rate / 100);
        $finalPrice = $product->price + $taxAmount;

        return back()->with('result', "Цена продукта: {$product->name}, Окончательная цена: €" . number_format($finalPrice, 2));
    }
}
