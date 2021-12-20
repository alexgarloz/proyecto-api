<?php

use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\ComentarioController;
use App\Http\Controllers\DireccionController;
use App\Http\Controllers\ServicioController;
use App\Http\Controllers\SubCategoriaController;
use App\Http\Controllers\TipoController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\AsegurarIdNumerico;
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

Route::get('/error', function (Request $request) {
    return response()->json(['message' => 'Error'], 404);
})->name('error');


Route::prefix('/user')->name('user.')->group(function () {
    Route::get('/', [UserController::class, 'getAll']);
    Route::middleware(AsegurarIdNumerico::class)->group(function () {
        Route::get('/{id}', [UserController::class, 'getId']);
        Route::delete('/{id}', [UserController::class, 'deleteUser']);
        Route::put('/{id}', [UserController::class, 'modifyUser']);
    });
    Route::post('', [UserController::class, 'insertUser']);
});

Route::prefix('/tipo')->name('tipo.')->group(function () {
    Route::get('/', [TipoController::class, 'getAll']);
    Route::middleware(AsegurarIdNumerico::class)->group(function () {
        Route::get('/{id}', [TipoController::class, 'getId']);
        Route::delete('/{id}', [TipoController::class, 'deleteTipo']);
        Route::put('/{id}', [TipoController::class, 'modifyTipo']);
    });
    Route::post('', [TipoController::class, 'insertTipo']);
});

Route::prefix('/direccion')->name('direccion.')->group(function () {
    Route::get('/', [DireccionController::class, 'getAll']);
    Route::middleware(AsegurarIdNumerico::class)->group(function () {
        Route::get('/{id}', [DireccionController::class, 'getId']);
        Route::delete('/{id}', [DireccionController::class, 'deleteDireccion']);
        Route::put('/{id}', [DireccionController::class, 'modifyDireccion']);
    });
    Route::post('', [DireccionController::class, 'insertDireccion']);
});

Route::prefix('/categoria')->name('categoria.')->group(function () {
    Route::get('/', [CategoriaController::class, 'getAll']);
    Route::middleware(AsegurarIdNumerico::class)->group(function () {
        Route::get('/{id}', [CategoriaController::class, 'getId']);
        Route::delete('/{id}', [CategoriaController::class, 'deleteCategoria']);
        Route::put('/{id}', [CategoriaController::class, 'modifyCategoria']);
    });
    Route::post('', [CategoriaController::class, 'insertCategoria']);
});

Route::prefix('/sub_categoria')->name('sub_categoria.')->group(function () {
    Route::get('/', [SubCategoriaController::class, 'getAll']);
    Route::middleware(AsegurarIdNumerico::class)->group(function () {
        Route::get('/{id}', [SubCategoriaController::class, 'getId']);
        Route::delete('/{id}', [SubCategoriaController::class, 'deleteSubCategoria']);
        Route::put('/{id}', [SubCategoriaController::class, 'modifySubCategoria']);
    });
    Route::post('', [SubCategoriaController::class, 'insertSubCategoria']);
});

Route::prefix('/servicio')->name('servicio.')->group(function () {
    Route::get('/', [ServicioController::class, 'getAll']);
    Route::middleware(AsegurarIdNumerico::class)->group(function () {
        Route::get('/{id}', [ServicioController::class, 'getId']);
        Route::delete('/{id}', [ServicioController::class, 'deleteServicio']);
        Route::put('/{id}', [ServicioController::class, 'modifyServicio']);
    });
    Route::post('', [ServicioController::class, 'insertServicio']);
});

Route::prefix('/comentario')->name('comentario.')->group(function () {
    Route::get('/', [ComentarioController::class, 'getAll']);
    Route::middleware(AsegurarIdNumerico::class)->group(function () {
        Route::get('/{id}', [ComentarioController::class, 'getId']);
        Route::delete('/{id}', [ComentarioController::class, 'deleteComentario']);
        Route::put('/{id}', [ComentarioController::class, 'modifyComentario']);
    });
    Route::post('', [ComentarioController::class, 'insertComentario']);
});
