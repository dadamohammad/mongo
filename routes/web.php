<?php

use App\Models\Code;
use Illuminate\Support\Facades\Http;
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
    return Code::create([
        'phone' => "test",
        'rand_code' => "test"
    ]);
    return Http::post('https://rest.payamak-panel.com/api/SendSMS/SendSMS', [
        'username' => '09122710574',
        'password' => 'b4cac3e4-a242-4606-ab12-e7e9de96851a',
        'from'     => '50004001710574',
        'to'       => '09353770652',
        'text'     => 'dsdsdsd'
    ]);
});

