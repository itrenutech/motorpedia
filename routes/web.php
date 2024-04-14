<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ModelController;
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
Route::group([
    'prefix' => 'admin'
], function () {
    Route::get('login', [AdminController::class, 'Index'])->name('login.index');
    Route::post('login/verify', [AdminController::class, 'Verify'])->name('login.verify');
    Route::get('logout', [AdminController::class, 'Logout'])->name('login.out');
    Route::group(["middleware" => ['admin']], function () {
        Route::get('dashboard', [DashboardController::class, 'Index'])->name('admin.dashboard');
        Route::get('brand/list', [BrandController::class, 'Index'])->name('brand.index');
        Route::get('brand/create', [BrandController::class, 'Create'])->name('brand.create');
        Route::get('brand/inactive/list', [BrandController::class, 'Inactive'])->name('brand.inactive');
        Route::post('brand/create/submit', [BrandController::class, 'Submit'])->name('brand.submit');
        Route::get('brand/{id}/edit', [BrandController::class, 'Edit'])->name('brand.edit');
        Route::post('brand/update', [BrandController::class, 'Update'])->name('barnd.update');
        Route::delete('brand/{id}/destroy', [BrandController::class, 'Destroy'])->name('brand.destroy');
        Route::get('brand/{id}/active', [BrandController::class, 'Active'])->name('brand.active');

        Route::get('model/list', [ModelController::class, 'Index'])->name('model.index');
        Route::get('model/create', [ModelController::class, 'Create'])->name('model.create');
        Route::get('model/inactive/list', [ModelController::class, 'Inactive'])->name('model.inactive');
        Route::post('model/create/submit', [ModelController::class, 'Submit'])->name('model.submit');
        Route::get('model/{id}/edit', [ModelController::class, 'Edit'])->name('model.edit');
        Route::post('model/update', [ModelController::class, 'Update'])->name('model.update');
        Route::delete('model/{id}/destroy', [ModelController::class, 'Destroy'])->name('model.destroy');
        Route::get('model/{id}/active', [ModelController::class, 'Active'])->name('model.active');
    });
});
