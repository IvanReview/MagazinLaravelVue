<?php

namespace App\Http\Controllers\Person;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    /**
     * Отображение заказов пользователя
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        $orders = Auth::user()->orders()->with('products')->orderBy('created_at', 'desc')->paginate(7);

        return response()->json($orders, 200);

    }


    /**
     * Детальное отображение заказа
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(int $id)
    {
        $order = Order::with('products')->where('id', $id)->first();
        $products = $order->products;

        return  response()->json(['order'=>$order, 'products'=>$products], 200);
    }
}
