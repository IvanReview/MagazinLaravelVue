<?php

namespace App\Http\Controllers\Person;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Repositories\ImageRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function update(Request $request, $id)
    {
        $request->validate([
            'email'     => 'required|email',
            'name'      => 'required|min:3',
            'surname'   => 'sometimes|nullable|min:4',
            'phone'     => 'sometimes|nullable|numeric|min:6',
            'password'  => 'sometimes|required|confirmed|min:6',
        ]);
        $user = User::find($id);

        $data = $request->all();

        //если содержит изображение
        if ($request->hasFile('image')) {
            $request->validate([
                'image'     => 'required|image|mimes:jpeg,png,jpg',
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
}
