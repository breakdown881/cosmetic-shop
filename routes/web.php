<?php

use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\DashBoardController;
use App\Http\Controllers\Admin\LoginController;
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
    return view('welcome');
});

//Admin area
Route::prefix('admin')->group(function () {

    //login
    Route::get('login', [LoginController::class, 'index'])->name('admin.login.form');

    Route::post('login', [LoginController::class, 'login'])->name('admin.login');

    Route::post('logout', [LoginController::class, 'logout'])->name('admin.logout');

    Route::middleware(['admin'])->group(function () {
        Route::get('/', [DashBoardController::class, 'index'])->name('admin.dashboard');
        Route::prefix('brands')->group(function() {
            Route::get('/', [BrandController::class, 'index'])->name('admin.brand.index');
            Route::get('create', [BrandController::class, 'create'])->name('admin.brand.create');
            Route::post('store', [BrandController::class, 'store'])->name('admin.brand.store');
            Route::get('edit/{id}', [BrandController::class, 'edit'])->name('admin.brand.edit');
            Route::patch('update/{id}', [BrandController::class, 'update'])->name('admin.brand.update');
            Route::delete('delete/{id}', [BrandController::class, 'destroy'])->name('admin.brand.destroy');
        });
    });
});
