<nav class="bg-[#FF6F61] text-white shadow-lg sticky top-0 z-40">
    <div class="container mx-auto px-4">
        <div class="flex justify-between items-center py-4">
            <!-- Logo -->
            <div class="flex items-center space-x-3">
                <a href="{{ route('home') }}" class="flex items-center space-x-3 hover:opacity-90 transition-opacity">
                    <div class="relative">
                        <div class="w-12 h-12 bg-white rounded-full flex items-center justify-center shadow-lg">
                            @if(\App\Models\Setting::get('logo'))
                                <img src="{{ asset('storage/logo/' . \App\Models\Setting::get('logo')) }}" 
                                     alt="BUNNYPOPS Logo" 
                                     class="w-10 h-10 rounded-full object-cover">
                            @else
                                <i class="fas fa-bunny text-2xl text-[#FF6F61]"></i>
                            @endif
                        </div>
                        <div class="absolute -top-1 -right-1 w-5 h-5 bg-[#8E7AB5] rounded-full flex items-center justify-center">
                            <i class="fas fa-star text-xs text-white"></i>
                        </div>
                    </div>
                    <div>
                        <h1 class="text-2xl font-bold tracking-wide">BUNNYPOPS</h1>
                        <p class="text-xs text-[#F9DCC4] opacity-90">Cute Shopping Paradise</p>
                    </div>
                </a>
            </div>

            <!-- Desktop Navigation -->
            <div class="hidden md:flex items-center space-x-6">
                <a href="{{ route('home') }}" 
                   class="flex items-center space-x-2 px-3 py-2 rounded-lg hover:bg-white/10 transition-colors {{ request()->routeIs('home') ? 'bg-white/10' : '' }}">
                    <i class="fas fa-home"></i>
                    <span>Home</span>
                </a>
                
                <a href="{{ route('shop') }}" 
                   class="flex items-center space-x-2 px-3 py-2 rounded-lg hover:bg-white/10 transition-colors {{ request()->routeIs('shop') ? 'bg-white/10' : '' }}">
                    <i class="fas fa-store"></i>
                    <span>Shop</span>
                </a>
                
                <a href="{{ route('about') }}" 
                   class="flex items-center space-x-2 px-3 py-2 rounded-lg hover:bg-white/10 transition-colors {{ request()->routeIs('about') ? 'bg-white/10' : '' }}">
                    <i class="fas fa-info-circle"></i>
                    <span>About</span>
                </a>

                @auth
                    @if(auth()->user()->isGuest())
                        <!-- Cart -->
                        <a href="{{ route('cart.index') }}" 
                           class="relative flex items-center space-x-2 px-3 py-2 rounded-lg hover:bg-white/10 transition-colors {{ request()->routeIs('cart.*') ? 'bg-white/10' : '' }}">
                            <i class="fas fa-shopping-cart"></i>
                            <span>Cart</span>
                            @php
                                $cartCount = auth()->user()->carts()->count();
                            @endphp
                            @if($cartCount > 0)
                                <span id="cart-counter" class="absolute -top-1 -right-1 bg-[#8E7AB5] text-white text-xs w-5 h-5 rounded-full flex items-center justify-center">
                                    {{ $cartCount }}
                                </span>
                            @endif
                        </a>

                        <!-- Transactions -->
                        <a href="{{ route('transactions.index') }}" 
                           class="flex items-center space-x-2 px-3 py-2 rounded-lg hover:bg-white/10 transition-colors {{ request()->routeIs('transactions.*') ? 'bg-white/10' : '' }}">
                            <i class="fas fa-history"></i>
                            <span>History</span>
                        </a>
                    @elseif(auth()->user()->isAdmin())
                        <!-- Admin Dashboard -->
                        <a href="{{ route('admin.dashboard') }}" 
                           class="flex items-center space-x-2 px-3 py-2 rounded-lg hover:bg-white/10 transition-colors {{ request()->routeIs('admin.*') ? 'bg-white/10' : '' }}">
                            <i class="fas fa-tachometer-alt"></i>
                            <span>Dashboard</span>
                        </a>
                    @endif

                    <!-- User Dropdown -->
                    <div class="relative group">
                        <button class="flex items-center space-x-2 px-3 py-2 rounded-lg hover:bg-white/10 transition-colors">
                            <div class="w-8 h-8 bg-[#F9DCC4] rounded-full flex items-center justify-center text-[#4D4C7D]">
                                <i class="fas fa-user"></i>
                            </div>
                            <span>{{ auth()->user()->name }}</span>
                            <i class="fas fa-chevron-down text-xs"></i>
                        </button>
                        
                        <div class="absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-xl py-2 text-[#4D4C7D] opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 z-50">
                            <div class="px-4 py-2 border-b border-gray-100">
                                <p class="font-bold">{{ auth()->user()->name }}</p>
                                <p class="text-sm text-gray-500">{{ auth()->user()->email }}</p>
                            </div>
                            <form method="POST" action="{{ route('logout') }}" class="w-full">
                                @csrf
                                <button type="submit" class="w-full text-left px-4 py-2 hover:bg-[#FCEFEA] transition-colors flex items-center">
                                    <i class="fas fa-sign-out-alt mr-3 text-[#FF6F61]"></i>
                                    Logout
                                </button>
                            </form>
                        </div>
                    </div>
                @else
                    <!-- Auth Buttons -->
                    <div class="flex items-center space-x-3">
                        <a href="{{ route('login') }}" 
                           class="bg-white text-[#FF6F61] px-4 py-2 rounded-lg font-bold hover:bg-[#F9DCC4] transition-colors shadow-md hover:shadow-lg flex items-center">
                            <i class="fas fa-sign-in-alt mr-2"></i>
                            Login
                        </a>
                        <a href="{{ route('register') }}" 
                           class="bg-[#8E7AB5] text-white px-4 py-2 rounded-lg font-bold hover:bg-[#4D4C7D] transition-colors shadow-md hover:shadow-lg flex items-center">
                            <i class="fas fa-user-plus mr-2"></i>
                            Register
                        </a>
                    </div>
                @endauth
            </div>

            <!-- Mobile Menu Button -->
            <button id="mobile-menu-button" class="md:hidden text-2xl hover:opacity-80 transition-opacity">
                <i class="fas fa-bars"></i>
            </button>
        </div>

        <!-- Mobile Menu -->
        <div id="mobile-menu" class="md:hidden hidden bg-[#FF6F61] rounded-lg shadow-lg mt-2 p-4 animate-slide-down">
            <div class="flex flex-col space-y-4">
                <a href="{{ route('home') }}" 
                   class="flex items-center space-x-3 px-3 py-2 rounded-lg hover:bg-white/10 transition-colors">
                    <i class="fas fa-home w-6"></i>
                    <span>Home</span>
                </a>
                
                <a href="{{ route('shop') }}" 
                   class="flex items-center space-x-3 px-3 py-2 rounded-lg hover:bg-white/10 transition-colors">
                    <i class="fas fa-store w-6"></i>
                    <span>Shop</span>
                </a>
                
                <a href="{{ route('about') }}" 
                   class="flex items-center space-x-3 px-3 py-2 rounded-lg hover:bg-white/10 transition-colors">
                    <i class="fas fa-info-circle w-6"></i>
                    <span>About</span>
                </a>

                @auth
                    @if(auth()->user()->isGuest())
                        <a href="{{ route('cart.index') }}" 
                           class="flex items-center space-x-3 px-3 py-2 rounded-lg hover:bg-white/10 transition-colors">
                            <i class="fas fa-shopping-cart w-6"></i>
                            <span>Cart</span>
                            @if($cartCount > 0)
                                <span class="bg-[#8E7AB5] text-white text-xs px-2 py-1 rounded-full">
                                    {{ $cartCount }}
                                </span>
                            @endif
                        </a>

                        <a href="{{ route('transactions.index') }}" 
                           class="flex items-center space-x-3 px-3 py-2 rounded-lg hover:bg-white/10 transition-colors">
                            <i class="fas fa-history w-6"></i>
                            <span>History</span>
                        </a>
                    @elseif(auth()->user()->isAdmin())
                        <a href="{{ route('admin.dashboard') }}" 
                           class="flex items-center space-x-3 px-3 py-2 rounded-lg hover:bg-white/10 transition-colors">
                            <i class="fas fa-tachometer-alt w-6"></i>
                            <span>Dashboard</span>
                        </a>
                    @endif

                    <div class="pt-4 border-t border-white/20">
                        <div class="flex items-center space-x-3 px-3 py-2">
                            <div class="w-10 h-10 bg-[#F9DCC4] rounded-full flex items-center justify-center text-[#4D4C7D]">
                                <i class="fas fa-user"></i>
                            </div>
                            <div>
                                <p class="font-bold">{{ auth()->user()->name }}</p>
                                <p class="text-sm text-[#F9DCC4]">{{ auth()->user()->email }}</p>
                            </div>
                        </div>
                        
                        <form method="POST" action="{{ route('logout') }}" class="w-full">
                            @csrf
                            <button type="submit" class="w-full text-left px-3 py-2 rounded-lg hover:bg-white/10 transition-colors flex items-center">
                                <i class="fas fa-sign-out-alt mr-3"></i>
                                Logout
                            </button>
                        </form>
                    </div>
                @else
                    <div class="pt-4 border-t border-white/20">
                        <a href="{{ route('login') }}" 
                           class="block w-full bg-white text-[#FF6F61] px-4 py-3 rounded-lg font-bold hover:bg-[#F9DCC4] transition-colors text-center mb-3">
                            <i class="fas fa-sign-in-alt mr-2"></i>
                            Login
                        </a>
                        <a href="{{ route('register') }}" 
                           class="block w-full bg-[#8E7AB5] text-white px-4 py-3 rounded-lg font-bold hover:bg-[#4D4C7D] transition-colors text-center">
                            <i class="fas fa-user-plus mr-2"></i>
                            Register
                        </a>
                    </div>
                @endauth
            </div>
        </div>
    </div>
</nav>