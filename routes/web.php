<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\{
    PemasokController,KategoriController,BarangController,UserController,
    DashboardController,rolePermissionController,StockController,TransaksiController
};
use App\Http\Controllers\Users\{
    DashboardController as UsersDashboardController, TransaksiController as TransaksiUserController,
};

use App\Http\Controllers\{
    LandingController, CartController , BarangController as LandingBarangController, KategoriController as LandingKategoriController,
    TransaksiController as LandingTransaksiController
};


Route::get('/', LandingController::class)->name('landing');

Route::controller(LandingKategoriController::class)->as('kategori.')->group(function(){
    Route::get('/kategori', 'index')->name('index');
    Route::get('/kategori/{slug}', 'show')->name('show');
});

Route::controller(LandingBarangController::class)->as('barang.')->group(function(){
    Route::get('/barang', 'index')->name('index');
    Route::get('/barang/{slug}', 'show')->name('show');
});
Route::middleware('auth')->group(function () {
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart/{barang}', [CartController::class, 'store'])->name('cart.store');
    Route::put('/cart/{cart}', [CartController::class, 'update'])->name('cart.update');
    Route::delete('/cart/{cart}', [CartController::class, 'destroy'])->name('cart.destroy');
});
Route::post('/transaksi', [LandingTransaksiController::class, 'store'])
    ->middleware(['permission:create-transaction','auth'])->name('transaksi.store');

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => ['auth', 'role:Admin|superadmin']], function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard')
        ->middleware('permission:index-dashboard');

    Route::resource('/pemasok', PemasokController::class);
    Route::resource('/kategori', KategoriController::class);
    Route::resource('/stock', StockController::class);
    Route::resource('/barang', BarangController::class);
    Route::resource('/user', UserController::class);
    Route::resource('/roles', RolePermissionController::class);
    Route::post('/roles/permissions', [RolePermissionController::class, 'storePermission'])->name('permissions.store');
    Route::controller(TransaksiController::class)->group(function () {
        Route::get('/transaksi/barang', 'barang')->name('transaksi.barang');
    });

});


Route::group(['prefix' => 'user', 'as' => 'Users.', 'middleware' => ['auth', 'role:Murid']], function () {
    Route::get('/dashboard', [UsersDashboardController::class, 'index'])
        ->name('dashboard')
        ->middleware('permission:index-dashboard');
    Route::get('/transaksi', TransaksiUserController::class)->name('transaksi');

});



Auth::routes();


