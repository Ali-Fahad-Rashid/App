<?php

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


Route::get('/post',[App\Http\Controllers\TaskController::class, 'index']);
Route::post('/post',[App\Http\Controllers\TaskController::class, 'create']);
Route::delete('/post/{id}',[App\Http\Controllers\TaskController::class, 'destroy']);
Route::put('/update/{id}',[App\Http\Controllers\TaskController::class, 'store']);