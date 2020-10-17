<?php

use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\App\PostinganController;
use App\Http\Controllers\App\CommentController;
use App\Models\Postingan;
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

Route::post('/registrasi', [UserController::class, 'registrasi']);
Route::get('/{user}/listteman', [UserController::class, 'listteman']);
Route::get('/postingans', [PostinganController::class, 'index']);
Route::get('/postingan/{name}', [PostinganController::class, 'show']);
Route::get('/postingan/{postingan}/comments', [CommentController::class, 'index']);

Route::middleware('auth:api')->group(function () {
    Route::post('/postingans/{postingan}/comment', [CommentController::class, 'store']);
});
