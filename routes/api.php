<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AlumnoController;
use App\Http\Controllers\ProfesorController;
use App\Http\Controllers\GradoController;
use App\Http\Controllers\AlumnoGradoController;

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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });


Route::post('login', [UserController::class, 'login']);
Route::post('register', [UserController::class, 'register']);
Route::post('logout', [UserController::class, 'logout'])->middleware('auth:sanctum');

Route::group(['prefix' => 'alumno', 'middleware' => 'auth:sanctum'], function () {
    Route::get('/', [AlumnoController::class, 'index']);
    Route::post('add', [AlumnoController::class, 'add']);
    Route::post('update', [AlumnoController::class, 'update']);
    Route::delete('delete/{id}', [AlumnoController::class, 'delete']);
    Route::get('get/{id}', [AlumnoController::class, 'get']);
});

Route::group(['prefix' => 'profesor', 'middleware' => 'auth:sanctum'], function () {
    Route::get('/', [ProfesorController::class, 'index']);
    Route::post('add', [ProfesorController::class, 'add']);
    Route::post('update', [ProfesorController::class, 'update']);
    Route::delete('delete/{id}', [ProfesorController::class, 'delete']);
    Route::get('get/{id}', [ProfesorController::class, 'get']);
});

Route::group(['prefix' => 'grado', 'middleware' => 'auth:sanctum'], function () {
    Route::get('/', [GradoController::class, 'index']);
    Route::post('add', [GradoController::class, 'add']);
    Route::post('update', [GradoController::class, 'update']);
    Route::delete('delete/{id}', [GradoController::class, 'delete']);
    Route::get('get/{id}', [GradoController::class, 'get']);
});

Route::group(['prefix' => 'alumnogrado', 'middleware' => 'auth:sanctum'], function () {
    Route::get('/', [AlumnoGradoController::class, 'index']);
    Route::post('add', [AlumnoGradoController::class, 'add']);
    Route::post('update', [AlumnoGradoController::class, 'update']);
    Route::delete('delete/{id}', [AlumnoGradoController::class, 'delete']);
    Route::get('get/{id}', [AlumnoGradoController::class, 'get']);
});