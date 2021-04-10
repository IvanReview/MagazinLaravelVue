<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Currency;
use App\Models\Product;
use App\Models\User;
use App\Repositories\CurrencyConversion;
use App\Repositories\CurrencyRates;
use App\Repositories\FilterRepository;
use Illuminate\Http\Request;

class MainController extends Controller
{
    /**
     * Отображение продуктов
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function products(Request $request)
    {
        //число элементов на странице
        $itemsOnPage = $request->items_on_page ?? 6;

        $productsQuery = Product::query();
        $products = (new FilterRepository($productsQuery, $request))->apply()->paginate($itemsOnPage);

        return response()->json($products,  200);
    }

    /**
     * Отображение категорий
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function categories()
    {
        $categories = Category::with('children_cat')
            ->parentCat()
            ->OrderBy('created_at', 'DESC')
            ->get();

        return response()->json($categories, 200);
    }


    /**
     *
     * Отображение 1 продукта вместе с комментариями
     *
     * @param Product $product
     * @return \Illuminate\Http\JsonResponse
     */
    public function oneProduct(Product $product)
    {
        //берем только родительские комментарии внутри них вложенные(replies)
        // parent и status скоупы
        $comments = $product->comments()->parent()->status()->with('replies', 'replies.replies')->get();
        $users = User::get();
        $product = $product::with('galleryImages')->find($product->id);


        return response()->json(['product'=>$product, 'comments'=>$comments, 'users'=>$users],200);
    }


    /**
     * Изменение валюты
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function changeCurrency(Request $request)
    {
        CurrencyRates::getRates();
        $currencyCode = $request->currency_code;
        $currency = Currency::byCode($currencyCode)->first();

        $kef = CurrencyConversion::convert($currency->code);
        $code = $currency->code;


        return response()->json(['id'=>$currency->id,'currency_coefficient' => $kef, 'currency_code' => $code],200);

    }



}
