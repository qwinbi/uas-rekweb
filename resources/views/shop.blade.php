@extends('layouts.app')

@section('title', 'Shop - BUNNYPOPS')

@section('content')
<div class="py-8">
    <!-- Shop Header -->
    <div class="mb-8">
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
            <div>
                <h1 class="text-3xl md:text-4xl font-bold text-[#4D4C7D] mb-2">Shop Our Collection</h1>
                <p class="text-[#8E7AB5]">Discover cute products that bring joy</p>
            </div>
            
            <!-- Sort and Filter Toggle -->
            <div class="flex items-center gap-4">
                <div class="relative">
                    <select class="appearance-none bg-white border-2 border-[#F9DCC4] rounded-lg px-4 py-2 pr-10 text-[#4D4C7D] focus:outline-none focus:border-[#FF6F61] focus:ring-2 focus:ring-[#FF6F61]/30">
                        <option>Sort by: Newest</option>
                        <option>Price: Low to High</option>
                        <option>Price: High to Low</option>
                        <option>Most Popular</option>
                    </select>
                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-[#8E7AB5]">
                        <i class="fas fa-chevron-down"></i>
                    </div>
                </div>
                
                <button id="filter-toggle" 
                        class="md:hidden bg-[#FF6F61] text-white px-4 py-2 rounded-lg flex items-center gap-2">
                    <i class="fas fa-filter"></i>
                    Filters
                </button>
            </div>
        </div>
    </div>

    <div class="flex flex-col md:flex-row gap-8">
        <!-- Sidebar Filters -->
        <div id="filter-sidebar" class="md:w-1/4">
            <div class="bg-white rounded-2xl shadow-lg p-6 mb-6 sticky top-24">
                <!-- Mobile Filter Header -->
                <div class="flex justify-between items-center mb-6 md:hidden">
                    <h3 class="font-bold text-lg text-[#4D4C7D]">Filters</h3>
                    <button id="close-filters" class="text-[#FF6F61]">
                        <i class="fas fa-times text-xl"></i>
                    </button>
                </div>

                <h3 class="font-bold text-lg text-[#4D4C7D] mb-6 hidden md:block">Filters</h3>
                
                <!-- Price Range -->
                <div class="mb-8">
                    <h4 class="font-medium text-[#4D4C7D] mb-4 flex items-center">
                        <i class="fas fa-tag mr-2 text-[#8E7AB5]"></i>
                        Price Range
                    </h4>
                    <div class="space-y-3">
                        <label class="flex items-center cursor-pointer">
                            <input type="radio" name="price" class="hidden" checked>
                            <div class="w-5 h-5 rounded-full border-2 border-[#F9DCC4] flex items-center justify-center mr-3">
                                <div class="w-3 h-3 rounded-full bg-[#FF6F61] hidden"></div>
                            </div>
                            <span class="text-[#4D4C7D]">All Prices</span>
                        </label>
                        
                        <label class="flex items-center cursor-pointer">
                            <input type="radio" name="price" class="hidden">
                            <div class="w-5 h-5 rounded-full border-2 border-[#F9DCC4] flex items-center justify-center mr-3">
                                <div class="w-3 h-3 rounded-full bg-[#FF6F61] hidden"></div>
                            </div>
                            <span class="text-[#4D4C7D]">Under Rp 50.000</span>
                        </label>
                        
                        <label class="flex items-center cursor-pointer">
                            <input type="radio" name="price" class="hidden">
                            <div class="w-5 h-5 rounded-full border-2 border-[#F9DCC4] flex items-center justify-center mr-3">
                                <div class="w-3 h-3 rounded-full bg-[#FF6F61] hidden"></div>
                            </div>
                            <span class="text-[#4D4C7D]">Rp 50.000 - 100.000</span>
                        </label>
                        
                        <label class="flex items-center cursor-pointer">
                            <input type="radio" name="price" class="hidden">
                            <div class="w-5 h-5 rounded-full border-2 border-[#F9DCC4] flex items-center justify-center mr-3">
                                <div class="w-3 h-3 rounded-full bg-[#FF6F61] hidden"></div>
                            </div>
                            <span class="text-[#4D4C7D]">Over Rp 100.000</span>
                        </label>
                    </div>
                </div>
                
                <!-- Categories -->
                <div class="mb-8">
                    <h4 class="font-medium text-[#4D4C7D] mb-4 flex items-center">
                        <i class="fas fa-list mr-2 text-[#8E7AB5]"></i>
                        Categories
                    </h4>
                    <div class="space-y-2">
                        <label class="flex items-center cursor-pointer">
                            <input type="checkbox" class="hidden">
                            <div class="w-5 h-5 border-2 border-[#F9DCC4] rounded flex items-center justify-center mr-3">
                                <i class="fas fa-check text-[#FF6F61] text-xs hidden"></i>
                            </div>
                            <span class="text-[#4D4C7D]">Apparel</span>
                        </label>
                        
                        <label class="flex items-center cursor-pointer">
                            <input type="checkbox" class="hidden">
                            <div class="w-5 h-5 border-2 border-[#F9DCC4] rounded flex items-center justify-center mr-3">
                                <i class="fas fa-check text-[#FF6F61] text-xs hidden"></i>
                            </div>
                            <span class="text-[#4D4C7D]">Home Decor</span>
                        </label>
                        
                        <label class="flex items-center cursor-pointer">
                            <input type="checkbox" class="hidden">
                            <div class="w-5 h-5 border-2 border-[#F9DCC4] rounded flex items-center justify-center mr-3">
                                <i class="fas fa-check text-[#FF6F61] text-xs hidden"></i>
                            </div>
                            <span class="text-[#4D4C7D]">Gifts</span>
                        </label>
                        
                        <label class="flex items-center cursor-pointer">
                            <input type="checkbox" class="hidden">
                            <div class="w-5 h-5 border-2 border-[#F9DCC4] rounded flex items-center justify-center mr-3">
                                <i class="fas fa-check text-[#FF6F61] text-xs hidden"></i>
                            </div>
                            <span class="text-[#4D4C7D]">Bunny Items</span>
                        </label>
                    </div>
                </div>
                
                <!-- Stock Availability -->
                <div class="mb-8">
                    <h4 class="font-medium text-[#4D4C7D] mb-4 flex items-center">
                        <i class="fas fa-box mr-2 text-[#8E7AB5]"></i>
                        Stock
                    </h4>
                    <div class="space-y-2">
                        <label class="flex items-center cursor-pointer">
                            <input type="checkbox" class="hidden" checked>
                            <div class="w-5 h-5 border-2 border-[#F9DCC4] rounded flex items-center justify-center mr-3">
                                <i class="fas fa-check text-[#FF6F61] text-xs"></i>
                            </div>
                            <span class="text-[#4D4C7D]">In Stock</span>
                        </label>
                        
                        <label class="flex items-center cursor-pointer">
                            <input type="checkbox" class="hidden">
                            <div class="w-5 h-5 border-2 border-[#F9DCC4] rounded flex items-center justify-center mr-3">
                                <i class="fas fa-check text-[#FF6F61] text-xs hidden"></i>
                            </div>
                            <span class="text-[#4D4C7D]">Out of Stock</span>
                        </label>
                    </div>
                </div>
                
                <!-- Rating -->
                <div class="mb-8">
                    <h4 class="font-medium text-[#4D4C7D] mb-4 flex items-center">
                        <i class="fas fa-star mr-2 text-[#8E7AB5]"></i>
                        Rating
                    </h4>
                    <div class="space-y-2">
                        @for($i = 5; $i >= 1; $i--)
                            <label class="flex items-center cursor-pointer">
                                <input type="checkbox" class="hidden">
                                <div class="w-5 h-5 border-2 border-[#F9DCC4] rounded flex items-center justify-center mr-3">
                                    <i class="fas fa-check text-[#FF6F61] text-xs hidden"></i>
                                </div>
                                <div class="flex text-yellow-400 mr-2">
                                    @for($j = 1; $j <= $i; $j++)
                                        <i class="fas fa-star text-sm"></i>
                                    @endfor
                                    @for($j = $i + 1; $j <= 5; $j++)
                                        <i class="far fa-star text-sm"></i>
                                    @endfor
                                </div>
                                <span class="text-[#8E7AB5] text-sm">& Up</span>
                            </label>
                        @endfor
                    </div>
                </div>
                
                <!-- Action Buttons -->
                <div class="flex gap-3">
                    <button class="flex-1 bg-[#FF6F61] text-white py-3 rounded-lg font-bold hover:bg-[#FF8A80] transition-colors">
                        Apply Filters
                    </button>
                    <button class="flex-1 bg-[#FCEFEA] text-[#4D4C7D] py-3 rounded-lg font-bold hover:bg-[#F9DCC4] transition-colors">
                        Reset
                    </button>
                </div>
            </div>
            
            <!-- Banner -->
            <div class="bg-gradient-to-r from-[#FF6F61] to-[#8E7AB5] rounded-2xl p-6 text-white text-center">
                <div class="w-16 h-16 mx-auto mb-4 bg-white/20 rounded-full flex items-center justify-center">
                    <i class="fas fa-gift text-2xl"></i>
                </div>
                <h4 class="font-bold text-lg mb-2">Special Offer!</h4>
                <p class="text-sm mb-4">Get 10% off your first order</p>
                <button class="bg-white text-[#FF6F61] px-4 py-2 rounded-lg font-bold text-sm hover:bg-[#F9DCC4] transition-colors">
                    CLAIM NOW
                </button>
            </div>
        </div>

        <!-- Products Grid -->
        <div class="md:w-3/4">
            <!-- Products Count -->
            <div class="flex justify-between items-center mb-6">
                <p class="text-[#4D4C7D]">
                    Showing <span class="font-bold">{{ $products->count() }}</span> products
                </p>
                
                <div class="flex items-center gap-2">
                    <span class="text-[#4D4C7D]">View:</span>
                    <button class="p-2 rounded-lg bg-white border border-[#F9DCC4] text-[#8E7AB5] hover:text-[#FF6F61]">
                        <i class="fas fa-th-large"></i>
                    </button>
                    <button class="p-2 rounded-lg bg-[#FCEFEA] border border-[#F9DCC4] text-[#FF6F61]">
                        <i class="fas fa-list"></i>
                    </button>
                </div>
            </div>
            
            @if($products->count() > 0)
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($products as $product)
                <div class="bg-white rounded-2xl shadow-lg overflow-hidden hover:shadow-xl transition-all duration-300 hover:-translate-y-1">
                    <!-- Product Image -->
                    <div class="relative h-48 overflow-hidden">
                        @if($product->photo)
                            <img src="{{ asset('storage/products/' . $product->photo) }}" 
                                 alt="{{ $product->name }}" 
                                 class="w-full h-full object-cover hover:scale-110 transition-transform duration-500">
                        @else
                            <div class="w-full h-full bg-gradient-to-br from-[#F9DCC4] to-[#8E7AB5] flex items-center justify-center">
                                <i class="fas fa-box text-white text-5xl opacity-50"></i>
                            </div>
                        @endif
                        
                        <!-- Wishlist Button -->
                        <button class="absolute top-3 right-3 w-10 h-10 bg-white rounded-full flex items-center justify-center shadow-lg hover:bg-[#FF6F61] hover:text-white transition-colors">
                            <i class="far fa-heart"></i>
                        </button>
                        
                        <!-- Stock Badge -->
                        @if($product->stock == 0)
                            <div class="absolute top-3 left-3">
                                <span class="bg-red-100 text-red-800 text-xs font-bold px-3 py-1 rounded-full">
                                    Out of Stock
                                </span>
                            </div>
                        @elseif($product->stock < 10)
                            <div class="absolute top-3 left-3">
                                <span class="bg-yellow-100 text-yellow-800 text-xs font-bold px-3 py-1 rounded-full">
                                    Only {{ $product->stock }} left
                                </span>
                            </div>
                        @endif
                    </div>
                    
                    <!-- Product Info -->
                    <div class="p-5">
                        <div class="flex justify-between items-start mb-2">
                            <h3 class="font-bold text-lg text-[#4D4C7D] truncate">{{ $product->name }}</h3>
                            @if($product->stock > 0)
                                <span class="text-xs text-[#8E7AB5] bg-[#FCEFEA] px-2 py-1 rounded-full">
                                    {{ $product->stock }} in stock
                                </span>
                            @endif
                        </div>
                        
                        <!-- Rating -->
                        <div class="flex items-center mb-3">
                            <div class="flex text-yellow-400">
                                @for($i = 1; $i <= 5; $i++)
                                    <i class="fas fa-star text-sm"></i>
                                @endfor
                            </div>
                            <span class="text-sm text-[#8E7AB5] ml-2">(5.0)</span>
                        </div>
                        
                        <p class="text-[#4D4C7D]/70 text-sm mb-4 line-clamp-2 min-h-[40px]">
                            {{ $product->description ?: 'No description available.' }}
                        </p>
                        
                        <!-- Price & Actions -->
                        <div class="flex justify-between items-center">
                            <div>
                                <span class="text-2xl font-bold text-[#FF6F61]">
                                    Rp {{ number_format($product->price, 0, ',', '.') }}
                                </span>
                                @if($product->price > 100000)
                                    <div class="text-xs text-[#8E7AB5] line-through">
                                        Rp {{ number_format($product->price * 1.2, 0, ',', '.') }}
                                    </div>
                                @endif
                            </div>
                            
                            <div class="flex gap-2">
                                <a href="{{ route('product.detail', $product->id) }}" 
                                   class="w-10 h-10 bg-[#FCEFEA] text-[#4D4C7D] rounded-lg flex items-center justify-center hover:bg-[#F9DCC4] transition-colors">
                                    <i class="fas fa-eye"></i>
                                </a>
                                
                                @auth
                                    @if(auth()->user()->isGuest() && $product->stock > 0)
                                    <form action="{{ route('cart.add') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                                        <input type="hidden" name="qty" value="1">
                                        <button type="submit" 
                                                class="w-10 h-10 bg-[#8E7AB5] text-white rounded-lg flex items-center justify-center hover:bg-[#4D4C7D] transition-colors"
                                                onclick="addToCartAnimation('{{ $product->name }}')">
                                            <i class="fas fa-cart-plus"></i>
                                        </button>
                                    </form>
                                    @endif
                                @endauth
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            
            <!-- Pagination -->
            @if($products->hasPages())
            <div class="mt-12">
                <div class="flex justify-center">
                    <nav class="flex items-center gap-2">
                        <!-- Previous Button -->
                        @if($products->onFirstPage())
                            <span class="px-4 py-2 rounded-lg bg-[#FCEFEA] text-[#8E7AB5] cursor-not-allowed">
                                <i class="fas fa-chevron-left"></i>
                            </span>
                        @else
                            <a href="{{ $products->previousPageUrl() }}" 
                               class="px-4 py-2 rounded-lg bg-white text-[#4D4C7D] hover:bg-[#FCEFEA] transition-colors shadow-sm">
                                <i class="fas fa-chevron-left"></i>
                            </a>
                        @endif
                        
                        <!-- Page Numbers -->
                        @foreach(range(1, $products->lastPage()) as $page)
                            @if($page == $products->currentPage())
                                <span class="px-4 py-2 rounded-lg bg-[#FF6F61] text-white font-bold">
                                    {{ $page }}
                                </span>
                            @else
                                <a href="{{ $products->url($page) }}" 
                                   class="px-4 py-2 rounded-lg bg-white text-[#4D4C7D] hover:bg-[#FCEFEA] transition-colors shadow-sm">
                                    {{ $page }}
                                </a>
                            @endif
                        @endforeach
                        
                        <!-- Next Button -->
                        @if($products->hasMorePages())
                            <a href="{{ $products->nextPageUrl() }}" 
                               class="px-4 py-2 rounded-lg bg-white text-[#4D4C7D] hover:bg-[#FCEFEA] transition-colors shadow-sm">
                                <i class="fas fa-chevron-right"></i>
                            </a>
                        @else
                            <span class="px-4 py-2 rounded-lg bg-[#FCEFEA] text-[#8E7AB5] cursor-not-allowed">
                                <i class="fas fa-chevron-right"></i>
                            </span>
                        @endif
                    </nav>
                </div>
            </div>
            @endif
            
            @else
            <!-- Empty State -->
            <div class="text-center py-16">
                <div class="w-32 h-32 mx-auto mb-6 bg-gradient-to-br from-[#F9DCC4] to-[#FCEFEA] rounded-full flex items-center justify-center">
                    <i class="fas fa-search text-[#8E7AB5] text-5xl"></i>
                </div>
                <h3 class="text-2xl font-bold text-[#4D4C7D] mb-3">No Products Found</h3>
                <p class="text-[#8E7AB5] mb-8 max-w-md mx-auto">
                    We couldn't find any products matching your criteria. Try adjusting your filters or check back later.
                </p>
                <a href="{{ route('shop') }}" 
                   class="inline-flex items-center bg-[#FF6F61] text-white px-6 py-3 rounded-lg font-bold hover:bg-[#FF8A80] transition-colors">
                    <i class="fas fa-redo mr-2"></i>
                    Reset Filters
                </a>
            </div>
            @endif
        </div>
    </div>
</div>

<script>
    // Filter toggle for mobile
    document.getElementById('filter-toggle')?.addEventListener('click', function() {
        const sidebar = document.getElementById('filter-sidebar');
        sidebar.classList.remove('hidden');
        sidebar.classList.add('fixed', 'inset-0', 'z-50', 'bg-white', 'p-6', 'overflow-y-auto');
    });
    
    document.getElementById('close-filters')?.addEventListener('click', function() {
        const sidebar = document.getElementById('filter-sidebar');
        sidebar.classList.add('hidden');
        sidebar.classList.remove('fixed', 'inset-0', 'z-50', 'bg-white', 'p-6', 'overflow-y-auto');
    });
    
    // Custom radio and checkbox styling
    document.querySelectorAll('input[type="radio"]').forEach(radio => {
        radio.addEventListener('change', function() {
            // Remove all checkmarks
            document.querySelectorAll('input[type="radio"]').forEach(r => {
                const checkmark = r.closest('label').querySelector('div > div');
                checkmark?.classList.add('hidden');
            });
            
            // Add checkmark to selected
            const checkmark = this.closest('label').querySelector('div > div');
            checkmark?.classList.remove('hidden');
        });
    });
    
    document.querySelectorAll('input[type="checkbox"]').forEach(checkbox => {
        checkbox.addEventListener('change', function() {
            const icon = this.closest('label').querySelector('.fa-check');
            if (this.checked) {
                icon?.classList.remove('hidden');
            } else {
                icon?.classList.add('hidden');
            }
        });
    });
</script>

<style>
    /* Custom checkbox and radio styles */
    input[type="radio"]:checked + div > div {
        display: flex;
    }
    
    input[type="checkbox"]:checked + div > .fa-check {
        display: block;
    }
    
    .line-clamp-2 {
        overflow: hidden;
        display: -webkit-box;
        -webkit-box-orient: vertical;
        -webkit-line-clamp: 2;
    }
</style>
@endsection