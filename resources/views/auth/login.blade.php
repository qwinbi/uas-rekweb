@extends('layouts.guest')

@section('title', 'Login')

@section('content')
<div class="row align-items-center">
    <!-- Left Column - Form -->
    <div class="col-lg-6">
        <div class="card border-0">
            <div class="card-body p-5">
                <div class="text-center mb-4">
                    <div class="icon-wrapper mb-3">
                        <i class="fas fa-bunny fa-3x" style="color: var(--burgundy);"></i>
                    </div>
                    <h2 class="fw-bold mb-2" style="color: var(--burgundy);">
                        Welcome Back
                    </h2>
                    <p class="text-muted">Sign in to your BUNNYPOPS account</p>
                </div>
                
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    
                    <!-- Email -->
                    <div class="mb-4">
                        <label for="email" class="form-label">Email Address</label>
                        <div class="input-group">
                            <span class="input-group-text">
                                <i class="fas fa-envelope"></i>
                            </span>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" 
                                   id="email" name="email" value="{{ old('email') }}" 
                                   placeholder="Enter your email" required autofocus>
                        </div>
                        @error('email')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <!-- Password -->
                    <div class="mb-4">
                        <label for="password" class="form-label">Password</label>
                        <div class="input-group">
                            <span class="input-group-text">
                                <i class="fas fa-lock"></i>
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
                    
                    <!-- Remember & Forgot Password -->
                    <div class="mb-4 d-flex justify-content-between align-items-center">
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="remember" name="remember">
                            <label class="form-check-label" for="remember">Remember me</label>
                        </div>
                        <a href="#" class="link-primary">Forgot password?</a>
                    </div>
                    
                    <!-- Submit Button -->
                    <div class="d-grid mb-4">
                        <button type="submit" class="btn btn-primary btn-lg">
                            <i class="fas fa-sign-in-alt me-2"></i>Sign In
                        </button>
                    </div>
                    
                    <!-- Divider -->
                    <div class="divider mb-4">
                        <span>Or continue with</span>
                    </div>
                    
                    <!-- Social Login -->
                    <div class="row g-2 mb-4">
                        <div class="col-6">
                            <button type="button" class="btn social-login-btn w-100">
                                <i class="fab fa-google me-2"></i>Google
                            </button>
                        </div>
                        <div class="col-6">
                            <button type="button" class="btn social-login-btn w-100">
                                <i class="fab fa-facebook me-2"></i>Facebook
                            </button>
                        </div>
                    </div>
                    
                    <!-- Register Link -->
                    <div class="text-center">
                        <p class="mb-0" style="color: var(--lapis-lazuli);">
                            Don't have an account? 
                            <a href="{{ route('register') }}" class="link-primary fw-semibold">
                                Create Account
                            </a>
                        </p>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
    <!-- Right Column - Image/Info -->
    <div class="col-lg-6 d-none d-lg-block">
        <div class="card border-0">
            <div class="auth-image">
                <div class="text-center">
                    <i class="fas fa-shopping-bag auth-icon mb-4"></i>
                    <h3 class="fw-bold mb-3" style="color: var(--burgundy);">Welcome to BUNNYPOPS</h3>
                    <p class="mb-4" style="color: var(--lapis-lazuli);">
                        Sign in to access your personalized shopping experience, 
                        track orders, and enjoy exclusive member benefits.
                    </p>
                    <div class="features">
                        <div class="d-flex align-items-center mb-2">
                            <i class="fas fa-check-circle me-2" style="color: var(--cherry-blossom);"></i>
                            <span>Fast & secure checkout</span>
                        </div>
                        <div class="d-flex align-items-center mb-2">
                            <i class="fas fa-check-circle me-2" style="color: var(--cherry-blossom);"></i>
                            <span>Order tracking</span>
                        </div>
                        <div class="d-flex align-items-center">
                            <i class="fas fa-check-circle me-2" style="color: var(--cherry-blossom);"></i>
                            <span>Exclusive member discounts</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // Toggle password visibility
    document.getElementById('togglePassword').addEventListener('click', function() {
        const passwordInput = document.getElementById('password');
        const icon = this.querySelector('i');
        
        if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
            icon.classList.remove('fa-eye');
            icon.classList.add('fa-eye-slash');
            this.style.borderColor = 'var(--burgundy)';
            this.style.color = 'var(--burgundy)';
        } else {
            passwordInput.type = 'password';
            icon.classList.remove('fa-eye-slash');
            icon.classList.add('fa-eye');
            this.style.borderColor = '';
            this.style.color = '';
        }
    });
    
    // Forgot password
    document.querySelector('.link-primary[href="#"]').addEventListener('click', function(e) {
        e.preventDefault();
        
        Swal.fire({
            title: 'Reset Password',
            html: `
                <div class="mb-3">
                    <label class="form-label">Enter your email address</label>
                    <input type="email" class="form-control" id="resetEmail" placeholder="email@example.com">
                </div>
            `,
            showCancelButton: true,
            confirmButtonText: 'Send Reset Link',
            confirmButtonColor: 'var(--burgundy)',
            cancelButtonColor: 'var(--silver-lake)',
            background: 'var(--light-pink)',
            color: 'var(--burgundy)',
            preConfirm: () => {
                const email = document.getElementById('resetEmail').value;
                if (!email) {
                    Swal.showValidationMessage('Please enter your email address');
                }
                return { email: email };
            }
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire({
                    title: 'Check Your Email',
                    text: 'We have sent a password reset link to your email address.',
                    icon: 'success',
                    confirmButtonColor: 'var(--burgundy)',
                    background: 'var(--light-pink)',
                    color: 'var(--burgundy)'
                });
            }
        });
    });
    
    // Social login
    document.querySelectorAll('.social-login-btn').forEach(btn => {
        btn.addEventListener('click', function() {
            const provider = this.textContent.trim();
            Swal.fire({
                title: `${provider} Login`,
                text: `Redirecting to ${provider} authentication...`,
                icon: 'info',
                timer: 1500,
                showConfirmButton: false,
                background: 'var(--light-pink)',
                color: 'var(--burgundy)'
            });
        });
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
    
    .features {
        text-align: left;
        display: inline-block;
    }
    
    .features span {
        color: var(--lapis-lazuli);
    }
    
    .btn-outline-secondary {
        border-color: var(--light-blue);
        color: var(--silver-lake);
    }
    
    .btn-outline-secondary:hover {
        background-color: var(--light-blue);
        color: var(--burgundy);
    }
    
    .form-check-input:checked {
        background-color: var(--burgundy);
        border-color: var(--burgundy);
    }
</style>
@endsection