<?php

use App\Http\Controllers\Atu\ApiAuthController;
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
Route::get('/api/user', function (){});

Route::prefix('/')->group(function () {
    Route::post('/login', [ApiAuthController::class, 'login'])->name('login.api');
    Route::post('/register', [ApiAuthController::class, 'register'])->name('register.api');
})->middleware(['cors', 'json.response']);

Route::middleware('auth:api')->group(function () {
    Route::post('/logout', [ApiAuthController::class, 'logout'])->name('logout.api');
});
