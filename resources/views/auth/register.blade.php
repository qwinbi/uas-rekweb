@extends('layouts.guest')

@section('title', 'Register')

@section('content')
<div class="row align-items-center">
    <!-- Left Column - Image/Info -->
    <div class="col-lg-6 d-none d-lg-block">
        <div class="card border-0">
            <div class="auth-image">
                <div class="text-center">
                    <i class="fas fa-bunny auth-icon mb-4"></i>
                    <h3 class="fw-bold mb-3" style="color: var(--burgundy);">Join BUNNYPOPS</h3>
                    <p class="mb-0" style="color: var(--lapis-lazuli);">
                        Create an account to enjoy exclusive benefits, faster checkout, 
                        and personalized shopping experience.
                    </p>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Right Column - Form -->
    <div class="col-lg-6">
        <div class="card border-0">
            <div class="card-body p-5">
                <div class="text-center mb-4">
                    <h2 class="fw-bold mb-2" style="color: var(--burgundy);">
                        Create Account
                    </h2>
                    <p class="text-muted">Join our community today</p>
                </div>
                
                <form method="POST" action="{{ route('register') }}">
                    @csrf
                    
                    <!-- Name -->
                    <div class="mb-3">
                        <label for="name" class="form-label">Full Name</label>
                        <div class="input-group">
                            <span class="input-group-text">
                                <i class="fas fa-user"></i>
                            </span>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" 
                                   id="name" name="name" value="{{ old('name') }}" 
                                   placeholder="Enter your full name" required autofocus>
                        </div>
                        @error('name')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <!-- Email -->
                    <div class="mb-3">
                        <label for="email" class="form-label">Email Address</label>
                        <div class="input-group">
                            <span class="input-group-text">
                                <i class="fas fa-envelope"></i>
                            </span>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" 
                                   id="email" name="email" value="{{ old('email') }}" 
                                   placeholder="Enter your email" required>
                        </div>
                        @error('email')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <!-- Password -->
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <div class="input-group">
                            <span class="input-group-text">
                                <i class="fas fa-lock"></i>
                            </span>
                            <input type="password" class="form-control @error('password') is-invalid @enderror" 
                                   id="password" name="password" placeholder="Create password" required>
                            <button class="btn btn-outline-secondary" type="button" id="togglePassword">
                                <i class="fas fa-eye"></i>
                            </button>
                        </div>
                        @error('password')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                        <div class="form-text">
                            <small>Must be at least 8 characters with letters and numbers</small>
                        </div>
                    </div>
                    
                    <!-- Confirm Password -->
                    <div class="mb-4">
                        <label for="password_confirmation" class="form-label">Confirm Password</label>
                        <div class="input-group">
                            <span class="input-group-text">
                                <i class="fas fa-lock"></i>
                            </span>
                            <input type="password" class="form-control" 
                                   id="password_confirmation" name="password_confirmation" 
                                   placeholder="Confirm password" required>
                            <button class="btn btn-outline-secondary" type="button" id="toggleConfirmPassword">
                                <i class="fas fa-eye"></i>
                            </button>
                        </div>
                    </div>
                    
                    <!-- Terms Agreement -->
                    <div class="mb-4">
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input @error('terms') is-invalid @enderror" 
                                   id="terms" name="terms" {{ old('terms') ? 'checked' : '' }}>
                            <label class="form-check-label" for="terms">
                                I agree to the 
                                <a href="#" class="link-primary">Terms of Service</a> 
                                and 
                                <a href="#" class="link-primary">Privacy Policy</a>
                            </label>
                            @error('terms')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    
                    <!-- Submit Button -->
                    <div class="d-grid mb-4">
                        <button type="submit" class="btn btn-primary btn-lg">
                            <i class="fas fa-user-plus me-2"></i>Create Account
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
                    
                    <!-- Login Link -->
                    <div class="text-center">
                        <p class="mb-0" style="color: var(--lapis-lazuli);">
                            Already have an account? 
                            <a href="{{ route('login') }}" class="link-primary fw-semibold">
                                Sign In
                            </a>
                        </p>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    // Toggle password visibility
    document.getElementById('togglePassword').addEventListener('click', function() {
        const passwordInput = document.getElementById('password');
        const icon = this.querySelector('i');
        togglePasswordVisibility(passwordInput, icon, this);
    });
    
    document.getElementById('toggleConfirmPassword').addEventListener('click', function() {
        const confirmInput = document.getElementById('password_confirmation');
        const icon = this.querySelector('i');
        togglePasswordVisibility(confirmInput, icon, this);
    });
    
    function togglePasswordVisibility(input, icon, button) {
        if (input.type === 'password') {
            input.type = 'text';
            icon.classList.remove('fa-eye');
            icon.classList.add('fa-eye-slash');
            button.style.borderColor = 'var(--burgundy)';
            button.style.color = 'var(--burgundy)';
        } else {
            input.type = 'password';
            icon.classList.remove('fa-eye-slash');
            icon.classList.add('fa-eye');
            button.style.borderColor = '';
            button.style.color = '';
        }
    }
    
    // Password strength indicator
    document.getElementById('password').addEventListener('input', function() {
        const password = this.value;
        const strength = checkPasswordStrength(password);
        updateStrengthIndicator(strength);
    });
    
    function checkPasswordStrength(password) {
        let score = 0;
        if (password.length >= 8) score++;
        if (/[A-Z]/.test(password)) score++;
        if (/[0-9]/.test(password)) score++;
        if (/[^A-Za-z0-9]/.test(password)) score++;
        return score;
    }
    
    function updateStrengthIndicator(score) {
        let strengthIndicator = document.getElementById('strengthIndicator');
        
        if (!strengthIndicator) {
            strengthIndicator = document.createElement('div');
            strengthIndicator.id = 'strengthIndicator';
            strengthIndicator.className = 'mt-2';
            document.getElementById('password').parentElement.parentElement.appendChild(strengthIndicator);
        }
        
        const strengthText = ['Very Weak', 'Weak', 'Fair', 'Good', 'Strong'];
        const strengthColors = [
            'var(--burgundy)',
            'var(--cherry-blossom)',
            'var(--silver-lake)',
            'var(--lapis-lazuli)',
            'var(--silver-lake)'
        ];
        
        strengthIndicator.innerHTML = `
            <div class="progress" style="height: 5px; background-color: var(--light-blue);">
                <div class="progress-bar" style="width: ${score * 25}%; background-color: ${strengthColors[score]};"></div>
            </div>
            <small style="color: ${strengthColors[score]}; font-weight: 500;">${strengthText[score]}</small>
        `;
    }
    
    // Social login buttons
    document.querySelectorAll('.social-login-btn').forEach(btn => {
        btn.addEventListener('click', function() {
            const provider = this.textContent.trim();
            Swal.fire({
                title: `${provider} Login`,
                text: `Redirecting to ${provider} authentication...`,
                icon: 'info',
                timer: 2000,
                showConfirmButton: false,
                background: 'var(--light-pink)',
                color: 'var(--burgundy)'
            });
        });
    });
</script>

<style>
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
    
    .form-text {
        color: var(--silver-lake);
    }
    
    .progress {
        border-radius: 3px;
        overflow: hidden;
    }
</style>
@endsection