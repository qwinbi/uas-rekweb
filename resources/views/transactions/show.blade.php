@extends('layouts.app')

@section('title', 'Order Details - BUNNYPOPS')

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
                        <a href="{{ route('transactions.index') }}" class="text-sm text-[#8E7AB5] hover:text-[#FF6F61]">
                            Orders
                        </a>
                    </div>
                </li>
                <li aria-current="page">
                    <div class="flex items-center">
                        <i class="fas fa-chevron-right text-[#8E7AB5] mx-2"></i>
                        <span class="text-sm font-medium text-[#4D4C7D]">
                            Order {{ $transaction->invoice_number }}
                        </span>
                    </div>
                </li>
            </ol>
        </nav>
    </div>

    <!-- Order Header -->
    <div class="bg-white rounded-2xl shadow-lg p-6 mb-8">
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
            <div>
                <h1 class="text-2xl md:text-3xl font-bold text-[#4D4C7D] mb-2">
                    Order {{ $transaction->invoice_number }}
                </h1>
                <p class="text-[#8E7AB5]">
                    Placed on {{ $transaction->created_at->format('F d, Y \a\t h:i A') }}
                </p>
            </div>
            
            <!-- Order Status -->
            <div class="flex items-center gap-4">
                @if($transaction->status == 'completed')
                <span class="inline-flex items-center px-4 py-2 rounded-full bg-green-100 text-green-800 font-bold">
                    <i class="fas fa-check-circle mr-2"></i> Completed
                </span>
                @elseif($transaction->status == 'processing')
                <span class="inline-flex items-center px-4 py-2 rounded-full bg-blue-100 text-blue-800 font-bold">
                    <i class="fas fa-sync-alt mr-2"></i> Processing
                </span>
                @elseif($transaction->status == 'waiting_payment')
                <span class="inline-flex items-center px-4 py-2 rounded-full bg-yellow-100 text-yellow-800 font-bold">
                    <i class="fas fa-clock mr-2"></i> Waiting Payment
                </span>
                @else
                <span class="inline-flex items-center px-4 py-2 rounded-full bg-gray-100 text-gray-800 font-bold">
                    <i class="fas fa-hourglass-half mr-2"></i> Pending
                </span>
                @endif
                
                <div class="text-right">
                    <div class="text-2xl font-bold text-[#FF6F61]">
                        Rp {{ number_format($transaction->total, 0, ',', '.') }}
                    </div>
                    <div class="text-sm text-[#8E7AB5]">Total Amount</div>
                </div>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Order Details -->
        <div class="lg:col-span-2 space-y-8">
            <!-- Order Items -->
            <div class="bg-white rounded-2xl shadow-lg p-6">
                <h2 class="text-xl font-bold text-[#4D4C7D] mb-6 flex items-center">
                    <i class="fas fa-box-open mr-3 text-[#8E7AB5]"></i>
                    Order Items
                </h2>
                
                <div class="space-y-6">
                    @foreach($transaction->items as $item)
                    <div class="flex flex-col sm:flex-row gap-4 p-4 border border-[#F9DCC4] rounded-xl">
                        <!-- Product Image -->
                        <div class="sm:w-20 h-20 flex-shrink-0">
                            @if($item->product->photo)
                                <img src="{{ asset('storage/products/' . $item->product->photo) }}" 
                                     alt="{{ $item->product->name }}" 
                                     class="w-full h-full object-cover rounded-lg">
                            @else
                                <div class="w-full h-full bg-gradient-to-br from-[#F9DCC4] to-[#8E7AB5] rounded-lg flex items-center justify-center">
                                    <i class="fas fa-box text-white text-xl opacity-50"></i>
                                </div>
                            @endif
                        </div>
                        
                        <!-- Product Info -->
                        <div class="flex-grow">
                            <div class="flex justify-between">
                                <div>
                                    <h3 class="font-bold text-[#4D4C7D] mb-1">{{ $item->product->name }}</h3>
                                    <p class="text-sm text-[#8E7AB5]">Quantity: {{ $item->quantity }}</p>
                                </div>
                                <div class="text-right">
                                    <div class="text-lg font-bold text-[#4D4C7D]">
                                        Rp {{ number_format($item->price, 0, ',', '.') }}
                                    </div>
                                    <div class="text-sm text-[#8E7AB5]">each</div>
                                </div>
                            </div>
                            
                            <!-- Subtotal -->
                            <div class="mt-3 pt-3 border-t border-[#F9DCC4] flex justify-between items-center">
                                <span class="text-[#4D4C7D]">Subtotal:</span>
                                <span class="text-lg font-bold text-[#4D4C7D]">
                                    Rp {{ number_format($item->subtotal, 0, ',', '.') }}
                                </span>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

            <!-- Order Timeline -->
            <div class="bg-white rounded-2xl shadow-lg p-6">
                <h2 class="text-xl font-bold text-[#4D4C7D] mb-6 flex items-center">
                    <i class="fas fa-history mr-3 text-[#8E7AB5]"></i>
                    Order Timeline
                </h2>
                
                <div class="space-y-6">
                    <!-- Timeline Step 1 -->
                    <div class="flex items-start">
                        <div class="w-10 h-10 bg-[#FF6F61] rounded-full flex items-center justify-center text-white font-bold flex-shrink-0">
                            <i class="fas fa-check"></i>
                        </div>
                        <div class="ml-4">
                            <h3 class="font-bold text-[#4D4C7D]">Order Placed</h3>
                            <p class="text-[#8E7AB5] text-sm">{{ $transaction->created_at->format('F d, Y \a\t h:i A') }}</p>
                            <p class="text-[#4D4C7D] mt-1">Your order has been received</p>
                        </div>
                    </div>
                    
                    <!-- Timeline Step 2 -->
                    <div class="flex items-start">
                        <div class="w-10 h-10 {{ $transaction->status != 'pending' ? 'bg-[#FF6F61]' : 'bg-[#FCEFEA]' }} rounded-full flex items-center justify-center {{ $transaction->status != 'pending' ? 'text-white' : 'text-[#8E7AB5]' }} font-bold flex-shrink-0">
                            @if($transaction->status != 'pending')
                                <i class="fas fa-check"></i>
                            @else
                                <i class="fas fa-clock"></i>
                            @endif
                        </div>
                        <div class="ml-4">
                            <h3 class="font-bold text-[#4D4C7D]">Payment {{ $transaction->status != 'pending' ? 'Confirmed' : 'Pending' }}</h3>
                            @if($transaction->payment_proof)
                                <p class="text-[#8E7AB5] text-sm">Payment proof uploaded</p>
                            @else
                                <p class="text-[#8E7AB5] text-sm">Awaiting payment confirmation</p>
                            @endif
                            <p class="text-[#4D4C7D] mt-1">
                                @if($transaction->payment_method == 'qris')
                                    QRIS Payment Method
                                @else
                                    Virtual Account Payment Method
                                @endif
                            </p>
                        </div>
                    </div>
                    
                    <!-- Timeline Step 3 -->
                    <div class="flex items-start">
                        <div class="w-10 h-10 {{ $transaction->status == 'processing' || $transaction->status == 'completed' ? 'bg-[#FF6F61]' : 'bg-[#FCEFEA]' }} rounded-full flex items-center justify-center {{ $transaction->status == 'processing' || $transaction->status == 'completed' ? 'text-white' : 'text-[#8E7AB5]' }} font-bold flex-shrink-0">
                            @if($transaction->status == 'processing' || $transaction->status == 'completed')
                                <i class="fas fa-check"></i>
                            @else
                                <i class="fas fa-box"></i>
                            @endif
                        </div>
                        <div class="ml-4">
                            <h3 class="font-bold text-[#4D4C7D]">Processing</h3>
                            @if($transaction->status == 'processing' || $transaction->status == 'completed')
                                <p class="text-[#8E7AB5] text-sm">Order is being prepared</p>
                            @else
                                <p class="text-[#8E7AB5] text-sm">Will start after payment confirmation</p>
                            @endif
                            <p class="text-[#4D4C7D] mt-1">Items are being prepared for shipment</p>
                        </div>
                    </div>
                    
                    <!-- Timeline Step 4 -->
                    <div class="flex items-start">
                        <div class="w-10 h-10 {{ $transaction->status == 'completed' ? 'bg-[#FF6F61]' : 'bg-[#FCEFEA]' }} rounded-full flex items-center justify-center {{ $transaction->status == 'completed' ? 'text-white' : 'text-[#8E7AB5]' }} font-bold flex-shrink-0">
                            @if($transaction->status == 'completed')
                                <i class="fas fa-check"></i>
                            @else
                                <i class="fas fa-shipping-fast"></i>
                            @endif
                        </div>
                        <div class="ml-4">
                            <h3 class="font-bold text-[#4D4C7D]">Shipped</h3>
                            @if($transaction->status == 'completed')
                                <p class="text-[#8E7AB5] text-sm">Order has been delivered</p>
                            @else
                                <p class="text-[#8E7AB5] text-sm">Not yet shipped</p>
                            @endif
                            <p class="text-[#4D4C7D] mt-1">Estimated delivery: 2-3 business days</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Order Summary -->
        <div class="space-y-8">
            <!-- Order Info -->
            <div class="bg-white rounded-2xl shadow-lg p-6">
                <h2 class="text-xl font-bold text-[#4D4C7D] mb-6 flex items-center">
                    <i class="fas fa-info-circle mr-3 text-[#8E7AB5]"></i>
                    Order Information
                </h2>
                
                <div class="space-y-4">
                    <div>
                        <div class="text-sm text-[#8E7AB5] mb-1">Order ID</div>
                        <div class="font-bold text-[#4D4C7D]">{{ $transaction->invoice_number }}</div>
                    </div>
                    
                    <div>
                        <div class="text-sm text-[#8E7AB5] mb-1">Payment Method</div>
                        <div class="font-bold text-[#4D4C7D]">
                            @if($transaction->payment_method == 'qris')
                                QRIS Payment
                            @else
                                Virtual Account
                            @endif
                        </div>
                    </div>
                    
                    <div>
                        <div class="text-sm text-[#8E7AB5] mb-1">Payment Status</div>
                        <div class="font-bold text-[#4D4C7D]">
                            @if($transaction->payment_proof)
                                <span class="text-green-600">Proof Uploaded</span>
                            @else
                                <span class="text-yellow-600">Awaiting Proof</span>
                            @endif
                        </div>
                    </div>
                    
                    <div>
                        <div class="text-sm text-[#8E7AB5] mb-1">Order Date</div>
                        <div class="font-bold text-[#4D4C7D]">{{ $transaction->created_at->format('F d, Y') }}</div>
                    </div>
                </div>
            </div>

            <!-- Price Breakdown -->
            <div class="bg-white rounded-2xl shadow-lg p-6">
                <h2 class="text-xl font-bold text-[#4D4C7D] mb-6 flex items-center">
                    <i class="fas fa-receipt mr-3 text-[#8E7AB5]"></i>
                    Price Breakdown
                </h2>
                
                <div class="space-y-3">
                    <div class="flex justify-between">
                        <span class="text-[#4D4C7D]">Subtotal</span>
                        <span class="text-[#4D4C7D] font-medium">
                            Rp {{ number_format($transaction->total, 0, ',', '.') }}
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
                            Rp {{ number_format($transaction->total * 0.1, 0, ',', '.') }}
                        </span>
                    </div>
                    
                    <div class="border-t border-[#F9DCC4] pt-3">
                        <div class="flex justify-between">
                            <span class="text-lg font-bold text-[#4D4C7D]">Total</span>
                            <span class="text-2xl font-bold text-[#FF6F61]">
                                Rp {{ number_format($transaction->total + 10000 + ($transaction->total * 0.1), 0, ',', '.') }}
                            </span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Actions -->
            <div class="bg-white rounded-2xl shadow-lg p-6">
                <h2 class="text-xl font-bold text-[#4D4C7D] mb-6 flex items-center">
                    <i class="fas fa-cog mr-3 text-[#8E7AB5]"></i>
                    Actions
                </h2>
                
                <div class="space-y-3">
                    @if(($transaction->status == 'pending' || $transaction->status == 'waiting_payment') && !$transaction->payment_proof)
                    <button onclick="showUploadModal({{ $transaction->id }})"
                            class="w-full bg-[#8E7AB5] text-white py-3 rounded-lg font-bold hover:bg-[#4D4C7D] transition-colors flex items-center justify-center">
                        <i class="fas fa-upload mr-2"></i>
                        Upload Payment Proof
                    </button>
                    @endif
                    
                    <a href="#" 
                       class="w-full bg-[#FCEFEA] text-[#4D4C7D] py-3 rounded-lg font-bold hover:bg-[#F9DCC4] transition-colors flex items-center justify-center">
                        <i class="fas fa-print mr-2"></i>
                        Print Invoice
                    </a>
                    
                    <a href="#" 
                       class="w-full bg-[#FCEFEA] text-[#4D4C7D] py-3 rounded-lg font-bold hover:bg-[#F9DCC4] transition-colors flex items-center justify-center">
                        <i class="fas fa-question-circle mr-2"></i>
                        Get Help
                    </a>
                    
                    <a href="{{ route('transactions.index') }}" 
                       class="w-full bg-[#FCEFEA] text-[#4D4C7D] py-3 rounded-lg font-bold hover:bg-[#F9DCC4] transition-colors flex items-center justify-center">
                        <i class="fas fa-arrow-left mr-2"></i>
                        Back to Orders
                    </a>
                </div>
            </div>
            
            <!-- Payment Proof Preview -->
            @if($transaction->payment_proof)
            <div class="bg-white rounded-2xl shadow-lg p-6">
                <h2 class="text-xl font-bold text-[#4D4C7D] mb-6 flex items-center">
                    <i class="fas fa-image mr-3 text-[#8E7AB5]"></i>
                    Payment Proof
                </h2>
                
                <div class="text-center">
                    <img src="{{ asset('storage/payments/' . $transaction->payment_proof) }}" 
                         alt="Payment Proof" 
                         class="max-w-full h-48 object-contain mx-auto rounded-lg shadow-sm">
                    <p class="text-sm text-[#8E7AB5] mt-3">Uploaded on {{ $transaction->updated_at->format('F d, Y') }}</p>
                </div>
            </div>
            @endif
        </div>
    </div>
</div>

<!-- Upload Payment Proof Modal (same as in index.blade.php) -->
<div id="upload-modal" class="fixed inset-0 z-50 hidden">
    <div class="absolute inset-0 bg-black/50"></div>
    <div class="absolute inset-0 flex items-center justify-center p-4">
        <div class="bg-white rounded-2xl shadow-2xl w-full max-w-md">
            <div class="p-6 border-b border-[#F9DCC4]">
                <div class="flex justify-between items-center">
                    <h3 class="text-xl font-bold text-[#4D4C7D]">Upload Payment Proof</h3>
                    <button onclick="closeUploadModal()" class="text-[#8E7AB5] hover:text-[#FF6F61] text-xl">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            </div>
            
            <div class="p-6">
                <form id="upload-form" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" id="transaction-id" name="transaction_id" value="{{ $transaction->id }}">
                    
                    <div class="mb-6">
                        <p class="text-[#4D4C7D] mb-4">Please upload proof of payment for your order.</p>
                        
                        <div class="border-2 border-dashed border-[#F9DCC4] rounded-xl p-6 text-center hover:border-[#8E7AB5] transition-colors">
                            <input type="file" 
                                   id="payment_proof_modal" 
                                   name="payment_proof"
                                   accept="image/*"
                                   class="hidden"
                                   onchange="previewModalImage(this)">
                            <div id="image-preview-modal" class="hidden mb-4">
                                <img id="preview-image-modal" class="max-w-full max-h-48 mx-auto rounded-lg">
                                <button type="button" 
                                        onclick="removeModalImage()"
                                        class="mt-2 text-[#FF6F61] hover:text-red-700">
                                    <i class="fas fa-trash mr-1"></i> Remove image
                                </button>
                            </div>
                            <div id="upload-prompt-modal">
                                <i class="fas fa-cloud-upload-alt text-4xl text-[#8E7AB5] mb-3"></i>
                                <p class="text-[#4D4C7D] mb-2">Click to upload payment proof</p>
                                <p class="text-sm text-[#8E7AB5] mb-4">Supported: JPG, PNG (Max: 2MB)</p>
                                <label for="payment_proof_modal" 
                                       class="inline-block bg-[#FCEFEA] text-[#4D4C7D] px-6 py-2 rounded-lg font-bold hover:bg-[#F9DCC4] transition-colors cursor-pointer">
                                    <i class="fas fa-image mr-2"></i> Choose File
                                </label>
                            </div>
                        </div>
                    </div>
                    
                    <div class="flex gap-3">
                        <button type="button" 
                                onclick="closeUploadModal()"
                                class="flex-1 bg-[#FCEFEA] text-[#4D4C7D] py-3 rounded-lg font-bold hover:bg-[#F9DCC4] transition-colors">
                            Cancel
                        </button>
                        <button type="submit" 
                                class="flex-1 bg-[#FF6F61] text-white py-3 rounded-lg font-bold hover:bg-[#FF8A80] transition-colors">
                            Upload
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    // Show upload modal
    function showUploadModal(transactionId) {
        document.getElementById('transaction-id').value = transactionId;
        document.getElementById('upload-modal').classList.remove('hidden');
        document.body.style.overflow = 'hidden';
    }
    
    // Close upload modal
    function closeUploadModal() {
        document.getElementById('upload-modal').classList.add('hidden');
        document.body.style.overflow = 'auto';
        resetModalForm();
    }
    
    // Reset modal form
    function resetModalForm() {
        document.getElementById('upload-form').reset();
        document.getElementById('image-preview-modal').style.display = 'none';
        document.getElementById('upload-prompt-modal').style.display = 'block';
    }
    
    // Image preview for modal
    function previewModalImage(input) {
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            const maxSize = 2 * 1024 * 1024; // 2MB
            
            if (input.files[0].size > maxSize) {
                alert('File size must be less than 2MB');
                input.value = '';
                return;
            }
            
            reader.onload = function(e) {
                document.getElementById('preview-image-modal').src = e.target.result;
                document.getElementById('image-preview-modal').style.display = 'block';
                document.getElementById('upload-prompt-modal').style.display = 'none';
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
    
    function removeModalImage() {
        document.getElementById('payment_proof_modal').value = '';
        document.getElementById('image-preview-modal').style.display = 'none';
        document.getElementById('upload-prompt-modal').style.display = 'block';
    }
    
    // Handle form submission
    document.getElementById('upload-form').addEventListener('submit', function(e) {
        e.preventDefault();
        
        const formData = new FormData(this);
        const transactionId = document.getElementById('transaction-id').value;
        const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        
        // Show loading
        const submitBtn = this.querySelector('button[type="submit"]');
        const originalText = submitBtn.innerHTML;
        submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i> Uploading...';
        submitBtn.disabled = true;
        
        fetch(`/transactions/${transactionId}/upload-proof`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': token
            },
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.status === 'success') {
                showNotification('Payment proof uploaded successfully!', 'success');
                closeUploadModal();
                setTimeout(() => location.reload(), 1500);
            } else {
                showNotification(data.message || 'Error uploading proof', 'error');
                submitBtn.innerHTML = originalText;
                submitBtn.disabled = false;
            }
        })
        .catch(error => {
            console.error('Error:', error);
            showNotification('Error uploading proof', 'error');
            submitBtn.innerHTML = originalText;
            submitBtn.disabled = false;
        });
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