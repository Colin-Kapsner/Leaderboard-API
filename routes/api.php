<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\User;
use App\Http\Controllers\API\UserController;

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



Route::middleware('auth:sanctum')->group(function () {

    Route::prefix('v1')->group(function () {
        Route::apiResource('users', UserController::class);

        //Route::get('/user', function (Request $request){
        //    return $request->user();
        //});
    });

    Route::prefix('v2')->group(function () {
        //
    });
});