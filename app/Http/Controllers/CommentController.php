<?php

namespace App\Http\Controllers;

use App\Http\Requests\CommentRequest;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    /**
     * Добавить комментарий к продукту
     *
     * @param Request $request
     * @param $id
     */
    public function commentAdd(CommentRequest $request, $id)
    {
        $data = $request->all();
        $product = Product::where('id', $id)->first();

        $comment = $product->comments()->create($data);
        $comment['replies'] = [];

        return response()->json($comment);
    }

}
