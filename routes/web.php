<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\DashboardController;
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
    });
});