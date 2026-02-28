<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BatteryController;
use App\Http\Controllers\CarVariantController;
use App\Http\Controllers\FinderController;
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

Route::get('/', [FinderController::class, 'index'])->name('finder.index');
// Route::get('/models/{brand}', [FinderController::class, 'models']);
// Route::get('/variants/{model}', [FinderController::class, 'variants']);
// Route::get('/model/{model}', [FinderController::class, 'modelResult']);
Route::get('/vehicle/{variant}', [FinderController::class, 'vehicleResult']);
Route::get('/battery/{battery}', [FinderController::class, 'batteryResult']);

Route::controller(AuthController::class)->group(function () {
    Route::get('/cms/login', 'index')->name('login')->middleware('guest');
    Route::post('/cms/login', 'authenticate')->name('authenticate');
    Route::get('/cms/logout', 'logout')->name('logout');
});

Route::prefix('/cms')
    ->middleware('admin')
    ->group(function () {
		Route::get('/', function () {
			return redirect()->route('dashboard');
		});

        Route::controller(AdminController::class)->group(function () {
			Route::get('/dashboard', 'index')->name('dashboard');
			Route::get('/profile', 'adminProfile')->name('profile');
			Route::put('/profile', 'adminUpdate')->name('profile.update');
        });

        Route::resource('/batteries', BatteryController::class);
        Route::resource('/vehicles', CarVariantController::class);
});