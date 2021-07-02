<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateProductRequest;
use App\Http\Requests\UpdateProductRequest;
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
        $products = Product::with('galleryImages')->orderBy('created_at', 'DESC')->paginate(6);
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
     * @param UpdateProductRequest $request
     * @param Product $product
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(UpdateProductRequest $request, Product $product): \Illuminate\Http\JsonResponse
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


        //потом крепить галлерею
        if ($data['gallery_img']) {
            //Разделяем старые и новые изображения(старые -строка, новые - файл)
            $old_img = collect($data['gallery_img'])->filter(function ($value, $key) {
                if (is_string($value)) return $value;
                    else return [];
            });

            $new_img = collect($data['gallery_img'])->filter(function ($value) {
                if (is_file($value)) return $value;
                    else return [];
            });

            //старые изображения котор хотим удалить
            $old_gallery_images = $product->galleryImages()->whereNotIn('id', $old_img)->get();
            //удаляем изобр из бд
            foreach ($old_gallery_images as $model_img ){
                $model_img->delete();
                Storage::delete($model_img->name);
            }

            foreach ($new_img as $key => $fileItem) {
                //если файл значит изобр вновь загруженно

                $path = $fileItem->store('products');

                $gall_data['name'] = $path;

                $product->galleryImages()->create($gall_data);
            }

        } else {
            //если массив пуст удаляем все изобр галлереи для товара
            $old_gallery_images = $product->galleryImages()->get();
            foreach ($old_gallery_images as $model_img ){
                $model_img->delete();
                Storage::delete($model_img->name);
            }
        }

        $success = $product->update($data);

        $productEnd = $product::with('galleryImages')->find($product->id);

        if ($success){

            return response()->json($productEnd, 200);
        } else{
            return response()->json($product, 500);
        }
    }


    /**
     * Удалить продукт
     *
     * @param Product $product
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function destroy(Product $product): \Illuminate\Http\JsonResponse
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
