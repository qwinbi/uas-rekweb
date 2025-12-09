<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Welcome') - {{ config('app.name', 'BUNNYPOPS') }}</title>
    
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
            --light-pink: #FCF5F6;
        }
        
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, var(--misty-rose), var(--light-pink));
            color: #333;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }
        
        .guest-container {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem 0;
        }
        
        .guest-header {
            background: linear-gradient(135deg, var(--lapis-lazuli), var(--silver-lake));
            padding: 2rem 0;
            box-shadow: 0 2px 15px rgba(108, 8, 32, 0.1);
        }
        
        .brand-logo {
            font-family: 'Quicksand', sans-serif;
            font-weight: 700;
            color: white !important;
            font-size: 1.8rem;
            text-decoration: none;
        }
        
        .brand-logo:hover {
            color: var(--cherry-blossom) !important;
        }
        
        .card {
            border: none;
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(108, 8, 32, 0.1);
            background: white;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            overflow: hidden;
        }
        
        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 35px rgba(108, 8, 32, 0.15);
        }
        
        .btn-primary {
            background: linear-gradient(135deg, var(--burgundy), var(--dark-burgundy));
            border: none;
            padding: 0.75rem 2rem;
            border-radius: 10px;
            font-weight: 500;
            transition: all 0.3s ease;
        }
        
        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(108, 8, 32, 0.3);
            background: linear-gradient(135deg, var(--dark-burgundy), var(--burgundy));
        }
        
        .btn-outline-primary {
            border: 2px solid var(--burgundy);
            color: var(--burgundy);
            font-weight: 500;
        }
        
        .btn-outline-primary:hover {
            background-color: var(--burgundy);
            color: white;
        }
        
        .form-control {
            border: 2px solid var(--light-blue);
            border-radius: 10px;
            padding: 0.75rem;
            transition: all 0.3s ease;
        }
        
        .form-control:focus {
            border-color: var(--cherry-blossom);
            box-shadow: 0 0 0 0.25rem rgba(242, 174, 188, 0.25);
        }
        
        .text-primary {
            color: var(--burgundy) !important;
        }
        
        .text-secondary {
            color: var(--silver-lake) !important;
        }
        
        .link-primary {
            color: var(--burgundy);
            text-decoration: none;
            font-weight: 500;
            transition: all 0.3s ease;
        }
        
        .link-primary:hover {
            color: var(--dark-burgundy);
            text-decoration: underline;
        }
        
        .footer {
            background: linear-gradient(135deg, var(--lapis-lazuli), var(--silver-lake));
            color: white;
            padding: 1.5rem 0;
            margin-top: auto;
        }
        
        .auth-image {
            background: linear-gradient(135deg, rgba(242, 174, 188, 0.2), rgba(90, 134, 203, 0.2));
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem;
        }
        
        .auth-icon {
            font-size: 4rem;
            color: var(--burgundy);
            opacity: 0.8;
        }
        
        .form-label {
            font-weight: 500;
            color: var(--lapis-lazuli);
        }
        
        .input-group-text {
            background-color: var(--light-blue);
            border: 2px solid var(--light-blue);
            color: var(--silver-lake);
        }
        
        .nav-tabs .nav-link {
            color: var(--silver-lake);
            font-weight: 500;
            border: none;
        }
        
        .nav-tabs .nav-link.active {
            color: var(--burgundy);
            border-bottom: 3px solid var(--cherry-blossom);
            background: none;
        }
        
        .social-login-btn {
            border: 2px solid var(--light-blue);
            border-radius: 10px;
            padding: 0.75rem;
            color: var(--lapis-lazuli);
            transition: all 0.3s ease;
        }
        
        .social-login-btn:hover {
            border-color: var(--cherry-blossom);
            background-color: rgba(242, 174, 188, 0.1);
            color: var(--burgundy);
        }
        
        .divider {
            display: flex;
            align-items: center;
            text-align: center;
            color: var(--silver-lake);
        }
        
        .divider::before,
        .divider::after {
            content: '';
            flex: 1;
            border-bottom: 2px solid var(--light-blue);
        }
        
        .divider::before {
            margin-right: 1rem;
        }
        
        .divider::after {
            margin-left: 1rem;
        }
    </style>
    
    @stack('styles')
</head>
<body>
    <!-- Header -->
    <header class="guest-header">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center">
                <a class="brand-logo d-flex align-items-center" href="{{ url('/') }}">
                    <i class="fas fa-bunny me-2"></i>
                    BUNNYPOPS
                </a>
                <div>
                    <a href="{{ url('/') }}" class="btn btn-outline-light btn-sm me-2">
                        <i class="fas fa-home me-1"></i> Home
                    </a>
                    <a href="{{ route('shop') }}" class="btn btn-outline-light btn-sm">
                        <i class="fas fa-store me-1"></i> Shop
                    </a>
                </div>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="guest-container">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-10 col-lg-8">
                    @yield('content')
                </div>
            </div>
        </div>
    </main>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <p class="mb-0">
                        <i class="fas fa-bunny me-2"></i>
                        &copy; {{ date('Y') }} BUNNYPOPS. All rights reserved.
                    </p>
                </div>
                <div class="col-md-6 text-end">
                    <a href="{{ route('about') }}" class="text-white text-decoration-none me-3">About</a>
                    <a href="#" class="text-white text-decoration-none me-3">Privacy Policy</a>
                    <a href="#" class="text-white text-decoration-none">Terms of Service</a>
                </div>
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
                background: 'var(--light-pink)',
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
                background: 'var(--light-pink)',
                color: 'var(--burgundy)'
            });
        @endif

        @if($errors->any())
            Swal.fire({
                icon: 'error',
                title: 'Validation Error!',
                html: `@foreach($errors->all() as $error)<p>{{ $error }}</p>@endforeach`,
                timer: 5000,
                background: 'var(--light-pink)',
                color: 'var(--burgundy)'
            });
        @endif
    </script>
    
    @stack('scripts')
</body>
</html>