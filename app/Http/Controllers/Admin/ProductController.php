<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateProductRequest;
use App\Http\Requests\updateProductRequest;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Отображение продуктов в админке
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $products = Product::with('galleryImages')->OrderBy('created_at', 'DESC')->paginate(6);
        $categories = Category::all();
        $categories_tree = Category::with('children_cat')->parentCat()->get();

        return response()->json(['products'=>$products, 'categories'=>$categories, 'categories_tree'=>$categories_tree], 200);
    }


    /**
     * Сохранение созданного продукта в админке
     *
     * @param \Illuminate\Http\Request $request
     * @param Product $product
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(CreateProductRequest $request, Product $product)
    {
        $data = $request->all();

        //картинка
        $path = $request->file('image')->store('products');
        $data['image'] = $path;

        //создать продукт
        $productModel = $product->create($data);

        //потом крепить галлерею
        if (count($data['gallery_img'])) {

            foreach ($data['gallery_img'] as $key => $fileItem) {

                $path = $fileItem->store('products');

                $gall_data['name'] = $path;

                 $productModel->galleryImages()->create($gall_data);
            }
            $productEnd = Product::with('galleryImages')->find($productModel['id']);
        }

        $res =  $productEnd ? $productEnd : $productModel;

        if ($res){
            return response()->json($res, 200);
        } else{
            return response()->json($productModel, 500);
        }
    }

    /**
     * Обновление отредактированного продукта
     *
     * @param \Illuminate\Http\Request $request
     * @param Product $product
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(UpdateProductRequest $request, Product $product)
    {

        $data = $request->all();

        if ($request->hasFile('image')) {
            $request->validate([
                'image'  => 'required|image|mimes:jpeg,png,jpg',
            ]);

            Storage::delete($product->image);
            $path = $request->file('image')->store('products');
            $data['image'] = $path;
        }


        if ($product->update($data)){

            return response()->json($product, 200);
        } else{
            return response()->json($product, 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Product $product
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function destroy(Product $product)
    {
        if($product->delete()){
            Storage::delete($product->image);
            $success = "Удаление успешно";
        }else{
            $success = 'Ошибка удаления';
        };

        return response()->json(['data'=>$success, "product" => $product]);
    }
}
