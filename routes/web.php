<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\Public\HomeController;
use App\Http\Controllers\Admin\ProductCardController;
use App\Http\Controllers\Admin\CatalogController;
use App\Http\Controllers\Public\PriceListController;
use App\Http\Controllers\Admin\CatalogMappingController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\ProductPageController;
use App\Models\CatalogProductMapping;

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

Route::get('/', HomeController::class)->name('public.home');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// === HALAMAN INFORMASI ===
Route::view('/cek-pesanan', 'pages.cek-pesanan')->name('cek.pesanan');

Route::view('/daftar-harga', 'pages.daftar-harga')->name('daftar.harga');
Route::get('/daftar-harga', [PriceListController::class, 'index'])->name('daftar.harga');

Route::view('/panduan', 'pages.panduan')->name('panduan');
Route::view('/kontak', 'pages.kontak')->name('kontak');
Route::view('/faq', 'pages.faq')->name('faq');
Route::view('/snk', 'pages.snk')->name('snk');

Route::get('/produk/{section}/{slug}', [ProductPageController::class, 'show'])
    ->whereIn('section', ['games','pulsa','lainnya'])
    ->name('produk.show');



// === Panel Admin ===
Route::middleware(['auth', 'admin'])
    ->prefix('admin')->name('admin.')
    ->group(function () {
        Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
        // // Placeholder resource routes (nanti diisi CRUD)
        // Route::resource('games', \App\Http\Controllers\Admin\GameController::class)->except(['show']);
        // Route::resource('categories', \App\Http\Controllers\Admin\CategoryController::class)->except(['show']);
        // Route::resource('products', \App\Http\Controllers\Admin\ProductController::class)->except(['show']);
        // Route::resource('methods', \App\Http\Controllers\Admin\MethodController::class)->except(['show']);
        // Route::resource('banners', \App\Http\Controllers\Admin\BannerController::class)->except(['show']);
        Route::resource('banners', BannerController::class)->except(['show']);
        // Route::resource('users', \App\Http\Controllers\Admin\UserController::class)->except(['show']);
        // Route::resource('vouchers', \App\Http\Controllers\Admin\VoucherController::class)->except(['show']);
        Route::resource('catalog', ProductCardController::class)->except(['show']);
        // Route::resource('setProduk', CatalogProductMapping::class)->except(['show']);

        // Settings terpadu (Tripay, Digiflazz, Cekmutasi, Fonnte, Umum)
        Route::view('settings', 'admin.settings.index')->name('settings.index');


        Route::get('/setProduk', [CatalogMappingController::class, 'index'])->name('setProduk.index');
        Route::post('/setProduk', [CatalogMappingController::class, 'store'])->name('setProduk.store');
        Route::patch('/setProduk/{mapping}', [CatalogMappingController::class, 'update'])->name('setProduk.update');
        Route::delete('/setProduk/{mapping}', [CatalogMappingController::class, 'destroy'])->name('setProduk.destroy');
    });


require __DIR__.'/auth.php';
