<?php

use App\Models\ProdukJenis;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\JenisController;
use App\Http\Controllers\Admin\ProdukController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\Admin\KategoriController;
use App\Http\Controllers\Admin\SupplierController;
use App\Http\Controllers\Frontend\OrderController;
use App\Http\Controllers\Admin\ProdukJenisController;
use App\Http\Controllers\Admin\SubKategoriController;
use App\Http\Controllers\Frontend\CheckoutController;
use App\Http\Controllers\Frontend\FrontendController;
use App\Http\Controllers\Frontend\WishlistController;
use App\Http\Controllers\Frontend\KeranjangController;
use App\Http\Controllers\Admin\OrderController as AdminOrderController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\PaymentController;

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

// Route::get('/', function () {
//     return view('welcome');
// });



Auth::routes();

Route::get('/', [FrontendController::class, 'index'])->name('home.index');
Route::get('/collections', [FrontendController::class, 'kategoris'])->name('home.kategoris');
Route::get('/collections/all-products', [FrontendController::class, 'allProdukShow'])->name('home.all-products.show');
Route::get('/collections/kategori/{kategori_slug}', [FrontendController::class, 'kategori'])->name('kategori');
Route::get('/collections/kategori/{kategori_slug}/{subkategori_slug}', [FrontendController::class, 'subkategori'])->name('subkategori');
Route::get('/collections/{produk_slug}/view', [FrontendController::class, 'produkView']);

Route::middleware(['auth'])->group(function () {
    Route::get('/wishlist', [WishlistController::class, 'index'])->name('wishlist.index');
    Route::get('/keranjang', [KeranjangController::class, 'index'])->name('keranjang.index');
    Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
    Route::get('/orders', [OrderController::class, 'index'])->name('order.index');
    Route::get('/orders/{order_id}/view', [OrderController::class, 'view'])->name('order.view');
});

Route::get('thank-you', [FrontendController::class, 'thankyou'])->name('thankyou.checkout');

// Route::get('/collections/kategori/{kategori_slug}', [FrontendController::class, 'produks'])->name('selectKategori');
// Route::get('/collections/kategori/{kategori_slug}/{subKategori_slug}', [FrontendController::class, 'subKategoriProduks']);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::prefix('admin')->middleware(['auth', 'isAdmin'])->group(function () {
    Route::get('dashboard', [AdminDashboardController::class, 'index']);

    // Kategori Routes
    Route::resource('kategori', KategoriController::class);
    // Sub Kategori Routes
    Route::resource('sub-kategori', SubKategoriController::class);

    // Jenis produk Routes
    Route::resource('brand', BrandController::class);
    
    // Jenis produk Routes
    Route::resource('jenis', JenisController::class)->parameters(['jenis' => 'jenis']);

    // Supplier Routes
    Route::resource('supplier', SupplierController::class);
    
    // Produk Routes
    Route::resource('produk', ProdukController::class);
    Route::get('produk/get-subcategories/{kategori}', [ProdukController::class, 'getSubcategories']);
    Route::get('produk/{produk}/get-subcategories/{kategori}', [ProdukController::class, 'getSubcategories']);
    Route::get('gambar-produk/{id}/delete', [ProdukController::class, 'destroyGambar']);
    Route::post('admin/produkJenis/{produk_jenis_id}', [ProdukController::class, 'produkJenisUpdate']);
    
    // ProdukJenis Routes
    Route::resource('produkJenis',ProdukJenisController::class)->parameters(['produkJenis' => 'produkJenis']);
    Route::post('produkJenis/{id_produk}', [ProdukJenisController::class, 'storeProdukJenis'])->name('produkidJenis.store');
    // Slider Routes
    Route::resource('slider', SliderController::class);

    // Order routes 
    Route::resource('AdminOrder', AdminOrderController::class);
    Route::get('AdminOrder/invoice/{id_order}/download', [AdminOrderController::class, 'invoiceDownload'])->name('AdminOrder.invoice-download');
    Route::get('AdminOrder/invoice/{id_order}/generate', [AdminOrderController::class, 'invoiceGenerate'])->name('AdminOrder.invoice-view');

    // User Routes
    Route::resource('user', UserController::class);

    // Payment Routes
    Route::resource('AdminPayment', PaymentController::class);
});