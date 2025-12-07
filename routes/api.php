<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\CartController;
use App\Http\Controllers\Api\CheckoutController;
use App\Http\Controllers\Api\TransactionController;

Route::prefix('v1')->group(function () {
    // Public routes
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/products', [ProductController::class, 'index']);
    Route::get('/products/{id}', [ProductController::class, 'show']);
    Route::get('/payment-info', [CheckoutController::class, 'getPaymentInfo']);
    
    // Protected routes
    Route::middleware(['api.auth'])->group(function () {
        Route::post('/logout', [AuthController::class, 'logout']);
        Route::get('/profile', [AuthController::class, 'profile']);
        
        // Guest routes
        Route::middleware(['guest.api'])->group(function () {
            Route::get('/cart', [CartController::class, 'index']);
            Route::post('/cart/add', [CartController::class, 'add']);
            Route::put('/cart/{id}', [CartController::class, 'update']);
            Route::delete('/cart/{id}', [CartController::class, 'remove']);
            Route::delete('/cart', [CartController::class, 'clear']);
            Route::post('/checkout', [CheckoutController::class, 'checkout']);
            Route::get('/transactions', [TransactionController::class, 'index']);
            Route::get('/transactions/{id}', [TransactionController::class, 'show']);
            Route::post('/transactions/{id}/upload-proof', [TransactionController::class, 'uploadPaymentProof']);
        });
        
        // Admin routes
        Route::middleware(['admin.api'])->group(function () {
            Route::post('/products', [ProductController::class, 'store']);
            Route::put('/products/{id}', [ProductController::class, 'update']);
            Route::delete('/products/{id}', [ProductController::class, 'destroy']);
        });
    });
});