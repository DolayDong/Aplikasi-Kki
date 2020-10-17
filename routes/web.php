<?php

use App\Http\Controllers\App\AuthController;
use App\Http\Controllers\App\PostinganController;
use App\Http\Controllers\App\HomeController;
use Illuminate\Support\Facades\Auth;
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

Route::get('/', function () {
    if (!Auth::check()) {
        return view('auth.login_');
    } else {
        return redirect()->route('/home');
    }
})->name('/');

Route::get('/verifikasi', [AuthController::class, 'verifikasi']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth')->group(function () {
    Route::get('/cariteman', [App\Http\Controllers\App\UserController::class, 'index']);
    Route::get('/home', [HomeController::class, 'index'])->name('/home');
    Route::get('/logout', [AuthController::class, 'logout']);
    Route::post('/posting', [PostinganController::class, 'store']);
    Route::get('/user/{name}', [App\Http\Controllers\App\UserController::class, 'showprofile']);
    Route::get('/postingan/{postingan}', [PostinganController::class, 'show']);
});
