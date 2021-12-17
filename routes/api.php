<?php

use App\Http\Controllers\TipoController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('/user')->name('user.')->group(function () {
    Route::get('/', [UserController::class, 'getAll']);
    //Route::middleware(ComprobarIdNumerico::class)->group(function () {
    Route::get('/{id}', [UserController::class, 'getId']);
    Route::delete('/{id}', [UserController::class, 'deleteUser']);
    Route::put('/{id}', [UserController::class, 'modifyUser']);
    //});
    Route::post('', [UserController::class, 'insertUser']);
});

Route::prefix('/tipo')->name('tipo.')->group(function () {
    Route::get('/', [TipoController::class, 'getAll']);
    //Route::middleware(ComprobarIdNumerico::class)->group(function () {
    Route::get('/{id}', [TipoController::class, 'getId']);
    Route::delete('/{id}', [TipoController::class, 'deleteTipo']);
    Route::put('/{id}', [TipoController::class, 'modifyTipo']);
    //});
    Route::post('', [TipoController::class, 'insertTipo']);
});

