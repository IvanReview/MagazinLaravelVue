<?php

namespace App\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class AuthController extends Controller
{

    /**
     *
     * Регистрация пользователя
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(Request $request)
    {
        $request->validate([
            'name'      => 'required|string|max:255',
            'email'     => 'required|string|email|unique:users',
            'password'  => 'min:6|string|confirmed'
        ]);

        $user = new User();

        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);

        if ($user->save()){
            return response()->json(['message'=>'Пользователь создан успешно!'],201);
        } else{
            return response()->json(['message'=>'Ошибка при создании пользователя'],500);
        }
    }

    /**
     *
     * Авторизация
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
            'remember_me' => 'boolean'

        ]);

        //attempt сразу находит пользов в БД по эмаил и сравнив пароль
        if (! Auth::attempt(['email'=>$request->email, 'password'=>$request->password])){
            return response()->json([
                'message' => 'Пользователь не найден, неверный логин или пароль',
                'status_code' => 401
            ], 401);
        }

        $user = Auth::user();


        if ($user->role === 'admin') {
            $tokenData = $user->createToken('Personal Access Token', ['admin']);
        } else {
            $tokenData = $user->createToken('Personal Access Token', ['user']);
        }


        $token = $tokenData->token;

        if($request->remember_me){
            $token->expires_at  =  Carbon::now()->addWeeks(2);
        }

        if ($token->save()){
            return response()->json([
                'user'          =>  $user,
                'access_token'  =>  $tokenData->accessToken,
                'token_type'    =>  'Bearer',
                'token_scope'   =>  $tokenData->token->scopes[0],
                'expires_at '   =>  Carbon::parse($tokenData->token->expires_at)->toDateTimeString(),
                'status_code'   =>  200
            ],200);
        }
        else{
            return response()->json([
                'message'     =>    'Ошибка при создании авторизации',
                'status_code' =>    500
            ],500);
        }
    }

    /**
     *
     * Выход из профиля
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout(Request $request)
    {
        Auth::user()->token()->revoke();

        return response()->json([
            "message"     =>    "Вы вышли из системы",
            'status_code' =>    200
        ],200);
    }


    /**
     * Запрос кода подтверждения для смены пароля
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function resetPasswordRequest(Request $request)
    {
        $request->validate([
            'email' => 'required|email'
        ]);

        $user = User::where('email', $request->email)->first();
        if (!$user){
            return response()->json([
                'message' => 'Данный email не найден!',
                'status_code' => 500

            ], 500);
        } else{

            $random = rand(11111, 99999);
            $user->verification_code = $random;
            if ($user->save()){
                $userData = [
                    'email' => $user->email,
                    'full_name' => $user->name,
                    'random' => $random,
                ];

                Mail::send('mail.reset_password', ['user'=>$userData], function ($message) use ($userData){
                    $message->from('andreyvictorov98@gmail.com', 'Password request');
                    $message->to($userData['email'], $userData['full_name']);
                    $message->subject('Код подтверждения для сброса пароля');
                });

                if (Mail::failures()){
                    return response()->json([
                        'message' => 'Some error, Try again',
                        'status_code' => 500
                    ], 500);
                } else {
                    return response()->json([
                        'message' => 'Мы отправили код подтверждения на ваш email адрес',
                        'status_code' => 200
                    ], 200);
                }
            } else {
                return response()->json([
                    'message' => 'Some error, Try again',
                    'status_code' => 500
                ], 500);
            }
        }

    }


    /**
     * Смена пароля
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function resetPassword(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'verification_code' => 'required|integer',
            'password' => 'required|confirmed|min:6'
        ]);

        $user = User::where('email', $request->email)->where('verification_code', $request->verification_code)->first();

        if (!$user){
            return response()->json([
                'message' => 'User not found',
                'status_code' => 401
            ], 401);
        } else{
            $user->password = bcrypt(trim($request->password));
            $user->verification_code = null;

            if ($user->save()){
                return response()->json([
                    'message' => 'Пароль успешно изменен!',
                    'status_code' => 200
                ], 200);
            } else {
                return response()->json([
                    'message' => 'Some error, Try again',
                    'status_code' => 500
                ], 500);
            }
        }

    }

}
