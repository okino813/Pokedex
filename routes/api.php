<?php

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
Route::get('/creatures', [CreatureController::class, 'index']);
Route::get('/creatures/{user}', [CreatureController::class, 'show']);
Route::post('/creatures', [CreatureController::class, 'store']);
Route::put('/creatures/{user}', [CreatureController::class, 'update']);
Route::delete('/creatures/{user}', [CreatureController::class, 'destroy']);

