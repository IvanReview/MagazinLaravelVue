<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateCategoryRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use App\Repositories\FilterRepository;
use App\Repositories\ImageRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Image;

class UserController extends Controller
{

    public $my;

    /**
     * Отобразить пользоват в админке
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $user = User::paginate(10);

        return response()->json($user);

    }


    /**
     *
     *
     * @param Request $request
     * @param User $user
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request, User $user): \Illuminate\Http\JsonResponse
    {

        if ($user->save()){

            return response()->json($user, 200);
        } else{
            return response()->json($user, 500);
        }

    }

    /**
     * Обновить пользователя
     *
     * @param Request $request
     * @param User $user
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, User $user): \Illuminate\Http\JsonResponse
    {
        $request->validate([
            'email' => 'required|email',
            'name' => 'required|min:3',
            'surname'   => 'sometimes|nullable|min:4',
            'phone'     => 'sometimes|nullable|numeric|min:6',
            'password'  => 'sometimes|required|confirmed|min:6',
        ]);

        $data = $request->all();

        //если содержит изображение
        if ($request->hasFile('image')) {
            $request->validate([
                'image'  => 'required|image|mimes:jpeg,png,jpg',
            ]);

            Storage::delete($user->image);

            $file = $request->file('image');
            $data['image'] = (new ImageRepository())->modifyImageForUser($file);
        }

        //если содержит пароль
        if ($request->filled('password')){

            $data['password'] = bcrypt(trim($request->password));
        }

        if ($user->update($data)){

            return response()->json($user, 200);
        } else{
            return response()->json($user, 500);
        }
    }


    /**
     * Удалить пользователя
     *
     * @param User $user
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function destroy(User $user): \Illuminate\Http\JsonResponse
    {
        if($user->delete()){
            Storage::delete($user->image);
            $success = "Удаление успешно";
        }else{
            $success = 'Ошибка удаления';
        };

        return response()->json(['data'=>$success, "user" => $user], 200);
    }

}
