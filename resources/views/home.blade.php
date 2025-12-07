@extends('layouts.app')

@section('title', 'Home')

@section('content')
<!-- Hero Section -->
<section class="hero-section mb-5">
    <div class="row align-items-center">
        <div class="col-lg-6">
            <h1 class="display-4 fw-bold mb-3">
                Welcome to <span class="text-primary">{{ config('app.name') }}</span>
            </h1>
            <p class="lead mb-4">
                Discover amazing products at unbeatable prices. Quality products with fast delivery and excellent customer service.
            </p>
            <a href="{{ route('shop') }}" class="btn btn-primary btn-lg px-4">
                <i class="fas fa-shopping-bag me-2"></i>Shop Now
            </a>
        </div>
        <div class="col-lg-6">
            <img src="https://images.unsplash.com/photo-1607082348824-0a96f2a4b9da?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" 
                 alt="Hero Image" class="img-fluid rounded-3 shadow">
        </div>
    </div>
</section>

<!-- Featured Categories -->
<section class="mb-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold">Featured Categories</h2>
        <a href="{{ route('shop') }}" class="btn btn-outline-primary">View All</a>
    </div>
    
    <div class="row g-4">
        @for($i = 1; $i <= 4; $i++)
        <div class="col-md-3 col-sm-6">
            <div class="card category-card text-center border-0">
                <div class="card-body p-4">
                    <div class="icon-wrapper mb-3">
                        <i class="fas fa-tshirt fa-3x text-primary"></i>
                    </div>
                    <h5 class="fw-bold">Category {{ $i }}</h5>
                    <p class="text-muted mb-0">50+ Products</p>
                </div>
            </div>
        </div>
        @endfor
    </div>
</section>

<!-- Featured Products -->
<section class="mb-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold">Featured Products</h2>
        <a href="{{ route('shop') }}" class="btn btn-outline-primary">View All</a>
    </div>
    
    <div class="row g-4">
        @for($i = 1; $i <= 8; $i++)
        <div class="col-lg-3 col-md-4 col-sm-6">
            <div class="card product-card h-100">
                <div class="position-relative">
                    <img src="https://images.unsplash.com/photo-1505740420928-5e560c06d30e?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80" 
                         class="card-img-top" alt="Product {{ $i }}">
                    <span class="badge bg-success position-absolute top-0 end-0 m-2">New</span>
                </div>
                <div class="card-body">
                    <h6 class="card-title fw-bold">Product Name {{ $i }}</h6>
                    <p class="card-text text-muted small">High quality product with excellent features.</p>
                    <div class="d-flex justify-content-between align-items-center">
                        <span class="h5 text-primary mb-0">Rp {{ number_format(rand(50000, 500000), 0, ',', '.') }}</span>
                        <button class="btn btn-sm btn-outline-primary">
                            <i class="fas fa-cart-plus"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
        @endfor
    </div>
</section>

<!-- Testimonials -->
<section class="mb-5">
    <h2 class="fw-bold text-center mb-5">What Our Customers Say</h2>
    
    <div class="row">
        @for($i = 1; $i <= 3; $i++)
        <div class="col-md-4">
            <div class="card testimonial-card border-0">
                <div class="card-body">
                    <div class="d-flex align-items-center mb-3">
                        <img src="https://i.pravatar.cc/150?img={{ $i }}" 
                             alt="Customer" class="rounded-circle me-3" width="50">
                        <div>
                            <h6 class="fw-bold mb-0">Customer {{ $i }}</h6>
                            <div class="text-warning small">
                                @for($j = 1; $j <= 5; $j++)
                                <i class="fas fa-star"></i>
                                @endfor
                            </div>
                        </div>
                    </div>
                    <p class="card-text">"Excellent service and quality products! Fast delivery and great customer support."</p>
                </div>
            </div>
        </div>
        @endfor
    </div>
</section>

<style>
    .hero-section {
        padding: 4rem 0;
    }
    
    .category-card {
        transition: transform 0.3s ease;
        cursor: pointer;
    }
    
    .category-card:hover {
        transform: translateY(-10px);
    }
    
    .category-card .icon-wrapper {
        width: 80px;
        height: 80px;
        background: linear-gradient(135deg, rgba(67, 97, 238, 0.1), rgba(58, 12, 163, 0.1));
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto;
    }
    
    .product-card {
        border: 1px solid #e0e0e0;
    }
    
    .testimonial-card {
        background: linear-gradient(135deg, #f8f9fa, #e9ecef);
    }
</style>
@endsection