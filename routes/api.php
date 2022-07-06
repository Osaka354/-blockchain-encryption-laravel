<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DesController;
use App\Http\Controllers\RsaController;

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

Route::group(['prefix' => 'des'], function() {
    Route::get('/', [DesController::class, 'index']);
    Route::post('/store', [DesController::class, 'store']);
    Route::post('/encrypt', [DesController::class, 'get_encrypyt']);
    Route::post('/decrypt', [DesController::class, 'get_decrypyt']);
});