@extends('layouts.app')

@section('title', 'Shop')

@section('content')
<div class="row">
    <!-- Sidebar Filter -->
    <div class="col-lg-3 mb-4">
        <div class="card border-0 shadow-sm">
            <div class="card-body">
                <h5 class="fw-bold mb-4" style="color: var(--burgundy);">
                    <i class="fas fa-filter me-2"></i>Filters
                </h5>
                
                <!-- Categories -->
                <div class="mb-4">
                    <h6 class="fw-semibold mb-3" style="color: var(--lapis-lazuli);">Categories</h6>
                    @foreach(['Electronics', 'Fashion', 'Home & Garden', 'Beauty', 'Books'] as $category)
                    <div class="form-check mb-2">
                        <input class="form-check-input" type="checkbox" id="cat{{ $loop->index }}">
                        <label class="form-check-label" for="cat{{ $loop->index }}">
                            {{ $category }}
                        </label>
                    </div>
                    @endforeach
                </div>
                
                <!-- Price Range -->
                <div class="mb-4">
                    <h6 class="fw-semibold mb-3" style="color: var(--lapis-lazuli);">Price Range</h6>
                    <input type="range" class="form-range" min="0" max="1000000" step="10000" id="priceRange">
                    <div class="d-flex justify-content-between">
                        <small style="color: var(--silver-lake);">Rp 0</small>
                        <small style="color: var(--silver-lake);">Rp 1,000,000</small>
                    </div>
                </div>
                
                <!-- Sort By -->
                <div class="mb-4">
                    <h6 class="fw-semibold mb-3" style="color: var(--lapis-lazuli);">Sort By</h6>
                    <select class="form-select">
                        <option>Newest First</option>
                        <option>Price: Low to High</option>
                        <option>Price: High to Low</option>
                        <option>Most Popular</option>
                    </select>
                </div>
                
                <!-- Colors -->
                <div class="mb-4">
                    <h6 class="fw-semibold mb-3" style="color: var(--lapis-lazuli);">Colors</h6>
                    <div class="d-flex flex-wrap gap-2">
                        @foreach(['#6C0820', '#F2AEBC', '#5A86CB', '#3D5D91', '#000000', '#FFFFFF'] as $color)
                        <div class="color-option" style="background-color: {{ $color }}; {{ $color == '#FFFFFF' ? 'border: 1px solid #ddd;' : '' }}"
                             data-color="{{ $color }}"></div>
                        @endforeach
                    </div>
                </div>
                
                <button class="btn btn-primary w-100">
                    <i class="fas fa-filter me-2"></i>Apply Filters
                </button>
                
                <button class="btn btn-outline-primary w-100 mt-2" id="resetFilters">
                    <i class="fas fa-redo me-2"></i>Reset All
                </button>
            </div>
        </div>
        
        <!-- Special Offers -->
        <div class="card border-0 shadow-sm mt-4" style="background: linear-gradient(135deg, var(--light-cherry), var(--cherry-blossom));">
            <div class="card-body">
                <h6 class="fw-bold mb-3" style="color: var(--burgundy);">
                    <i class="fas fa-gift me-2"></i>Special Offers
                </h6>
                <p class="small mb-0" style="color: var(--dark-burgundy);">
                    Use code <strong>BUNNY10</strong> for 10% off your first order!
                </p>
            </div>
        </div>
    </div>
    
    <!-- Products Grid -->
    <div class="col-lg-9">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="page-title fw-bold">All Products</h2>
            <div class="d-flex gap-2">
                <div class="input-group" style="width: 300px;">
                    <input type="text" class="form-control" placeholder="Search products...">
                    <button class="btn btn-primary">
                        <i class="fas fa-search"></i>
                    </button>
                </div>
                <div class="btn-group">
                    <button class="btn btn-outline-primary active">
                        <i class="fas fa-th-large"></i>
                    </button>
                    <button class="btn btn-outline-primary">
                        <i class="fas fa-list"></i>
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
                        <span class="badge bg-primary position-absolute top-0 end-0 m-2">Sale</span>
                        @endif
                        @if($i % 5 == 0)
                        <span class="badge bg-secondary position-absolute top-0 start-0 m-2">New</span>
                        @endif
                    </div>
                    <div class="card-body d-flex flex-column">
                        <h6 class="card-title fw-bold mb-1" style="color: var(--lapis-lazuli);">Product Name {{ $i }}</h6>
                        <p class="card-text text-muted small flex-grow-1">
                            High quality product with excellent features and durability.
                        </p>
                        <div class="d-flex justify-content-between align-items-center mt-auto">
                            <div>
                                <span class="h5 mb-0" style="color: var(--burgundy);">Rp {{ number_format(rand(50000, 500000), 0, ',', '.') }}</span>
                                @if($i % 3 == 0)
                                <small class="text-muted text-decoration-line-through d-block">
                                    Rp {{ number_format(rand(60000, 600000), 0, ',', '.') }}
                                </small>
                                @endif
                            </div>
                            <button class="btn btn-sm" style="background: var(--cherry-blossom); color: var(--burgundy);">
                                <i class="fas fa-cart-plus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-footer bg-transparent border-top-0 pt-0">
                        <div class="d-flex justify-content-between">
                            <a href="{{ route('product.detail', $i) }}" class="btn btn-sm btn-outline-primary">
                                <i class="fas fa-eye me-1"></i>View
                            </a>
                            <button class="btn btn-sm btn-primary">
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
                    <a class="page-link" href="#" tabindex="-1" style="color: var(--silver-lake);">
                        <i class="fas fa-chevron-left"></i>
                    </a>
                </li>
                <li class="page-item active">
                    <a class="page-link" href="#" style="background-color: var(--burgundy); border-color: var(--burgundy);">1</a>
                </li>
                <li class="page-item">
                    <a class="page-link" href="#" style="color: var(--lapis-lazuli);">2</a>
                </li>
                <li class="page-item">
                    <a class="page-link" href="#" style="color: var(--lapis-lazuli);">3</a>
                </li>
                <li class="page-item">
                    <a class="page-link" href="#" style="color: var(--silver-lake);">
                        <i class="fas fa-chevron-right"></i>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</div>

<style>
    .color-option {
        width: 25px;
        height: 25px;
        border-radius: 50%;
        cursor: pointer;
        transition: transform 0.2s ease;
        border: 2px solid transparent;
    }
    
    .color-option:hover {
        transform: scale(1.1);
        border-color: var(--cherry-blossom);
    }
    
    .color-option.active {
        border-color: var(--burgundy);
        transform: scale(1.1);
    }
    
    .product-card .card-footer {
        padding: 0.75rem 1.25rem 1.25rem;
    }
    
    .btn-group .btn {
        border-color: var(--burgundy);
        color: var(--burgundy);
    }
    
    .btn-group .btn.active {
        background-color: var(--burgundy);
        color: white;
    }
    
    .btn-group .btn:hover {
        background-color: rgba(108, 8, 32, 0.1);
    }
    
    .form-range::-webkit-slider-thumb {
        background-color: var(--burgundy);
    }
    
    .form-range::-moz-range-thumb {
        background-color: var(--burgundy);
    }
    
    .form-check-input:checked {
        background-color: var(--burgundy);
        border-color: var(--burgundy);
    }
    
    .form-select:focus {
        border-color: var(--cherry-blossom);
        box-shadow: 0 0 0 0.25rem rgba(242, 174, 188, 0.25);
    }
</style>

<script>
    // Color selection
    document.querySelectorAll('.color-option').forEach(color => {
        color.addEventListener('click', function() {
            document.querySelectorAll('.color-option').forEach(c => c.classList.remove('active'));
            this.classList.add('active');
        });
    });
    
    // Reset filters
    document.getElementById('resetFilters').addEventListener('click', function() {
        document.querySelectorAll('input[type="checkbox"]').forEach(cb => cb.checked = false);
        document.querySelectorAll('.color-option').forEach(c => c.classList.remove('active'));
        document.getElementById('priceRange').value = 500000;
        
        Swal.fire({
            title: 'Filters Reset',
            text: 'All filters have been reset to default.',
            icon: 'success',
            timer: 1500,
            showConfirmButton: false,
            background: 'var(--misty-rose)',
            color: 'var(--burgundy)'
        });
    });
    
    // Add to cart functionality
    document.querySelectorAll('.product-card .btn-primary').forEach(btn => {
        btn.addEventListener('click', function() {
            const productCard = this.closest('.product-card');
            const productName = productCard.querySelector('.card-title').textContent;
            const price = productCard.querySelector('.h5').textContent;
            
            Swal.fire({
                title: 'Added to Cart!',
                html: `<strong>${productName}</strong><br>${price}`,
                icon: 'success',
                timer: 2000,
                showConfirmButton: false,
                background: 'var(--misty-rose)',
                color: 'var(--burgundy)'
            });
        });
    });
</script>
@endsection