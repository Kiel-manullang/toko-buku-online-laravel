<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\BukuController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\KeranjangController;
use App\Http\Controllers\PesananController;
use App\Http\Controllers\AdminPesananController;
use App\Http\Controllers\AdminUserController; // <-- BARIS INI DITAMBAHKAN
use App\Http\Middleware\AdminMiddleware;

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

// Public routes
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/bukus/{buku}', [HomeController::class, 'show'])->name('bukus.show');

// Auth routes
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout')->middleware('auth');

// Authenticated user dashboard, Shopping Cart, and Order routes
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Shopping Cart Routes
    Route::get('/keranjang', [KeranjangController::class, 'index'])->name('keranjang.index');
    Route::post('/keranjang/tambah/{buku}', [KeranjangController::class, 'tambah'])->name('keranjang.tambah');
    Route::put('/keranjang/update/{item}', [KeranjangController::class, 'update'])->name('keranjang.update');
    Route::delete('/keranjang/hapus/{item}', [KeranjangController::class, 'hapus'])->name('keranjang.hapus');

    // Order/Checkout Routes
    Route::post('/checkout', [PesananController::class, 'checkout'])->name('checkout');
    Route::get('/pesanans', [PesananController::class, 'index'])->name('pesanan.index');
    Route::get('/pesanans/{pesanan}', [PesananController::class, 'show'])->name('pesanan.show');
});

// Admin panel routes (requires 'auth' and 'admin' middleware)
Route::middleware(['auth', AdminMiddleware::class])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');

    // Rute CRUD untuk Buku
    Route::resource('admin/bukus', BukuController::class)->names([
        'index' => 'admin.bukus.index',
        'create' => 'admin.bukus.create',
        'store' => 'admin.bukus.store',
        'show' => 'admin.bukus.show',
        'edit' => 'admin.bukus.edit',
        'update' => 'admin.bukus.update',
        'destroy' => 'admin.bukus.destroy',
    ]);

    // Rute CRUD untuk Kategori
    Route::resource('admin/kategoris', KategoriController::class)->names([
        'index' => 'admin.kategoris.index',
        'create' => 'admin.kategoris.create',
        'store' => 'admin.kategoris.store',
        'show' => 'admin.kategoris.show',
        'edit' => 'admin.kategoris.edit',
        'update' => 'admin.kategoris.update',
        'destroy' => 'admin.kategoris.destroy',
    ]);

    // Rute untuk Manajemen Pesanan Admin
    Route::prefix('admin/pesanans')->name('admin.pesanans.')->group(function () {
        Route::get('/', [AdminPesananController::class, 'index'])->name('index');
        Route::get('/{pesanan}', [AdminPesananController::class, 'show'])->name('show');
        Route::put('/{pesanan}/status', [AdminPesananController::class, 'updateStatus'])->name('updateStatus');
        Route::delete('/{pesanan}', [AdminPesananController::class, 'destroy'])->name('destroy');
    });

    // Rute CRUD untuk Pengguna (AdminUserController)
    Route::resource('admin/users', AdminUserController::class)->names([ // <-- BLOK INI DITAMBAHKAN
        'index' => 'admin.users.index',
        'show' => 'admin.users.show',
    ])->except(['create', 'store', 'edit', 'update', 'destroy']); // Untuk saat ini, hanya izinkan INDEX & SHOW
});
