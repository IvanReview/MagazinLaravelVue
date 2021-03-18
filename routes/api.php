<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Person\OrderController as OrderPersonController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\Admin\CommentController as AdminCommentController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\Person\ProfileController;
use App\Http\Controllers\TestController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('/products', [MainController::class, 'products']);
Route::get('/product/{product}', [MainController::class, 'oneProduct']);
Route::get('/categories', [MainController::class, 'categories']);
Route::get('/currency', [MainController::class, 'changeCurrency']);
Route::post('/order', [CartController::class, 'orderConfirm']);
Route::post('/product/{id}/comment', [CommentController::class, 'commentAdd']);


//Древо
Route::get('/tree', [TestController::class, 'tree']);

//Админка
Route::group(['prefix'=>'admin', 'middleware' => 'auth:api'], function () {

    Route::group(['middleware'=> 'scope:admin'], function () {
        Route::apiResource('/categories', CategoryController::class);
        Route::apiResource('/products', ProductController::class);
        Route::apiResource('/orders', OrderController::class);
        Route::apiResource('/users', UserController::class);
        Route::apiResource('/comments', AdminCommentController::class);
        Route::get('/comments-all', [AdminCommentController::class, 'commentAll']);

    });

});

//Юзер
Route::group(['prefix'=>'person', 'middleware' => 'auth:api'], function () {
    Route::group(['middleware'=> 'scope:user'], function () {
        Route::apiResource('/orders', OrderPersonController::class);
        Route::apiResource('/profile', ProfileController::class);
    });

});

Route::group(['prefix' => 'auth'], function ($router) {
    Route::post('register', [AuthController::class, 'register']);
    Route::post('login', [AuthController::class, 'login']);
    Route::post('reset-password-request', [AuthController::class, 'resetPasswordRequest']);
    Route::post('reset-password', [AuthController::class, 'resetPassword']);

    Route::group(['middleware' => 'auth:api'], function (){
        Route::get('logout',[AuthController::class, 'logout']);
        Route::get('profile', [AuthController::class, 'profile']);
    });
});



