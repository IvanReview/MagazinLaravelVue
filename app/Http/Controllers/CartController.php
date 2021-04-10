<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrderRequest;
use App\Mail\OrderMail;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class CartController extends Controller
{
    //текущий заказ
    private $order;

    /**
     * Отправка формы подтерждения заказа
     *
     * @param OrderRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function orderConfirm(OrderRequest $request)
    {

        $data = $request->all();

        $this->order = Order::create($data);


        //вставка записей в промежуточную таблицу
        foreach ($request->productsInCart as $product){
            $this->order->products()->attach($product['id'],['quantity'=> $product['quantity'], 'price' => $product['price']]);
        }

        //изменение количества товара в базе
        if ($this->changeCountProduct()){

            $order = $this->order::with('products')->find($this->order->id);

            //отправка уведомления администратору
            Mail::to('andreyvictorov98@gmail.com')->send(new OrderMail($order));

            return response()->json($order, 200);
        } else {
            return response()->json(["message"=>"Продукт кончился пока, вы делали заказ"], 500);
        }

    }


    /**
     * Изменение кол-ва товара на складе(вычитание кол-ва в заказе)
     *
     * @return bool
     */
    public function changeCountProduct()
    {
        foreach ($this->order->products as $productInOrder ){
            //количество в заказе(промежуточная таблица)
            $quantity = $this->order->products()->where('product_id', $productInOrder->id)->first()->pivot->quantity;
            //кол-во на складе(поле продукта)
            $productInOrder->count = $productInOrder->count - $quantity;

            if ($productInOrder->count < 0) {
                return false;
            }
            $productInOrder->save();
        }
        return true;
    }
}
