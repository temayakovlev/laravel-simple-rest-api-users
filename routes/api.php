<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserAuthController;
use App\Http\Controllers\UserManageController;

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

Route::post('login', [UserAuthController::class, 'login'])->name('login');
Route::post('register', [UserAuthController::class, 'register'])->name('register');
Route::get('users/{id}', [UserManageController::class, 'getUser'])->name('getUser');
Route::put('users/{id}', [UserManageController::class, 'updateUser'])->name('updateUser');
Route::delete('users/{id}', [UserManageController::class, 'deleteUser'])->name('deleteUser');