@extends('layouts.app')

@section('title', 'Order Details')

@section('content')
<div class="row">
    <div class="col-lg-8">
        <!-- Order Summary -->
        <div class="card border-0 shadow-sm mb-4">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <div>
                        <h3 class="fw-bold mb-1" style="color: var(--burgundy);">
                            Order #ORD1001
                        </h3>
                        <small class="text-muted">Placed on {{ now()->format('d F Y, H:i') }}</small>
                    </div>
                    <div>
                        <span class="badge bg-success">Delivered</span>
                    </div>
                </div>
                
                <!-- Order Status Timeline -->
                <div class="mb-4">
                    <div class="status-timeline">
                        <div class="row text-center">
                            @foreach([
                                ['icon' => 'fas fa-shopping-cart', 'title' => 'Order Placed', 'date' => now()->subDays(5)->format('d M'), 'active' => true],
                                ['icon' => 'fas fa-money-bill-wave', 'title' => 'Payment Confirmed', 'date' => now()->subDays(5)->format('d M'), 'active' => true],
                                ['icon' => 'fas fa-cog', 'title' => 'Processing', 'date' => now()->subDays(4)->format('d M'), 'active' => true],
                                ['icon' => 'fas fa-truck', 'title' => 'Shipped', 'date' => now()->subDays(3)->format('d M'), 'active' => true],
                                ['icon' => 'fas fa-check-circle', 'title' => 'Delivered', 'date' => now()->subDays(1)->format('d M'), 'active' => true]
                            ] as $status)
                            <div class="col">
                                <div class="status-step {{ $status['active'] ? 'active' : '' }}">
                                    <div class="status-icon">
                                        <i class="{{ $status['icon'] }} fa-2x"></i>
                                    </div>
                                    <div class="status-info mt-2">
                                        <small class="d-block fw-semibold">{{ $status['title'] }}</small>
                                        <small class="text-muted">{{ $status['date'] }}</small>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                
                <!-- Order Items -->
                <div class="mb-4">
                    <h5 class="fw-bold mb-3" style="color: var(--lapis-lazuli);">Order Items</h5>
                    
                    <div class="order-items">
                        @for($i = 1; $i <= 3; $i++)
                        <div class="order-item border-bottom pb-3 mb-3">
                            <div class="row align-items-center">
                                <div class="col-md-2">
                                    <img src="https://images.unsplash.com/photo-1505740420928-5e560c06d30e?ixlib=rb-4.0.3&auto=format&fit=crop&w=200&q=80" 
                                         class="img-fluid rounded" style="border: 2px solid var(--cherry-blossom);">
                                </div>
                                <div class="col-md-5">
                                    <h6 class="fw-bold mb-1" style="color: var(--lapis-lazuli);">Product Name {{ $i }}</h6>
                                    <small class="text-muted">SKU: PROD-{{ 1000 + $i }}</small>
                                    <div class="text-warning small mt-1">
                                        @for($j = 1; $j <= 5; $j++)
                                        <i class="fas fa-star"></i>
                                        @endfor
                                    </div>
                                </div>
                                <div class="col-md-2 text-center">
                                    <span class="fw-bold">Qty: {{ $i }}</span>
                                </div>
                                <div class="col-md-3 text-end">
                                    <div class="fw-bold" style="color: var(--burgundy);">
                                        Rp {{ number_format(rand(50000, 200000) * $i, 0, ',', '.') }}
                                    </div>
                                    <button class="btn btn-sm btn-outline-primary mt-2">
                                        <i class="fas fa-redo me-1"></i>Buy Again
                                    </button>
                                </div>
                            </div>
                        </div>
                        @endfor
                    </div>
                </div>
                
                <!-- Order Summary -->
                <div class="order-summary">
                    <h5 class="fw-bold mb-3" style="color: var(--lapis-lazuli);">Order Summary</h5>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="border rounded p-3 mb-3">
                                <h6 class="fw-bold mb-3" style="color: var(--lapis-lazuli);">Payment Information</h6>
                                <div class="row">
                                    <div class="col-6">
                                        <small class="text-muted d-block">Method</small>
                                        <strong>QRIS</strong>
                                    </div>
                                    <div class="col-6">
                                        <small class="text-muted d-block">Status</small>
                                        <span class="badge bg-success">Paid</span>
                                    </div>
                                    <div class="col-6 mt-2">
                                        <small class="text-muted d-block">Transaction ID</small>
                                        <strong>TX{{ rand(100000, 999999) }}</strong>
                                    </div>
                                    <div class="col-6 mt-2">
                                        <small class="text-muted d-block">Paid Date</small>
                                        <strong>{{ now()->format('d/m/Y H:i') }}</strong>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="border rounded p-3">
                                <h6 class="fw-bold mb-3" style="color: var(--lapis-lazuli);">Shipping Information</h6>
                                <div class="row">
                                    <div class="col-6">
                                        <small class="text-muted d-block">Method</small>
                                        <strong>Standard Shipping</strong>
                                    </div>
                                    <div class="col-6">
                                        <small class="text-muted d-block">Tracking</small>
                                        <strong>TRK{{ rand(100000000, 999999999) }}</strong>
                                    </div>
                                    <div class="col-12 mt-2">
                                        <small class="text-muted d-block">Address</small>
                                        <strong>Jl. Sudirman No. 123, Jakarta Pusat</strong>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Price Breakdown -->
                    <div class="border rounded p-3 mt-3">
                        <div class="row">
                            <div class="col-md-8">
                                <div class="d-flex justify-content-between mb-2">
                                    <span>Subtotal (3 items)</span>
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
                                <hr>
                                <div class="d-flex justify-content-between">
                                    <span class="fw-bold h5" style="color: var(--burgundy);">Total</span>
                                    <span class="fw-bold h5" style="color: var(--burgundy);">Rp 429,850</span>
                                </div>
                            </div>
                            <div class="col-md-4 text-end">
                                <button class="btn btn-primary">
                                    <i class="fas fa-print me-2"></i>Print Invoice
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Need Help? -->
        <div class="card border-0 shadow-sm" style="background: linear-gradient(135deg, var(--light-pink), #fff);">
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col-md-8">
                        <h5 class="fw-bold mb-2" style="color: var(--burgundy);">Need help with your order?</h5>
                        <p class="mb-0" style="color: var(--lapis-lazuli);">
                            Our customer support team is here to help you with any questions or issues.
                        </p>
                    </div>
                    <div class="col-md-4 text-end">
                        <button class="btn btn-primary">
                            <i class="fas fa-headset me-2"></i>Contact Support
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Sidebar -->
    <div class="col-lg-4">
        <!-- Order Actions -->
        <div class="card border-0 shadow-sm mb-4">
            <div class="card-body">
                <h5 class="fw-bold mb-3" style="color: var(--burgundy);">Order Actions</h5>
                
                <div class="d-grid gap-2">
                    <button class="btn btn-primary" onclick="trackOrder()">
                        <i class="fas fa-map-marked-alt me-2"></i>Track Order
                    </button>
                    <button class="btn btn-outline-primary" onclick="downloadInvoice()">
                        <i class="fas fa-download me-2"></i>Download Invoice
                    </button>
                    <button class="btn btn-outline-secondary" onclick="requestReturn()">
                        <i class="fas fa-undo me-2"></i>Request Return
                    </button>
                    <button class="btn btn-outline-secondary" onclick="writeReview()">
                        <i class="fas fa-star me-2"></i>Write Review
                    </button>
                </div>
            </div>
        </div>
        
        <!-- Delivery Information -->
        <div class="card border-0 shadow-sm mb-4">
            <div class="card-body">
                <h5 class="fw-bold mb-3" style="color: var(--burgundy);">
                    <i class="fas fa-truck me-2"></i>Delivery Information
                </h5>
                
                <div class="delivery-info">
                    <div class="d-flex align-items-center mb-3">
                        <div class="delivery-icon me-3">
                            <i class="fas fa-box fa-2x" style="color: var(--silver-lake);"></i>
                        </div>
                        <div>
                            <div class="fw-bold" style="color: var(--lapis-lazuli);">Package Delivered</div>
                            <small class="text-muted">Delivered on {{ now()->subDays(1)->format('d F Y') }}</small>
                        </div>
                    </div>
                    
                    <div class="border-top pt-3">
                        <div class="row">
                            <div class="col-6">
                                <small class="text-muted d-block">Carrier</small>
                                <strong>JNE</strong>
                            </div>
                            <div class="col-6">
                                <small class="text-muted d-block">Tracking Number</small>
                                <strong>TRK{{ rand(100000000, 999999999) }}</strong>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Customer Support -->
        <div class="card border-0 shadow-sm" style="background: linear-gradient(135deg, var(--light-blue), #fff);">
            <div class="card-body">
                <h5 class="fw-bold mb-3" style="color: var(--burgundy);">
                    <i class="fas fa-headset me-2"></i>Customer Support
                </h5>
                
                <div class="support-info">
                    <div class="d-flex align-items-center mb-3">
                        <i class="fas fa-clock me-3" style="color: var(--silver-lake);"></i>
                        <div>
                            <div class="fw-bold" style="color: var(--lapis-lazuli);">Available 24/7</div>
                            <small class="text-muted">We're here to help anytime</small>
                        </div>
                    </div>
                    
                    <div class="d-flex align-items-center mb-3">
                        <i class="fas fa-envelope me-3" style="color: var(--silver-lake);"></i>
                        <div>
                            <div class="fw-bold" style="color: var(--lapis-lazuli);">Email Support</div>
                            <small class="text-muted">support@bunnypops.com</small>
                        </div>
                    </div>
                    
                    <div class="d-flex align-items-center">
                        <i class="fas fa-phone me-3" style="color: var(--silver-lake);"></i>
                        <div>
                            <div class="fw-bold" style="color: var(--lapis-lazuli);">Phone Support</div>
                            <small class="text-muted">+62 812 3456 7890</small>
                        </div>
                    </div>
                </div>
                
                <div class="mt-4">
                    <button class="btn btn-outline-primary w-100" onclick="contactSupport()">
                        <i class="fas fa-comments me-2"></i>Live Chat
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function trackOrder() {
        Swal.fire({
            title: 'Track Your Order',
            html: `
                <div class="text-center mb-3">
                    <img src="https://images.unsplash.com/photo-1556742049-0cfed4f6a45d?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80" 
                         class="img-fluid rounded mb-3">
                    <h6 class="fw-bold" style="color: var(--lapis-lazuli);">Package Delivered</h6>
                    <p class="text-muted">Your order has been delivered successfully.</p>
                </div>
                <div class="tracking-timeline">
                    <div class="tracking-step active">
                        <div class="tracking-icon">
                            <i class="fas fa-check-circle"></i>
                        </div>
                        <div class="tracking-info">
                            <div class="fw-bold">Delivered</div>
                            <small class="text-muted">${new Date().toLocaleDateString()}</small>
                        </div>
                    </div>
                </div>
            `,
            confirmButtonColor: 'var(--burgundy)',
            background: 'var(--light-pink)',
            color: 'var(--burgundy)'
        });
    }
    
    function downloadInvoice() {
        Swal.fire({
            title: 'Downloading Invoice...',
            text: 'Please wait while we generate your invoice.',
            timer: 2000,
            showConfirmButton: false,
            background: 'var(--light-pink)',
            color: 'var(--burgundy)'
        }).then(() => {
            Swal.fire({
                title: 'Invoice Downloaded!',
                text: 'Your invoice has been downloaded successfully.',
                icon: 'success',
                confirmButtonColor: 'var(--burgundy)',
                background: 'var(--light-pink)',
                color: 'var(--burgundy)'
            });
        });
    }
    
    function requestReturn() {
        Swal.fire({
            title: 'Request Return',
            html: `
                <div class="mb-3">
                    <label class="form-label">Select Item to Return</label>
                    <select class="form-select" id="returnItem">
                        <option>Product Name 1</option>
                        <option>Product Name 2</option>
                        <option>Product Name 3</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label class="form-label">Return Reason</label>
                    <select class="form-select" id="returnReason">
                        <option>Wrong Item Received</option>
                        <option>Damaged Product</option>
                        <option>Not as Described</option>
                        <option>Changed Mind</option>
                        <option>Other</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label class="form-label">Additional Notes</label>
                    <textarea class="form-control" id="returnNotes" rows="3"></textarea>
                </div>
            `,
            showCancelButton: true,
            confirmButtonText: 'Submit Return Request',
            confirmButtonColor: 'var(--burgundy)',
            cancelButtonColor: 'var(--silver-lake)',
            background: 'var(--light-pink)',
            color: 'var(--burgundy)'
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire({
                    title: 'Request Submitted!',
                    text: 'Your return request has been submitted. We will contact you within 24 hours.',
                    icon: 'success',
                    confirmButtonColor: 'var(--burgundy)',
                    background: 'var(--light-pink)',
                    color: 'var(--burgundy)'
                });
            }
        });
    }
    
    function writeReview() {
        Swal.fire({
            title: 'Write Review',
            html: `
                <div class="text-center mb-3">
                    <div class="rating mb-3">
                        ${Array(5).fill().map((_, i) => `
                            <i class="fas fa-star text-warning" style="font-size: 2rem; cursor: pointer;" 
                               onclick="setRating(${i + 1})" id="reviewStar-${i + 1}"></i>
                        `).join('')}
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Review Title</label>
                        <input type="text" class="form-control" id="reviewTitle" placeholder="Title of your review">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Your Review</label>
                        <textarea class="form-control" id="reviewText" rows="4" 
                                  placeholder="Share your experience with this product..."></textarea>
                    </div>
                </div>
            `,
            showCancelButton: true,
            confirmButtonText: 'Submit Review',
            confirmButtonColor: 'var(--burgundy)',
            cancelButtonColor: 'var(--silver-lake)',
            background: 'var(--light-pink)',
            color: 'var(--burgundy)',
            preConfirm: () => {
                const rating = document.querySelectorAll('.fa-star.active').length;
                const title = document.getElementById('reviewTitle').value;
                const review = document.getElementById('reviewText').value;
                
                if (rating === 0) {
                    Swal.showValidationMessage('Please select a rating');
                    return false;
                }
                
                return { rating, title, review };
            }
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire(
                    'Thank You!',
                    'Your review has been submitted successfully.',
                    'success'
                );
            }
        });
    }
    
    function setRating(rating) {
        document.querySelectorAll('.fa-star').forEach((star, index) => {
            star.classList.remove('active');
            if (index < rating) {
                star.classList.add('active');
            }
        });
    }
    
    function contactSupport() {
        Swal.fire({
            title: 'Contact Support',
            html: `
                <div class="text-center mb-3">
                    <i class="fas fa-headset fa-3x mb-3" style="color: var(--silver-lake);"></i>
                    <p class="mb-3" style="color: var(--lapis-lazuli);">
                        Our support team is available 24/7 to assist you.
                    </p>
                </div>
                <div class="d-grid gap-2">
                    <button class="btn btn-outline-primary" onclick="startLiveChat()">
                        <i class="fas fa-comments me-2"></i>Start Live Chat
                    </button>
                    <button class="btn btn-outline-secondary" onclick="sendEmail()">
                        <i class="fas fa-envelope me-2"></i>Send Email
                    </button>
                    <button class="btn btn-outline-secondary" onclick="callSupport()">
                        <i class="fas fa-phone me-2"></i>Call Support
                    </button>
                </div>
            `,
            showConfirmButton: false,
            showCloseButton: true,
            background: 'var(--light-pink)',
            color: 'var(--burgundy)'
        });
    }
</script>

<style>
    .status-step {
        position: relative;
        padding: 10px;
    }
    
    .status-step.active .status-icon {
        background-color: var(--cherry-blossom);
        color: white;
    }
    
    .status-icon {
        width: 60px;
        height: 60px;
        border-radius: 50%;
        background-color: var(--light-pink);
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto;
        color: var(--burgundy);
        border: 3px solid var(--cherry-blossom);
    }
    
    .status-info {
        margin-top: 10px;
    }
    
    .order-item {
        transition: all 0.3s ease;
    }
    
    .order-item:hover {
        background-color: rgba(242, 174, 188, 0.05);
    }
    
    .delivery-icon {
        width: 50px;
        height: 50px;
        background-color: rgba(90, 134, 203, 0.1);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    
    .badge.bg-success {
        background-color: var(--silver-lake) !important;
    }
    
    .text-success {
        color: var(--silver-lake) !important;
    }
    
    .text-danger {
        color: var(--cherry-blossom) !important;
    }
    
    .rating .fa-star {
        transition: all 0.2s ease;
    }
    
    .rating .fa-star:hover {
        transform: scale(1.2);
    }
    
    .rating .fa-star.active {
        color: #ffc107;
        text-shadow: 0 0 10px rgba(255, 193, 7, 0.5);
    }
</style>
@endsection