<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\Admin\ProductController as AdminProductController;
use App\Http\Controllers\Admin\TransactionController as AdminTransactionController;
use App\Http\Controllers\Admin\AdminSettingController;
use App\Http\Controllers\Admin\AdminAboutController;

// Public routes
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/shop', [HomeController::class, 'shop'])->name('shop');
Route::get('/product/{id}', [HomeController::class, 'productDetail'])->name('product.detail');
Route::get('/about', [HomeController::class, 'about'])->name('about');

// Auth routes
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Guest routes
Route::middleware(['auth', 'isGuest'])->group(function () {
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
    Route::put('/cart/update/{id}', [CartController::class, 'update'])->name('cart.update');
    Route::delete('/cart/remove/{id}', [CartController::class, 'destroy'])->name('cart.destroy');
    Route::get('/checkout', [CheckoutController::class, 'show'])->name('checkout');
    Route::post('/checkout', [CheckoutController::class, 'process'])->name('checkout.process');
    Route::get('/transactions', [TransactionController::class, 'index'])->name('transactions.index');
    Route::get('/transactions/{id}', [TransactionController::class, 'show'])->name('transactions.show');
});

// Admin routes
Route::middleware(['auth', 'isAdmin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', function () {
        $newTransactions = \App\Models\Transaction::where('status', 'waiting_payment')->count();
        $totalProducts = \App\Models\Product::count();
        $totalTransactions = \App\Models\Transaction::count();
        $totalRevenue = \App\Models\Transaction::where('status', 'completed')->sum('total');
        
        return view('admin.dashboard', compact('newTransactions', 'totalProducts', 'totalTransactions', 'totalRevenue'));
    })->name('dashboard');
    
    Route::resource('products', AdminProductController::class);
    
    Route::get('/transactions', [AdminTransactionController::class, 'index'])->name('transactions.index');
    Route::get('/transactions/{id}', [AdminTransactionController::class, 'show'])->name('transactions.show');
    Route::put('/transactions/{id}/status', [AdminTransactionController::class, 'updateStatus'])->name('transactions.updateStatus');
    
    // Settings
    Route::prefix('settings')->group(function () {
        Route::get('/logo', [AdminSettingController::class, 'logo'])->name('settings.logo');
        Route::post('/logo', [AdminSettingController::class, 'updateLogo']);
        
        Route::get('/footer', [AdminSettingController::class, 'footer'])->name('settings.footer');
        Route::post('/footer', [AdminSettingController::class, 'updateFooter']);
        
        Route::get('/about', [AdminAboutController::class, 'index'])->name('settings.about');
        Route::post('/about', [AdminAboutController::class, 'update']);
        
        Route::get('/qris', [AdminSettingController::class, 'qris'])->name('settings.qris');
        Route::post('/qris', [AdminSettingController::class, 'updateQris']);
    });
});