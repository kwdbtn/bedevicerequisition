<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DeviceRequestController;
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

Route::controller(AuthController::class)->group(function () {
    Route::post('register', 'register');
    Route::post('login', 'login');
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Route::resource('device-requests', DeviceRequestController::class);
Route::get('device-requests', [DeviceRequestController::class, 'index']);
Route::post('device-requests', [DeviceRequestController::class, 'store']);
Route::get('device-requests/expired', [DeviceRequestController::class, 'expired']);
Route::get('device-requests/{user}', [DeviceRequestController::class, 'user']);
Route::get('device-requests/mine/{user}', [DeviceRequestController::class, 'mine']);
Route::get('device-requests/onbehalf/{user}', [DeviceRequestController::class, 'onbehalf']);
Route::get('users', [DeviceRequestController::class, 'users']);
