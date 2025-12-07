@extends('layouts.app')

@section('title', 'Shop')

@section('content')
<div class="row">
    <!-- Sidebar Filter -->
    <div class="col-lg-3 mb-4">
        <div class="card border-0 shadow-sm">
            <div class="card-body">
                <h5 class="fw-bold mb-4">Filters</h5>
                
                <!-- Categories -->
                <div class="mb-4">
                    <h6 class="fw-semibold mb-3">Categories</h6>
                    <div class="form-check mb-2">
                        <input class="form-check-input" type="checkbox" id="cat1">
                        <label class="form-check-label" for="cat1">
                            Electronics
                        </label>
                    </div>
                    <div class="form-check mb-2">
                        <input class="form-check-input" type="checkbox" id="cat2">
                        <label class="form-check-label" for="cat2">
                            Fashion
                        </label>
                    </div>
                    <div class="form-check mb-2">
                        <input class="form-check-input" type="checkbox" id="cat3">
                        <label class="form-check-label" for="cat3">
                            Home & Garden
                        </label>
                    </div>
                </div>
                
                <!-- Price Range -->
                <div class="mb-4">
                    <h6 class="fw-semibold mb-3">Price Range</h6>
                    <input type="range" class="form-range" min="0" max="1000000" step="10000" id="priceRange">
                    <div class="d-flex justify-content-between">
                        <span>Rp 0</span>
                        <span>Rp 1,000,000</span>
                    </div>
                </div>
                
                <!-- Sort By -->
                <div class="mb-4">
                    <h6 class="fw-semibold mb-3">Sort By</h6>
                    <select class="form-select">
                        <option>Newest First</option>
                        <option>Price: Low to High</option>
                        <option>Price: High to Low</option>
                        <option>Most Popular</option>
                    </select>
                </div>
                
                <button class="btn btn-primary w-100">
                    <i class="fas fa-filter me-2"></i>Apply Filters
                </button>
            </div>
        </div>
    </div>
    
    <!-- Products Grid -->
    <div class="col-lg-9">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="fw-bold">All Products</h2>
            <div class="d-flex gap-2">
                <div class="input-group" style="width: 300px;">
                    <input type="text" class="form-control" placeholder="Search products...">
                    <button class="btn btn-primary">
                        <i class="fas fa-search"></i>
                    </button>
                </div>
            </div>
        </div>
        
        <div class="row g-4">
            @for($i = 1; $i <= 12; $i++)
            <div class="col-xl-3 col-lg-4 col-md-6">
                <div class="card product-card h-100">
                    <div class="position-relative">
                        <img src="https://images.unsplash.com/photo-1505740420928-5e560c06d30e?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80" 
                             class="card-img-top" alt="Product {{ $i }}" style="height: 200px; object-fit: cover;">
                        @if($i % 3 == 0)
                        <span class="badge bg-danger position-absolute top-0 end-0 m-2">Sale</span>
                        @endif
                    </div>
                    <div class="card-body d-flex flex-column">
                        <h6 class="card-title fw-bold">Product Name {{ $i }}</h6>
                        <p class="card-text text-muted small flex-grow-1">
                            High quality product with excellent features and durability.
                        </p>
                        <div class="d-flex justify-content-between align-items-center mt-auto">
                            <div>
                                <span class="h5 text-primary mb-0">Rp {{ number_format(rand(50000, 500000), 0, ',', '.') }}</span>
                                @if($i % 3 == 0)
                                <small class="text-muted text-decoration-line-through d-block">
                                    Rp {{ number_format(rand(60000, 600000), 0, ',', '.') }}
                                </small>
                                @endif
                            </div>
                            <button class="btn btn-sm btn-outline-primary">
                                <i class="fas fa-cart-plus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-footer bg-transparent border-top-0">
                        <div class="d-flex justify-content-between">
                            <a href="{{ route('product.detail', $i) }}" class="btn btn-sm btn-outline-secondary">
                                <i class="fas fa-eye me-1"></i>View
                            </a>
                            <button class="btn btn-sm btn-outline-primary">
                                <i class="fas fa-shopping-cart me-1"></i>Add to Cart
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            @endfor
        </div>
        
        <!-- Pagination -->
        <nav class="mt-5">
            <ul class="pagination justify-content-center">
                <li class="page-item disabled">
                    <a class="page-link" href="#" tabindex="-1">
                        <i class="fas fa-chevron-left"></i>
                    </a>
                </li>
                <li class="page-item active"><a class="page-link" href="#">1</a></li>
                <li class="page-item"><a class="page-link" href="#">2</a></li>
                <li class="page-item"><a class="page-link" href="#">3</a></li>
                <li class="page-item">
                    <a class="page-link" href="#">
                        <i class="fas fa-chevron-right"></i>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</div>

<style>
    .product-card {
        transition: all 0.3s ease;
        border: 1px solid #e0e0e0;
    }
    
    .product-card:hover {
        box-shadow: 0 10px 25px rgba(0,0,0,0.1);
        transform: translateY(-5px);
        border-color: var(--primary-color);
    }
    
    .card-img-top {
        transition: transform 0.3s ease;
    }
    
    .product-card:hover .card-img-top {
        transform: scale(1.05);
    }
</style>
@endsection