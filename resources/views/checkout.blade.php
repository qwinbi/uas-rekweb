@extends('layouts.app')

@section('title', 'Checkout')

@section('content')
<div class="row">
    <!-- Checkout Steps -->
    <div class="col-12 mb-4">
        <div class="card border-0 shadow-sm">
            <div class="card-body">
                <div class="steps">
                    <div class="step-item active">
                        <div class="step-number">1</div>
                        <div class="step-label">Cart</div>
                    </div>
                    <div class="step-item active">
                        <div class="step-number">2</div>
                        <div class="step-label">Information</div>
                    </div>
                    <div class="step-item active">
                        <div class="step-number">3</div>
                        <div class="step-label">Shipping</div>
                    </div>
                    <div class="step-item">
                        <div class="step-number">4</div>
                        <div class="step-label">Payment</div>
                    </div>
                    <div class="step-item">
                        <div class="step-number">5</div>
                        <div class="step-label">Review</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Billing & Shipping -->
    <div class="col-lg-8">
        <div class="card border-0 shadow-sm mb-4">
            <div class="card-body p-4">
                <h4 class="fw-bold mb-4">Shipping Information</h4>
                
                <form id="checkoutForm">
                    <div class="row g-3">
                        <!-- Contact Information -->
                        <div class="col-12">
                            <h6 class="fw-bold mb-3">Contact Information</h6>
                        </div>
                        
                        <div class="col-md-6">
                            <label class="form-label">First Name</label>
                            <input type="text" class="form-control" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Last Name</label>
                            <input type="text" class="form-control" required>
                        </div>
                        
                        <div class="col-md-6">
                            <label class="form-label">Email Address</label>
                            <input type="email" class="form-control" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Phone Number</label>
                            <input type="tel" class="form-control" required>
                        </div>
                        
                        <!-- Shipping Address -->
                        <div class="col-12 mt-4">
                            <h6 class="fw-bold mb-3">Shipping Address</h6>
                        </div>
                        
                        <div class="col-12">
                            <label class="form-label">Address</label>
                            <input type="text" class="form-control" placeholder="Street address" required>
                        </div>
                        
                        <div class="col-md-6">
                            <label class="form-label">City</label>
                            <input type="text" class="form-control" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">State/Province</label>
                            <select class="form-select" required>
                                <option value="">Select Province</option>
                                <option>DKI Jakarta</option>
                                <option>Jawa Barat</option>
                                <option>Jawa Timur</option>
                                <option>Jawa Tengah</option>
                            </select>
                        </div>
                        
                        <div class="col-md-6">
                            <label class="form-label">Postal Code</label>
                            <input type="text" class="form-control" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Country</label>
                            <select class="form-select" required>
                                <option value="">Select Country</option>
                                <option selected>Indonesia</option>
                                <option>Malaysia</option>
                                <option>Singapore</option>
                            </select>
                        </div>
                        
                        <!-- Shipping Method -->
                        <div class="col-12 mt-4">
                            <h6 class="fw-bold mb-3">Shipping Method</h6>
                            <div class="list-group">
                                <label class="list-group-item">
                                    <input class="form-check-input me-2" type="radio" name="shipping" checked>
                                    <div class="d-flex justify-content-between w-100">
                                        <div>
                                            <h6 class="fw-bold mb-0">Standard Shipping</h6>
                                            <small class="text-muted">5-7 business days</small>
                                        </div>
                                        <span class="fw-bold">FREE</span>
                                    </div>
                                </label>
                                <label class="list-group-item">
                                    <input class="form-check-input me-2" type="radio" name="shipping">
                                    <div class="d-flex justify-content-between w-100">
                                        <div>
                                            <h6 class="fw-bold mb-0">Express Shipping</h6>
                                            <small class="text-muted">2-3 business days</small>
                                        </div>
                                        <span class="fw-bold">Rp 25,000</span>
                                    </div>
                                </label>
                                <label class="list-group-item">
                                    <input class="form-check-input me-2" type="radio" name="shipping">
                                    <div class="d-flex justify-content-between w-100">
                                        <div>
                                            <h6 class="fw-bold mb-0">Same Day Delivery</h6>
                                            <small class="text-muted">Within Jakarta area</small>
                                        </div>
                                        <span class="fw-bold">Rp 50,000</span>
                                    </div>
                                </label>
                            </div>
                        </div>
                        
                        <!-- Billing Address -->
                        <div class="col-12 mt-4">
                            <div class="form-check mb-3">
                                <input class="form-check-input" type="checkbox" id="sameAsShipping">
                                <label class="form-check-label" for="sameAsShipping">
                                    Billing address same as shipping address
                                </label>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
    <!-- Order Summary -->
    <div class="col-lg-4">
        <div class="card border-0 shadow-sm sticky-top" style="top: 20px;">
            <div class="card-body p-4">
                <h4 class="fw-bold mb-4">Order Summary</h4>
                
                <!-- Order Items -->
                <div class="mb-4">
                    @for($i = 1; $i <= 3; $i++)
                    <div class="d-flex align-items-center mb-3">
                        <div class="position-relative me-3">
                            <img src="https://images.unsplash.com/photo-1505740420928-5e560c06d30e?ixlib=rb-4.0.3&auto=format&fit=crop&w=80&q=80" 
                                 class="rounded" width="60">
                            <span class="badge bg-primary rounded-circle position-absolute top-0 end-0">
                                {{ $i }}
                            </span>
                        </div>
                        <div class="flex-grow-1">
                            <h6 class="fw-bold mb-0">Product Name {{ $i }}</h6>
                            <small class="text-muted">Size: M, Color: Black</small>
                        </div>
                        <div class="text-end">
                            <div class="fw-bold">Rp {{ number_format(rand(50000, 200000), 0, ',', '.') }}</div>
                        </div>
                    </div>
                    @endfor
                </div>
                
                <!-- Pricing Summary -->
                <div class="border-top pt-3">
                    <div class="d-flex justify-content-between mb-2">
                        <span>Subtotal</span>
                        <span class="fw-semibold">Rp 457,000</span>
                    </div>
                    <div class="d-flex justify-content-between mb-2">
                        <span>Shipping</span>
                        <span class="fw-semibold text-success">FREE</span>
                    </div>
                    <div class="d-flex justify-content-between mb-2">
                        <span>Tax</span>
                        <span class="fw-semibold">Rp 22,850</span>
                    </div>
                    <div class="d-flex justify-content-between mb-3">
                        <span>Discount</span>
                        <span class="fw-semibold text-danger">-Rp 50,000</span>
                    </div>
                    
                    <hr class="my-3">
                    
                    <div class="d-flex justify-content-between mb-4">
                        <span class="fw-bold">Total</span>
                        <span class="fw-bold text-primary h4">Rp 429,850</span>
                    </div>
                </div>
                
                <!-- Payment Methods -->
                <div class="mb-4">
                    <h6 class="fw-bold mb-3">Payment Method</h6>
                    <div class="accordion" id="paymentMethods">
                        <div class="accordion-item border-0 mb-2">
                            <h6 class="accordion-header">
                                <button class="accordion-button collapsed bg-light" type="button" 
                                        data-bs-toggle="collapse" data-bs-target="#creditCard">
                                    <i class="fas fa-credit-card me-2"></i> Credit/Debit Card
                                </button>
                            </h6>
                            <div id="creditCard" class="accordion-collapse collapse" 
                                 data-bs-parent="#paymentMethods">
                                <div class="accordion-body p-3">
                                    <div class="mb-3">
                                        <label class="form-label">Card Number</label>
                                        <input type="text" class="form-control" placeholder="1234 5678 9012 3456">
                                    </div>
                                    <div class="row g-2">
                                        <div class="col-6">
                                            <label class="form-label">Expiry Date</label>
                                            <input type="text" class="form-control" placeholder="MM/YY">
                                        </div>
                                        <div class="col-6">
                                            <label class="form-label">CVV</label>
                                            <input type="text" class="form-control" placeholder="123">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="accordion-item border-0 mb-2">
                            <h6 class="accordion-header">
                                <button class="accordion-button collapsed bg-light" type="button" 
                                        data-bs-toggle="collapse" data-bs-target="#bankTransfer">
                                    <i class="fas fa-university me-2"></i> Bank Transfer
                                </button>
                            </h6>
                            <div id="bankTransfer" class="accordion-collapse collapse" 
                                 data-bs-parent="#paymentMethods">
                                <div class="accordion-body p-3">
                                    <p class="small mb-2">Transfer to:</p>
                                    <div class="border rounded p-3 mb-2">
                                        <div class="d-flex justify-content-between mb-1">
                                            <span>Bank Name:</span>
                                            <strong>BCA</strong>
                                        </div>
                                        <div class="d-flex justify-content-between mb-1">
                                            <span>Account Number:</span>
                                            <strong>1234567890</strong>
                                        </div>
                                        <div class="d-flex justify-content-between">
                                            <span>Account Name:</span>
                                            <strong>Toko Online</strong>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="accordion-item border-0">
                            <h6 class="accordion-header">
                                <button class="accordion-button collapsed bg-light" type="button" 
                                        data-bs-toggle="collapse" data-bs-target="#qris">
                                    <i class="fas fa-qrcode me-2"></i> QRIS
                                </button>
                            </h6>
                            <div id="qris" class="accordion-collapse collapse" 
                                 data-bs-parent="#paymentMethods">
                                <div class="accordion-body p-3 text-center">
                                    <div class="mb-3">
                                        <img src="https://api.qrserver.com/v1/create-qr-code/?size=150x150&data=TokoOnline-{{ rand(1000, 9999) }}" 
                                             class="img-fluid rounded" alt="QR Code">
                                    </div>
                                    <p class="small text-muted">
                                        Scan QR code above using your mobile banking app
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Place Order Button -->
                <div class="d-grid">
                    <button type="button" class="btn btn-primary btn-lg" id="placeOrderBtn">
                        <i class="fas fa-lock me-2"></i>Place Order
                    </button>
                </div>
                
                <!-- Security Info -->
                <div class="text-center mt-4">
                    <div class="small text-muted">
                        <i class="fas fa-shield-alt text-success me-1"></i>
                        Secure payment • 256-bit SSL encryption
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // Place order button
    document.getElementById('placeOrderBtn').addEventListener('click', function() {
        const form = document.getElementById('checkoutForm');
        if (form.checkValidity()) {
            Swal.fire({
                title: 'Confirm Order',
                text: 'Are you sure you want to place this order?',
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#4361ee',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Yes, place order!'
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire({
                        title: 'Success!',
                        text: 'Your order has been placed successfully.',
                        icon: 'success',
                        confirmButtonText: 'View Order'
                    });
                }
            });
        } else {
            form.reportValidity();
        }
    });
    
    // Same as shipping checkbox
    document.getElementById('sameAsShipping').addEventListener('change', function() {
        if (this.checked) {
            // In real app, copy shipping values to billing
            Swal.fire({
                title: 'Billing Address Updated',
                text: 'Billing address set to shipping address.',
                icon: 'success',
                timer: 1500,
                showConfirmButton: false
            });
        }
    });
</script>

<style>
    /* Steps */
    .steps {
        display: flex;
        justify-content: space-between;
        position: relative;
    }
    
    .steps::before {
        content: '';
        position: absolute;
        top: 20px;
        left: 10%;
        right: 10%;
        height: 2px;
        background-color: #e0e0e0;
        z-index: 1;
    }
    
    .step-item {
        display: flex;
        flex-direction: column;
        align-items: center;
        position: relative;
        z-index: 2;
    }
    
    .step-number {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        background-color: #e0e0e0;
        color: #6c757d;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: bold;
        margin-bottom: 8px;
        border: 3px solid white;
    }
    
    .step-item.active .step-number {
        background-color: var(--primary-color);
        color: white;
    }
    
    .step-label {
        font-size: 0.85rem;
        color: #6c757d;
        text-align: center;
    }
    
    .step-item.active .step-label {
        color: var(--primary-color);
        font-weight: 600;
    }
    
    /* List Group */
    .list-group-item {
        border: 1px solid #dee2e6;
        border-radius: 8px !important;
        margin-bottom: 8px;
        cursor: pointer;
        transition: all 0.3s ease;
    }
    
    .list-group-item:hover {
        border-color: var(--primary-color);
        background-color: rgba(67, 97, 238, 0.05);
    }
    
    .list-group-item .form-check-input:checked {
        background-color: var(--primary-color);
        border-color: var(--primary-color);
    }
    
    /* Accordion */
    .accordion-button {
        border-radius: 8px !important;
        font-weight: 500;
    }
    
    .accordion-button:not(.collapsed) {
        background-color: rgba(67, 97, 238, 0.1);
        color: var(--primary-color);
        box-shadow: none;
    }
    
    .accordion-button:focus {
        box-shadow: none;
        border-color: var(--primary-color);
    }
</style>
@endsection