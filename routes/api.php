<?php

use App\Http\Controllers\Api\v1\LoginController;
use App\Http\Controllers\Api\v1\RegisterController;
use App\Http\Controllers\Auth\ApiAuthController;
use App\Http\Controllers\UserController;
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

Route::get('/test', function(Request $request) {
    \Illuminate\Support\Facades\Validator::validate($request->all(), [
        'mobile' => 'required|unique:users,mobile|size:11',
    ]);

    $mobile = $request->mobile;
    return "کد به $mobile ارسال شد";

    $user = \App\Models\User::whereFirst('username', $request->username);
    return $user();
});

Route::post('/register', [RegisterController::class, "register"]);
Route::post('verify_mobile', [RegisterController::class, "verfiy"]);
Route::post('/login', [LoginController::class, "login"]);


