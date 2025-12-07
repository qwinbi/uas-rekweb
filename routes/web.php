<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\Admin\ProductController as AdminProductController;
use App\Http\Controllers\Admin\TransactionController as AdminTransactionController;
use App\Http\Controllers\Admin\AdminSettingController;
use App\Http\Controllers\Admin\AdminAboutController;

// ---------------------------
// Public Routes
// ---------------------------
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/about', [HomeController::class, 'about'])->name('about');
Route::get('/shop', [HomeController::class, 'shop'])->name('shop');
Route::get('/product/{slug}', [HomeController::class, 'productDetail'])->name('product.detail');
Route::get('/contact', [HomeController::class, 'contact'])->name('contact');
Route::get('/faq', [HomeController::class, 'faq'])->name('faq');
Route::get('/privacy', [HomeController::class, 'privacy'])->name('privacy');
Route::get('/terms', [HomeController::class, 'terms'])->name('terms');

// ---------------------------
// Guest Authentication
// ---------------------------
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// ---------------------------
// Authenticated User Routes
// ---------------------------
Route::middleware('auth')->group(function () {

    // -------- Cart Routes --------
    Route::prefix('cart')->group(function () {
        Route::get('/', [CartController::class, 'index'])->name('cart');   // ← CART PAGE
        Route::post('/add', [CartController::class, 'add'])->name('cart.add');
        Route::post('/update/{id}', [CartController::class, 'update'])->name('cart.update');
        Route::delete('/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');
        Route::post('/clear', [CartController::class, 'clear'])->name('cart.clear');
    });

    // -------- Checkout Routes --------
    Route::prefix('checkout')->group(function () {
        Route::get('/', [CheckoutController::class, 'index'])->name('checkout');
        Route::post('/process', [CheckoutController::class, 'process'])->name('checkout.process');
        Route::get('/success/{transaction}', [CheckoutController::class, 'success'])->name('checkout.success');
        Route::get('/cancel', [CheckoutController::class, 'cancel'])->name('checkout.cancel');
    });

    // -------- Transactions Routes --------
    Route::prefix('transactions')->group(function () {
        Route::get('/', [TransactionController::class, 'index'])->name('transactions');
        Route::get('/{transaction}', [TransactionController::class, 'show'])->name('transactions.show');
        Route::post('/{transaction}/cancel', [TransactionController::class, 'cancel'])->name('transactions.cancel');
        Route::post('/{transaction}/confirm', [TransactionController::class, 'confirm'])->name('transactions.confirm');
    });
});

// ---------------------------
// ADMIN ROUTES
// ---------------------------
Route::prefix('admin')->middleware(['auth', 'admin'])->group(function () {

    // Dashboard
    Route::get('/dashboard', [AdminProductController::class, 'index'])->name('admin.dashboard');

    // Products
    Route::resource('products', AdminProductController::class);

    // Transactions
    Route::resource('transactions', AdminTransactionController::class);
    Route::post('transactions/{transaction}/update-status', [AdminTransactionController::class, 'updateStatus'])
        ->name('admin.transactions.update-status');

    // Settings
    Route::prefix('settings')->group(function () {
        Route::get('/logo', [AdminSettingController::class, 'logo'])->name('admin.settings.logo');
        Route::post('/logo', [AdminSettingController::class, 'updateLogo']);

        Route::get('/footer', [AdminSettingController::class, 'footer'])->name('admin.settings.footer');
        Route::post('/footer', [AdminSettingController::class, 'updateFooter']);

        Route::get('/about', [AdminAboutController::class, 'index'])->name('admin.settings.about');
        Route::post('/about', [AdminAboutController::class, 'update']);

        Route::get('/qris', [AdminSettingController::class, 'qris'])->name('admin.settings.qris');
        Route::post('/qris', [AdminSettingController::class, 'updateQris']);
    });
});