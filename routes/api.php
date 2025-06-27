<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CreatureController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/users', [UserController::class, 'index']);
Route::get('/users/{user}', [UserController::class, 'show']);
Route::post('/users', [UserController::class, 'store']);
Route::put('/users/{user}', [UserController::class, 'update']);
Route::delete('/users/{user}', [UserController::class, 'destroy']);


Route::get('/creatures/typerace', [CreatureController::class, 'getTypeRace']);
Route::get('/creatures/type/{type}', [CreatureController::class, 'type']);
Route::get('/creatures', [CreatureController::class, 'index']);
Route::get('/creatures/{creature}', [CreatureController::class, 'show']);
Route::post('/creatures', [CreatureController::class, 'store']);
Route::put('/creatures/{creature}', [CreatureController::class, 'update']);
Route::delete('/creatures/{creature}', [CreatureController::class, 'destroy']);
Route::get('/creatures-by-user/{user}', [CreatureController::class, 'listByUser']);


Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login'])->name("login");
//Seulement accessible via le JWT
Route::middleware('auth:api')->group(function() {
    Route::get('/currentuser', [UserController::class, 'currentUser']);
    Route::post('/logout', [AuthController::class, 'logout']);
});

