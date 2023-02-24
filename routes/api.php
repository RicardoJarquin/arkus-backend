<?php

use App\Http\Controllers\API\AccountController;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\UserAccountController;
use App\Http\Controllers\API\UserController;
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

Route::group(['middleware' => ['cors']], function (){
    Route::post('/register', [AuthController::class, 'register'])->name('user.register');
    Route::post('/login', [AuthController::class, 'login'])->name('user.login');
    Route::post('/logout', [AuthController::class, 'logout'])->name('user.logout');
    Route::apiResource('/users', UserController::class);
    Route::apiResource('/accounts', AccountController::class);
    Route::get('/account/{account}/users', [UserController::class, 'usersList']);
    Route::get('/account/users/{account_user}', [UserAccountController::class, 'show']);
    Route::post('/account/users', [UserAccountController::class, 'store']);
    Route::put('/account/users', [UserAccountController::class, 'update']);
    Route::delete('/account/users/{user_id}/{account_id}', [UserAccountController::class, 'destroy']);
});