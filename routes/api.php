<?php

use App\Http\Controllers\Api\PesanController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\App\PostinganController;
use App\Http\Controllers\App\CommentController;
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
    Route::post('/{user}/tambah_teman', [UserController::class, 'addTeman']);
    Route::post('/{user}/hapus_teman', [UserController::class, 'hapusTeman']);
    Route::post('/{postingan}/like', [App\Http\Controllers\Api\PostinganController::class, 'like']);
    Route::post('/{postingan}/unlike', [App\Http\Controllers\Api\PostinganController::class, 'unlike']);
    Route::get('/{postingan}/islike', [App\Http\Controllers\Api\PostinganController::class, 'menyukai']);
    Route::post('/pesan/{user}/kirimpesan', [PesanController::class, 'insert']);
    Route::get('/pesans/{id}', [PesanController::class, 'index']);

});
