<?php

use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\ComentarioController;
use App\Http\Controllers\ContratoServicioController;
use App\Http\Controllers\DireccionController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PasswordResetRequestController;
use App\Http\Controllers\ServicioController;
use App\Http\Controllers\SubCategoriaController;
use App\Http\Controllers\TipoController;
use App\Http\Controllers\UserController;

use App\Http\Controllers\VerificationController;
use App\Http\Middleware\AsegurarIdNumerico;
use App\Http\Middleware\IsLoggedMiddleware;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
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

/*
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
*/

Route::get('/error', function (Request $request) {
    return response()->json(['message' => 'Error'], 404);
})->name('error');

Route::group(['prefix' => 'auth'], function () {
    Route::post('login', [AuthController::class, 'login']);
    // Route::post('login', [ 'as' => 'login', 'uses' => [AuthController::class, 'login']]);
    Route::post('register', [AuthController::class, 'registerUser']);
    Route::post('reset-password-request', [PasswordResetRequestController::class, 'sendPasswordResetEmail']);
    Route::post('change-password', [\App\Http\Controllers\ChangePasswordController::class, 'passwordResetProcess']);

});


Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();

    return Redirect::to('http://localhost:4200/auth/login');
})->middleware(['auth', 'signed'])->name('verification.verify');

Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();
    return back()->with('message', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');


//Route::get('register/verify', 'VerificationController@show')->name('verification.notice');
//Route::get('register/verify/{code}', 'VerificationController@verify')->name('verification.verify');
//Route::get('register/resend', 'VerificationController@resend')->name('verification.resend');

/*
Route::group(['middleware' => ['auth']], function () {

    Route::get('/email/verify', 'VerificationController@show')->name('verification.notice');
    Route::get('/email/verify/{id}/{hash}', [VerificationController::class, 'verify'])->name('verification.verify')->middleware(['signed']);
    Route::post('/email/resend', 'VerificationController@resend')->name('verification.resend');

});*/

//Route::group(['middleware' => ['verified']], function () {

Route::group(['middleware' => 'auth:sanctum', 'cors'], function () {
    //@todo añadir middleware para limitar a lo usuarios con roles.
    Route::get('logout', [AuthController::class, 'logout']);

    Route::prefix('/user')->name('user.')->group(function () {
        Route::get('/search/{terms}', [UserController::class, 'getAll']);
        //Route::get('/search/{nombre}', [UserController::class, 'getSearch']);
        Route::middleware(AsegurarIdNumerico::class)->group(function () {
            Route::get('/{id}', [UserController::class, 'getId']);
            Route::delete('/{id}', [UserController::class, 'deleteUser']);
            Route::put('/{id}', [UserController::class, 'modifyUser']);
        });
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
        // Route::get('/', [CategoriaController::class, 'getAll']);
        Route::get('/search/{terms}', [CategoriaController::class, 'getAll']);
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
        Route::get('/search/{terms}', [ServicioController::class, 'getAll']);
        //Route::get('/', [ServicioController::class, 'getAll']);
        Route::middleware(AsegurarIdNumerico::class)->group(function () {
            Route::get('/{id}', [ServicioController::class, 'getId']);
            Route::delete('/{id}', [ServicioController::class, 'deleteServicio']);
            Route::put('/{id}', [ServicioController::class, 'modifyServicio']);
        });
        Route::post('', [ServicioController::class, 'insertServicio']);
    });

    Route::prefix('/contrato-servicio')->name('contrato-servicio.')->group(function () {
        Route::middleware(AsegurarIdNumerico::class)->group(function () {
            Route::get('/{id}', [ContratoServicioController::class, 'getIdUser']);
        });
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
});

//});


