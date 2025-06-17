<?php

use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\CategoryController;
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
            Route::patch('update/{brand}', [BrandController::class, 'update'])->name('admin.brand.update');
            Route::delete('delete/{brand}', [BrandController::class, 'destroy'])->name('admin.brand.destroy');
            Route::post('changeStatus/{brand}', [BrandController::class, 'changeStatus'])->name('admin.brand.change_status');
        });
        Route::prefix('categories')->group(function () {
            Route::get('/', [CategoryController::class, 'index'])->name('admin.category.index');
            Route::get('create', [CategoryController::class, 'create'])->name('admin.category.create');
            Route::post('store', [CategoryController::class, 'store'])->name('admin.category.store');
            Route::get('edit/{id}', [CategoryController::class, 'edit'])->name('admin.category.edit');
            Route::patch('update/{category}', [CategoryController::class, 'update'])->name('admin.category.update');
            Route::delete('delete/{category}', [CategoryController::class, 'destroy'])->name('admin.category.destroy');
            Route::post('changeStatus/{category}', [CategoryController::class, 'changeStatus'])->name('admin.category.change_status');
            Route::get('/{id}', [CategoryController::class, 'list'])->name('admin.category.list');
            Route::get('/{id}/create', [CategoryController::class, 'createChild'])->name('admin.category.create.child');
            Route::post('/{id}/store', [CategoryController::class, 'storeChild'])->name('admin.category.store.child');
            Route::get('{id}/edit/{category}', [CategoryController::class, 'editChild'])->name('admin.category.edit.child');
            Route::patch('{id}/update/{category}', [CategoryController::class, 'updateChild'])->name('admin.category.update.child');
        });
    });
});
