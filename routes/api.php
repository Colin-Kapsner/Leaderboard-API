<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\User;
use App\Http\Controllers\API\TimeController;
use App\Http\Controllers\API\UserController;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

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
        Route::apiResource('times', TimeController::class)->except(['update']);

        Route::get('/toptimes', [TimeController::class, 'topTimes']);



        //Route::get('/user', function (Request $request){
        //    return $request->user();
        //});
    });
});

Route::post('/signup', [UserController::class, 'store']);

Route::get('/alltoptimes', [TimeController::class, 'allTopTimes']);

Route::post('v1/login/token', function (Request $request) {
    $request->validate([
        'username' => 'required',
        'password' => 'required',
        'device_name' => 'required',
    ]);

    $user = User::where('username', $request->username)->first();


    if (! $user || ! Hash::check($request->password, $user->password)) {
        throw ValidationException::withMessages([
            'error' => ['The provided credentials are incorrect.'],
        ]);
    }

    $tokenText = $user->createToken($request->device_name)->plainTextToken;
    return ['token' => $tokenText];
});