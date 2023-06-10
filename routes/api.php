<?php

use App\Http\Resources\PostResource;
use App\Models\Post;
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

Route::post('/register', 'App\Http\Controllers\AuthController@register');
Route::post('/login', 'App\Http\Controllers\AuthController@login');

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', 'App\Http\Controllers\AuthController@logout');
    Route::get('/user', 'App\Http\Controllers\AuthController@user');

    Route::get('/posts', 'App\Http\Controllers\AuthController@user');

});


Route::get('posts',  function() {
    return PostResource::collection(Post::Paginate(2));
});

Route::get('post/{id}',  function($id) {
    return new PostResource(Post::findOrFail($id));
});