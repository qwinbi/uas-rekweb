@extends('layouts.app')

@section('title', 'Home - BUNNYPOPS')

@section('content')
<!-- Hero Section -->
<section class="mb-16">
    <div class="relative rounded-3xl overflow-hidden shadow-2xl" 
         style="background: linear-gradient(135deg, #FF6F61 0%, #8E7AB5 100%);">
        <div class="absolute inset-0 opacity-10">
            <div class="absolute top-10 left-10 w-32 h-32 bg-white rounded-full"></div>
            <div class="absolute bottom-10 right-10 w-40 h-40 bg-white rounded-full"></div>
        </div>
        
        <div class="relative px-8 py-12 md:px-16 md:py-20">
            <div class="flex flex-col md:flex-row items-center">
                <div class="md:w-1/2 mb-10 md:mb-0">
                    <div class="inline-block bg-white/20 backdrop-blur-sm rounded-full px-4 py-2 mb-4">
                        <span class="text-white text-sm font-bold">
                            <i class="fas fa-star mr-1"></i> New Arrivals!
                        </span>
                    </div>
                    
                    <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold text-white mb-4 leading-tight">
                        Welcome to 
                        <span class="text-[#F9DCC4] block">BUNNYPOPS</span>
                    </h1>
                    <p class="text-xl text-white/90 mb-8 max-w-lg">
                        Your favorite cute e-commerce with adorable products that bring joy to every day!
                    </p>
                    
                    <div class="flex flex-col sm:flex-row gap-4">
                        <a href="{{ route('shop') }}" 
                           class="bg-white text-[#FF6F61] px-8 py-4 rounded-xl font-bold text-lg hover:bg-[#F9DCC4] transition-all shadow-lg hover:shadow-xl transform hover:-translate-y-1 flex items-center justify-center">
                            <i class="fas fa-shopping-bag mr-3"></i>
                            Shop Now
                        </a>
                        <a href="{{ route('about') }}" 
                           class="bg-transparent border-2 border-white text-white px-8 py-4 rounded-xl font-bold text-lg hover:bg-white/10 transition-all flex items-center justify-center">
                            <i class="fas fa-play-circle mr-3"></i>
                            Watch Video
                        </a>
                    </div>
                    
                    <!-- Stats -->
                    <div class="flex gap-8 mt-10">
                        <div class="text-center">
                            <div class="text-3xl font-bold text-white">500+</div>
                            <div class="text-white/80 text-sm">Happy Customers</div>
                        </div>
                        <div class="text-center">
                            <div class="text-3xl font-bold text-white">100+</div>
                            <div class="text-white/80 text-sm">Cute Products</div>
                        </div>
                        <div class="text-center">
                            <div class="text-3xl font-bold text-white">24/7</div>
                            <div class="text-white/80 text-sm">Customer Support</div>
                        </div>
                    </div>
                </div>
                
                <div class="md:w-1/2 flex justify-center">
                    <div class="relative w-72 h-72 md:w-96 md:h-96">
                        <!-- Background circles -->
                        <div class="absolute inset-0 bg-[#F9DCC4] rounded-full opacity-20 animate-pulse"></div>
                        <div class="absolute inset-10 bg-white rounded-full opacity-10"></div>
                        
                        <!-- Main bunny character -->
                        <div class="absolute inset-0 flex items-center justify-center">
                            <div class="relative">
                                <div class="w-64 h-64 md:w-80 md:h-80 bg-gradient-to-br from-white to-[#FCEFEA] rounded-full flex items-center justify-center shadow-2xl">
                                    <i class="fas fa-bunny text-[#FF6F61] text-8xl md:text-9xl"></i>
                                </div>
                                
                                <!-- Floating elements -->
                                <div class="absolute -top-4 -left-4 w-16 h-16 bg-[#8E7AB5] rounded-full flex items-center justify-center shadow-lg">
                                    <i class="fas fa-heart text-white text-xl"></i>
                                </div>
                                <div class="absolute -bottom-4 -right-4 w-20 h-20 bg-[#FF6F61] rounded-full flex items-center justify-center shadow-lg">
                                    <i class="fas fa-gift text-white text-2xl"></i>
                                </div>
                                <div class="absolute top-10 -right-6 w-12 h-12 bg-[#4D4C7D] rounded-full flex items-center justify-center shadow-lg">
                                    <i class="fas fa-star text-white"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Featured Products -->
<section class="mb-16">
    <div class="flex flex-col md:flex-row justify-between items-center mb-8">
        <div>
            <h2 class="text-3xl md:text-4xl font-bold text-[#4D4C7D] mb-2">Featured Products</h2>
            <p class="text-[#8E7AB5]">Discover our most adorable items</p>
        </div>
        <a href="{{ route('shop') }}" 
           class="mt-4 md:mt-0 inline-flex items-center text-[#8E7AB5] hover:text-[#FF6F61] font-bold transition-colors group">
            View All Products
            <i class="fas fa-arrow-right ml-2 group-hover:translate-x-2 transition-transform"></i>
        </a>
    </div>
    
    @if($products->count() > 0)
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
        @foreach($products as $product)
        <div class="card-product group hover:scale-[1.02] transition-all duration-300">
            <!-- Product Image -->
            <div class="relative h-56 overflow-hidden rounded-t-2xl">
                @if($product->photo)
                    <img src="{{ asset('storage/products/' . $product->photo) }}" 
                         alt="{{ $product->name }}" 
                         class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                @else
                    <div class="w-full h-full bg-gradient-to-br from-[#F9DCC4] to-[#8E7AB5] flex items-center justify-center">
                        <i class="fas fa-box text-white text-5xl opacity-50"></i>
                    </div>
                @endif
                
                <!-- Stock badge -->
                <div class="absolute top-3 left-3">
                    @if($product->stock > 10)
                        <span class="bg-green-100 text-green-800 text-xs font-bold px-3 py-1 rounded-full">
                            In Stock
                        </span>
                    @elseif($product->stock > 0)
                        <span class="bg-yellow-100 text-yellow-800 text-xs font-bold px-3 py-1 rounded-full">
                            Limited Stock
                        </span>
                    @else
                        <span class="bg-red-100 text-red-800 text-xs font-bold px-3 py-1 rounded-full">
                            Out of Stock
                        </span>
                    @endif
                </div>
                
                <!-- Quick view button -->
                <div class="absolute top-3 right-3 opacity-0 group-hover:opacity-100 transition-opacity">
                    <a href="{{ route('product.detail', $product->id) }}" 
                       class="w-10 h-10 bg-white rounded-full flex items-center justify-center shadow-lg hover:bg-[#FF6F61] hover:text-white transition-colors">
                        <i class="fas fa-eye"></i>
                    </a>
                </div>
            </div>
            
            <!-- Product Info -->
            <div class="p-5">
                <h3 class="font-bold text-lg text-[#4D4C7D] mb-2 truncate">{{ $product->name }}</h3>
                <p class="text-[#4D4C7D]/70 text-sm mb-4 line-clamp-2 min-h-[40px]">
                    {{ $product->description ?: 'No description available.' }}
                </p>
                
                <div class="flex justify-between items-center mb-4">
                    <div>
                        <span class="text-2xl font-bold text-[#FF6F61]">
                            Rp {{ number_format($product->price, 0, ',', '.') }}
                        </span>
                        @if($product->stock > 0)
                            <span class="text-sm text-[#8E7AB5] block">
                                {{ $product->stock }} available
                            </span>
                        @endif
                    </div>
                    
                    <!-- Rating -->
                    <div class="flex items-center">
                        <div class="flex text-yellow-400">
                            @for($i = 1; $i <= 5; $i++)
                                <i class="fas fa-star text-sm"></i>
                            @endfor
                        </div>
                        <span class="text-sm text-[#8E7AB5] ml-1">(5.0)</span>
                    </div>
                </div>
                
                <!-- Action Buttons -->
                <div class="flex gap-2">
                    <a href="{{ route('product.detail', $product->id) }}" 
                       class="flex-1 bg-[#FCEFEA] text-[#4D4C7D] text-center py-3 rounded-lg hover:bg-[#F9DCC4] transition-colors flex items-center justify-center">
                        <i class="fas fa-shopping-cart mr-2"></i> View
                    </a>
                    
                    @auth
                        @if(auth()->user()->isGuest())
                        <form action="{{ route('cart.add') }}" method="POST" class="flex-1">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                            <input type="hidden" name="qty" value="1">
                            <button type="submit" 
                                    class="w-full bg-[#8E7AB5] text-white py-3 rounded-lg hover:bg-[#4D4C7D] transition-colors flex items-center justify-center"
                                    {{ $product->stock == 0 ? 'disabled' : '' }}
                                    onclick="addToCartAnimation('{{ $product->name }}')">
                                <i class="fas fa-plus mr-2"></i> Add
                            </button>
                        </form>
                        @endif
                    @endauth
                </div>
            </div>
        </div>
        @endforeach
    </div>
    @else
    <div class="text-center py-12">
        <div class="w-24 h-24 mx-auto mb-4 bg-[#F9DCC4] rounded-full flex items-center justify-center">
            <i class="fas fa-box-open text-[#8E7AB5] text-3xl"></i>
        </div>
        <h3 class="text-xl font-bold text-[#4D4C7D] mb-2">No products yet</h3>
        <p class="text-[#8E7AB5]">Check back soon for cute products!</p>
    </div>
    @endif
</section>

<!-- Categories -->
<section class="mb-16">
    <h2 class="text-3xl md:text-4xl font-bold text-[#4D4C7D] mb-8 text-center">Shop by Category</h2>
    
    <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
        <a href="{{ route('shop') }}" class="category-card">
            <div class="category-icon bg-gradient-to-br from-[#FF6F61] to-[#FF8A80]">
                <i class="fas fa-tshirt"></i>
            </div>
            <h3 class="category-title">Apparel</h3>
            <p class="category-description">Cute clothing & accessories</p>
        </a>
        
        <a href="{{ route('shop') }}" class="category-card">
            <div class="category-icon bg-gradient-to-br from-[#8E7AB5] to-[#A396C4]">
                <i class="fas fa-home"></i>
            </div>
            <h3 class="category-title">Home Decor</h3>
            <p class="category-description">Adorable home items</p>
        </a>
        
        <a href="{{ route('shop') }}" class="category-card">
            <div class="category-icon bg-gradient-to-br from-[#F9DCC4] to-[#FFE8D6]">
                <i class="fas fa-gift"></i>
            </div>
            <h3 class="category-title">Gifts</h3>
            <p class="category-description">Perfect presents</p>
        </a>
        
        <a href="{{ route('shop') }}" class="category-card">
            <div class="category-icon bg-gradient-to-br from-[#4D4C7D] to-[#6A6899]">
                <i class="fas fa-bunny"></i>
            </div>
            <h3 class="category-title">Bunny Items</h3>
            <p class="category-description">Bunny-themed products</p>
        </a>
    </div>
</section>

<!-- Testimonials -->
<section class="mb-16">
    <div class="bg-gradient-to-r from-[#F9DCC4] to-[#FCEFEA] rounded-3xl p-8 md:p-12">
        <div class="text-center mb-10">
            <h2 class="text-3xl md:text-4xl font-bold text-[#4D4C7D] mb-2">What Our Customers Say</h2>
            <p class="text-[#8E7AB5]">Join thousands of happy customers</p>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <!-- Testimonial 1 -->
            <div class="bg-white rounded-2xl p-6 shadow-lg">
                <div class="flex items-center mb-4">
                    <div class="w-12 h-12 bg-gradient-to-r from-[#FF6F61] to-[#8E7AB5] rounded-full flex items-center justify-center text-white font-bold">
                        A
                    </div>
                    <div class="ml-4">
                        <h4 class="font-bold text-[#4D4C7D]">Alice Johnson</h4>
                        <div class="flex text-yellow-400">
                            @for($i = 1; $i <= 5; $i++)
                                <i class="fas fa-star text-sm"></i>
                            @endfor
                        </div>
                    </div>
                </div>
                <p class="text-[#4D4C7D] italic">
                    "The bunny plushie is so adorable! My daughter loves it. Fast shipping too!"
                </p>
            </div>
            
            <!-- Testimonial 2 -->
            <div class="bg-white rounded-2xl p-6 shadow-lg">
                <div class="flex items-center mb-4">
                    <div class="w-12 h-12 bg-gradient-to-r from-[#8E7AB5] to-[#4D4C7D] rounded-full flex items-center justify-center text-white font-bold">
                        B
                    </div>
                    <div class="ml-4">
                        <h4 class="font-bold text-[#4D4C7D]">Bob Smith</h4>
                        <div class="flex text-yellow-400">
                            @for($i = 1; $i <= 5; $i++)
                                <i class="fas fa-star text-sm"></i>
                            @endfor
                        </div>
                    </div>
                </div>
                <p class="text-[#4D4C7D] italic">
                    "Great quality products and excellent customer service. Will shop again!"
                </p>
            </div>
            
            <!-- Testimonial 3 -->
            <div class="bg-white rounded-2xl p-6 shadow-lg">
                <div class="flex items-center mb-4">
                    <div class="w-12 h-12 bg-gradient-to-r from-[#4D4C7D] to-[#FF6F61] rounded-full flex items-center justify-center text-white font-bold">
                        C
                    </div>
                    <div class="ml-4">
                        <h4 class="font-bold text-[#4D4C7D]">Charlie Brown</h4>
                        <div class="flex text-yellow-400">
                            @for($i = 1; $i <= 5; $i++)
                                <i class="fas fa-star text-sm"></i>
                            @endfor
                        </div>
                    </div>
                </div>
                <p class="text-[#4D4C7D] italic">
                    "Perfect gifts for my friends. Everyone loves the cute designs!"
                </p>
            </div>
        </div>
    </div>
</section>

<!-- About Preview -->
<section class="mb-16">
    <div class="bg-white rounded-3xl shadow-xl overflow-hidden">
        <div class="flex flex-col md:flex-row">
            <div class="md:w-1/2 p-8 md:p-12 flex flex-col justify-center">
                <h2 class="text-3xl md:text-4xl font-bold text-[#4D4C7D] mb-4">About BUNNYPOPS</h2>
                <p class="text-[#4D4C7D] mb-6 text-lg leading-relaxed">
                    BUNNYPOPS is an adorable e-commerce platform specializing in cute and playful products. 
                    Our mission is to bring joy and happiness through our carefully curated collection.
                </p>
                <p class="text-[#4D4C7D] mb-8 leading-relaxed">
                    Every product is selected with love and care to ensure it meets our high standards of cuteness and quality.
                    We believe in spreading happiness one cute item at a time!
                </p>
                
                <div class="flex flex-wrap gap-4 mb-8">
                    <div class="flex items-center">
                        <div class="w-10 h-10 bg-[#F9DCC4] rounded-full flex items-center justify-center mr-3">
                            <i class="fas fa-check text-[#FF6F61]"></i>
                        </div>
                        <span class="text-[#4D4C7D]">100% Cute Guarantee</span>
                    </div>
                    <div class="flex items-center">
                        <div class="w-10 h-10 bg-[#F9DCC4] rounded-full flex items-center justify-center mr-3">
                            <i class="fas fa-shipping-fast text-[#FF6F61]"></i>
                        </div>
                        <span class="text-[#4D4C7D]">Fast Shipping</span>
                    </div>
                    <div class="flex items-center">
                        <div class="w-10 h-10 bg-[#F9DCC4] rounded-full flex items-center justify-center mr-3">
                            <i class="fas fa-heart text-[#FF6F61]"></i>
                        </div>
                        <span class="text-[#4D4C7D]">Quality Materials</span>
                    </div>
                </div>
                
                <a href="{{ route('about') }}" 
                   class="inline-flex items-center justify-center bg-gradient-to-r from-[#FF6F61] to-[#8E7AB5] text-white px-8 py-3 rounded-xl font-bold hover:opacity-90 transition-all shadow-lg hover:shadow-xl w-full md:w-auto">
                    <i class="fas fa-info-circle mr-3"></i>
                    Learn More About Us
                </a>
            </div>
            
            <div class="md:w-1/2 relative">
                <div class="absolute inset-0 bg-gradient-to-r from-transparent via-white/50 to-white z-10"></div>
                <div class="h-full min-h-[400px] bg-gradient-to-br from-[#FF6F61] to-[#8E7AB5] flex items-center justify-center">
                    <div class="relative z-20 text-center p-8">
                        <i class="fas fa-heart text-white text-8xl mb-6"></i>
                        <h3 class="text-3xl font-bold text-white mb-4">Spread Love & Joy</h3>
                        <p class="text-white/90 text-lg">With every purchase</p>
                    </div>
                </div>
                
                <!-- Floating elements -->
                <div class="absolute top-6 right-6 w-16 h-16 bg-white rounded-full flex items-center justify-center shadow-xl z-20">
                    <i class="fas fa-gift text-[#FF6F61] text-2xl"></i>
                </div>
                <div class="absolute bottom-6 left-6 w-20 h-20 bg-white rounded-full flex items-center justify-center shadow-xl z-20">
                    <i class="fas fa-smile text-[#8E7AB5] text-3xl"></i>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Newsletter -->
<section class="mb-16">
    <div class="bg-gradient-to-r from-[#8E7AB5] to-[#4D4C7D] rounded-3xl p-8 md:p-12 text-center">
        <div class="max-w-2xl mx-auto">
            <h2 class="text-3xl md:text-4xl font-bold text-white mb-4">Stay Updated!</h2>
            <p class="text-white/90 mb-8 text-lg">
                Subscribe to our newsletter for exclusive deals and new cute arrivals
            </p>
            
            <form class="flex flex-col sm:flex-row gap-4 max-w-md mx-auto">
                <input type="email" 
                       placeholder="Your email address" 
                       class="flex-grow px-6 py-4 rounded-xl text-[#4D4C7D] outline-none shadow-lg">
                <button type="submit" 
                        class="bg-[#FF6F61] text-white px-8 py-4 rounded-xl font-bold hover:bg-[#FF8A80] transition-all shadow-lg hover:shadow-xl">
                    <i class="fas fa-paper-plane mr-2"></i>Subscribe
                </button>
            </form>
            
            <p class="text-white/70 text-sm mt-4">
                We promise not to spam you. Unsubscribe at any time.
            </p>
        </div>
    </div>
</section>

<style>
    .category-card {
        @apply bg-white rounded-2xl p-6 text-center shadow-lg hover:shadow-xl transition-all duration-300 hover:-translate-y-2 cursor-pointer;
    }
    
    .category-icon {
        @apply w-20 h-20 mx-auto mb-4 rounded-full flex items-center justify-center text-white text-3xl shadow-lg;
    }
    
    .category-title {
        @apply font-bold text-lg text-[#4D4C7D] mb-2;
    }
    
    .category-description {
        @apply text-[#8E7AB5] text-sm;
    }
    
    .card-product {
        @apply bg-white rounded-2xl shadow-lg overflow-hidden hover:shadow-xl transition-shadow duration-300;
    }
    
    .animate-slide-down {
        animation: slideDown 0.3s ease-out;
    }
    
    @keyframes slideDown {
        from {
            transform: translateY(-10px);
            opacity: 0;
        }
        to {
            transform: translateY(0);
            opacity: 1;
        }
    }
    
    .animate-pulse {
        animation: pulse 2s infinite;
    }
    
    @keyframes pulse {
        0%, 100% {
            opacity: 0.2;
        }
        50% {
            opacity: 0.3;
        }
    }
</style>
@endsection