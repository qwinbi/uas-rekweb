@extends('layouts.app')

@section('title', 'Checkout - BUNNYPOPS')

@section('content')
<div class="py-8">
    <!-- Page Header -->
    <div class="mb-8 text-center">
        <h1 class="text-3xl md:text-4xl font-bold text-[#4D4C7D] mb-3">Checkout</h1>
        <p class="text-[#8E7AB5]">Complete your purchase</p>
    </div>

    <!-- Checkout Steps -->
    <div class="mb-8">
        <div class="flex justify-center">
            <div class="flex items-center w-full max-w-2xl">
                <!-- Step 1 -->
                <div class="flex items-center">
                    <div class="w-10 h-10 bg-[#FF6F61] rounded-full flex items-center justify-center text-white font-bold shadow-lg">
                        1
                    </div>
                    <div class="ml-3">
                        <div class="font-bold text-[#4D4C7D]">Cart</div>
                        <div class="text-sm text-[#8E7AB5]">Review items</div>
                    </div>
                </div>
                
                <!-- Line -->
                <div class="flex-grow h-1 bg-[#F9DCC4] mx-4"></div>
                
                <!-- Step 2 -->
                <div class="flex items-center">
                    <div class="w-10 h-10 bg-[#FF6F61] rounded-full flex items-center justify-center text-white font-bold shadow-lg">
                        2
                    </div>
                    <div class="ml-3">
                        <div class="font-bold text-[#4D4C7D]">Details</div>
                        <div class="text-sm text-[#8E7AB5]">Shipping & payment</div>
                    </div>
                </div>
                
                <!-- Line -->
                <div class="flex-grow h-1 bg-[#F9DCC4] mx-4"></div>
                
                <!-- Step 3 -->
                <div class="flex items-center">
                    <div class="w-10 h-10 bg-[#FCEFEA] rounded-full flex items-center justify-center text-[#8E7AB5] font-bold">
                        3
                    </div>
                    <div class="ml-3">
                        <div class="font-medium text-[#8E7AB5]">Complete</div>
                        <div class="text-sm text-[#8E7AB5]">Order confirmation</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <form action="{{ route('checkout.process') }}" method="POST" enctype="multipart/form-data" id="checkout-form">
        @csrf
        
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Left Column - Order Details -->
            <div class="lg:col-span-2 space-y-8">
                <!-- Shipping Address -->
                <div class="bg-white rounded-2xl shadow-lg p-6">
                    <h2 class="text-xl font-bold text-[#4D4C7D] mb-6 flex items-center">
                        <i class="fas fa-shipping-fast mr-3 text-[#8E7AB5]"></i>
                        Shipping Address
                    </h2>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Full Name -->
                        <div>
                            <label class="block text-[#4D4C7D] font-medium mb-2">Full Name</label>
                            <input type="text" 
                                   name="name"
                                   value="{{ auth()->user()->name }}"
                                   required
                                   class="w-full px-4 py-3 rounded-lg border-2 border-[#F9DCC4] focus:border-[#FF6F61] focus:ring-2 focus:ring-[#FF6F61]/30 outline-none transition-all">
                        </div>
                        
                        <!-- Email -->
                        <div>
                            <label class="block text-[#4D4C7D] font-medium mb-2">Email Address</label>
                            <input type="email" 
                                   name="email"
                                   value="{{ auth()->user()->email }}"
                                   required
                                   class="w-full px-4 py-3 rounded-lg border-2 border-[#F9DCC4] focus:border-[#FF6F61] focus:ring-2 focus:ring-[#FF6F61]/30 outline-none transition-all">
                        </div>
                        
                        <!-- Phone Number -->
                        <div>
                            <label class="block text-[#4D4C7D] font-medium mb-2">Phone Number</label>
                            <input type="tel" 
                                   name="phone"
                                   required
                                   placeholder="+62 812 3456 7890"
                                   class="w-full px-4 py-3 rounded-lg border-2 border-[#F9DCC4] focus:border-[#FF6F61] focus:ring-2 focus:ring-[#FF6F61]/30 outline-none transition-all">
                        </div>
                        
                        <!-- Address -->
                        <div class="md:col-span-2">
                            <label class="block text-[#4D4C7D] font-medium mb-2">Address</label>
                            <textarea name="address" 
                                      rows="3"
                                      required
                                      placeholder="Your complete address"
                                      class="w-full px-4 py-3 rounded-lg border-2 border-[#F9DCC4] focus:border-[#FF6F61] focus:ring-2 focus:ring-[#FF6F61]/30 outline-none transition-all resize-none"></textarea>
                        </div>
                        
                        <!-- City & Postal Code -->
                        <div>
                            <label class="block text-[#4D4C7D] font-medium mb-2">City</label>
                            <input type="text" 
                                   name="city"
                                   required
                                   placeholder="City"
                                   class="w-full px-4 py-3 rounded-lg border-2 border-[#F9DCC4] focus:border-[#FF6F61] focus:ring-2 focus:ring-[#FF6F61]/30 outline-none transition-all">
                        </div>
                        
                        <div>
                            <label class="block text-[#4D4C7D] font-medium mb-2">Postal Code</label>
                            <input type="text" 
                                   name="postal_code"
                                   required
                                   placeholder="12345"
                                   class="w-full px-4 py-3 rounded-lg border-2 border-[#F9DCC4] focus:border-[#FF6F61] focus:ring-2 focus:ring-[#FF6F61]/30 outline-none transition-all">
                        </div>
                    </div>
                </div>

                <!-- Payment Method -->
                <div class="bg-white rounded-2xl shadow-lg p-6">
                    <h2 class="text-xl font-bold text-[#4D4C7D] mb-6 flex items-center">
                        <i class="fas fa-credit-card mr-3 text-[#8E7AB5]"></i>
                        Payment Method
                    </h2>
                    
                    <div class="space-y-4">
                        <!-- QRIS Option -->
                        <label class="flex items-center p-4 border-2 border-[#F9DCC4] rounded-xl cursor-pointer hover:border-[#8E7AB5] transition-colors payment-method">
                            <input type="radio" 
                                   name="payment_method" 
                                   value="qris" 
                                   required
                                   class="hidden"
                                   checked>
                            <div class="w-6 h-6 border-2 border-[#8E7AB5] rounded-full flex items-center justify-center mr-4">
                                <div class="w-3 h-3 rounded-full bg-[#FF6F61] payment-check"></div>
                            </div>
                            <div class="flex-grow">
                                <div class="flex items-center">
                                    <i class="fas fa-qrcode text-2xl text-[#8E7AB5] mr-3"></i>
                                    <div>
                                        <div class="font-bold text-[#4D4C7D]">QRIS Payment</div>
                                        <div class="text-sm text-[#8E7AB5]">Scan QR code to pay</div>
                                    </div>
                                </div>
                                
                                <!-- QRIS Image -->
                                <div id="qris-details" class="mt-4 p-4 bg-[#FCEFEA] rounded-lg">
                                    @if($qrisImage)
                                        <p class="text-[#4D4C7D] mb-3">Scan this QR code using your mobile banking app:</p>
                                        <div class="flex flex-col md:flex-row items-center gap-6">
                                            <div class="bg-white p-4 rounded-lg shadow-inner">
                                                <img src="{{ asset('storage/qris/' . $qrisImage) }}" 
                                                     alt="QRIS Code" 
                                                     class="w-48 h-48">
                                            </div>
                                            <div class="text-[#4D4C7D]">
                                                <p class="font-bold mb-2">Instructions:</p>
                                                <ol class="list-decimal pl-5 space-y-1 text-sm">
                                                    <li>Open your mobile banking app</li>
                                                    <li>Tap "Scan QR" or "QRIS"</li>
                                                    <li>Scan the QR code above</li>
                                                    <li>Confirm the payment amount</li>
                                                    <li>Complete the transaction</li>
                                                </ol>
                                            </div>
                                        </div>
                                    @else
                                        <p class="text-[#8E7AB5]">QRIS payment is currently unavailable.</p>
                                    @endif
                                </div>
                            </div>
                        </label>
                        
                        <!-- Virtual Account Option -->
                        <label class="flex items-center p-4 border-2 border-[#F9DCC4] rounded-xl cursor-pointer hover:border-[#8E7AB5] transition-colors payment-method">
                            <input type="radio" 
                                   name="payment_method" 
                                   value="virtual_account" 
                                   required
                                   class="hidden">
                            <div class="w-6 h-6 border-2 border-[#8E7AB5] rounded-full flex items-center justify-center mr-4">
                                <div class="w-3 h-3 rounded-full bg-[#FF6F61] payment-check" style="display: none;"></div>
                            </div>
                            <div class="flex-grow">
                                <div class="flex items-center">
                                    <i class="fas fa-university text-2xl text-[#8E7AB5] mr-3"></i>
                                    <div>
                                        <div class="font-bold text-[#4D4C7D]">Virtual Account</div>
                                        <div class="text-sm text-[#8E7AB5]">Pay via bank transfer</div>
                                    </div>
                                </div>
                                
                                <!-- Virtual Account Details -->
                                <div id="virtual-account-details" class="mt-4 p-4 bg-[#FCEFEA] rounded-lg" style="display: none;">
                                    <p class="text-[#4D4C7D] mb-3">Transfer to this virtual account number:</p>
                                    <div class="bg-white p-4 rounded-lg shadow-inner">
                                        <div class="text-center">
                                            <div class="text-sm text-[#8E7AB5] mb-1">Virtual Account Number</div>
                                            <div class="text-2xl font-bold text-[#4D4C7D] mb-2">{{ $virtualAccount }}</div>
                                            <div class="text-sm text-[#4D4C7D]">Bank: BUNNY BANK</div>
                                            <div class="text-sm text-[#4D4C7D]">Account Name: BUNNYPOPS STORE</div>
                                        </div>
                                    </div>
                                    <p class="text-sm text-[#8E7AB5] mt-3">
                                        Please transfer the exact amount within 24 hours.
                                    </p>
                                </div>
                            </div>
                        </label>
                    </div>
                    
                    <!-- Payment Proof Upload -->
                    <div id="payment-proof-section" class="mt-6">
                        <h3 class="font-bold text-[#4D4C7D] mb-4 flex items-center">
                            <i class="fas fa-upload mr-2 text-[#8E7AB5]"></i>
                            Upload Payment Proof (Optional)
                        </h3>
                        <div class="border-2 border-dashed border-[#F9DCC4] rounded-xl p-6 text-center hover:border-[#8E7AB5] transition-colors">
                            <input type="file" 
                                   id="payment_proof" 
                                   name="payment_proof"
                                   accept="image/*"
                                   class="hidden"
                                   onchange="previewImage(this)">
                            <div id="image-preview" class="hidden mb-4">
                                <img id="preview-image" class="max-w-full max-h-48 mx-auto rounded-lg">
                                <button type="button" 
                                        onclick="removeImage()"
                                        class="mt-2 text-[#FF6F61] hover:text-red-700">
                                    <i class="fas fa-trash mr-1"></i> Remove image
                                </button>
                            </div>
                            <div id="upload-prompt">
                                <i class="fas fa-cloud-upload-alt text-4xl text-[#8E7AB5] mb-3"></i>
                                <p class="text-[#4D4C7D] mb-2">Click to upload payment proof</p>
                                <p class="text-sm text-[#8E7AB5] mb-4">Supported: JPG, PNG (Max: 2MB)</p>
                                <label for="payment_proof" 
                                       class="inline-block bg-[#FCEFEA] text-[#4D4C7D] px-6 py-2 rounded-lg font-bold hover:bg-[#F9DCC4] transition-colors cursor-pointer">
                                    <i class="fas fa-image mr-2"></i> Choose File
                                </label>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Order Items -->
                <div class="bg-white rounded-2xl shadow-lg p-6">
                    <h2 class="text-xl font-bold text-[#4D4C7D] mb-6 flex items-center">
                        <i class="fas fa-shopping-bag mr-3 text-[#8E7AB5]"></i>
                        Order Summary
                    </h2>
                    
                    <div class="space-y-4">
                        @foreach($cartItems as $cartItem)
                        <div class="flex items-center p-4 border border-[#F9DCC4] rounded-xl">
                            <div class="w-16 h-16 flex-shrink-0">
                                @if($cartItem->product->photo)
                                    <img src="{{ asset('storage/products/' . $cartItem->product->photo) }}" 
                                         alt="{{ $cartItem->product->name }}" 
                                         class="w-full h-full object-cover rounded-lg">
                                @else
                                    <div class="w-full h-full bg-gradient-to-br from-[#F9DCC4] to-[#8E7AB5] rounded-lg flex items-center justify-center">
                                        <i class="fas fa-box text-white text-xl opacity-50"></i>
                                    </div>
                                @endif
                            </div>
                            
                            <div class="flex-grow ml-4">
                                <h4 class="font-bold text-[#4D4C7D]">{{ $cartItem->product->name }}</h4>
                                <p class="text-sm text-[#8E7AB5]">Qty: {{ $cartItem->quantity }}</p>
                            </div>
                            
                            <div class="text-right">
                                <div class="text-lg font-bold text-[#4D4C7D]">
                                    Rp {{ number_format($cartItem->product->price * $cartItem->quantity, 0, ',', '.') }}
                                </div>
                                <div class="text-sm text-[#8E7AB5]">
                                    Rp {{ number_format($cartItem->product->price, 0, ',', '.') }} each
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- Right Column - Order Summary -->
            <div class="lg:col-span-1">
                <div class="bg-white rounded-2xl shadow-lg p-6 sticky top-24">
                    <h2 class="text-xl font-bold text-[#4D4C7D] mb-6">Order Total</h2>
                    
                    <!-- Order Details -->
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
                            <span class="text-[#4D4C7D]">Tax (10%)</span>
                            <span class="text-[#4D4C7D] font-medium">
                                Rp {{ number_format($total * 0.1, 0, ',', '.') }}
                            </span>
                        </div>
                        
                        <div class="border-t border-[#F9DCC4] pt-4">
                            <div class="flex justify-between mb-2">
                                <span class="text-lg font-bold text-[#4D4C7D]">Total</span>
                                <span class="text-2xl font-bold text-[#FF6F61]">
                                    Rp {{ number_format($total + 10000 + ($total * 0.1), 0, ',', '.') }}
                                </span>
                            </div>
                            <p class="text-sm text-[#8E7AB5]">Including shipping and tax</p>
                        </div>
                    </div>
                    
                    <!-- Terms Agreement -->
                    <div class="mb-6">
                        <label class="flex items-start">
                            <input type="checkbox" 
                                   name="terms" 
                                   required
                                   class="w-5 h-5 mt-1 text-[#FF6F61] border-[#F9DCC4] rounded focus:ring-[#FF6F61]">
                            <span class="ml-3 text-sm text-[#4D4C7D]">
                                I agree to the 
                                <a href="#" class="text-[#8E7AB5] hover:text-[#FF6F61]">Terms & Conditions</a>
                                and confirm that I have reviewed my order details.
                            </span>
                        </label>
                    </div>
                    
                    <!-- Place Order Button -->
                    <button type="submit" 
                            class="w-full bg-gradient-to-r from-[#FF6F61] to-[#8E7AB5] text-white py-4 rounded-xl font-bold hover:opacity-90 transition-all shadow-lg hover:shadow-xl flex items-center justify-center group disabled:opacity-50 disabled:cursor-not-allowed"
                            id="place-order-btn">
                        <i class="fas fa-lock mr-3 group-hover:scale-110 transition-transform"></i>
                        Place Order
                    </button>
                    
                    <!-- Back to Cart -->
                    <div class="text-center mt-6">
                        <a href="{{ route('cart.index') }}" 
                           class="inline-flex items-center text-[#8E7AB5] hover:text-[#FF6F61] transition-colors">
                            <i class="fas fa-arrow-left mr-2"></i>
                            Back to Cart
                        </a>
                    </div>
                    
                    <!-- Security Notice -->
                    <div class="mt-6 p-4 bg-[#FCEFEA] rounded-lg">
                        <div class="flex items-start">
                            <i class="fas fa-shield-alt text-[#8E7AB5] mt-1 mr-3"></i>
                            <div>
                                <h4 class="font-bold text-[#4D4C7D] text-sm mb-1">Secure & Encrypted</h4>
                                <p class="text-[#8E7AB5] text-xs">
                                    Your payment information is protected with 256-bit SSL encryption.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Help Section -->
                <div class="bg-white rounded-2xl shadow-lg p-6 mt-6">
                    <h3 class="font-bold text-[#4D4C7D] mb-4 flex items-center">
                        <i class="fas fa-question-circle mr-2 text-[#8E7AB5]"></i>
                        Need Help?
                    </h3>
                    <div class="space-y-3">
                        <div class="flex items-center">
                            <div class="w-10 h-10 bg-[#F9DCC4] rounded-full flex items-center justify-center mr-3">
                                <i class="fas fa-phone text-[#8E7AB5]"></i>
                            </div>
                            <div>
                                <div class="font-bold text-[#4D4C7D] text-sm">Call Us</div>
                                <div class="text-[#8E7AB5] text-sm">+62 812 3456 7890</div>
                            </div>
                        </div>
                        <div class="flex items-center">
                            <div class="w-10 h-10 bg-[#F9DCC4] rounded-full flex items-center justify-center mr-3">
                                <i class="fas fa-envelope text-[#8E7AB5]"></i>
                            </div>
                            <div>
                                <div class="font-bold text-[#4D4C7D] text-sm">Email Us</div>
                                <div class="text-[#8E7AB5] text-sm">help@bunnypops.com</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

<script>
    // Payment method selection
    document.querySelectorAll('.payment-method').forEach(method => {
        method.addEventListener('click', function() {
            // Uncheck all
            document.querySelectorAll('.payment-check').forEach(check => {
                check.style.display = 'none';
            });
            
            // Check selected
            const check = this.querySelector('.payment-check');
            if (check) check.style.display = 'flex';
            
            // Show/hide details
            const paymentMethod = this.querySelector('input[type="radio"]').value;
            
            if (paymentMethod === 'qris') {
                document.getElementById('qris-details').style.display = 'block';
                document.getElementById('virtual-account-details').style.display = 'none';
            } else if (paymentMethod === 'virtual_account') {
                document.getElementById('qris-details').style.display = 'none';
                document.getElementById('virtual-account-details').style.display = 'block';
            }
        });
    });
    
    // Image preview for payment proof
    function previewImage(input) {
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            const maxSize = 2 * 1024 * 1024; // 2MB
            
            if (input.files[0].size > maxSize) {
                alert('File size must be less than 2MB');
                input.value = '';
                return;
            }
            
            reader.onload = function(e) {
                document.getElementById('preview-image').src = e.target.result;
                document.getElementById('image-preview').style.display = 'block';
                document.getElementById('upload-prompt').style.display = 'none';
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
    
    function removeImage() {
        document.getElementById('payment_proof').value = '';
        document.getElementById('image-preview').style.display = 'none';
        document.getElementById('upload-prompt').style.display = 'block';
    }
    
    // Form validation
    document.getElementById('checkout-form').addEventListener('submit', function(e) {
        const placeOrderBtn = document.getElementById('place-order-btn');
        placeOrderBtn.disabled = true;
        placeOrderBtn.innerHTML = `
            <i class="fas fa-spinner fa-spin mr-3"></i>
            Processing...
        `;
        
        // Validate shipping address
        const requiredFields = this.querySelectorAll('[required]');
        let isValid = true;
        
        requiredFields.forEach(field => {
            if (!field.value.trim()) {
                isValid = false;
                field.classList.add('border-red-500');
                field.classList.remove('border-[#F9DCC4]');
            } else {
                field.classList.remove('border-red-500');
                field.classList.add('border-[#F9DCC4]');
            }
        });
        
        if (!isValid) {
            e.preventDefault();
            placeOrderBtn.disabled = false;
            placeOrderBtn.innerHTML = `
                <i class="fas fa-lock mr-3"></i>
                Place Order
            `;
            
            showNotification('Please fill in all required fields', 'error');
            return;
        }
        
        // Validate payment method
        const paymentMethod = document.querySelector('input[name="payment_method"]:checked');
        if (!paymentMethod) {
            e.preventDefault();
            placeOrderBtn.disabled = false;
            placeOrderBtn.innerHTML = `
                <i class="fas fa-lock mr-3"></i>
                Place Order
            `;
            
            showNotification('Please select a payment method', 'error');
            return;
        }
        
        // Validate terms agreement
        const terms = document.querySelector('input[name="terms"]');
        if (!terms.checked) {
            e.preventDefault();
            placeOrderBtn.disabled = false;
            placeOrderBtn.innerHTML = `
                <i class="fas fa-lock mr-3"></i>
                Place Order
            `;
            
            showNotification('Please agree to the terms and conditions', 'error');
            return;
        }
        
        // If all validations pass, form will submit
    });
    
    function showNotification(message, type = 'success') {
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
    
    // Auto-fill address if available
    document.addEventListener('DOMContentLoaded', function() {
        // Check if user has saved address
        const savedAddress = localStorage.getItem('bunnypops_shipping_address');
        if (savedAddress) {
            const address = JSON.parse(savedAddress);
            Object.keys(address).forEach(key => {
                const field = document.querySelector(`[name="${key}"]`);
                if (field) field.value = address[key];
            });
        }
        
        // Save address on input change
        const addressFields = document.querySelectorAll('[name="name"], [name="email"], [name="phone"], [name="address"], [name="city"], [name="postal_code"]');
        addressFields.forEach(field => {
            field.addEventListener('input', function() {
                const address = {};
                addressFields.forEach(f => {
                    address[f.name] = f.value;
                });
                localStorage.setItem('bunnypops_shipping_address', JSON.stringify(address));
            });
        });
    });
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
    
    .payment-method input[type="radio"]:checked + div > .payment-check {
        display: flex !important;
    }
    
    .payment-method input[type="radio"]:checked ~ div {
        border-color: #8E7AB5;
    }
</style>
@endsection