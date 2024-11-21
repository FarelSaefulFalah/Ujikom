<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\{
    PemasokController,KategoriController,BarangController,UserController,
    DashboardController,rolePermissionController,StockController
};
use App\Http\Controllers\Users\{
    DashboardController as UsersDashboardController,
};

use App\Http\Controllers\{
    LandingController, CartController , BarangController as LandingBarangController, KategoriController as LandingKategoriController,
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
Route::controller(CartController::class)->middleware(['permission:create-transaction','auth'])->group(function(){
    Route::get('/cart', 'index')->name('cart.index');
    Route::post('/cart/{slug}', 'store')->name('cart.store');
    Route::delete('/cart/destroy/{cart:id}', 'destroy')->name('cart.destroy');
    Route::put('/cart/update/{cart:id}', 'update')->name('cart.update');
    Route::post('/cart/order/{barang:slug}', 'order')->name('cart.order');
});

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
});


Route::group(['prefix' => 'user', 'as' => 'Users.', 'middleware' => ['auth', 'role:Murid']], function () {
    Route::get('/dashboard', [UsersDashboardController::class, 'index'])
        ->name('dashboard')
        ->middleware('permission:index-dashboard');

});



Auth::routes();


