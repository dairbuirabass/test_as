<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Расчет цены продукта</title>
</head>
<body>
    <h2>Расчет цены продукта</h2>

    @if(session('result'))
        <p style="color: green;">{{ session('result') }}</p>
    @endif

    @if($errors->any())
        <div style="color: red;">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('calculate') }}" method="POST">
        @csrf
        <label for="product">Выберите продукт:</label>
        <select name="product_id" id="product">
            @foreach($products as $product)
                <option value="{{ $product->id }}">{{ $product->name }} (€{{ $product->price }})</option>
            @endforeach
        </select>

        <br><br>

        <label for="tax_number">Введите Tax номер:</label>
        <input type="text" name="tax_number" id="tax_number" required>

        <br><br>

        <button type="submit">Рассчитать цену</button>
    </form>
</body>
</html>
