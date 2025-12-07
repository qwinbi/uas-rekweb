@extends('layouts.app')

@section('title', $product->name . ' - BUNNYPOPS')

@section('content')
<div class="py-8">
    <!-- Breadcrumb -->
    <div class="mb-6">
        <nav class="flex" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-1 md:space-x-3">
                <li class="inline-flex items-center">
                    <a href="{{ route('home') }}" class="inline-flex items-center text-sm text-[#8E7AB5] hover:text-[#FF6F61]">
                        <i class="fas fa-home mr-2"></i>
                        Home
                    </a>
                </li>
                <li>
                    <div class="flex items-center">
                        <i class="fas fa-chevron-right text-[#8E7AB5] mx-2"></i>
                        <a href="{{ route('shop') }}" class="text-sm text-[#8E7AB5] hover:text-[#FF6F61]">
                            Shop
                        </a>
                    </div>
                </li>
                <li aria-current="page">
                    <div class="flex items-center">
                        <i class="fas fa-chevron-right text-[#8E7AB5] mx-2"></i>
                        <span class="text-sm font-medium text-[#4D4C7D] truncate max-w-xs">
                            {{ $product->name }}
                        </span>
                    </div>
                </li>
            </ol>
        </nav>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
        <!-- Product Images -->
        <div>
            <!-- Main Image -->
            <div class="bg-white rounded-2xl shadow-lg overflow-hidden mb-4">
                <div class="relative h-96">
                    @if($product->photo)
                        <img src="{{ asset('storage/products/' . $product->photo) }}" 
                             alt="{{ $product->name }}" 
                             class="w-full h-full object-cover">
                    @else
                        <div class="w-full h-full bg-gradient-to-br from-[#F9DCC4] to-[#8E7AB5] flex items-center justify-center">
                            <i class="fas fa-box text-white text-8xl opacity-50"></i>
                        </div>
                    @endif
                    
                    <!-- Sale Badge -->
                    @if($product->price > 100000)
                        <div class="absolute top-4 left-4">
                            <span class="bg-[#FF6F61] text-white px-4 py-2 rounded-full font-bold text-sm shadow-lg">
                                20% OFF
                            </span>
                        </div>
                    @endif
                    
                    <!-- Wishlist Button -->
                    <button class="absolute top-4 right-4 w-12 h-12 bg-white rounded-full flex items-center justify-center shadow-lg hover:bg-[#FF6F61] hover:text-white transition-colors">
                        <i class="far fa-heart text-xl"></i>
                    </button>
                </div>
            </div>
            
            <!-- Thumbnails -->
            <div class="flex gap-3 overflow-x-auto pb-2">
                @for($i = 0; $i < 3; $i++)
                    <div class="flex-shrink-0 w-20 h-20 bg-white rounded-lg shadow-sm border-2 border-transparent hover:border-[#FF6F61] cursor-pointer overflow-hidden">
                        @if($product->photo)
                            <img src="{{ asset('storage/products/' . $product->photo) }}" 
                                 alt="{{ $product->name }}" 
                                 class="w-full h-full object-cover">
                        @else
                            <div class="w-full h-full bg-gradient-to-br from-[#F9DCC4] to-[#8E7AB5] flex items-center justify-center">
                                <i class="fas fa-box text-white opacity-50"></i>
                            </div>
                        @endif
                    </div>
                @endfor
            </div>
        </div>

        <!-- Product Info -->
        <div>
            <!-- Stock Status -->
            <div class="mb-4">
                @if($product->stock == 0)
                    <span class="bg-red-100 text-red-800 px-4 py-2 rounded-full font-bold text-sm">
                        <i class="fas fa-times-circle mr-2"></i> Out of Stock
                    </span>
                @elseif($product->stock < 10)
                    <span class="bg-yellow-100 text-yellow-800 px-4 py-2 rounded-full font-bold text-sm">
                        <i class="fas fa-exclamation-triangle mr-2"></i> Only {{ $product->stock }} left
                    </span>
                @else
                    <span class="bg-green-100 text-green-800 px-4 py-2 rounded-full font-bold text-sm">
                        <i class="fas fa-check-circle mr-2"></i> In Stock
                    </span>
                @endif
            </div>

            <!-- Product Title -->
            <h1 class="text-3xl md:text-4xl font-bold text-[#4D4C7D] mb-3">{{ $product->name }}</h1>
            
            <!-- Rating -->
            <div class="flex items-center mb-4">
                <div class="flex text-yellow-400 mr-2">
                    @for($i = 1; $i <= 5; $i++)
                        <i class="fas fa-star"></i>
                    @endfor
                </div>
                <span class="text-[#8E7AB5] mr-4">5.0 (24 reviews)</span>
                <span class="text-[#8E7AB5]">
                    <i class="fas fa-shopping-cart mr-1"></i> 42 sold
                </span>
            </div>

            <!-- Price -->
            <div class="mb-6">
                <div class="flex items-center">
                    <span class="text-4xl font-bold text-[#FF6F61]">
                        Rp {{ number_format($product->price, 0, ',', '.') }}
                    </span>
                    @if($product->price > 100000)
                        <span class="ml-4 text-xl text-[#8E7AB5] line-through">
                            Rp {{ number_format($product->price * 1.2, 0, ',', '.') }}
                        </span>
                        <span class="ml-4 bg-[#FF6F61]/10 text-[#FF6F61] px-3 py-1 rounded-full font-bold">
                            Save 20%
                        </span>
                    @endif
                </div>
            </div>

            <!-- Description -->
            <div class="mb-8">
                <h3 class="font-bold text-lg text-[#4D4C7D] mb-3">Description</h3>
                <div class="text-[#4D4C7D] leading-relaxed space-y-3">
                    <p>{{ $product->description ?: 'No description available for this product.' }}</p>
                    
                    <ul class="space-y-2">
                        <li class="flex items-center">
                            <i class="fas fa-check text-green-500 mr-3"></i>
                            <span>Premium quality materials</span>
                        </li>
                        <li class="flex items-center">
                            <i class="fas fa-check text-green-500 mr-3"></i>
                            <span>Safe for all ages</span>
                        </li>
                        <li class="flex items-center">
                            <i class="fas fa-check text-green-500 mr-3"></i>
                            <span>Easy to clean and maintain</span>
                        </li>
                        <li class="flex items-center">
                            <i class="fas fa-check text-green-500 mr-3"></i>
                            <span>Perfect gift for any occasion</span>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Quantity Selector -->
            <div class="mb-8">
                <h3 class="font-bold text-lg text-[#4D4C7D] mb-3">Quantity</h3>
                <div class="flex items-center">
                    <button id="decrease-qty" class="w-12 h-12 bg-[#FCEFEA] text-[#4D4C7D] rounded-l-lg hover:bg-[#F9DCC4] transition-colors">
                        <i class="fas fa-minus"></i>
                    </button>
                    <input type="number" 
                           id="quantity" 
                           name="quantity" 
                           value="1" 
                           min="1" 
                           max="{{ $product->stock }}"
                           class="w-20 h-12 text-center border-y border-[#F9DCC4] text-lg font-bold text-[#4D4C7D] focus:outline-none">
                    <button id="increase-qty" class="w-12 h-12 bg-[#FCEFEA] text-[#4D4C7D] rounded-r-lg hover:bg-[#F9DCC4] transition-colors">
                        <i class="fas fa-plus"></i>
                    </button>
                    
                    <div class="ml-6 text-[#8E7AB5]">
                        {{ $product->stock }} available
                    </div>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="flex flex-col sm:flex-row gap-4 mb-8">
                @auth
                    @if(auth()->user()->isGuest())
                        @if($product->stock > 0)
                        <form action="{{ route('cart.add') }}" method="POST" class="flex-1">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                            <input type="hidden" name="qty" value="1" id="form-qty">
                            <button type="submit" 
                                    class="w-full bg-[#8E7AB5] text-white py-4 rounded-xl font-bold hover:bg-[#4D4C7D] transition-all shadow-lg hover:shadow-xl flex items-center justify-center group">
                                <i class="fas fa-cart-plus text-xl mr-3 group-hover:scale-110 transition-transform"></i>
                                Add to Cart
                            </button>
                        </form>
                        @endif
                    @endif
                @else
                    <a href="{{ route('login') }}" 
                       class="flex-1 bg-[#8E7AB5] text-white py-4 rounded-xl font-bold hover:bg-[#4D4C7D] transition-all shadow-lg hover:shadow-xl flex items-center justify-center group">
                        <i class="fas fa-cart-plus text-xl mr-3 group-hover:scale-110 transition-transform"></i>
                        Add to Cart
                    </a>
                @endauth
                
                <button class="flex-1 bg-[#FCEFEA] text-[#4D4C7D] py-4 rounded-xl font-bold hover:bg-[#F9DCC4] transition-all shadow-lg hover:shadow-xl flex items-center justify-center group">
                    <i class="far fa-heart text-xl mr-3 group-hover:scale-110 transition-transform"></i>
                    Add to Wishlist
                </button>
            </div>
            
            <!-- Buy Now Button -->
            @auth
                @if(auth()->user()->isGuest() && $product->stock > 0)
                <form action="{{ route('cart.add') }}" method="POST" class="mb-8">
                    @csrf
                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                    <input type="hidden" name="qty" value="1" id="buy-now-qty">
                    <input type="hidden" name="buy_now" value="1">
                    <button type="submit" 
                            class="w-full bg-gradient-to-r from-[#FF6F61] to-[#FF8A80] text-white py-4 rounded-xl font-bold hover:opacity-90 transition-all shadow-lg hover:shadow-xl flex items-center justify-center group">
                        <i class="fas fa-bolt text-xl mr-3 group-hover:scale-110 transition-transform"></i>
                        Buy Now
                    </button>
                </form>
                @endif
            @else
                <a href="{{ route('login') }}" 
                   class="w-full bg-gradient-to-r from-[#FF6F61] to-[#FF8A80] text-white py-4 rounded-xl font-bold hover:opacity-90 transition-all shadow-lg hover:shadow-xl flex items-center justify-center group mb-8">
                    <i class="fas fa-bolt text-xl mr-3 group-hover:scale-110 transition-transform"></i>
                    Buy Now
                </a>
            @endauth

            <!-- Product Details -->
            <div class="border-t border-[#F9DCC4] pt-8">
                <h3 class="font-bold text-lg text-[#4D4C7D] mb-4">Product Details</h3>
                <div class="grid grid-cols-2 gap-4">
                    <div class="flex items-center">
                        <div class="w-10 h-10 bg-[#F9DCC4] rounded-lg flex items-center justify-center mr-3">
                            <i class="fas fa-weight text-[#8E7AB5]"></i>
                        </div>
                        <div>
                            <div class="text-sm text-[#8E7AB5]">Weight</div>
                            <div class="font-medium text-[#4D4C7D]">0.5 kg</div>
                        </div>
                    </div>
                    
                    <div class="flex items-center">
                        <div class="w-10 h-10 bg-[#F9DCC4] rounded-lg flex items-center justify-center mr-3">
                            <i class="fas fa-ruler-combined text-[#8E7AB5]"></i>
                        </div>
                        <div>
                            <div class="text-sm text-[#8E7AB5]">Dimensions</div>
                            <div class="font-medium text-[#4D4C7D]">20 x 15 x 10 cm</div>
                        </div>
                    </div>
                    
                    <div class="flex items-center">
                        <div class="w-10 h-10 bg-[#F9DCC4] rounded-lg flex items-center justify-center mr-3">
                            <i class="fas fa-palette text-[#8E7AB5]"></i>
                        </div>
                        <div>
                            <div class="text-sm text-[#8E7AB5]">Color</div>
                            <div class="font-medium text-[#4D4C7D]">Various</div>
                        </div>
                    </div>
                    
                    <div class="flex items-center">
                        <div class="w-10 h-10 bg-[#F9DCC4] rounded-lg flex items-center justify-center mr-3">
                            <i class="fas fa-cube text-[#8E7AB5]"></i>
                        </div>
                        <div>
                            <div class="text-sm text-[#8E7AB5]">Material</div>
                            <div class="font-medium text-[#4D4C7D]">Premium Fabric</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Related Products -->
    @if($relatedProducts->count() > 0)
    <div class="mt-16">
        <h2 class="text-3xl font-bold text-[#4D4C7D] mb-8">You May Also Like</h2>
        
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            @foreach($relatedProducts as $relatedProduct)
            <div class="bg-white rounded-2xl shadow-lg overflow-hidden hover:shadow-xl transition-all duration-300 hover:-translate-y-1">
                <a href="{{ route('product.detail', $relatedProduct->id) }}" class="block">
                    <div class="h-48 overflow-hidden">
                        @if($relatedProduct->photo)
                            <img src="{{ asset('storage/products/' . $relatedProduct->photo) }}" 
                                 alt="{{ $relatedProduct->name }}" 
                                 class="w-full h-full object-cover hover:scale-110 transition-transform duration-500">
                        @else
                            <div class="w-full h-full bg-gradient-to-br from-[#F9DCC4] to-[#8E7AB5] flex items-center justify-center">
                                <i class="fas fa-box text-white text-5xl opacity-50"></i>
                            </div>
                        @endif
                    </div>
                    <div class="p-4">
                        <h3 class="font-bold text-[#4D4C7D] mb-2 truncate">{{ $relatedProduct->name }}</h3>
                        <div class="flex justify-between items-center">
                            <span class="text-xl font-bold text-[#FF6F61]">
                                Rp {{ number_format($relatedProduct->price, 0, ',', '.') }}
                            </span>
                            @if($relatedProduct->stock > 0)
                                <span class="text-xs text-[#8E7AB5] bg-[#FCEFEA] px-2 py-1 rounded-full">
                                    {{ $relatedProduct->stock }} in stock
                                </span>
                            @endif
                        </div>
                    </div>
                </a>
            </div>
            @endforeach
        </div>
    </div>
    @endif

    <!-- Reviews Section -->
    <div class="mt-16">
        <h2 class="text-3xl font-bold text-[#4D4C7D] mb-8">Customer Reviews</h2>
        
        <div class="bg-white rounded-2xl shadow-lg p-8">
            <!-- Review Stats -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-8">
                <!-- Average Rating -->
                <div>
                    <div class="flex items-center mb-4">
                        <div class="text-5xl font-bold text-[#4D4C7D] mr-4">5.0</div>
                        <div>
                            <div class="flex text-yellow-400 mb-1">
                                @for($i = 1; $i <= 5; $i++)
                                    <i class="fas fa-star"></i>
                                @endfor
                            </div>
                            <div class="text-[#8E7AB5]">Based on 24 reviews</div>
                        </div>
                    </div>
                    
                    <!-- Rating Distribution -->
                    <div class="space-y-2">
                        @for($i = 5; $i >= 1; $i--)
                            <div class="flex items-center">
                                <div class="w-10 text-[#4D4C7D]">{{ $i }} <i class="fas fa-star text-yellow-400"></i></div>
                                <div class="flex-1 h-2 bg-[#FCEFEA] rounded-full overflow-hidden ml-3">
                                    <div class="h-full bg-yellow-400 rounded-full" style="width: {{ 100 - ($i * 15) }}%"></div>
                                </div>
                                <div class="w-10 text-right text-[#8E7AB5] text-sm">
                                    {{ 24 - ($i * 4) }}
                                </div>
                            </div>
                        @endfor
                    </div>
                </div>
                
                <!-- Write Review Button -->
                <div class="flex flex-col justify-center">
                    <h3 class="font-bold text-lg text-[#4D4C7D] mb-4">Share Your Experience</h3>
                    <p class="text-[#4D4C7D] mb-6">
                        Have you purchased this product? Share your thoughts with other customers!
                    </p>
                    <button class="bg-[#FCEFEA] text-[#4D4C7D] py-3 rounded-xl font-bold hover:bg-[#F9DCC4] transition-colors flex items-center justify-center group">
                        <i class="fas fa-pen mr-3 group-hover:scale-110 transition-transform"></i>
                        Write a Review
                    </button>
                </div>
            </div>
            
            <!-- Reviews List -->
            <div class="space-y-6">
                <!-- Sample Review 1 -->
                <div class="border-b border-[#F9DCC4] pb-6 last:border-0 last:pb-0">
                    <div class="flex justify-between items-start mb-4">
                        <div>
                            <div class="flex items-center mb-2">
                                <div class="w-10 h-10 bg-gradient-to-r from-[#FF6F61] to-[#8E7AB5] rounded-full flex items-center justify-center text-white font-bold mr-3">
                                    A
                                </div>
                                <div>
                                    <div class="font-bold text-[#4D4C7D]">Alice Johnson</div>
                                    <div class="flex text-yellow-400">
                                        @for($i = 1; $i <= 5; $i++)
                                            <i class="fas fa-star text-sm"></i>
                                        @endfor
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="text-[#8E7AB5] text-sm">2 days ago</div>
                    </div>
                    <p class="text-[#4D4C7D]">
                        "Absolutely love this product! The quality is amazing and it's even cuter in person. 
                        My daughter hasn't stopped playing with it since it arrived."
                    </p>
                </div>
                
                <!-- Sample Review 2 -->
                <div class="border-b border-[#F9DCC4] pb-6 last:border-0 last:pb-0">
                    <div class="flex justify-between items-start mb-4">
                        <div>
                            <div class="flex items-center mb-2">
                                <div class="w-10 h-10 bg-gradient-to-r from-[#8E7AB5] to-[#4D4C7D] rounded-full flex items-center justify-center text-white font-bold mr-3">
                                    B
                                </div>
                                <div>
                                    <div class="font-bold text-[#4D4C7D]">Bob Smith</div>
                                    <div class="flex text-yellow-400">
                                        @for($i = 1; $i <= 5; $i++)
                                            <i class="fas fa-star text-sm"></i>
                                        @endfor
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="text-[#8E7AB5] text-sm">1 week ago</div>
                    </div>
                    <p class="text-[#4D4C7D]">
                        "Great product! Fast shipping and excellent packaging. Would definitely buy again."
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // Quantity selector
    const quantityInput = document.getElementById('quantity');
    const formQtyInput = document.getElementById('form-qty');
    const buyNowQtyInput = document.getElementById('buy-now-qty');
    const maxStock = {{ $product->stock }};
    
    document.getElementById('decrease-qty')?.addEventListener('click', function() {
        let value = parseInt(quantityInput.value);
        if (value > 1) {
            quantityInput.value = value - 1;
            updateFormQuantities();
        }
    });
    
    document.getElementById('increase-qty')?.addEventListener('click', function() {
        let value = parseInt(quantityInput.value);
        if (value < maxStock) {
            quantityInput.value = value + 1;
            updateFormQuantities();
        }
    });
    
    quantityInput.addEventListener('change', function() {
        let value = parseInt(this.value);
        if (isNaN(value) || value < 1) {
            this.value = 1;
        } else if (value > maxStock) {
            this.value = maxStock;
        }
        updateFormQuantities();
    });
    
    function updateFormQuantities() {
        const value = quantityInput.value;
        if (formQtyInput) formQtyInput.value = value;
        if (buyNowQtyInput) buyNowQtyInput.value = value;
    }
    
    // Add to cart animation
    function addToCartAnimation(productName) {
        const notification = document.createElement('div');
        notification.className = 'fixed top-20 right-4 z-50 bg-[#8E7AB5] text-white px-6 py-3 rounded-lg shadow-xl animate-slide-in flex items-center';
        notification.innerHTML = `
            <div class="w-8 h-8 bg-white/20 rounded-full flex items-center justify-center mr-3">
                <i class="fas fa-check"></i>
            </div>
            <div>
                <div class="font-bold">Added to Cart!</div>
                <div class="text-sm opacity-90">${productName}</div>
            </div>
        `;
        document.body.appendChild(notification);
        
        setTimeout(() => {
            notification.style.opacity = '0';
            setTimeout(() => notification.remove(), 500);
        }, 3000);
        
        // Update cart counter
        const cartCounter = document.getElementById('cart-counter');
        if (cartCounter) {
            let count = parseInt(cartCounter.textContent) || 0;
            count += parseInt(quantityInput.value);
            cartCounter.textContent = count;
            cartCounter.classList.remove('hidden');
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
    
    input[type="number"]::-webkit-inner-spin-button,
    input[type="number"]::-webkit-outer-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }
</style>
@endsection