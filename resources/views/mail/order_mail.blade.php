<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>My site</title>
</head>
<body>

    <h1>Данные заказа</h1>
    <p><b>Имя заказчика:</b> {{$order['name']}}</p>
    <p><b>Телефон:</b> {{$order['phone']}}</p>
    <p><b>Email:</b> {{$order['email']}}</p>
    <table>
        <thead>
        <tr style="background-color: #f8f8f8;">
            <th style='padding: 10px; border: #e9e9e9 1px solid;'>№</th>
            <th style='padding: 10px; border: #e9e9e9 1px solid;'>Имя</th>
            <th style='padding: 10px; border: #e9e9e9 1px solid;'>Цена</th>
            <th style='padding: 10px; border: #e9e9e9 1px solid;'>Количество</th>
            <th style='padding: 10px; border: #e9e9e9 1px solid;'>Общая стоимость</th>
        </tr>
        </thead>
        <tbody>
        @foreach($order->products as $key =>$product)
            <tr>
                <td style='padding: 10px; border: #e9e9e9 1px solid;'>{{$key+1}}</td>
                <td style='padding: 10px; border: #e9e9e9 1px solid;'>{{$product->name}}</td>
                <td style='padding: 10px; border: #e9e9e9 1px solid;'>{{$product->pivot->price}} {{$order->currency->symbol}}</td>
                <td style='padding: 10px; border: #e9e9e9 1px solid;'><span class="badge">{{$product->pivot->quantity}}</span><br/>
                <td style='padding: 10px; border: #e9e9e9 1px solid;'>{{$product->pivot->quantity * $product->pivot->price}}  {{$order->currency->symbol}}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
    <p>Общая сумма: <b>{{$fullSum}} {{$order->currency->symbol}}</b></p>

    <h1>Сбасибо за заказ!</h1>

</body>
</html>
