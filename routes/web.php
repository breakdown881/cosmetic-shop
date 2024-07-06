<?php

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
        Route::get('/', [DashBoardController::class, 'index'])->name('dashboard');
        // Route::get('category/create', 'CategoryController@create')->name('admin.category.create');
        // Route::get('image', 'UploadController@index')->name('admin.image');
        // Route::post('image/upload', 'UploadController@upload')->name('admin.image.upload');
    });
});
