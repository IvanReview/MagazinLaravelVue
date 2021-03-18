<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class OrderController extends Controller
{
    /**
     * Отображение заказов в админке
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        $orders = Order::with('products')->orderBy('created_at', 'desc')->paginate(7);

        return response()->json($orders, 200);
    }

    /**
     * Детальный просмотр заказа
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

    public function update(Request $request, $id)
    {
        $order = Order::find($id);
        $data = $request->all();


        if ($order->update($data)){

            return response()->json($order, 200);
        } else{
            return response()->json($order, 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Order $order
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Order $order)
    {
        if($order->delete()){
            $success = "Удаление успешно";
        }else {
            $success = "Удаление провалилось";
        }

        return response()->json($success);
    }

}
