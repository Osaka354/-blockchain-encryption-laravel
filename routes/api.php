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

Route::group(['prefix' => 'rsa'], function() {
    Route::get('/get_public_key', [RsaController::class, 'get_public_key']);
    Route::post('/encrypt', [RsaController::class, 'encrypt']);
    Route::post('/encrypt_by_private', [RsaController::class, 'encrypt_by_private']);
    Route::post('/decrypt', [RsaController::class, 'decrypt']);
});