<?php

use App\Http\Controllers\AlertController;
    use App\Http\Controllers\DeviceController;
    use App\Http\Controllers\UsersController;
use App\Services\Teryt;
use App\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    if (Auth::user()) {
        return to_route('dashboard');
    } else {
        return redirect('login');
    }
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return to_route('alerts.index');
    })->name('dashboard');

    Route::resource('users', UsersController::class);
    Route::resource('categories', CategoryController::class);
    Route::resource('devices', DeviceController::class);
    Route::resource('alerts', AlertController::class);

    Route::get('settings', function () {
        return view('settings');
    })->name('settings');

    Route::get('statistics', function () {
        return view('statistics');
    })->name('statistics');

    Route::get('report', function () {
        return view('report');
    })->name('report');
});

Route::prefix('/teryt')->group(function () {
    Route::get('provinces', function () {
        return response()->json(['options' => Teryt::provinces()]);
    });

    Route::get('districts/{provinceId}', function ($provinceId) {
        return response()->json(['options' => Teryt::districts($provinceId)]);
    });

    Route::get('communes/{districtId}', function ($districtId) {
        return response()->json(['options' => Teryt::communes($districtId)]);
    });

    Route::get('cities/{communeId}', function ($communeId) {
        return response()->json(['options' => Teryt::cities($communeId)]);
    });

    Route::get('streets/{cityId}', function ($cityId) {
        return response()->json(['options' => Teryt::streets($cityId)]);
    });
});
