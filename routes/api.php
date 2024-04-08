<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\LandingsController;
use App\Http\Controllers\ReservaController;
use App\Http\Controllers\VehiculoController;

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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });


Route::post('/login',[AuthController::class,'login']);
Route::post('/logout',[AuthController::class,'logout']);
Route::get('/landings' , [LandingsController::class, 'index']);
Route::delete('/landings/{id}', [LandingsController::class, 'destroy']);
Route::get('/reserva' , [ReservaController::class, 'index']);
Route::post('/create_landings' , [LandingsController::class, 'store']);
Route::post('/register' , [AuthController::class, 'register']);
Route::post('/vehiculo' , [VehiculoController::class, 'index']);
Route::post('/create_vehiculo' , [VehiculoController::class, 'store']);
Route::delete('/vehiculo/{$id}' , [VehiculoController::class, 'destroy']);