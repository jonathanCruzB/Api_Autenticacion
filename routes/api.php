<?php

use App\Http\Controllers\AutenticacionController;
use App\Http\Controllers\ProductoController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('productos', [ProductoController::class, 'index']);
Route::post('registrate', [AutenticacionController::class, 'registro']);

Route::post('iniciar_sesion', [AutenticacionController::class, 'ingreso']);
Route::middleware('auth:sanctum')->post('cerrar_sesion', [AutenticacionController::class, 'salir']);