@extends('layouts.app')

@section('title', 'Shopping Cart')

@section('content')
<div class="row">
    <!-- Cart Items -->
    <div class="col-lg-8">
        <div class="card border-0 shadow-sm mb-4">
            <div class="card-body p-4">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h2 class="fw-bold mb-0" style="color: var(--burgundy);">
                        <i class="fas fa-shopping-cart me-2"></i>Shopping Cart
                    </h2>
                    <span class="badge bg-primary">{{ $cartCount ?? 3 }} Items</span>
                </div>
                
                @for($i = 1; $i <= 3; $i++)
                <div class="cart-item border-bottom pb-4 mb-4">
                    <div class="row align-items-center">
                        <div class="col-md-2">
                            <img src="https://images.unsplash.com/photo-1505740420928-5e560c06d30e?ixlib=rb-4.0.3&auto=format&fit=crop&w=200&q=80" 
                                 class="img-fluid rounded" alt="Product {{ $i }}" style="border: 2px solid var(--cherry-blossom);">
                        </div>
                        <div class="col-md-5">
                            <h6 class="fw-bold mb-1" style="color: var(--lapis-lazuli);">Product Name {{ $i }}</h6>
                            <p class="text-muted small mb-2">High quality product with excellent features</p>
                            <div class="text-warning small">
                                @for($j = 1; $j <= 5; $j++)
                                <i class="fas fa-star"></i>
                                @endfor
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="input-group input-group-sm">
                                <button class="btn btn-outline-secondary" type="button">
                                    <i class="fas fa-minus"></i>
                                </button>
                                <input type="text" class="form-control text-center" value="{{ $i }}">
                                <button class="btn btn-outline-secondary" type="button">
                                    <i class="fas fa-plus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="col-md-2 text-end">
                            <h6 class="fw-bold mb-0" style="color: var(--burgundy);">Rp {{ number_format(rand(50000, 500000), 0, ',', '.') }}</h6>
                            @if($i == 1)
                            <small class="text-muted text-decoration-line-through">Rp 599,000</small>
                            @endif
                        </div>
                        <div class="col-md-1 text-end">
                            <button class="btn btn-sm" style="background: var(--cherry-blossom); color: var(--burgundy);">
                                <i class="fas fa-trash"></i>
                            </button>
                        </div>
                    </div>
                </div>
                @endfor
                
                <div class="d-flex justify-content-between align-items-center mt-4">
                    <a href="{{ route('shop') }}" class="btn btn-outline-primary">
                        <i class="fas fa-arrow-left me-2"></i>Continue Shopping
                    </a>
                    <button class="btn" style="background: var(--cherry-blossom); color: var(--burgundy); font-weight: 600;">
                        <i class="fas fa-trash me-2"></i>Clear Cart
                    </button>
                </div>
            </div>
        </div>
        
        <!-- Coupon Code -->
        <div class="card border-0 shadow-sm mb-4">
            <div class="card-body p-4">
                <h5 class="fw-bold mb-3" style="color: var(--burgundy);">
                    <i class="fas fa-tag me-2"></i>Apply Coupon
                </h5>
                <div class="row g-2">
                    <div class="col-md-8">
                        <input type="text" class="form-control" placeholder="Enter coupon code">
                    </div>
                    <div class="col-md-4">
                        <button class="btn btn-primary w-100">Apply Code</button>
                    </div>
                </div>
                <div class="mt-3">
                    <small class="text-muted">Available coupons: <strong class="text-primary">BUNNY10</strong> (10% off), <strong class="text-primary">FREESHIP</strong> (Free shipping)</small>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Order Summary -->
    <div class="col-lg-4">
        <div class="card border-0 shadow-sm sticky-top" style="top: 20px;">
            <div class="card-body p-4">
                <h5 class="fw-bold mb-4" style="color: var(--burgundy);">Order Summary</h5>
                
                <div class="d-flex justify-content-between mb-2">
                    <span style="color: var(--lapis-lazuli);">Subtotal (3 items)</span>
                    <span class="fw-semibold" style="color: var(--burgundy);">Rp 1,497,000</span>
                </div>
                <div class="d-flex justify-content-between mb-2">
                    <span style="color: var(--lapis-lazuli);">Shipping</span>
                    <span class="fw-semibold text-success">FREE</span>
                </div>
                <div class="d-flex justify-content-between mb-2">
                    <span style="color: var(--lapis-lazuli);">Tax</span>
                    <span class="fw-semibold" style="color: var(--burgundy);">Rp 74,850</span>
                </div>
                <div class="d-flex justify-content-between mb-2">
                    <span style="color: var(--lapis-lazuli);">Discount</span>
                    <span class="fw-semibold" style="color: var(--cherry-blossom);">-Rp 100,000</span>
                </div>
                
                <hr class="my-3" style="border-color: var(--cherry-blossom);">
                
                <div class="d-flex justify-content-between mb-4">
                    <span class="fw-bold" style="color: var(--lapis-lazuli);">Total</span>
                    <span class="fw-bold h4" style="color: var(--burgundy);">Rp 1,471,850</span>
                </div>
                
                <a href="{{ route('checkout') }}" class="btn btn-primary btn-lg w-100 mb-3">
                    <i class="fas fa-credit-card me-2"></i>Proceed to Checkout
                </a>
                
                <!-- Payment Methods -->
                <div class="border-top pt-4">
                    <h6 class="fw-bold mb-3" style="color: var(--burgundy);">Payment Methods</h6>
                    <div class="row g-2">
                        <div class="col-6">
                            <div class="border rounded p-3 text-center" style="border-color: var(--silver-lake);">
                                <i class="fas fa-credit-card fa-2x mb-2" style="color: var(--silver-lake);"></i>
                                <small class="d-block" style="color: var(--lapis-lazuli);">Credit Card</small>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="border rounded p-3 text-center" style="border-color: var(--silver-lake);">
                                <i class="fas fa-qrcode fa-2x mb-2" style="color: var(--silver-lake);"></i>
                                <small class="d-block" style="color: var(--lapis-lazuli);">QRIS</small>
                            </div>
                        </div>
                        <div class="col-6 mt-2">
                            <div class="border rounded p-3 text-center" style="border-color: var(--silver-lake);">
                                <i class="fas fa-university fa-2x mb-2" style="color: var(--silver-lake);"></i>
                                <small class="d-block" style="color: var(--lapis-lazuli);">Bank Transfer</small>
                            </div>
                        </div>
                        <div class="col-6 mt-2">
                            <div class="border rounded p-3 text-center" style="border-color: var(--silver-lake);">
                                <i class="fas fa-wallet fa-2x mb-2" style="color: var(--silver-lake);"></i>
                                <small class="d-block" style="color: var(--lapis-lazuli);">E-Wallet</small>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Security Info -->
                <div class="border-top pt-4">
                    <div class="d-flex align-items-center">
                        <i class="fas fa-shield-alt me-2" style="color: var(--silver-lake);"></i>
                        <div>
                            <small class="d-block fw-semibold" style="color: var(--lapis-lazuli);">Secure Payment</small>
                            <small class="text-muted">256-bit SSL encryption</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Need Help? -->
        <div class="card border-0 shadow-sm mt-4" style="background: linear-gradient(135deg, var(--light-blue), #ffffff);">
            <div class="card-body p-4">
                <h6 class="fw-bold mb-3" style="color: var(--burgundy);">
                    <i class="fas fa-question-circle me-2"></i>Need Help?
                </h6>
                <p class="small mb-3" style="color: var(--lapis-lazuli);">
                    Have questions about your order? Our support team is here to help!
                </p>
                <button class="btn btn-outline-primary btn-sm w-100">
                    <i class="fas fa-headset me-2"></i>Contact Support
                </button>
            </div>
        </div>
    </div>
</div>

<style>
    .cart-item {
        transition: all 0.3s ease;
        padding: 1rem;
        border-radius: 10px;
    }
    
    .cart-item:hover {
        background-color: rgba(242, 174, 188, 0.05);
    }
    
    .input-group.input-group-sm {
        width: 120px;
    }
    
    .input-group.input-group-sm .btn {
        width: 30px;
        padding: 0.25rem;
        border-color: var(--silver-lake);
        color: var(--silver-lake);
    }
    
    .input-group.input-group-sm .btn:hover {
        background-color: var(--light-blue);
    }
    
    .sticky-top {
        z-index: 1;
    }
    
    .text-success {
        color: var(--silver-lake) !important;
    }
    
    hr {
        opacity: 0.3;
    }
</style>

<script>
    // Quantity controls for cart items
    document.querySelectorAll('.cart-item .input-group .btn').forEach(btn => {
        btn.addEventListener('click', function() {
            const input = this.parentElement.querySelector('input');
            let value = parseInt(input.value);
            
            if (this.textContent.includes('minus')) {
                if (value > 1) {
                    input.value = value - 1;
                    updateCartTotal();
                }
            } else {
                input.value = value + 1;
                updateCartTotal();
            }
        });
    });
    
    // Remove item
    document.querySelectorAll('.cart-item .btn-sm').forEach(btn => {
        btn.addEventListener('click', function() {
            const cartItem = this.closest('.cart-item');
            
            Swal.fire({
                title: 'Remove Item?',
                text: "Are you sure you want to remove this item from your cart?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: 'var(--burgundy)',
                cancelButtonColor: 'var(--silver-lake)',
                confirmButtonText: 'Yes, remove it!',
                background: 'var(--misty-rose)',
                color: 'var(--burgundy)'
            }).then((result) => {
                if (result.isConfirmed) {
                    cartItem.style.opacity = '0';
                    cartItem.style.transform = 'translateX(-20px)';
                    
                    setTimeout(() => {
                        cartItem.remove();
                        updateCartTotal();
                        
                        Swal.fire({
                            title: 'Removed!',
                            text: 'Item has been removed from your cart.',
                            icon: 'success',
                            timer: 1500,
                            showConfirmButton: false,
                            background: 'var(--misty-rose)',
                            color: 'var(--burgundy)'
                        });
                    }, 300);
                }
            });
        });
    });
    
    // Clear cart
    document.querySelector('.btn[style*="cherry-blossom"]').addEventListener('click', function() {
        Swal.fire({
            title: 'Clear Cart?',
            text: "Are you sure you want to remove all items from your cart?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: 'var(--burgundy)',
            cancelButtonColor: 'var(--silver-lake)',
            confirmButtonText: 'Yes, clear cart!',
            background: 'var(--misty-rose)',
            color: 'var(--burgundy)'
        }).then((result) => {
            if (result.isConfirmed) {
                document.querySelectorAll('.cart-item').forEach(item => {
                    item.style.opacity = '0';
                    item.style.transform = 'translateX(-20px)';
                    setTimeout(() => item.remove(), 300);
                });
                
                setTimeout(() => {
                    Swal.fire({
                        title: 'Cart Cleared!',
                        text: 'All items have been removed from your cart.',
                        icon: 'success',
                        timer: 1500,
                        showConfirmButton: false,
                        background: 'var(--misty-rose)',
                        color: 'var(--burgundy)'
                    });
                }, 500);
            }
        });
    });
    
    function updateCartTotal() {
        // In real app, calculate total from server
        console.log('Cart updated');
    }
</script>
@endsection