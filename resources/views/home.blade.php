@extends('layouts.app')

@section('title', 'Home')

@section('content')
<!-- Hero Section -->
<section class="hero-section mb-5">
    <div class="row align-items-center">
        <div class="col-lg-6">
            <h1 class="display-4 fw-bold mb-3">
                Welcome to <span class="text-primary">BUNNYPOPS</span>
            </h1>
            <p class="lead mb-4" style="color: var(--lapis-lazuli);">
                Discover amazing products at unbeatable prices. Quality products with fast delivery and excellent customer service.
            </p>
            <a href="{{ route('shop') }}" class="btn btn-primary btn-lg px-4 me-3">
                <i class="fas fa-shopping-bag me-2"></i>Shop Now
            </a>
            <a href="{{ route('about') }}" class="btn btn-outline-primary btn-lg px-4">
                <i class="fas fa-info-circle me-2"></i>Learn More
            </a>
        </div>
        <div class="col-lg-6">
            <img src="https://images.unsplash.com/photo-1607082348824-0a96f2a4b9da?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" 
                 alt="Hero Image" class="img-fluid rounded-3 shadow" style="border: 3px solid var(--cherry-blossom);">
        </div>
    </div>
</section>

<!-- Featured Categories -->
<section class="mb-5">
    <h2 class="page-title fw-bold mb-4">Featured Categories</h2>
    
    <div class="row g-4">
        @php
            $categories = [
                ['icon' => 'fas fa-tshirt', 'name' => 'Fashion', 'count' => '50+ Products'],
                ['icon' => 'fas fa-laptop', 'name' => 'Electronics', 'count' => '30+ Products'],
                ['icon' => 'fas fa-home', 'name' => 'Home & Living', 'count' => '40+ Products'],
                ['icon' => 'fas fa-heart', 'name' => 'Beauty', 'count' => '25+ Products'],
            ];
        @endphp
        
        @foreach($categories as $category)
        <div class="col-md-3 col-sm-6">
            <div class="card category-card text-center border-0 h-100">
                <div class="card-body p-4">
                    <div class="icon-wrapper mb-3">
                        <i class="{{ $category['icon'] }} fa-3x" style="color: var(--silver-lake);"></i>
                    </div>
                    <h5 class="fw-bold mb-2" style="color: var(--burgundy);">{{ $category['name'] }}</h5>
                    <p class="text-muted mb-0">{{ $category['count'] }}</p>
                    <a href="{{ route('shop') }}" class="btn btn-sm btn-secondary mt-3">
                        Browse <i class="fas fa-arrow-right ms-1"></i>
                    </a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</section>

<!-- Featured Products -->
<section class="mb-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="page-title fw-bold">Featured Products</h2>
        <a href="{{ route('shop') }}" class="btn btn-outline-primary">View All <i class="fas fa-arrow-right ms-1"></i></a>
    </div>
    
    <div class="row g-4">
        @for($i = 1; $i <= 8; $i++)
        <div class="col-lg-3 col-md-4 col-sm-6">
            <div class="card product-card h-100">
                <div class="position-relative">
                    <img src="https://images.unsplash.com/photo-1505740420928-5e560c06d30e?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80" 
                         class="card-img-top" alt="Product {{ $i }}" style="height: 200px; object-fit: cover;">
                    @if($i % 3 == 0)
                    <span class="badge bg-primary position-absolute top-0 end-0 m-2">Sale</span>
                    @elseif($i % 2 == 0)
                    <span class="badge bg-secondary position-absolute top-0 end-0 m-2">New</span>
                    @endif
                </div>
                <div class="card-body">
                    <h6 class="card-title fw-bold mb-1" style="color: var(--lapis-lazuli);">Product Name {{ $i }}</h6>
                    <p class="card-text text-muted small mb-3">High quality product with excellent features.</p>
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
</section>

<!-- Banner -->
<section class="mb-5">
    <div class="card border-0" style="background: linear-gradient(135deg, var(--light-cherry), var(--cherry-blossom));">
        <div class="card-body p-5">
            <div class="row align-items-center">
                <div class="col-lg-8">
                    <h3 class="fw-bold mb-2" style="color: var(--burgundy);">Summer Sale! Up to 50% Off</h3>
                    <p class="mb-0" style="color: var(--dark-burgundy);">Limited time offer on selected items. Shop now before it's too late!</p>
                </div>
                <div class="col-lg-4 text-end">
                    <a href="{{ route('shop') }}" class="btn btn-primary btn-lg">
                        Shop Now <i class="fas fa-arrow-right ms-2"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Testimonials -->
<section class="mb-5">
    <h2 class="page-title fw-bold text-center mb-5">What Our Customers Say</h2>
    
    <div class="row">
        @for($i = 1; $i <= 3; $i++)
        <div class="col-md-4">
            <div class="card testimonial-card border-0 h-100">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center mb-3">
                        <img src="https://i.pravatar.cc/150?img={{ $i + 10 }}" 
                             alt="Customer" class="rounded-circle me-3" width="60" style="border: 3px solid var(--cherry-blossom);">
                        <div>
                            <h6 class="fw-bold mb-0" style="color: var(--lapis-lazuli);">Customer {{ $i }}</h6>
                            <div class="text-warning small">
                                @for($j = 1; $j <= 5; $j++)
                                <i class="fas fa-star"></i>
                                @endfor
                            </div>
                        </div>
                    </div>
                    <p class="card-text" style="color: var(--lapis-lazuli);">
                        "Excellent service and quality products! Fast delivery and great customer support."
                    </p>
                </div>
            </div>
        </div>
        @endfor
    </div>
</section>

<!-- Newsletter -->
<section>
    <div class="card border-0" style="background: linear-gradient(135deg, var(--lapis-lazuli), var(--silver-lake));">
        <div class="card-body p-5 text-center text-white">
            <h3 class="fw-bold mb-3">Subscribe to Our Newsletter</h3>
            <p class="mb-4">Get updates on new products and exclusive offers!</p>
            <div class="row justify-content-center">
                <div class="col-lg-6">
                    <div class="input-group">
                        <input type="email" class="form-control" placeholder="Enter your email">
                        <button class="btn" style="background: var(--cherry-blossom); color: var(--burgundy); font-weight: 600;">
                            Subscribe
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
    .hero-section {
        padding: 3rem 0;
    }
    
    .icon-wrapper {
        width: 80px;
        height: 80px;
        background: rgba(90, 134, 203, 0.1);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto;
    }
    
    .testimonial-card {
        background: white;
        transition: transform 0.3s ease;
    }
    
    .testimonial-card:hover {
        transform: translateY(-5px);
    }
    
    .input-group .form-control {
        border: 2px solid transparent;
        padding: 0.75rem;
    }
    
    .input-group .form-control:focus {
        border-color: var(--cherry-blossom);
        box-shadow: 0 0 0 0.25rem rgba(242, 174, 188, 0.25);
    }
    
    .input-group .btn {
        border: 2px solid transparent;
        padding: 0.75rem 1.5rem;
    }
</style>

<script>
    // Newsletter subscription
    document.querySelector('.newsletter-form button').addEventListener('click', function() {
        const email = this.parentElement.querySelector('input').value;
        if (email) {
            Swal.fire({
                title: 'Thank You!',
                text: 'You have successfully subscribed to our newsletter.',
                icon: 'success',
                confirmButtonColor: 'var(--burgundy)',
                background: 'var(--misty-rose)',
                color: 'var(--burgundy)'
            });
        }
    });
</script>
@endsection