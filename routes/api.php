<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryProductController;
use App\Http\Controllers\ProductController;
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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login'])->name('login');

Route::group(['middleware' => 'auth:api'], function () {
    Route::get('category-products', [CategoryProductController::class, 'getCategoryProducts']);
    Route::get('category-products/{id}', [CategoryProductController::class, 'getOneCategoryProduct']);
    Route::put('category-products/{id}', [CategoryProductController::class, 'updateCategoryProductById']);
    Route::post('category-products', [CategoryProductController::class, 'createCategoryProduct']);
    Route::delete('category-products/{id}', [CategoryProductController::class, 'deleteCategoryProduct']);

    Route::get('products', [ProductController::class, 'getProducts']);
    Route::post('products', [ProductController::class, 'createProduct']);
    Route::get('products/{id}', [ProductController::class, 'getOneProductById']);
    Route::put('products/{id}', [ProductController::class, 'updateProduct']);
    Route::delete('products/{id}', [ProductController::class, 'deleteProductById']);
    Route::post('logout', [AuthController::class, 'logout']);
});
