<?php

use App\Http\Controllers\Api\CurrencyController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\PairsController;
use App\Http\Controllers\AuthController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Les différentes routes pour accéder à l'API
Route::apiResource('currencies',CurrencyController::class);
Route::apiResource('pairs', PairsController::class);
// Routes pour la connexion - enregitrement et la déconnexion
Route::post('register', [AuthController::class,'register']);
Route::post('login', [AuthController::class,'login']);
Route::post('logout', [AuthController::class,'logout'])->middleware('auth:sanctum');
// Routes pour faire la conversion
Route::get('/conversion', [PairsController::class,'conversion']);
Route::get('/convert/{from_id}/{to_id}/{amount}/{invert?}', [PairsController::class,'convert']);
