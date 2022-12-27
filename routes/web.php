<?php

use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [PostController::class, 'index']);
Route::get('/user/{user_id}', [PostController::class, 'IndexByUser']);
Route::get('/category/{category_id}', [PostController::class, 'IndexByCategory']);
Route::get('/tag/{tag_id}', [PostController::class, 'IndexByTag']);
Route::get('/user/{user_id}/category/{category_id}', [PostController::class, 'IndexByUserAndCategory']);
Route::get('/user/{user_id}/category/{category_id}/tag/{tag_id}', [PostController::class, 'IndexByUserAndCategoryAndTag']);
Route::get('{post}/show', [PostController::class, 'show']);
