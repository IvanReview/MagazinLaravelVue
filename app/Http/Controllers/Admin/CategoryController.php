<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{
    /**
     * Отображение страницы категорий.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $categories = Category::OrderBy('created_at', 'DESC')->paginate(5);

        return response()->json($categories, 200);
    }

    /**
     * Сохранение новой категории.
     *
     * @param \Illuminate\Http\Request $request
     * @param Category $category
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(CreateCategoryRequest $request, Category $category)
    {
        $data = $request->all();
        //картинка
        $path = $request->file('image')->store('categories');
        $data['image'] = $path;

        $newCategory = $category->create($data);

        if ($newCategory){

            return response()->json($newCategory, 200);
        } else{
            return response()->json($newCategory, 500);
        }

    }

    /**
     * Обновление категории.
     *
     * @param \Illuminate\Http\Request $request
     * @param Category $category
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(UpdateCategoryRequest $request, Category $category)
    {

        $data = $request->all();

        if ($request->hasFile('image')){
            $request->validate(['image' => 'required|image|mimes:jpeg,png,jpg',]);

            Storage::delete($category->image);
            $path = $request->file('image')->store('categories');
            $data['image'] = $path;
        }

        if ($category->update($data)){
            return response()->json($category, 200);
        } else{
            return response()->json($category, 500);
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Category $category
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Category $category)
    {
        if($category->delete()){
            Storage::delete($category->image);
            $success = "Удаление успешно";
        }else{
            $success = 'Ошибка удаления';
        };

        return response()->json(['data'=>$success, "category" => $category]);
    }
}
