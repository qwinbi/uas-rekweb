@extends('layouts.app')

@section('title', 'Shopping Cart')

@section('content')
<div class="row">
    <!-- Cart Items -->
    <div class="col-lg-8">
        <div class="card border-0 shadow-sm mb-4">
            <div class="card-body p-4">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h2 class="fw-bold mb-0">
                        <i class="fas fa-shopping-cart text-primary me-2"></i>Shopping Cart
                    </h2>
                    <span class="badge bg-primary">{{ $cartCount ?? 3 }} Items</span>
                </div>
                
                @for($i = 1; $i <= 3; $i++)
                <div class="cart-item border-bottom pb-4 mb-4">
                    <div class="row align-items-center">
                        <div class="col-md-2">
                            <img src="https://images.unsplash.com/photo-1505740420928-5e560c06d30e?ixlib=rb-4.0.3&auto=format&fit=crop&w=200&q=80" 
                                 class="img-fluid rounded" alt="Product {{ $i }}">
                        </div>
                        <div class="col-md-5">
                            <h6 class="fw-bold mb-1">Product Name {{ $i }}</h6>
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
                            <h6 class="fw-bold text-primary mb-0">Rp {{ number_format(rand(50000, 500000), 0, ',', '.') }}</h6>
                            @if($i == 1)
                            <small class="text-muted text-decoration-line-through">Rp 599,000</small>
                            @endif
                        </div>
                        <div class="col-md-1 text-end">
                            <button class="btn btn-sm btn-outline-danger">
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
                    <button class="btn btn-danger">
                        <i class="fas fa-trash me-2"></i>Clear Cart
                    </button>
                </div>
            </div>
        </div>
        
        <!-- Shipping Info -->
        <div class="card border-0 shadow-sm">
            <div class="card-body p-4">
                <h5 class="fw-bold mb-4">Shipping Information</h5>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Full Name</label>
                        <input type="text" class="form-control" placeholder="Enter your full name">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Phone Number</label>
                        <input type="text" class="form-control" placeholder="Enter phone number">
                    </div>
                    <div class="col-md-12 mb-3">
                        <label class="form-label">Address</label>
                        <textarea class="form-control" rows="3" placeholder="Enter full address"></textarea>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">City</label>
                        <input type="text" class="form-control" placeholder="Enter city">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Postal Code</label>
                        <input type="text" class="form-control" placeholder="Enter postal code">
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Order Summary -->
    <div class="col-lg-4">
        <div class="card border-0 shadow-sm sticky-top" style="top: 20px;">
            <div class="card-body p-4">
                <h5 class="fw-bold mb-4">Order Summary</h5>
                
                <div class="d-flex justify-content-between mb-2">
                    <span>Subtotal (3 items)</span>
                    <span class="fw-semibold">Rp 1,497,000</span>
                </div>
                <div class="d-flex justify-content-between mb-2">
                    <span>Shipping</span>
                    <span class="fw-semibold text-success">FREE</span>
                </div>
                <div class="d-flex justify-content-between mb-2">
                    <span>Tax</span>
                    <span class="fw-semibold">Rp 74,850</span>
                </div>
                <div class="d-flex justify-content-between mb-2">
                    <span>Discount</span>
                    <span class="fw-semibold text-danger">-Rp 100,000</span>
                </div>
                
                <hr class="my-3">
                
                <div class="d-flex justify-content-between mb-4">
                    <span class="fw-bold">Total</span>
                    <span class="fw-bold text-primary h4">Rp 1,471,850</span>
                </div>
                
                <a href="{{ route('checkout') }}" class="btn btn-primary btn-lg w-100 mb-3">
                    <i class="fas fa-credit-card me-2"></i>Proceed to Checkout
                </a>
                
                <!-- Payment Methods -->
                <div class="border-top pt-4">
                    <h6 class="fw-bold mb-3">Payment Methods</h6>
                    <div class="row g-2">
                        <div class="col-6">
                            <div class="border rounded p-3 text-center">
                                <i class="fas fa-credit-card fa-2x text-primary mb-2"></i>
                                <small class="d-block">Credit Card</small>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="border rounded p-3 text-center">
                                <i class="fas fa-qrcode fa-2x text-primary mb-2"></i>
                                <small class="d-block">QRIS</small>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="border rounded p-3 text-center">
                                <i class="fas fa-university fa-2x text-primary mb-2"></i>
                                <small class="d-block">Bank Transfer</small>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="border rounded p-3 text-center">
                                <i class="fas fa-wallet fa-2x text-primary mb-2"></i>
                                <small class="d-block">E-Wallet</small>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Promo Code -->
                <div class="border-top pt-4">
                    <h6 class="fw-bold mb-3">Promo Code</h6>
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="Enter promo code">
                        <button class="btn btn-outline-primary">Apply</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .cart-item {
        transition: all 0.3s ease;
    }
    
    .cart-item:hover {
        background-color: rgba(67, 97, 238, 0.02);
    }
    
    .input-group.input-group-sm {
        width: 120px;
    }
    
    .input-group.input-group-sm .btn {
        width: 30px;
        padding: 0.25rem;
    }
    
    .sticky-top {
        z-index: 1;
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
                }
            } else {
                input.value = value + 1;
            }
            
            // In real app, update cart via AJAX
        });
    });
</script>
@endsection