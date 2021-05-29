<?php

use App\Http\Controllers\API\ProductosController;
use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Symfony\Component\VarDumper\Caster\AmqpCaster;

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

/*Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});*/

//rutas publicas
Route::get('productos/{producto}', [ProductosController::class,'show']);
Route::get('productos', [ProductosController::class,'index']);
Route::post('/register', [AuthController::class,'register']);
Route::post('/login', [AuthController::class,'login']);



//rutas protegidas
Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::post('logout',[AuthController::class,'logout']);
    Route::post('productos', [ProductosController::class,'store']);
    Route::put('productos/{producto}', [ProductosController::class,'update']);
    Route::delete('productos/{producto}', [ProductosController::class,'destroy']);
});
