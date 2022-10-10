<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TestController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProductCategoryController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

// Route::middleware(['auth:sanctum',config('jetstream.auth_session'),'verified','isAdmin'])->group(function () {
//     Route::get('/dashboard', function () {
//         return view('dashboard');
//     })->name('dashboard');
// });

Route::group(['middleware' => ['auth:sanctum', 'verified']], function() {
    Route::name('dashboard.')->prefix('dashboard')->group(function() {
        Route::get('/', [DashboardController::class, 'index'])->name('index');
        Route::middleware('isAdmin')->group(function() {
            Route::resource('productCategory', ProductCategoryController::class);


            Route::get('test', [TestController::class, 'index']);
            Route::get('test/ganjilGenap', [TestController::class, 'ganjilGenap']);
            Route::get('test/perulanganDuaKali', [TestController::class, 'perulanganDuaKali']);
        });
    });
});