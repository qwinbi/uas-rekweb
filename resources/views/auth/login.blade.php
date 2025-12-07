@extends('layouts.guest')

@section('title', 'Login')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-5">
            <div class="card border-0 shadow-lg" style="background: white;">
                <div class="card-body p-5">
                    <div class="text-center mb-4">
                        <div class="icon-wrapper mb-3">
                            <i class="fas fa-bunny fa-3x" style="color: var(--burgundy);"></i>
                        </div>
                        <h2 class="fw-bold" style="color: var(--burgundy);">
                            Welcome Back
                        </h2>
                        <p class="text-muted">Sign in to your BUNNYPOPS account</p>
                    </div>
                    
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        
                        <div class="mb-4">
                            <label for="email" class="form-label" style="color: var(--lapis-lazuli);">Email Address</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0">
                                    <i class="fas fa-envelope" style="color: var(--silver-lake);"></i>
                                </span>
                                <input type="email" class="form-control @error('email') is-invalid @enderror" 
                                       id="email" name="email" value="{{ old('email') }}" 
                                       placeholder="Enter your email" required autofocus>
                            </div>
                            @error('email')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="mb-4">
                            <label for="password" class="form-label" style="color: var(--lapis-lazuli);">Password</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0">
                                    <i class="fas fa-lock" style="color: var(--silver-lake);"></i>
                                </span>
                                <input type="password" class="form-control @error('password') is-invalid @enderror" 
                                       id="password" name="password" placeholder="Enter your password" required>
                                <button class="btn btn-outline-secondary" type="button" id="togglePassword">
                                    <i class="fas fa-eye"></i>
                                </button>
                            </div>
                            @error('password')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="mb-4 d-flex justify-content-between align-items-center">
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="remember" name="remember">
                                <label class="form-check-label" for="remember" style="color: var(--lapis-lazuli);">Remember me</label>
                            </div>
                            <a href="#" class="text-decoration-none" style="color: var(--silver-lake);">Forgot password?</a>
                        </div>
                        
                        <div class="d-grid mb-3">
                            <button type="submit" class="btn btn-primary btn-lg">
                                <i class="fas fa-sign-in-alt me-2"></i>Sign In
                            </button>
                        </div>
                        
                        <!-- Social Login -->
                        <div class="text-center mb-4">
                            <p class="text-muted mb-3">Or continue with</p>
                            <div class="d-flex justify-content-center gap-3">
                                <button type="button" class="btn btn-outline-primary">
                                    <i class="fab fa-google me-2"></i>Google
                                </button>
                                <button type="button" class="btn btn-outline-primary">
                                    <i class="fab fa-facebook me-2"></i>Facebook
                                </button>
                            </div>
                        </div>
                        
                        <!-- Register Link -->
                        <div class="text-center">
                            <p class="mb-0" style="color: var(--lapis-lazuli);">
                                Don't have an account? 
                                <a href="{{ route('register') }}" class="text-decoration-none fw-semibold" style="color: var(--burgundy);">
                                    Sign Up
                                </a>
                            </p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.getElementById('togglePassword').addEventListener('click', function() {
        const passwordInput = document.getElementById('password');
        const icon = this.querySelector('i');
        
        if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
            icon.classList.remove('fa-eye');
            icon.classList.add('fa-eye-slash');
            this.style.borderColor = 'var(--burgundy)';
        } else {
            passwordInput.type = 'password';
            icon.classList.remove('fa-eye-slash');
            icon.classList.add('fa-eye');
            this.style.borderColor = '';
        }
    });
</script>

<style>
    .icon-wrapper {
        width: 80px;
        height: 80px;
        background: linear-gradient(135deg, rgba(242, 174, 188, 0.1), rgba(108, 8, 32, 0.1));
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto;
    }
    
    .input-group .btn-outline-secondary {
        border-color: var(--silver-lake);
        color: var(--silver-lake);
    }
    
    .input-group .btn-outline-secondary:hover {
        background-color: var(--light-blue);
        color: var(--burgundy);
    }
    
    .form-check-input:checked {
        background-color: var(--burgundy);
        border-color: var(--burgundy);
    }
    
    .btn-outline-primary {
        border-color: var(--silver-lake);
        color: var(--silver-lake);
    }
    
    .btn-outline-primary:hover {
        background-color: var(--light-blue);
        color: var(--burgundy);
        border-color: var(--burgundy);
    }
    
    .card {
        border: 2px solid transparent;
    }
    
    .card:hover {
        border-color: var(--cherry-blossom);
    }
</style>
@endsection