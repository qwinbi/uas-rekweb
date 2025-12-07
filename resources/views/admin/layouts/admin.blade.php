<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - BUNNYPOPS - {{ $title ?? 'Dashboard' }}</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700;800&display=swap');
        .font-cute { font-family: 'Nunito', cursive, sans-serif; }
    </style>
    @stack('styles')
</head>
<body class="bg-[#FCEFEA] min-h-screen font-cute">
    <!-- Admin Navbar -->
    <nav class="bg-[#4D4C7D] text-white shadow-lg">
        <div class="container mx-auto px-4">
            <div class="flex justify-between items-center py-4">
                <!-- Logo & Brand -->
                <div class="flex items-center space-x-3">
                    <a href="{{ route('admin.dashboard') }}" class="flex items-center space-x-3">
                        <div class="w-10 h-10 bg-white rounded-full flex items-center justify-center">
                            <i class="fas fa-bunny text-[#FF6F61] text-xl"></i>
                        </div>
                        <div>
                            <h1 class="text-xl font-bold">BUNNYPOPS</h1>
                            <p class="text-xs text-[#F9DCC4]">Admin Panel</p>
                        </div>
                    </a>
                </div>

                <!-- Admin Controls -->
                <div class="flex items-center space-x-4">
                    <!-- Notifications -->
                    <div class="relative group">
                        <button class="relative p-2 hover:bg-white/10 rounded-lg transition-colors">
                            <i class="fas fa-bell text-xl"></i>
                            @if($newTransactions ?? 0 > 0)
                                <span class="absolute -top-1 -right-1 w-5 h-5 bg-[#FF6F61] text-white text-xs rounded-full flex items-center justify-center">
                                    {{ $newTransactions }}
                                </span>
                            @endif
                        </button>
                        
                        <!-- Notifications Dropdown -->
                        <div class="absolute right-0 mt-2 w-80 bg-white rounded-lg shadow-xl py-2 text-[#4D4C7D] opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 z-50">
                            <div class="px-4 py-2 border-b border-gray-100">
                                <div class="font-bold">Notifications</div>
                                <div class="text-sm text-gray-500">{{ $newTransactions ?? 0 }} new orders</div>
                            </div>
                            
                            <div class="max-h-64 overflow-y-auto">
                                @php
                                    $notifications = \App\Models\Transaction::where('status', 'waiting_payment')
                                        ->with('user')
                                        ->latest()
                                        ->take(5)
                                        ->get();
                                @endphp
                                
                                @forelse($notifications as $notification)
                                <a href="{{ route('admin.transactions.show', $notification->id) }}" 
                                   class="block px-4 py-3 hover:bg-[#FCEFEA] transition-colors">
                                    <div class="flex items-start">
                                        <div class="w-8 h-8 bg-[#FF6F61] rounded-full flex items-center justify-center mr-3 mt-1">
                                            <i class="fas fa-shopping-cart text-white text-sm"></i>
                                        </div>
                                        <div class="flex-grow">
                                            <div class="font-medium">New Order</div>
                                            <div class="text-sm text-gray-500">
                                                {{ $notification->user->name }} • {{ $notification->invoice_number }}
                                            </div>
                                            <div class="text-xs text-gray-400 mt-1">
                                                {{ $notification->created_at->diffForHumans() }}
                                            </div>
                                        </div>
                                    </div>
                                </a>
                                @empty
                                <div class="px-4 py-8 text-center">
                                    <i class="fas fa-bell-slash text-2xl text-gray-300 mb-2"></i>
                                    <p class="text-gray-500">No new notifications</p>
                                </div>
                                @endforelse
                            </div>
                            
                            <div class="px-4 py-2 border-t border-gray-100">
                                <a href="{{ route('admin.transactions.index') }}" 
                                   class="text-[#FF6F61] hover:text-[#FF8A80] text-sm font-medium">
                                    View all notifications →
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- User Menu -->
                    <div class="relative group">
                        <button class="flex items-center space-x-2 hover:bg-white/10 px-3 py-2 rounded-lg transition-colors">
                            <div class="w-8 h-8 bg-[#F9DCC4] rounded-full flex items-center justify-center text-[#4D4C7D]">
                                <i class="fas fa-user"></i>
                            </div>
                            <div class="text-left hidden md:block">
                                <div class="font-bold text-sm">{{ auth()->user()->name }}</div>
                                <div class="text-xs text-[#F9DCC4]">Administrator</div>
                            </div>
                            <i class="fas fa-chevron-down text-xs"></i>
                        </button>
                        
                        <!-- Dropdown Menu -->
                        <div class="absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-xl py-2 text-[#4D4C7D] opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 z-50">
                            <div class="px-4 py-2 border-b border-gray-100">
                                <div class="font-bold">{{ auth()->user()->name }}</div>
                                <div class="text-sm text-gray-500">{{ auth()->user()->email }}</div>
                            </div>
                            
                            <a href="{{ route('admin.dashboard') }}" 
                               class="block px-4 py-2 hover:bg-[#FCEFEA] transition-colors">
                                <i class="fas fa-tachometer-alt mr-3 text-[#8E7AB5]"></i>
                                Dashboard
                            </a>
                            
                            <a href="{{ route('home') }}" 
                               target="_blank"
                               class="block px-4 py-2 hover:bg-[#FCEFEA] transition-colors">
                                <i class="fas fa-external-link-alt mr-3 text-[#8E7AB5]"></i>
                                View Website
                            </a>
                            
                            <div class="border-t border-gray-100 mt-2 pt-2">
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" 
                                            class="block w-full text-left px-4 py-2 hover:bg-[#FCEFEA] transition-colors text-red-600">
                                        <i class="fas fa-sign-out-alt mr-3"></i>
                                        Logout
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="container mx-auto px-4 py-6">
        <div class="flex">
            <!-- Sidebar -->
            <div class="w-64 flex-shrink-0 hidden lg:block">
                <div class="bg-white rounded-2xl shadow-lg p-4 mb-6">
                    <!-- Admin Info -->
                    <div class="p-4 text-center mb-6">
                        <div class="w-20 h-20 mx-auto mb-4 bg-gradient-to-r from-[#FF6F61] to-[#8E7AB5] rounded-full flex items-center justify-center text-white text-2xl">
                            <i class="fas fa-user-cog"></i>
                        </div>
                        <h3 class="font-bold text-lg text-[#4D4C7D]">{{ auth()->user()->name }}</h3>
                        <p class="text-[#8E7AB5] text-sm">Administrator</p>
                    </div>
                    
                    <!-- Navigation -->
                    <nav class="space-y-1">
                        <a href="{{ route('admin.dashboard') }}" 
                           class="flex items-center space-x-3 p-3 rounded-lg hover:bg-[#FCEFEA] transition-colors {{ request()->routeIs('admin.dashboard') ? 'bg-[#FCEFEA] text-[#FF6F61]' : 'text-[#4D4C7D]' }}">
                            <i class="fas fa-tachometer-alt w-6"></i>
                            <span>Dashboard</span>
                        </a>
                        
                        <a href="{{ route('admin.products.index') }}" 
                           class="flex items-center space-x-3 p-3 rounded-lg hover:bg-[#FCEFEA] transition-colors {{ request()->routeIs('admin.products.*') ? 'bg-[#FCEFEA] text-[#FF6F61]' : 'text-[#4D4C7D]' }}">
                            <i class="fas fa-box-open w-6"></i>
                            <span>Products</span>
                        </a>
                        
                        <a href="{{ route('admin.transactions.index') }}" 
                           class="flex items-center space-x-3 p-3 rounded-lg hover:bg-[#FCEFEA] transition-colors {{ request()->routeIs('admin.transactions.*') ? 'bg-[#FCEFEA] text-[#FF6F61]' : 'text-[#4D4C7D]' }}">
                            <i class="fas fa-receipt w-6"></i>
                            <span>Transactions</span>
                            @if($newTransactions ?? 0 > 0)
                                <span class="bg-[#FF6F61] text-white text-xs px-2 py-1 rounded-full">
                                    {{ $newTransactions }}
                                </span>
                            @endif
                        </a>
                        
                        <!-- Settings Section -->
                        <div class="pt-4 mt-4 border-t border-gray-100">
                            <div class="px-3 py-2 text-[#8E7AB5] font-bold text-sm">Settings</div>
                            
                            <a href="{{ route('admin.settings.logo') }}" 
                               class="flex items-center space-x-3 p-3 rounded-lg hover:bg-[#FCEFEA] transition-colors {{ request()->routeIs('admin.settings.logo') ? 'bg-[#FCEFEA] text-[#FF6F61]' : 'text-[#4D4C7D]' }}">
                                <i class="fas fa-image w-6"></i>
                                <span>Logo</span>
                            </a>
                            
                            <a href="{{ route('admin.settings.footer') }}" 
                               class="flex items-center space-x-3 p-3 rounded-lg hover:bg-[#FCEFEA] transition-colors {{ request()->routeIs('admin.settings.footer') ? 'bg-[#FCEFEA] text-[#FF6F61]' : 'text-[#4D4C7D]' }}">
                                <i class="fas fa-shoe-prints w-6"></i>
                                <span>Footer</span>
                            </a>
                            
                            <a href="{{ route('admin.settings.about') }}" 
                               class="flex items-center space-x-3 p-3 rounded-lg hover:bg-[#FCEFEA] transition-colors {{ request()->routeIs('admin.settings.about') ? 'bg-[#FCEFEA] text-[#FF6F61]' : 'text-[#4D4C7D]' }}">
                                <i class="fas fa-info-circle w-6"></i>
                                <span>About Page</span>
                            </a>
                            
                            <a href="{{ route('admin.settings.qris') }}" 
                               class="flex items-center space-x-3 p-3 rounded-lg hover:bg-[#FCEFEA] transition-colors {{ request()->routeIs('admin.settings.qris') ? 'bg-[#FCEFEA] text-[#FF6F61]' : 'text-[#4D4C7D]' }}">
                                <i class="fas fa-qrcode w-6"></i>
                                <span>Payment Settings</span>
                            </a>
                        </div>
                    </nav>
                </div>
                
                <!-- Quick Stats -->
                <div class="bg-white rounded-2xl shadow-lg p-6">
                    <h4 class="font-bold text-[#4D4C7D] mb-4">Quick Stats</h4>
                    <div class="space-y-4">
                        <div>
                            <div class="text-sm text-[#8E7AB5]">Today's Orders</div>
                            <div class="text-2xl font-bold text-[#4D4C7D]">
                                {{ \App\Models\Transaction::whereDate('created_at', today())->count() }}
                            </div>
                        </div>
                        
                        <div>
                            <div class="text-sm text-[#8E7AB5]">Low Stock Items</div>
                            <div class="text-2xl font-bold text-[#FF6F61]">
                                {{ \App\Models\Product::where('stock', '<', 10)->where('stock', '>', 0)->count() }}
                            </div>
                        </div>
                        
                        <div>
                            <div class="text-sm text-[#8E7AB5]">Out of Stock</div>
                            <div class="text-2xl font-bold text-red-600">
                                {{ \App\Models\Product::where('stock', 0)->count() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Mobile Menu Button -->
            <button id="mobile-sidebar-toggle" 
                    class="lg:hidden fixed bottom-6 right-6 z-40 w-12 h-12 bg-[#FF6F61] text-white rounded-full shadow-lg flex items-center justify-center">
                <i class="fas fa-bars text-xl"></i>
            </button>

            <!-- Mobile Sidebar Overlay -->
            <div id="mobile-sidebar-overlay" 
                 class="lg:hidden fixed inset-0 bg-black/50 z-30 hidden"></div>

            <!-- Mobile Sidebar -->
            <div id="mobile-sidebar" 
                 class="lg:hidden fixed left-0 top-0 h-full w-64 bg-white shadow-xl z-40 transform -translate-x-full transition-transform">
                <div class="p-4 border-b border-gray-100">
                    <div class="flex justify-between items-center">
                        <h3 class="font-bold text-lg text-[#4D4C7D]">Menu</h3>
                        <button id="close-mobile-sidebar" class="text-[#8E7AB5] hover:text-[#FF6F61]">
                            <i class="fas fa-times text-xl"></i>
                        </button>
                    </div>
                </div>
                
                <!-- Same navigation as desktop -->
                <div class="p-4">
                    <nav class="space-y-1">
                        <a href="{{ route('admin.dashboard') }}" 
                           class="flex items-center space-x-3 p-3 rounded-lg hover:bg-[#FCEFEA] transition-colors {{ request()->routeIs('admin.dashboard') ? 'bg-[#FCEFEA] text-[#FF6F61]' : 'text-[#4D4C7D]' }}">
                            <i class="fas fa-tachometer-alt w-6"></i>
                            <span>Dashboard</span>
                        </a>
                        
                        <a href="{{ route('admin.products.index') }}" 
                           class="flex items-center space-x-3 p-3 rounded-lg hover:bg-[#FCEFEA] transition-colors {{ request()->routeIs('admin.products.*') ? 'bg-[#FCEFEA] text-[#FF6F61]' : 'text-[#4D4C7D]' }}">
                            <i class="fas fa-box-open w-6"></i>
                            <span>Products</span>
                        </a>
                        
                        <a href="{{ route('admin.transactions.index') }}" 
                           class="flex items-center space-x-3 p-3 rounded-lg hover:bg-[#FCEFEA] transition-colors {{ request()->routeIs('admin.transactions.*') ? 'bg-[#FCEFEA] text-[#FF6F61]' : 'text-[#4D4C7D]' }}">
                            <i class="fas fa-receipt w-6"></i>
                            <span>Transactions</span>
                            @if($newTransactions ?? 0 > 0)
                                <span class="bg-[#FF6F61] text-white text-xs px-2 py-1 rounded-full">
                                    {{ $newTransactions }}
                                </span>
                            @endif
                        </a>
                        
                        <!-- Settings Section -->
                        <div class="pt-4 mt-4 border-t border-gray-100">
                            <div class="px-3 py-2 text-[#8E7AB5] font-bold text-sm">Settings</div>
                            
                            <a href="{{ route('admin.settings.logo') }}" 
                               class="flex items-center space-x-3 p-3 rounded-lg hover:bg-[#FCEFEA] transition-colors {{ request()->routeIs('admin.settings.logo') ? 'bg-[#FCEFEA] text-[#FF6F61]' : 'text-[#4D4C7D]' }}">
                                <i class="fas fa-image w-6"></i>
                                <span>Logo</span>
                            </a>
                            
                            <a href="{{ route('admin.settings.footer') }}" 
                               class="flex items-center space-x-3 p-3 rounded-lg hover:bg-[#FCEFEA] transition-colors {{ request()->routeIs('admin.settings.footer') ? 'bg-[#FCEFEA] text-[#FF6F61]' : 'text-[#4D4C7D]' }}">
                                <i class="fas fa-shoe-prints w-6"></i>
                                <span>Footer</span>
                            </a>
                            
                            <a href="{{ route('admin.settings.about') }}" 
                               class="flex items-center space-x-3 p-3 rounded-lg hover:bg-[#FCEFEA] transition-colors {{ request()->routeIs('admin.settings.about') ? 'bg-[#FCEFEA] text-[#FF6F61]' : 'text-[#4D4C7D]' }}">
                                <i class="fas fa-info-circle w-6"></i>
                                <span>About Page</span>
                            </a>
                            
                            <a href="{{ route('admin.settings.qris') }}" 
                               class="flex items-center space-x-3 p-3 rounded-lg hover:bg-[#FCEFEA] transition-colors {{ request()->routeIs('admin.settings.qris') ? 'bg-[#FCEFEA] text-[#FF6F61]' : 'text-[#4D4C7D]' }}">
                                <i class="fas fa-qrcode w-6"></i>
                                <span>Payment Settings</span>
                            </a>
                        </div>
                    </nav>
                </div>
            </div>

            <!-- Main Content Area -->
            <div class="flex-grow lg:ml-6">
                <!-- Page Title -->
                <div class="bg-white rounded-2xl shadow-lg p-6 mb-6">
                    <h1 class="text-2xl md:text-3xl font-bold text-[#4D4C7D]">{{ $title ?? 'Dashboard' }}</h1>
                    @if(isset($description))
                    <p class="text-[#8E7AB5] mt-2">{{ $description }}</p>
                    @endif
                </div>

                <!-- Flash Messages -->
                @if(session('success'))
                <div class="mb-6 animate-slide-in">
                    <div class="bg-green-100 border border-green-400 text-green-700 px-6 py-4 rounded-lg flex items-center">
                        <i class="fas fa-check-circle text-xl mr-3"></i>
                        <div class="flex-grow">{{ session('success') }}</div>
                        <button class="text-green-700 hover:text-green-900" onclick="this.parentElement.remove()">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                </div>
                @endif

                @if(session('error'))
                <div class="mb-6 animate-slide-in">
                    <div class="bg-red-100 border border-red-400 text-red-700 px-6 py-4 rounded-lg flex items-center">
                        <i class="fas fa-exclamation-circle text-xl mr-3"></i>
                        <div class="flex-grow">{{ session('error') }}</div>
                        <button class="text-red-700 hover:text-red-900" onclick="this.parentElement.remove()">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                </div>
                @endif

                <!-- Content -->
                @yield('admin-content')
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="mt-12 bg-[#4D4C7D] text-white py-6">
        <div class="container mx-auto px-4">
            <div class="flex flex-col md:flex-row justify-between items-center">
                <div class="mb-4 md:mb-0">
                    <p class="text-[#F9DCC4]">BUNNYPOPS Admin Panel</p>
                    <p class="text-sm text-white/70">v1.0.0</p>
                </div>
                <div class="text-center">
                    <p class="text-sm">© 2024 BUNNYPOPS. All rights reserved.</p>
                    <p class="text-xs text-white/50 mt-1">Admin: {{ auth()->user()->email }}</p>
                </div>
            </div>
        </div>
    </footer>

    <script>
        // Mobile sidebar toggle
        const mobileSidebarToggle = document.getElementById('mobile-sidebar-toggle');
        const mobileSidebar = document.getElementById('mobile-sidebar');
        const mobileSidebarOverlay = document.getElementById('mobile-sidebar-overlay');
        const closeMobileSidebar = document.getElementById('close-mobile-sidebar');
        
        if (mobileSidebarToggle && mobileSidebar && mobileSidebarOverlay && closeMobileSidebar) {
            mobileSidebarToggle.addEventListener('click', () => {
                mobileSidebar.classList.remove('-translate-x-full');
                mobileSidebarOverlay.classList.remove('hidden');
                document.body.style.overflow = 'hidden';
            });
            
            closeMobileSidebar.addEventListener('click', () => {
                mobileSidebar.classList.add('-translate-x-full');
                mobileSidebarOverlay.classList.add('hidden');
                document.body.style.overflow = 'auto';
            });
            
            mobileSidebarOverlay.addEventListener('click', () => {
                mobileSidebar.classList.add('-translate-x-full');
                mobileSidebarOverlay.classList.add('hidden');
                document.body.style.overflow = 'auto';
            });
        }
        
        // Auto-hide flash messages
        setTimeout(() => {
            const flashMessages = document.querySelectorAll('[role="alert"], .bg-green-100, .bg-red-100');
            flashMessages.forEach(message => {
                message.style.opacity = '0';
                setTimeout(() => message.remove(), 500);
            });
        }, 5000);
    </script>
    
    @stack('scripts')
</body>
</html>