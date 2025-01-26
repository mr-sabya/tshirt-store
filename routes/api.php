<?php

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


Route::get('/tshirts', [App\Http\Controllers\Frontend\TshirtMaker\TshirtController::class, 'index']);
Route::get('/designs', [App\Http\Controllers\Frontend\TshirtMaker\DesignController::class, 'index']);
Route::post('/upload-design', [App\Http\Controllers\Frontend\TshirtMaker\DesignController::class, 'upload']);