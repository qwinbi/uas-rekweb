<nav id="navbar" class="sticky top-0 z-40 transition-all duration-300 bg-white/95 backdrop-blur-md border-b border-var(--light)">
    <div class="w-full px-4">
        <div class="max-w-7xl mx-auto flex items-center justify-between h-20">

            <!-- Logo -->
            <a href="{{ route('home') }}" class="flex items-center space-x-3 group">
                <div class="relative">
                    <div class="w-12 h-12 gradient-primary rounded-2xl flex items-center justify-center shadow-lg group-hover:scale-110 transition-transform duration-300">
                        <i class="fas fa-bunny text-white text-xl"></i>
                    </div>
                    <div class="absolute -top-1 -right-1 w-5 h-5 bg-white rounded-full border-2 border-white flex items-center justify-center shadow-sm">
                        <div class="w-2 h-2" style="background-color: var(--secondary); border-radius: 50%;"></div>
                    </div>
                </div>

                <div>
                    <h1 class="text-2xl font-display" style="color: var(--primary);">BUNNYPOPS</h1>
                    <p class="text-xs" style="color: var(--accent);">Cute Shopping Paradise</p>
                </div>
            </a>

            <!-- Desktop Navigation -->
            <div class="hidden lg:flex items-center space-x-1">
                @php
                    $navItems = [
                        ['route' => 'home', 'icon' => 'fas fa-home', 'text' => 'Home'],
                        ['route' => 'shop', 'icon' => 'fas fa-store', 'text' => 'Shop'],
                        ['route' => 'about', 'icon' => 'fas fa-info-circle', 'text' => 'About'],
                        ['route' => 'contact', 'icon' => 'fas fa-envelope', 'text' => 'Contact'],
                    ];
                @endphp

                @foreach($navItems as $item)
                    <a href="{{ route($item['route']) }}"
                        class="nav-item {{ request()->routeIs($item['route']) ? 'active' : '' }}">
                        <i class="{{ $item['icon'] }} mr-2"></i>
                        {{ $item['text'] }}
                    </a>
                @endforeach

                <!-- Auth & Cart -->
                <div class="ml-6 flex items-center space-x-3">
                    @auth
                        @if(auth()->user()->isGuest())
                            <!-- Cart -->
                            <button onclick="toggleCart()" class="relative p-3 hover-lift rounded-xl transition-all">
                                <i class="fas fa-shopping-bag text-lg" style="color: var(--accent);"></i>

                                @php $cartCount = auth()->user()->carts()->count(); @endphp
                                
                                @if($cartCount > 0)
                                    <span id="cart-counter"
                                        class="absolute -top-1 -right-1 w-5 h-5 gradient-primary text-white text-xs rounded-full flex items-center justify-center font-bold">
                                        {{ $cartCount }}
                                    </span>
                                @endif
                            </button>

                            <!-- User Menu -->
                            <div class="relative group">
                                <button class="flex items-center space-x-2 p-2 hover-lift rounded-xl transition-all">
                                    <div class="w-10 h-10 gradient-secondary rounded-full flex items-center justify-center">
                                        <span class="text-white font-semibold">{{ substr(auth()->user()->name, 0, 1) }}</span>
                                    </div>
                                    <span class="hidden md:block font-medium" style="color: var(--dark);">
                                        {{ auth()->user()->name }}
                                    </span>
                                    <i class="fas fa-chevron-down text-xs" style="color: var(--gray);"></i>
                                </button>

                                <div
                                    class="absolute right-0 mt-2 w-56 glass-card rounded-xl shadow-lg py-2 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 border border-var(--light)">
                                    
                                    <div class="px-4 py-3 border-b border-var(--light)">
                                        <p class="font-semibold" style="color: var(--primary);">{{ auth()->user()->name }}</p>
                                        <p class="text-sm" style="color: var(--accent);">{{ auth()->user()->email }}</p>
                                    </div>

                                    <a href="{{ route('transactions.index') }}" class="dropdown-item">
                                        <i class="fas fa-receipt" style="color: var(--secondary);"></i>
                                        <span>My Orders</span>
                                    </a>

                                    <a href="{{ route('profile.edit') }}" class="dropdown-item">
                                        <i class="fas fa-user-cog" style="color: var(--primary);"></i>
                                        <span>Account Settings</span>
                                    </a>

                                    <div class="border-t border-var(--light) mt-2 pt-2">
                                        <form method="POST" action="{{ route('logout') }}">
                                            @csrf
                                            <button type="submit" class="dropdown-item" style="color: var(--primary);">
                                                <i class="fas fa-sign-out-alt"></i>
                                                Logout
                                            </button>
                                        </form>
                                    </div>

                                </div>
                            </div>
                        @elseif(auth()->user()->isAdmin())
                            <a href="{{ route('admin.dashboard') }}"
                                class="btn-accent px-4 py-2 rounded-lg text-white text-sm font-semibold">
                                <i class="fas fa-tachometer-alt mr-2"></i>
                                Dashboard
                            </a>
                        @endif

                    @else
                        <a href="{{ route('login') }}" class="nav-item">
                            <i class="fas fa-sign-in-alt mr-2"></i> Login
                        </a>

                        <a href="{{ route('register') }}"
                            class="btn-primary px-6 py-2 rounded-lg text-white font-semibold">
                            Sign Up
                        </a>
                    @endauth
                </div>
            </div>

            <!-- Mobile Menu Button -->
            <button id="mobile-menu-btn"
                class="lg:hidden w-10 h-10 rounded-xl flex items-center justify-center hover-lift transition-all"
                style="background-color: var(--light);">
                <i class="fas fa-bars" style="color: var(--primary);"></i>
            </button>
        </div>

        <!-- Mobile Menu -->
        <div id="mobile-menu"
            class="lg:hidden absolute top-full left-0 right-0 mt-2 glass-card rounded-xl shadow-lg p-4 transform -translate-y-2 opacity-0 invisible transition-all duration-300 border border-var(--light)">
            
            <div class="space-y-2">
                @foreach($navItems as $item)
                    <a href="{{ route($item['route']) }}"
                        class="mobile-nav-item {{ request()->routeIs($item['route']) ? 'active' : '' }}">
                        <i class="{{ $item['icon'] }} w-5"></i>
                        <span>{{ $item['text'] }}</span>
                    </a>
                @endforeach

                @auth
                    @if(auth()->user()->isGuest())
                        <a href="{{ route('transactions.index') }}" class="mobile-nav-item">
                            <i class="fas fa-receipt w-5"></i> My Orders
                        </a>

                        <a href="{{ route('profile.edit') }}" class="mobile-nav-item">
                            <i class="fas fa-user-cog w-5"></i> Account
                        </a>

                        <div class="pt-4 border-t border-var(--light)">
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="mobile-nav-item w-full text-left" style="color: var(--primary);">
                                    <i class="fas fa-sign-out-alt w-5"></i> Logout
                                </button>
                            </form>
                        </div>
                    @endif
                @else
                    <div class="pt-4 border-t border-var(--light) space-y-3">
                        <a href="{{ route('login') }}" class="mobile-nav-item">
                            <i class="fas fa-sign-in-alt w-5"></i> Login
                        </a>

                        <a href="{{ route('register') }}"
                            class="block w-full gradient-primary text-white py-3 rounded-lg text-center font-semibold">
                            Create Account
                        </a>
                    </div>
                @endauth
            </div>
        </div>

    </div>
</nav>

<style>
    .nav-item {
        @apply px-4 py-2.5 rounded-lg font-medium flex items-center transition-all duration-300;
        color: var(--accent);
    }
    .nav-item:hover {
        background-color: rgba(242,174,188,0.1);
        color: var(--primary);
    }
    .nav-item.active {
        background-color: rgba(108,8,32,0.1);
        color: var(--primary);
        font-weight: 600;
    }

    .mobile-nav-item {
        @apply flex items-center space-x-3 px-4 py-3 rounded-lg transition-colors;
        color: var(--accent);
    }
    .mobile-nav-item:hover,
    .mobile-nav-item.active {
        background-color: rgba(242,174,188,0.1);
        color: var(--primary);
    }

    .dropdown-item {
        @apply flex items-center space-x-3 px-4 py-2.5 hover:bg-gray-50 transition-colors;
        color: var(--accent);
    }
    .dropdown-item:hover {
        color: var(--primary);
    }

    #navbar.scrolled {
        box-shadow: 0 4px 20px rgba(108,8,32,0.08);
    }
</style>

<script>
    const mobileMenuBtn = document.getElementById('mobile-menu-btn');
    const mobileMenu = document.getElementById('mobile-menu');

    mobileMenuBtn?.addEventListener('click', (e) => {
        e.stopPropagation();
        const visible = mobileMenu.classList.contains('visible');
        if (visible) {
            mobileMenu.classList.add('opacity-0','invisible','-translate-y-2');
            mobileMenu.classList.remove('opacity-100','visible','translate-y-0');
        } else {
            mobileMenu.classList.remove('opacity-0','invisible','-translate-y-2');
            mobileMenu.classList.add('opacity-100','visible','translate-y-0');
        }
    });

    window.addEventListener('scroll', () => {
        const navbar = document.getElementById('navbar');
        window.scrollY > 20 ? navbar.classList.add('scrolled') : navbar.classList.remove('scrolled');
    });

    document.addEventListener('click', (e) => {
        if (!mobileMenu.contains(e.target) && !mobileMenuBtn.contains(e.target)) {
            mobileMenu.classList.add('opacity-0','invisible','-translate-y-2');
            mobileMenu.classList.remove('opacity-100','visible','translate-y-0');
        }
    });

    mobileMenu.querySelectorAll('a')?.forEach(link => {
        link.addEventListener('click', () => {
            mobileMenu.classList.add('opacity-0','invisible','-translate-y-2');
            mobileMenu.classList.remove('opacity-100','visible','translate-y-0');
        });
    });
</script>
