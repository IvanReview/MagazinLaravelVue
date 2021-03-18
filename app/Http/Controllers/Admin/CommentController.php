<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateProductRequest;
use App\Http\Requests\updateProductRequest;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class CommentController extends Controller
{
    /**
     * Отображение комментов в админке
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $comments = Comment::with('product')->OrderBy('created_at', 'DESC')->paginate(10);

        return response()->json($comments, 200);
    }


    /**
     * Принять(отредактировать) комментарий
     *
     * @param \Illuminate\Http\Request $request
     * @param Comment $comment
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, Comment $comment)
    {
        $data = $request->all();

        if ($comment->update($data)){

            return response()->json($comment::with('product')->first(), 200);
        } else{
            return response()->json($comment, 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Product $product
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function destroy(Comment $comment)
    {
        if($comment->delete()){

            $success = "Удаление успешно";
        }else{
            $success = 'Ошибка удаления';
        };

        return response()->json(['data'=>$success], 200);
    }


    public function commentAll()
    {
        $comment = Comment::where('status', 0)->get();
        
        return response()->json($comment, 200);
    }
}
