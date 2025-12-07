@extends('layouts.app')

@section('title', 'Product Detail')

@section('content')
<div class="row mb-5">
    <div class="col-lg-6">
        <!-- Product Images -->
        <div class="card border-0 shadow-sm mb-3">
            <div class="card-body p-4">
                <div class="text-center mb-4">
                    <img src="https://images.unsplash.com/photo-1505740420928-5e560c06d30e?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80" 
                         class="img-fluid rounded-3" alt="Product Image" style="max-height: 400px; border: 2px solid var(--cherry-blossom);">
                </div>
                
                <div class="row g-2">
                    @for($i = 1; $i <= 4; $i++)
                    <div class="col-3">
                        <img src="https://images.unsplash.com/photo-1505740420928-5e560c06d30e?ixlib=rb-4.0.3&auto=format&fit=crop&w=150&q=80" 
                             class="img-fluid rounded border cursor-pointer" alt="Thumbnail {{ $i }}"
                             style="border-color: var(--silver-lake) !important;">
                    </div>
                    @endfor
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-lg-6">
        <!-- Product Info -->
        <div class="card border-0 shadow-sm">
            <div class="card-body p-4">
                <div class="d-flex justify-content-between align-items-start mb-3">
                    <div>
                        <h1 class="fw-bold mb-2" style="color: var(--lapis-lazuli);">Premium Wireless Headphones</h1>
                        <div class="d-flex align-items-center mb-3">
                            <div class="text-warning me-2">
                                @for($i = 1; $i <= 5; $i++)
                                <i class="fas fa-star"></i>
                                @endfor
                            </div>
                            <span class="text-muted">(4.5/5.0) • 128 Reviews</span>
                        </div>
                    </div>
                    <button class="btn btn-outline-danger btn-sm">
                        <i class="far fa-heart"></i>
                    </button>
                </div>
                
                <div class="mb-4">
                    <h2 class="fw-bold" style="color: var(--burgundy);">Rp 499,000</h2>
                    <small class="text-muted text-decoration-line-through">Rp 599,000</small>
                    <span class="badge bg-secondary ms-2">Save 16%</span>
                </div>
                
                <div class="mb-4">
                    <p class="text-muted" style="color: var(--lapis-lazuli);">
                        Experience premium sound quality with our wireless headphones. 
                        Features noise cancellation, 30-hour battery life, and comfortable design 
                        for extended use.
                    </p>
                    
                    <div class="row g-3 mb-4">
                        <div class="col-6">
                            <div class="d-flex align-items-center">
                                <i class="fas fa-bluetooth me-2" style="color: var(--silver-lake);"></i>
                                <span style="color: var(--lapis-lazuli);">Bluetooth 5.0</span>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="d-flex align-items-center">
                                <i class="fas fa-battery-full me-2" style="color: var(--silver-lake);"></i>
                                <span style="color: var(--lapis-lazuli);">30 Hours Battery</span>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="d-flex align-items-center">
                                <i class="fas fa-shield-alt me-2" style="color: var(--silver-lake);"></i>
                                <span style="color: var(--lapis-lazuli);">Water Resistant</span>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="d-flex align-items-center">
                                <i class="fas fa-headset me-2" style="color: var(--silver-lake);"></i>
                                <span style="color: var(--lapis-lazuli);">Noise Cancelling</span>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Product Options -->
                <div class="mb-4">
                    <h6 class="fw-semibold mb-3" style="color: var(--lapis-lazuli);">Color Options</h6>
                    <div class="d-flex gap-2 mb-3">
                        @foreach(['Black', 'White', 'Pink', 'Blue'] as $color)
                        <button class="btn btn-outline-primary btn-sm" 
                                style="{{ $color == 'Pink' ? 'border-color: var(--cherry-blossom); color: var(--burgundy);' : '' }}">
                            {{ $color }}
                        </button>
                        @endforeach
                    </div>
                </div>
                
                <!-- Quantity & Add to Cart -->
                <div class="d-flex align-items-center gap-3 mb-4">
                    <div class="input-group" style="width: 140px;">
                        <button class="btn btn-outline-secondary" type="button" id="decrement">
                            <i class="fas fa-minus"></i>
                        </button>
                        <input type="text" class="form-control text-center" value="1" id="quantity">
                        <button class="btn btn-outline-secondary" type="button" id="increment">
                            <i class="fas fa-plus"></i>
                        </button>
                    </div>
                    
                    <button class="btn btn-primary flex-grow-1">
                        <i class="fas fa-shopping-cart me-2"></i>Add to Cart
                    </button>
                </div>
                
                <!-- Additional Info -->
                <div class="border-top pt-3">
                    <div class="row">
                        <div class="col-6">
                            <div class="d-flex align-items-center">
                                <i class="fas fa-shipping-fast me-2" style="color: var(--silver-lake);"></i>
                                <div>
                                    <small class="d-block fw-semibold" style="color: var(--lapis-lazuli);">Free Shipping</small>
                                    <small class="text-muted">For orders above Rp 300,000</small>
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="d-flex align-items-center">
                                <i class="fas fa-undo me-2" style="color: var(--silver-lake);"></i>
                                <div>
                                    <small class="d-block fw-semibold" style="color: var(--lapis-lazuli);">30-Day Returns</small>
                                    <small class="text-muted">Easy return policy</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Product Tabs -->
<div class="card border-0 shadow-sm mb-5">
    <div class="card-body p-4">
        <ul class="nav nav-tabs border-0 mb-4" id="productTab" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="description-tab" data-bs-toggle="tab" 
                        data-bs-target="#description" type="button">
                    Description
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="specs-tab" data-bs-toggle="tab" 
                        data-bs-target="#specs" type="button">
                    Specifications
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="reviews-tab" data-bs-toggle="tab" 
                        data-bs-target="#reviews" type="button">
                    Reviews (128)
                </button>
            </li>
        </ul>
        
        <div class="tab-content" id="productTabContent">
            <div class="tab-pane fade show active" id="description">
                <h5 class="fw-bold mb-3" style="color: var(--burgundy);">Product Description</h5>
                <p class="text-muted" style="color: var(--lapis-lazuli);">
                    These premium wireless headphones deliver exceptional sound quality with active 
                    noise cancellation technology. Perfect for music lovers, gamers, and professionals 
                    who need crystal-clear audio.
                </p>
                <ul class="text-muted" style="color: var(--lapis-lazuli);">
                    <li>Advanced noise cancellation technology</li>
                    <li>30-hour battery life with quick charge</li>
                    <li>Comfortable over-ear design with memory foam</li>
                    <li>Voice assistant compatible (Siri, Google Assistant)</li>
                    <li>Built-in microphone for calls</li>
                </ul>
            </div>
            
            <div class="tab-pane fade" id="specs">
                <h5 class="fw-bold mb-3" style="color: var(--burgundy);">Technical Specifications</h5>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <tbody>
                            <tr>
                                <td class="fw-semibold" style="color: var(--lapis-lazuli);">Brand</td>
                                <td>AudioTech</td>
                            </tr>
                            <tr>
                                <td class="fw-semibold" style="color: var(--lapis-lazuli);">Model</td>
                                <td>ATH-M50x</td>
                            </tr>
                            <tr>
                                <td class="fw-semibold" style="color: var(--lapis-lazuli);">Connectivity</td>
                                <td>Bluetooth 5.0, 3.5mm jack</td>
                            </tr>
                            <tr>
                                <td class="fw-semibold" style="color: var(--lapis-lazuli);">Battery Life</td>
                                <td>30 hours</td>
                            </tr>
                            <tr>
                                <td class="fw-semibold" style="color: var(--lapis-lazuli);">Weight</td>
                                <td>285 grams</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            
            <div class="tab-pane fade" id="reviews">
                <h5 class="fw-bold mb-3" style="color: var(--burgundy);">Customer Reviews</h5>
                @for($i = 1; $i <= 3; $i++)
                <div class="border-bottom pb-3 mb-3">
                    <div class="d-flex justify-content-between mb-2">
                        <div>
                            <strong style="color: var(--lapis-lazuli);">Customer {{ $i }}</strong>
                            <div class="text-warning small">
                                @for($j = 1; $j <= 5; $j++)
                                <i class="fas fa-star"></i>
                                @endfor
                            </div>
                        </div>
                        <small class="text-muted">2 days ago</small>
                    </div>
                    <p class="mb-0" style="color: var(--lapis-lazuli);">Excellent product! Sound quality is amazing and very comfortable to wear.</p>
                </div>
                @endfor
                
                <button class="btn btn-outline-primary">
                    <i class="fas fa-comment me-2"></i>Write a Review
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Related Products -->
<div>
    <h3 class="page-title fw-bold mb-4">Related Products</h3>
    <div class="row g-4">
        @for($i = 1; $i <= 4; $i++)
        <div class="col-lg-3 col-md-6">
            <div class="card product-card">
                <img src="https://images.unsplash.com/photo-1505740420928-5e560c06d30e?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80" 
                     class="card-img-top" alt="Related Product" style="height: 150px; object-fit: cover;">
                <div class="card-body">
                    <h6 class="card-title fw-bold mb-1" style="color: var(--lapis-lazuli);">Related Product {{ $i }}</h6>
                    <div class="d-flex justify-content-between align-items-center">
                        <span class="h5 mb-0" style="color: var(--burgundy);">Rp {{ number_format(rand(50000, 500000), 0, ',', '.') }}</span>
                        <button class="btn btn-sm" style="background: var(--cherry-blossom); color: var(--burgundy);">
                            <i class="fas fa-cart-plus"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
        @endfor
    </div>
</div>

<script>
    // Quantity controls
    document.getElementById('decrement').addEventListener('click', function() {
        const input = document.getElementById('quantity');
        let value = parseInt(input.value);
        if (value > 1) {
            input.value = value - 1;
        }
    });
    
    document.getElementById('increment').addEventListener('click', function() {
        const input = document.getElementById('quantity');
        let value = parseInt(input.value);
        input.value = value + 1;
    });
    
    // Thumbnail click
    document.querySelectorAll('.cursor-pointer').forEach(img => {
        img.addEventListener('click', function() {
            const mainImg = document.querySelector('.card-body img');
            mainImg.src = this.src;
            mainImg.style.borderColor = 'var(--cherry-blossom)';
            
            // Add animation
            mainImg.style.transform = 'scale(0.95)';
            setTimeout(() => {
                mainImg.style.transform = 'scale(1)';
            }, 150);
        });
    });
    
    // Add to cart
    document.querySelector('.btn-primary.flex-grow-1').addEventListener('click', function() {
        const quantity = document.getElementById('quantity').value;
        const productName = document.querySelector('h1').textContent;
        const price = document.querySelector('h2').textContent;
        
        Swal.fire({
            title: 'Added to Cart!',
            html: `<strong>${productName}</strong><br>Quantity: ${quantity}<br>${price}`,
            icon: 'success',
            showConfirmButton: true,
            confirmButtonText: 'View Cart',
            showCancelButton: true,
            cancelButtonText: 'Continue Shopping',
            background: 'var(--misty-rose)',
            color: 'var(--burgundy)',
            confirmButtonColor: 'var(--burgundy)'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = '{{ route("cart") }}';
            }
        });
    });
</script>

<style>
    .cursor-pointer {
        cursor: pointer;
        transition: all 0.3s ease;
    }
    
    .cursor-pointer:hover {
        transform: scale(1.05);
        border-color: var(--burgundy) !important;
    }
    
    .nav-tabs .nav-link {
        border: none;
        color: var(--silver-lake);
        font-weight: 500;
        padding: 0.75rem 1.5rem;
        border-radius: 8px 8px 0 0;
    }
    
    .nav-tabs .nav-link.active {
        color: var(--burgundy);
        border-bottom: 3px solid var(--cherry-blossom);
        background-color: rgba(242, 174, 188, 0.1);
    }
    
    .input-group .btn {
        width: 40px;
        border-color: var(--silver-lake);
        color: var(--silver-lake);
    }
    
    .input-group .btn:hover {
        background-color: var(--light-blue);
    }
    
    .table-bordered {
        border-color: var(--cherry-blossom);
    }
    
    .table-bordered td {
        border-color: var(--cherry-blossom);
    }
    
    .btn-outline-danger {
        border-color: var(--cherry-blossom);
        color: var(--burgundy);
    }
    
    .btn-outline-danger:hover {
        background-color: var(--cherry-blossom);
        color: var(--burgundy);
    }
</style>
@endsection