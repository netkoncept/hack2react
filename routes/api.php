<?php

use App\Http\Controllers\DeviceController;
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

Route::middleware('mobile.app')->group(function () {
    Route::get('/device', [DeviceController::class, 'getDevice']);
    Route::get('/notifications', [DeviceController::class, 'getNotifications']);
    Route::get('/addresses', [DeviceController::class, 'getAddreses']);
    Route::post('/addresses/add', [DeviceController::class, 'addAddres']);
    Route::post('/addresses/remove', [DeviceController::class, 'removeAddres']);

    Route::get('/alerts', [DeviceController::class, 'getAlerts']);

});
