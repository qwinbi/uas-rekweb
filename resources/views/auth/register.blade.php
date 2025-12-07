@extends('layouts.app')

@section('title', 'Register - BUNNYPOPS')

@section('content')
<div class="min-h-[70vh] flex items-center justify-center py-12 px-4">
    <div class="max-w-md w-full">
        <!-- Decorative Elements -->
        <div class="relative mb-8">
            <div class="absolute -top-6 -left-6 w-12 h-12 bg-[#8E7AB5] rounded-full opacity-20"></div>
            <div class="absolute -bottom-6 -right-6 w-12 h-12 bg-[#FF6F61] rounded-full opacity-20"></div>
            
            <!-- Logo Card -->
            <div class="bg-white rounded-2xl shadow-xl p-6 text-center relative z-10" style="background-color: #F9DCC4;">
                <div class="w-20 h-20 mx-auto mb-4 bg-gradient-to-r from-[#8E7AB5] to-[#4D4C7D] rounded-full flex items-center justify-center">
                    <i class="fas fa-user-plus text-white text-4xl"></i>
                </div>
                <h1 class="text-3xl font-bold text-[#4D4C7D] mb-2">Join BUNNYPOPS!</h1>
                <p class="text-[#8E7AB5]">Create your account and start shopping</p>
            </div>
        </div>

        <!-- Register Form -->
        <div class="bg-white rounded-2xl shadow-xl p-8">
            <form method="POST" action="{{ route('register') }}">
                @csrf
                
                <!-- Name -->
                <div class="mb-6">
                    <label for="name" class="block text-[#4D4C7D] font-medium mb-2 flex items-center">
                        <i class="fas fa-user mr-2 text-[#8E7AB5]"></i>
                        Full Name
                    </label>
                    <input type="text" 
                           id="name" 
                           name="name" 
                           value="{{ old('name') }}" 
                           required 
                           autofocus
                           class="w-full px-4 py-3 rounded-lg border-2 border-[#F9DCC4] focus:border-[#FF6F61] focus:ring-2 focus:ring-[#FF6F61]/30 outline-none transition-all bg-[#FCEFEA]"
                           placeholder="John Doe">
                    @error('name')
                        <span class="text-[#FF6F61] text-sm mt-1 flex items-center">
                            <i class="fas fa-exclamation-circle mr-1"></i> {{ $message }}
                        </span>
                    @enderror
                </div>
                
                <!-- Email -->
                <div class="mb-6">
                    <label for="email" class="block text-[#4D4C7D] font-medium mb-2 flex items-center">
                        <i class="fas fa-envelope mr-2 text-[#8E7AB5]"></i>
                        Email Address
                    </label>
                    <input type="email" 
                           id="email" 
                           name="email" 
                           value="{{ old('email') }}" 
                           required
                           class="w-full px-4 py-3 rounded-lg border-2 border-[#F9DCC4] focus:border-[#FF6F61] focus:ring-2 focus:ring-[#FF6F61]/30 outline-none transition-all bg-[#FCEFEA]"
                           placeholder="you@example.com">
                    @error('email')
                        <span class="text-[#FF6F61] text-sm mt-1 flex items-center">
                            <i class="fas fa-exclamation-circle mr-1"></i> {{ $message }}
                        </span>
                    @enderror
                </div>
                
                <!-- Password -->
                <div class="mb-6">
                    <label for="password" class="block text-[#4D4C7D] font-medium mb-2 flex items-center">
                        <i class="fas fa-lock mr-2 text-[#8E7AB5]"></i>
                        Password
                    </label>
                    <div class="relative">
                        <input type="password" 
                               id="password" 
                               name="password" 
                               required
                               class="w-full px-4 py-3 rounded-lg border-2 border-[#F9DCC4] focus:border-[#FF6F61] focus:ring-2 focus:ring-[#FF6F61]/30 outline-none transition-all bg-[#FCEFEA] pr-12"
                               placeholder="••••••••">
                        <button type="button" 
                                class="absolute right-3 top-1/2 transform -translate-y-1/2 text-[#8E7AB5] hover:text-[#FF6F61]"
                                onclick="togglePassword('password')">
                            <i class="fas fa-eye"></i>
                        </button>
                    </div>
                    <p class="text-xs text-[#8E7AB5] mt-1">Minimum 4 characters</p>
                    @error('password')
                        <span class="text-[#FF6F61] text-sm mt-1 flex items-center">
                            <i class="fas fa-exclamation-circle mr-1"></i> {{ $message }}
                        </span>
                    @enderror
                </div>
                
                <!-- Confirm Password -->
                <div class="mb-6">
                    <label for="password_confirmation" class="block text-[#4D4C7D] font-medium mb-2 flex items-center">
                        <i class="fas fa-lock mr-2 text-[#8E7AB5]"></i>
                        Confirm Password
                    </label>
                    <div class="relative">
                        <input type="password" 
                               id="password_confirmation" 
                               name="password_confirmation" 
                               required
                               class="w-full px-4 py-3 rounded-lg border-2 border-[#F9DCC4] focus:border-[#FF6F61] focus:ring-2 focus:ring-[#FF6F61]/30 outline-none transition-all bg-[#FCEFEA] pr-12"
                               placeholder="••••••••">
                        <button type="button" 
                                class="absolute right-3 top-1/2 transform -translate-y-1/2 text-[#8E7AB5] hover:text-[#FF6F61]"
                                onclick="togglePassword('password_confirmation')">
                            <i class="fas fa-eye"></i>
                        </button>
                    </div>
                </div>
                
                <!-- Terms Agreement -->
                <div class="mb-6 flex items-start">
                    <input type="checkbox" 
                           id="terms" 
                           name="terms"
                           required
                           class="w-4 h-4 mt-1 text-[#FF6F61] border-[#F9DCC4] rounded focus:ring-[#FF6F61]">
                    <label for="terms" class="ml-2 text-[#4D4C7D] text-sm">
                        I agree to the 
                        <a href="#" class="text-[#8E7AB5] hover:text-[#FF6F61] font-medium">Terms & Conditions</a>
                        and 
                        <a href="#" class="text-[#8E7AB5] hover:text-[#FF6F61] font-medium">Privacy Policy</a>
                    </label>
                </div>
                
                <!-- Submit Button -->
                <button type="submit" 
                        class="w-full bg-gradient-to-r from-[#8E7AB5] to-[#4D4C7D] text-white py-3 rounded-lg font-bold hover:opacity-90 transition-all shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 mb-6">
                    <i class="fas fa-user-plus mr-2"></i>Create Account
                </button>
                
                <!-- Login Link -->
                <div class="text-center">
                    <p class="text-[#4D4C7D]">
                        Already have an account? 
                        <a href="{{ route('login') }}" 
                           class="text-[#8E7AB5] hover:text-[#FF6F61] font-bold transition-colors ml-1">
                            Login here
                            <i class="fas fa-arrow-right ml-1"></i>
                        </a>
                    </p>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    function togglePassword(fieldId) {
        const field = document.getElementById(fieldId);
        const icon = field.nextElementSibling.querySelector('i');
        
        if (field.type === 'password') {
            field.type = 'text';
            icon.classList.remove('fa-eye');
            icon.classList.add('fa-eye-slash');
        } else {
            field.type = 'password';
            icon.classList.remove('fa-eye-slash');
            icon.classList.add('fa-eye');
        }
    }
    
    // Password strength indicator
    const passwordInput = document.getElementById('password');
    if (passwordInput) {
        passwordInput.addEventListener('input', function() {
            const strengthIndicator = document.getElementById('password-strength');
            if (strengthIndicator) {
                const strength = this.value.length;
                let strengthText = '';
                let strengthColor = '';
                
                if (strength === 0) {
                    strengthText = '';
                } else if (strength < 4) {
                    strengthText = 'Weak';
                    strengthColor = '#FF6F61';
                } else if (strength < 8) {
                    strengthText = 'Fair';
                    strengthColor = '#F9DCC4';
                } else {
                    strengthText = 'Strong';
                    strengthColor = '#8E7AB5';
                }
                
                strengthIndicator.textContent = strengthText;
                strengthIndicator.style.color = strengthColor;
            }
        });
    }
</script>
@endsection