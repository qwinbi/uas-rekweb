@extends('layouts.app')

@section('title', 'Shopping Cart - BUNNYPOPS')

@section('content')
<div class="py-8">
    <!-- Page Header -->
    <div class="mb-8 text-center">
        <h1 class="text-3xl md:text-4xl font-bold text-[#4D4C7D] mb-3">Your Shopping Cart</h1>
        <p class="text-[#8E7AB5]">Review your items and proceed to checkout</p>
    </div>

    @if($cartItems->count() > 0)
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Cart Items -->
        <div class="lg:col-span-2">
            <!-- Cart Header -->
            <div class="bg-white rounded-2xl shadow-lg p-6 mb-6">
                <div class="flex items-center justify-between mb-4">
                    <h2 class="text-xl font-bold text-[#4D4C7D]">
                        {{ $cartItems->count() }} {{ Str::plural('item', $cartItems->count()) }} in Cart
                    </h2>
                    <form action="{{ route('cart.destroy', 'clear') }}" method="POST" onsubmit="return confirm('Are you sure you want to clear your cart?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-[#FF6F61] hover:text-red-700 transition-colors flex items-center">
                            <i class="fas fa-trash-alt mr-2"></i>
                            Clear Cart
                        </button>
                    </form>
                </div>
                
                <!-- Cart Items List -->
                <div class="space-y-4">
                    @foreach($cartItems as $cartItem)
                    <div class="flex flex-col sm:flex-row gap-4 p-4 border border-[#F9DCC4] rounded-xl hover:border-[#8E7AB5] transition-colors">
                        <!-- Product Image -->
                        <div class="sm:w-24 h-24 flex-shrink-0">
                            @if($cartItem->product->photo)
                                <img src="{{ asset('storage/products/' . $cartItem->product->photo) }}" 
                                     alt="{{ $cartItem->product->name }}" 
                                     class="w-full h-full object-cover rounded-lg">
                            @else
                                <div class="w-full h-full bg-gradient-to-br from-[#F9DCC4] to-[#8E7AB5] rounded-lg flex items-center justify-center">
                                    <i class="fas fa-box text-white text-2xl opacity-50"></i>
                                </div>
                            @endif
                        </div>
                        
                        <!-- Product Info -->
                        <div class="flex-grow">
                            <div class="flex justify-between">
                                <div>
                                    <h3 class="font-bold text-[#4D4C7D] mb-1">{{ $cartItem->product->name }}</h3>
                                    <p class="text-[#8E7AB5] text-sm mb-2">
                                        Stock: {{ $cartItem->product->stock }}
                                    </p>
                                    <div class="text-xl font-bold text-[#FF6F61]">
                                        Rp {{ number_format($cartItem->product->price, 0, ',', '.') }}
                                    </div>
                                </div>
                                
                                <!-- Quantity Controls -->
                                <div class="flex flex-col items-end">
                                    <form action="{{ route('cart.update', $cartItem->id) }}" method="POST" class="mb-2">
                                        @csrf
                                        @method('PUT')
                                        <div class="flex items-center">
                                            <button type="button" 
                                                    onclick="updateQuantity({{ $cartItem->id }}, -1)"
                                                    class="w-8 h-8 bg-[#FCEFEA] text-[#4D4C7D] rounded-l-lg hover:bg-[#F9DCC4] transition-colors">
                                                <i class="fas fa-minus"></i>
                                            </button>
                                            <input type="number" 
                                                   id="qty-{{ $cartItem->id }}"
                                                   value="{{ $cartItem->quantity }}" 
                                                   min="1" 
                                                   max="{{ $cartItem->product->stock }}"
                                                   class="w-12 h-8 text-center border-y border-[#F9DCC4] text-[#4D4C7D] focus:outline-none"
                                                   onchange="updateQuantityInput({{ $cartItem->id }}, this.value)">
                                            <button type="button" 
                                                    onclick="updateQuantity({{ $cartItem->id }}, 1)"
                                                    class="w-8 h-8 bg-[#FCEFEA] text-[#4D4C7D] rounded-r-lg hover:bg-[#F9DCC4] transition-colors">
                                                <i class="fas fa-plus"></i>
                                            </button>
                                        </div>
                                    </form>
                                    
                                    <!-- Remove Button -->
                                    <form action="{{ route('cart.destroy', $cartItem->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" 
                                                class="text-[#FF6F61] hover:text-red-700 transition-colors flex items-center text-sm">
                                            <i class="fas fa-trash mr-1"></i>
                                            Remove
                                        </button>
                                    </form>
                                </div>
                            </div>
                            
                            <!-- Subtotal -->
                            <div class="mt-3 pt-3 border-t border-[#F9DCC4] flex justify-between items-center">
                                <span class="text-[#4D4C7D]">Subtotal:</span>
                                <span class="text-xl font-bold text-[#4D4C7D]">
                                    Rp {{ number_format($cartItem->quantity * $cartItem->product->price, 0, ',', '.') }}
                                </span>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            
            <!-- Continue Shopping -->
            <div class="flex justify-between items-center">
                <a href="{{ route('shop') }}" 
                   class="inline-flex items-center text-[#8E7AB5] hover:text-[#FF6F61] transition-colors">
                    <i class="fas fa-arrow-left mr-2"></i>
                    Continue Shopping
                </a>
                
                <!-- Update Cart Button -->
                <button onclick="updateAllQuantities()" 
                        class="bg-[#FCEFEA] text-[#4D4C7D] px-6 py-2 rounded-lg font-bold hover:bg-[#F9DCC4] transition-colors">
                    <i class="fas fa-sync-alt mr-2"></i>
                    Update Cart
                </button>
            </div>
        </div>

        <!-- Order Summary -->
        <div class="lg:col-span-1">
            <div class="bg-white rounded-2xl shadow-lg p-6 sticky top-24">
                <h2 class="text-xl font-bold text-[#4D4C7D] mb-6">Order Summary</h2>
                
                <!-- Summary Details -->
                <div class="space-y-4 mb-6">
                    <div class="flex justify-between">
                        <span class="text-[#4D4C7D]">Subtotal</span>
                        <span class="text-[#4D4C7D] font-medium">
                            Rp {{ number_format($total, 0, ',', '.') }}
                        </span>
                    </div>
                    
                    <div class="flex justify-between">
                        <span class="text-[#4D4C7D]">Shipping</span>
                        <span class="text-[#4D4C7D] font-medium">
                            Rp {{ number_format(10000, 0, ',', '.') }}
                        </span>
                    </div>
                    
                    <div class="flex justify-between">
                        <span class="text-[#4D4C7D]">Tax</span>
                        <span class="text-[#4D4C7D] font-medium">
                            Rp {{ number_format($total * 0.1, 0, ',', '.') }}
                        </span>
                    </div>
                    
                    <div class="border-t border-[#F9DCC4] pt-4">
                        <div class="flex justify-between">
                            <span class="text-lg font-bold text-[#4D4C7D]">Total</span>
                            <span class="text-2xl font-bold text-[#FF6F61]">
                                Rp {{ number_format($total + 10000 + ($total * 0.1), 0, ',', '.') }}
                            </span>
                        </div>
                        <p class="text-[#8E7AB5] text-sm mt-1">Including shipping and tax</p>
                    </div>
                </div>
                
                <!-- Checkout Button -->
                <a href="{{ route('checkout') }}" 
                   class="block w-full bg-gradient-to-r from-[#FF6F61] to-[#8E7AB5] text-white py-4 rounded-xl font-bold hover:opacity-90 transition-all shadow-lg hover:shadow-xl text-center mb-4">
                    <i class="fas fa-lock mr-2"></i>
                    Proceed to Checkout
                </a>
                
                <!-- Payment Methods -->
                <div class="border-t border-[#F9DCC4] pt-6">
                    <h3 class="font-bold text-[#4D4C7D] mb-3">We Accept</h3>
                    <div class="flex gap-3">
                        <div class="bg-[#FCEFEA] p-3 rounded-lg">
                            <i class="fab fa-cc-visa text-2xl text-[#4D4C7D]"></i>
                        </div>
                        <div class="bg-[#FCEFEA] p-3 rounded-lg">
                            <i class="fab fa-cc-mastercard text-2xl text-[#4D4C7D]"></i>
                        </div>
                        <div class="bg-[#FCEFEA] p-3 rounded-lg">
                            <i class="fas fa-qrcode text-2xl text-[#4D4C7D]"></i>
                        </div>
                    </div>
                </div>
                
                <!-- Security Notice -->
                <div class="mt-6 p-4 bg-[#FCEFEA] rounded-lg">
                    <div class="flex items-start">
                        <i class="fas fa-shield-alt text-[#8E7AB5] mt-1 mr-3"></i>
                        <div>
                            <h4 class="font-bold text-[#4D4C7D] text-sm mb-1">Secure Checkout</h4>
                            <p class="text-[#8E7AB5] text-xs">
                                Your payment information is encrypted and secure.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Promo Code -->
            <div class="bg-white rounded-2xl shadow-lg p-6 mt-6">
                <h3 class="font-bold text-[#4D4C7D] mb-4">Have a Promo Code?</h3>
                <div class="flex">
                    <input type="text" 
                           placeholder="Enter promo code" 
                           class="flex-grow px-4 py-3 rounded-l-lg border-2 border-[#F9DCC4] focus:border-[#FF6F61] focus:outline-none">
                    <button class="bg-[#8E7AB5] text-white px-6 py-3 rounded-r-lg font-bold hover:bg-[#4D4C7D] transition-colors">
                        Apply
                    </button>
                </div>
            </div>
        </div>
    </div>
    @else
    <!-- Empty Cart -->
    <div class="text-center py-16">
        <div class="w-40 h-40 mx-auto mb-6">
            <div class="relative w-full h-full">
                <div class="absolute inset-0 bg-gradient-to-br from-[#F9DCC4] to-[#FCEFEA] rounded-full animate-pulse"></div>
                <div class="absolute inset-10 bg-white rounded-full flex items-center justify-center">
                    <i class="fas fa-shopping-cart text-[#8E7AB5] text-5xl"></i>
                </div>
            </div>
        </div>
        
        <h3 class="text-2xl font-bold text-[#4D4C7D] mb-3">Your Cart is Empty</h3>
        <p class="text-[#8E7AB5] mb-8 max-w-md mx-auto">
            Looks like you haven't added any cute products to your cart yet. 
            Start shopping to fill it with adorable items!
        </p>
        
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <a href="{{ route('shop') }}" 
               class="bg-gradient-to-r from-[#FF6F61] to-[#8E7AB5] text-white px-8 py-3 rounded-xl font-bold hover:opacity-90 transition-all shadow-lg hover:shadow-xl inline-flex items-center justify-center">
                <i class="fas fa-shopping-bag mr-3"></i>
                Start Shopping
            </a>
            
            <a href="{{ route('home') }}" 
               class="bg-[#FCEFEA] text-[#4D4C7D] px-8 py-3 rounded-xl font-bold hover:bg-[#F9DCC4] transition-colors shadow-lg hover:shadow-xl inline-flex items-center justify-center">
                <i class="fas fa-home mr-3"></i>
                Back to Home
            </a>
        </div>
    </div>
    @endif
</div>

<script>
    // Update quantity for a specific cart item
    function updateQuantity(cartId, change) {
        const input = document.getElementById(`qty-${cartId}`);
        let currentValue = parseInt(input.value);
        const maxStock = parseInt(input.max);
        
        let newValue = currentValue + change;
        if (newValue < 1) newValue = 1;
        if (newValue > maxStock) newValue = maxStock;
        
        input.value = newValue;
        
        // Update cart via AJAX
        updateCartItem(cartId, newValue);
    }
    
    // Update quantity from input change
    function updateQuantityInput(cartId, value) {
        const input = document.getElementById(`qty-${cartId}`);
        const maxStock = parseInt(input.max);
        
        let newValue = parseInt(value);
        if (isNaN(newValue) || newValue < 1) newValue = 1;
        if (newValue > maxStock) newValue = maxStock;
        
        input.value = newValue;
        updateCartItem(cartId, newValue);
    }
    
    // Update all quantities at once
    function updateAllQuantities() {
        const cartItems = document.querySelectorAll('[id^="qty-"]');
        cartItems.forEach(input => {
            const cartId = input.id.replace('qty-', '');
            const quantity = input.value;
            updateCartItem(cartId, quantity, true);
        });
    }
    
    // AJAX cart update
    function updateCartItem(cartId, quantity, showNotification = false) {
        const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        
        fetch(`/cart/update/${cartId}`, {
            method: 'PUT',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': token,
                'X-Requested-With': 'XMLHttpRequest'
            },
            body: JSON.stringify({
                qty: quantity
            })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                if (showNotification) {
                    showNotificationMessage('Cart updated successfully!', 'success');
                }
                // Update cart counter
                updateCartCounter();
                // Reload page to update totals
                setTimeout(() => location.reload(), 500);
            } else {
                showNotificationMessage(data.message || 'Error updating cart', 'error');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            showNotificationMessage('Error updating cart', 'error');
        });
    }
    
    // Update cart counter
    function updateCartCounter() {
        fetch('/cart/count')
            .then(response => response.json())
            .then(data => {
                const cartCounter = document.getElementById('cart-counter');
                if (cartCounter) {
                    cartCounter.textContent = data.count;
                    if (data.count > 0) {
                        cartCounter.classList.remove('hidden');
                    } else {
                        cartCounter.classList.add('hidden');
                    }
                }
            });
    }
    
    // Show notification message
    function showNotificationMessage(message, type = 'success') {
        const notification = document.createElement('div');
        notification.className = `fixed top-20 right-4 z-50 px-6 py-3 rounded-lg shadow-xl animate-slide-in ${
            type === 'success' ? 'bg-green-100 text-green-800 border border-green-200' : 
            'bg-red-100 text-red-800 border border-red-200'
        }`;
        notification.innerHTML = `
            <div class="flex items-center">
                <i class="fas ${type === 'success' ? 'fa-check-circle' : 'fa-exclamation-circle'} mr-3"></i>
                <span>${message}</span>
            </div>
        `;
        document.body.appendChild(notification);
        
        setTimeout(() => {
            notification.style.opacity = '0';
            setTimeout(() => notification.remove(), 500);
        }, 3000);
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