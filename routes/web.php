<?php

use App\Http\Controllers\Admin\KategoriController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\PemasokController;
use App\Http\Controllers\Admin\RolePermissionController;
use App\Http\Controllers\Users\DashboardController as UsersDashboardController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\LandingController;

Route::get('/', LandingController::class)->name('landing');

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => ['auth', 'role:Admin|superadmin']], function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard')
        ->middleware('permission:index-dashboard');

    Route::resource('/pemasok', PemasokController::class);
    Route::resource('/kategori', KategoriController::class);
    Route::resource('/user', UserController::class);
    Route::resource('/roles', RolePermissionController::class);
    Route::post('/roles/permissions', [RolePermissionController::class, 'storePermission'])->name('permissions.store');
});


Route::group(['prefix' => 'user', 'as' => 'Users.', 'middleware' => ['auth', 'role:Murid']], function () {
    Route::get('/dashboard', [UsersDashboardController::class, 'index'])
        ->name('dashboard')
        ->middleware('permission:index-dashboard');

});



Auth::routes();


