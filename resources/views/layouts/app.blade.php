<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'BUNNYPOPS') - {{ config('app.name', 'BUNNYPOPS') }}</title>
    
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@400;500;600&display=swap" rel="stylesheet">
    
    <style>
        :root {
            --burgundy: #6C0820;
            --cherry-blossom: #F2AEBC;
            --misty-rose: #F2DCDB;
            --silver-lake: #5A86CB;
            --lapis-lazuli: #3D5D91;
            --dark-burgundy: #5A061A;
            --light-cherry: #F8C8D4;
            --light-blue: #E8EEF7;
        }
        
        body {
            font-family: 'Poppins', sans-serif;
            background-color: var(--misty-rose);
            color: #333;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }
        
        .navbar-brand {
            font-family: 'Quicksand', sans-serif;
            font-weight: 700;
            color: var(--burgundy) !important;
            font-size: 1.5rem;
        }
        
        .navbar {
            background: linear-gradient(135deg, #ffffff, #f9f9f9) !important;
            box-shadow: 0 2px 15px rgba(108, 8, 32, 0.1);
        }
        
        .navbar-nav .nav-link {
            font-weight: 500;
            padding: 0.5rem 1rem;
            transition: all 0.3s ease;
            color: var(--lapis-lazuli) !important;
        }
        
        .navbar-nav .nav-link:hover {
            color: var(--burgundy) !important;
            transform: translateY(-2px);
        }
        
        .navbar-nav .nav-link.active {
            color: var(--burgundy) !important;
            font-weight: 600;
            position: relative;
        }
        
        .navbar-nav .nav-link.active::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 1rem;
            right: 1rem;
            height: 3px;
            background-color: var(--cherry-blossom);
            border-radius: 2px;
        }
        
        .main-content {
            flex: 1;
            padding-top: 2rem;
            padding-bottom: 2rem;
        }
        
        .footer {
            background: linear-gradient(135deg, var(--lapis-lazuli), var(--silver-lake));
            color: white;
            padding: 2rem 0;
            margin-top: auto;
        }
        
        .card {
            border: none;
            border-radius: 15px;
            box-shadow: 0 5px 20px rgba(108, 8, 32, 0.08);
            background: white;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        
        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(108, 8, 32, 0.12);
        }
        
        .btn-primary {
            background: linear-gradient(135deg, var(--burgundy), var(--dark-burgundy));
            border: none;
            padding: 0.5rem 1.5rem;
            border-radius: 10px;
            font-weight: 500;
            transition: all 0.3s ease;
        }
        
        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(108, 8, 32, 0.3);
            background: linear-gradient(135deg, var(--dark-burgundy), var(--burgundy));
        }
        
        .btn-secondary {
            background: linear-gradient(135deg, var(--cherry-blossom), var(--light-cherry));
            border: none;
            color: var(--burgundy);
            font-weight: 500;
        }
        
        .btn-outline-primary {
            border: 2px solid var(--burgundy);
            color: var(--burgundy);
        }
        
        .btn-outline-primary:hover {
            background-color: var(--burgundy);
            color: white;
        }
        
        .badge {
            border-radius: 10px;
            padding: 0.35em 0.65em;
            font-weight: 500;
        }
        
        .badge-primary {
            background-color: var(--burgundy) !important;
        }
        
        .badge-secondary {
            background-color: var(--cherry-blossom) !important;
            color: var(--burgundy);
        }
        
        .text-primary {
            color: var(--burgundy) !important;
        }
        
        .text-secondary {
            color: var(--silver-lake) !important;
        }
        
        .bg-primary {
            background-color: var(--burgundy) !important;
        }
        
        .bg-light {
            background-color: var(--light-blue) !important;
        }
        
        .border-primary {
            border-color: var(--burgundy) !important;
        }
        
        .page-title {
            font-family: 'Quicksand', sans-serif;
            color: var(--burgundy);
            position: relative;
            padding-bottom: 10px;
        }
        
        .page-title::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 60px;
            height: 3px;
            background: linear-gradient(90deg, var(--burgundy), var(--cherry-blossom));
            border-radius: 2px;
        }
        
        .category-card {
            background: linear-gradient(135deg, white, #fefefe);
            border: 2px solid transparent;
        }
        
        .category-card:hover {
            border-color: var(--cherry-blossom);
            background: linear-gradient(135deg, white, #fff5f7);
        }
        
        .product-card {
            overflow: hidden;
            border: 2px solid transparent;
        }
        
        .product-card:hover {
            border-color: var(--cherry-blossom);
        }
        
        .cart-badge {
            background: linear-gradient(135deg, var(--cherry-blossom), var(--light-cherry));
            color: var(--burgundy);
            font-weight: 600;
        }
    </style>
    
    @stack('styles')
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-light py-3">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center" href="{{ url('/') }}">
                <i class="fas fa-bunny me-2" style="color: var(--burgundy);"></i>
                <span>BUNNYPOPS</span>
            </a>
            
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('/') ? 'active' : '' }}" href="{{ url('/') }}">
                            <i class="fas fa-home me-1"></i> Home
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('shop') ? 'active' : '' }}" href="{{ route('shop') }}">
                            <i class="fas fa-shopping-bag me-1"></i> Shop
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('about') ? 'active' : '' }}" href="{{ route('about') }}">
                            <i class="fas fa-info-circle me-1"></i> About
                        </a>
                    </li>
                </ul>
                
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link position-relative" href="{{ route('cart') }}">
                            <i class="fas fa-shopping-cart"></i>
                            <span class="cart-badge badge rounded-pill position-absolute top-0 start-100 translate-middle">
                                {{ auth()->check() ? auth()->user()->carts()->count() : 0 }}
                            </span>
                        </a>
                    </li>
                    
                    @auth
                        @if(auth()->user()->is_admin)
                            <li class="nav-item">
                                <a class="nav-link {{ request()->is('admin*') ? 'active' : '' }}" href="{{ route('admin.dashboard') }}">
                                    <i class="fas fa-tachometer-alt me-1"></i> Dashboard
                                </a>
                            </li>
                        @else
                            <li class="nav-item">
                                <a class="nav-link {{ request()->is('transactions*') ? 'active' : '' }}" href="{{ route('transactions.index') }}">
                                    <i class="fas fa-history me-1"></i> Orders
                                </a>
                            </li>
                        @endif
                        
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                                <i class="fas fa-user me-1" style="color: var(--silver-lake);"></i> {{ Auth::user()->name }}
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li>
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button type="submit" class="dropdown-item">
                                            <i class="fas fa-sign-out-alt me-2"></i> Logout
                                        </button>
                                    </form>
                                </li>
                            </ul>
                        </li>
                    @else
                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('login') ? 'active' : '' }}" href="{{ route('login') }}">
                                <i class="fas fa-sign-in-alt me-1"></i> Login
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('register') ? 'active' : '' }}" href="{{ route('register') }}">
                                <i class="fas fa-user-plus me-1"></i> Register
                            </a>
                        </li>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="main-content">
        <div class="container">
            @yield('content')
        </div>
    </main>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="row">
                <div class="col-md-4 mb-4">
                    <h5 class="mb-3">
                        <i class="fas fa-bunny me-2"></i>
                        BUNNYPOPS
                    </h5>
                    <p class="mb-0">Your favorite online shop for quality products. Experience shopping with style and comfort.</p>
                </div>
                <div class="col-md-4 mb-4">
                    <h5 class="mb-3">Quick Links</h5>
                    <ul class="list-unstyled">
                        <li><a href="{{ url('/') }}" class="text-white text-decoration-none">Home</a></li>
                        <li><a href="{{ route('shop') }}" class="text-white text-decoration-none">Shop</a></li>
                        <li><a href="{{ route('about') }}" class="text-white text-decoration-none">About Us</a></li>
                        <li><a href="{{ route('cart') }}" class="text-white text-decoration-none">My Cart</a></li>
                    </ul>
                </div>
                <div class="col-md-4 mb-4">
                    <h5 class="mb-3">Contact Us</h5>
                    <p class="mb-2">
                        <i class="fas fa-envelope me-2"></i>
                        hello@bunnypops.com
                    </p>
                    <p class="mb-2">
                        <i class="fas fa-phone me-2"></i>
                        +62 812 3456 7890
                    </p>
                    <p class="mb-0">
                        <i class="fas fa-map-marker-alt me-2"></i>
                        Jakarta, Indonesia
                    </p>
                </div>
            </div>
            <hr class="my-4" style="border-color: rgba(255,255,255,0.2);">
            <div class="text-center">
                <p class="mb-0">&copy; {{ date('Y') }} BUNNYPOPS. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <!-- Bootstrap JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
    <script>
        // SweetAlert for notifications
        @if(session('success'))
            Swal.fire({
                icon: 'success',
                title: 'Success!',
                text: '{{ session('success') }}',
                timer: 3000,
                showConfirmButton: false,
                background: 'var(--misty-rose)',
                color: 'var(--burgundy)'
            });
        @endif

        @if(session('error'))
            Swal.fire({
                icon: 'error',
                title: 'Error!',
                text: '{{ session('error') }}',
                timer: 3000,
                showConfirmButton: false,
                background: 'var(--misty-rose)',
                color: 'var(--burgundy)'
            });
        @endif

        @if($errors->any())
            Swal.fire({
                icon: 'error',
                title: 'Validation Error!',
                html: `@foreach($errors->all() as $error)<p>{{ $error }}</p>@endforeach`,
                timer: 5000,
                background: 'var(--misty-rose)',
                color: 'var(--burgundy)'
            });
        @endif
    </script>
    
    @stack('scripts')
</body>
</html>