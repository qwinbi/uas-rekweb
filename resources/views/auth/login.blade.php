@extends('layouts.app')

@section('title', 'Login - BUNNYPOPS')

@section('content')
<div class="min-h-[70vh] flex items-center justify-center py-12 px-4">
    <div class="max-w-md w-full">
        <!-- Decorative Elements -->
        <div class="relative mb-8">
            <div class="absolute -top-6 -left-6 w-12 h-12 bg-[#FF6F61] rounded-full opacity-20"></div>
            <div class="absolute -bottom-6 -right-6 w-12 h-12 bg-[#8E7AB5] rounded-full opacity-20"></div>
            
            <!-- Logo Card -->
            <div class="bg-white rounded-2xl shadow-xl p-6 text-center relative z-10" style="background-color: #F9DCC4;">
                <div class="w-20 h-20 mx-auto mb-4 bg-gradient-to-r from-[#FF6F61] to-[#8E7AB5] rounded-full flex items-center justify-center">
                    <i class="fas fa-bunny text-white text-4xl"></i>
                </div>
                <h1 class="text-3xl font-bold text-[#4D4C7D] mb-2">Welcome Back!</h1>
                <p class="text-[#8E7AB5]">Login to your BUNNYPOPS account</p>
            </div>
        </div>

        <!-- Login Form -->
        <div class="bg-white rounded-2xl shadow-xl p-8">
            <form method="POST" action="{{ route('login') }}">
                @csrf
                
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
                           autofocus
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
                    <div class="flex justify-between items-center mb-2">
                        <label for="password" class="block text-[#4D4C7D] font-medium flex items-center">
                            <i class="fas fa-lock mr-2 text-[#8E7AB5]"></i>
                            Password
                        </label>
                        <a href="#" class="text-sm text-[#8E7AB5] hover:text-[#FF6F61] transition-colors">
                            Forgot password?
                        </a>
                    </div>
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
                    @error('password')
                        <span class="text-[#FF6F61] text-sm mt-1 flex items-center">
                            <i class="fas fa-exclamation-circle mr-1"></i> {{ $message }}
                        </span>
                    @enderror
                </div>
                
                <!-- Remember Me -->
                <div class="mb-6 flex items-center">
                    <input type="checkbox" 
                           id="remember" 
                           name="remember"
                           class="w-4 h-4 text-[#FF6F61] border-[#F9DCC4] rounded focus:ring-[#FF6F61]">
                    <label for="remember" class="ml-2 text-[#4D4C7D]">
                        Remember me
                    </label>
                </div>
                
                <!-- Submit Button -->
                <button type="submit" 
                        class="w-full bg-gradient-to-r from-[#FF6F61] to-[#8E7AB5] text-white py-3 rounded-lg font-bold hover:opacity-90 transition-all shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 mb-6">
                    <i class="fas fa-sign-in-alt mr-2"></i>Login
                </button>
                
                <!-- Demo Accounts -->
                <div class="bg-[#FCEFEA] rounded-lg p-4 mb-6 border border-[#F9DCC4]">
                    <p class="font-bold text-[#4D4C7D] mb-2 text-center">Demo Accounts:</p>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-2">
                        <div class="text-center">
                            <p class="text-sm font-medium text-[#4D4C7D]">Admin</p>
                            <p class="text-xs text-[#8E7AB5]">admin@email.com / 1234</p>
                        </div>
                        <div class="text-center">
                            <p class="text-sm font-medium text-[#4D4C7D]">Guest</p>
                            <p class="text-xs text-[#8E7AB5]">user@email.com / 4321</p>
                        </div>
                    </div>
                </div>
                
                <!-- Register Link -->
                <div class="text-center">
                    <p class="text-[#4D4C7D]">
                        Don't have an account? 
                        <a href="{{ route('register') }}" 
                           class="text-[#8E7AB5] hover:text-[#FF6F61] font-bold transition-colors ml-1">
                            Register here
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
</script>

<style>
    .animate-slide-in {
        animation: slideIn 0.3s ease-out;
    }
    
    @keyframes slideIn {
        from {
            transform: translateX(100%);
            opacity: 0;
        }
        to {
            transform: translateX(0);
            opacity: 1;
        }
    }
</style>
@endsection