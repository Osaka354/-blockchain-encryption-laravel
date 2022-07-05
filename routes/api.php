<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TextController;

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

Route::get('/', [TextController::class, 'index']);
Route::post('/store', [TextController::class, 'store']);
Route::post('/encrypt', [TextController::class, 'get_encrypyt']);
Route::post('/decrypt', [TextController::class, 'get_decrypyt']);
// Route::get('/get_key', [TextController::class, 'get_key']);