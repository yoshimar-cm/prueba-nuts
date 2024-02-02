<?php

use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Passport\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::post('auth/register', [AuthController::class, 'register']);
Route::post('auth/login', [AuthController::class, 'login']);


Route::middleware('auth:api')->group(function(){
    Route::post('auth/logout', [AuthController::class, 'logout']);

    Route::get('products', [ProductController::class, 'index'])->name('api.v1.products.index');
    Route::get('products/{product}', [ProductController::class, 'show'])->name('api.v1.products.show');
    Route::post('products', [ProductController::class, 'create'])->name('api.v1.products.create');
    Route::put('products/{product}/edit', [ProductController::class, 'update'])->name('api.v1.products.update');
    Route::delete('products/{product}', [ProductController::class, 'delete'])->name('api.v1.products.delete');

    Route::get('users/me',[UserController::class, 'show'])->name('api.v1.users.show');
    Route::put('users/update',[UserController::class, 'update'])->name('api.v1.users.update');
    Route::delete('users/delete',[UserController::class, 'delete'])->name('api.v1.users.delete');
});

