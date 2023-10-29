<?php

use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\JenisController;
use App\Http\Controllers\Admin\KategoriController;
use App\Http\Controllers\Admin\ProdukController;
use App\Http\Controllers\Admin\SubKategoriController;
use App\Http\Controllers\Admin\SupplierController;
use Illuminate\Support\Facades\Auth;
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

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::prefix('admin')->middleware(['auth', 'isAdmin'])->group(function () {
    Route::get('dashboard', [AdminDashboardController::class, 'index']);

    // Kategori Routes
    Route::resource('kategori', KategoriController::class);
    // Sub Kategori Routes
    Route::resource('sub-kategori', SubKategoriController::class);
    
    // Supplier Routes
    Route::resource('supplier', SupplierController::class);
    
    // Produk Routes
    Route::resource('produk', ProdukController::class);
    Route::get('produk/get-subcategories/{kategori}', [ProdukController::class, 'getSubcategories']);
    Route::get('produk/{produk}/get-subcategories/{kategori}', [ProdukController::class, 'getSubcategories']);
    Route::get('gambar-produk/{id}/delete', [ProdukController::class, 'destroyGambar']);

    // Jenis Routes
    Route::resource('jenis', JenisController::class);
});