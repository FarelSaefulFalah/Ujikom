<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\{
    PemasokController, KategoriController, BarangController, UserController,
    DashboardController, RolePermissionController, StockController,
    PeminjamanController as AdminPeminjamanController, PengembalianController as AdminPengembalianController
};
use App\Http\Controllers\User\{
    DashboardController as UserDashboardController,
    PeminjamanController as UserPeminjamanController, PengembalianController as UserPengembalianController
};
use App\Http\Controllers\{
    LandingController, CartController, BarangController as LandingBarangController, 
    KategoriController as LandingKategoriController
};

// Landing Page
Route::get('/', LandingController::class)->name('landing');

// Kategori Routes
Route::controller(LandingKategoriController::class)->as('kategori.')->group(function(){
    Route::get('/kategori', 'index')->name('index');
    Route::get('/kategori/{slug}', 'show')->name('show');
});

// Barang Routes
Route::controller(LandingBarangController::class)->as('barang.')->group(function(){
    Route::get('/barang', 'index')->name('index');
    Route::get('/barang/{slug}', 'show')->name('show');
});

// Admin Routes
Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => ['auth', 'role:Admin|superadmin']], function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::resource('/pemasok', PemasokController::class);
    Route::resource('/kategori', KategoriController::class);
    Route::resource('/stock', StockController::class);
    Route::resource('/barang', BarangController::class);
    Route::resource('/user', UserController::class);
    Route::resource('/roles', RolePermissionController::class);

    // Permissions Role
    Route::post('/roles/permissions', [RolePermissionController::class, 'storePermission'])
        ->name('permissions.store');

    // Peminjaman Barang (Admin)
    Route::controller(AdminPeminjamanController::class)->group(function () {
        Route::get('/peminjaman', 'index')->name('peminjaman.index');
        Route::post('/peminjaman/{id}/approve', 'approve')->name('peminjaman.approve');
        Route::post('/peminjaman/{id}/reject', 'reject')->name('peminjaman.reject');
    });

    // Pengembalian Barang (Admin)
    Route::controller(AdminPengembalianController::class)->group(function () {
        Route::get('/pengembalian', 'index')->name('pengembalian.index');
        Route::get('/pengembalian/{id}', 'show')->name('pengembalian.show');
    });
});

// User Routes
Route::group(['prefix' => 'user', 'as' => 'user.', 'middleware' => ['auth', 'role:Murid']], function () {
    Route::get('/dashboard', [UserDashboardController::class, 'index'])->name('dashboard');

    // Peminjaman Barang (User)
    Route::controller(UserPeminjamanController::class)->group(function () {
        Route::get('/peminjaman', 'index')->name('peminjaman.index');
        Route::post('/peminjaman/{barang}', 'store')->name('peminjaman.store');
        Route::get('/peminjaman/saya', 'myPeminjaman')->name('peminjaman.my');
    });

    // Pengembalian Barang & Denda (User)
    Route::controller(UserPengembalianController::class)->group(function () {
        Route::get('/pengembalian', 'index')->name('pengembalian.index');
        Route::get('/pengembalian/{id}/bayar', 'showBayar')->name('pengembalian.bayar');
        Route::post('/pengembalian/{id}/bayar', 'prosesBayar')->name('pengembalian.prosesBayar');
    });
});

// Auth Routes
Auth::routes();
