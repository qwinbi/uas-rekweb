@extends('layouts.app')

@section('title', 'Transaction History - BUNNYPOPS')

@section('content')
<div class="py-8">
    <!-- Page Header -->
    <div class="mb-8 text-center">
        <h1 class="text-3xl md:text-4xl font-bold text-[#4D4C7D] mb-3">Transaction History</h1>
        <p class="text-[#8E7AB5]">Track your orders and purchases</p>
    </div>

    @if($transactions->count() > 0)
    <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
        <!-- Transaction Filters -->
        <div class="p-6 border-b border-[#F9DCC4]">
            <div class="flex flex-col md:flex-row justify-between items-center gap-4">
                <div class="flex items-center gap-4">
                    <button class="px-4 py-2 rounded-lg bg-[#FF6F61] text-white font-bold">
                        All Orders
                    </button>
                    <button class="px-4 py-2 rounded-lg bg-[#FCEFEA] text-[#4D4C7D] hover:bg-[#F9DCC4] transition-colors">
                        Pending
                    </button>
                    <button class="px-4 py-2 rounded-lg bg-[#FCEFEA] text-[#4D4C7D] hover:bg-[#F9DCC4] transition-colors">
                        Completed
                    </button>
                </div>
                
                <div class="flex items-center gap-3">
                    <div class="relative">
                        <input type="text" 
                               placeholder="Search orders..." 
                               class="pl-10 pr-4 py-2 rounded-lg border-2 border-[#F9DCC4] focus:border-[#FF6F61] focus:outline-none">
                        <i class="fas fa-search absolute left-3 top-1/2 transform -translate-y-1/2 text-[#8E7AB5]"></i>
                    </div>
                    
                    <select class="px-4 py-2 rounded-lg border-2 border-[#F9DCC4] focus:border-[#FF6F61] focus:outline-none text-[#4D4C7D]">
                        <option>Last 30 days</option>
                        <option>Last 3 months</option>
                        <option>Last year</option>
                    </select>
                </div>
            </div>
        </div>

        <!-- Transactions List -->
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="bg-[#FCEFEA]">
                        <th class="text-left p-4 text-[#4D4C7D] font-bold">Order ID</th>
                        <th class="text-left p-4 text-[#4D4C7D] font-bold">Date</th>
                        <th class="text-left p-4 text-[#4D4C7D] font-bold">Items</th>
                        <th class="text-left p-4 text-[#4D4C7D] font-bold">Total</th>
                        <th class="text-left p-4 text-[#4D4C7D] font-bold">Status</th>
                        <th class="text-left p-4 text-[#4D4C7D] font-bold">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($transactions as $transaction)
                    <tr class="border-b border-[#F9DCC4] hover:bg-[#FCEFEA]/50 transition-colors">
                        <td class="p-4">
                            <div class="font-bold text-[#4D4C7D]">{{ $transaction->invoice_number }}</div>
                            <div class="text-sm text-[#8E7AB5]">#{{ $transaction->id }}</div>
                        </td>
                        
                        <td class="p-4 text-[#4D4C7D]">
                            {{ $transaction->created_at->format('d M Y') }}
                            <div class="text-sm text-[#8E7AB5]">
                                {{ $transaction->created_at->format('H:i') }}
                            </div>
                        </td>
                        
                        <td class="p-4">
                            <div class="flex items-center">
                                <div class="flex -space-x-2 mr-3">
                                    @foreach($transaction->items->take(3) as $item)
                                    <div class="w-8 h-8 rounded-full border-2 border-white bg-gradient-to-br from-[#F9DCC4] to-[#8E7AB5] flex items-center justify-center">
                                        <i class="fas fa-box text-white text-xs"></i>
                                    </div>
                                    @endforeach
                                    @if($transaction->items->count() > 3)
                                    <div class="w-8 h-8 rounded-full border-2 border-white bg-[#4D4C7D] flex items-center justify-center">
                                        <span class="text-white text-xs">+{{ $transaction->items->count() - 3 }}</span>
                                    </div>
                                    @endif
                                </div>
                                <span class="text-[#4D4C7D]">{{ $transaction->items->count() }} items</span>
                            </div>
                        </td>
                        
                        <td class="p-4">
                            <div class="text-xl font-bold text-[#FF6F61]">
                                Rp {{ number_format($transaction->total, 0, ',', '.') }}
                            </div>
                        </td>
                        
                        <td class="p-4">
                            @if($transaction->status == 'completed')
                            <span class="inline-flex items-center px-3 py-1 rounded-full bg-green-100 text-green-800 font-bold text-sm">
                                <i class="fas fa-check-circle mr-1"></i> Completed
                            </span>
                            @elseif($transaction->status == 'processing')
                            <span class="inline-flex items-center px-3 py-1 rounded-full bg-blue-100 text-blue-800 font-bold text-sm">
                                <i class="fas fa-sync-alt mr-1"></i> Processing
                            </span>
                            @elseif($transaction->status == 'waiting_payment')
                            <span class="inline-flex items-center px-3 py-1 rounded-full bg-yellow-100 text-yellow-800 font-bold text-sm">
                                <i class="fas fa-clock mr-1"></i> Waiting Payment
                            </span>
                            @else
                            <span class="inline-flex items-center px-3 py-1 rounded-full bg-gray-100 text-gray-800 font-bold text-sm">
                                <i class="fas fa-hourglass-half mr-1"></i> Pending
                            </span>
                            @endif
                        </td>
                        
                        <td class="p-4">
                            <div class="flex gap-2">
                                <a href="{{ route('transactions.show', $transaction->id) }}" 
                                   class="w-10 h-10 bg-[#FCEFEA] text-[#4D4C7D] rounded-lg flex items-center justify-center hover:bg-[#F9DCC4] transition-colors">
                                    <i class="fas fa-eye"></i>
                                </a>
                                
                                @if($transaction->status == 'pending' || $transaction->status == 'waiting_payment')
                                <button onclick="showUploadModal({{ $transaction->id }})"
                                        class="w-10 h-10 bg-[#8E7AB5] text-white rounded-lg flex items-center justify-center hover:bg-[#4D4C7D] transition-colors">
                                    <i class="fas fa-upload"></i>
                                </button>
                                @endif
                                
                                <a href="#" 
                                   class="w-10 h-10 bg-[#FCEFEA] text-[#4D4C7D] rounded-lg flex items-center justify-center hover:bg-[#F9DCC4] transition-colors">
                                    <i class="fas fa-print"></i>
                                </a>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        @if($transactions->hasPages())
        <div class="p-6 border-t border-[#F9DCC4]">
            <div class="flex justify-between items-center">
                <div class="text-[#4D4C7D]">
                    Showing {{ $transactions->firstItem() }} to {{ $transactions->lastItem() }} of {{ $transactions->total() }} orders
                </div>
                
                <div class="flex gap-2">
                    @if($transactions->onFirstPage())
                        <span class="px-4 py-2 rounded-lg bg-[#FCEFEA] text-[#8E7AB5] cursor-not-allowed">
                            <i class="fas fa-chevron-left"></i>
                        </span>
                    @else
                        <a href="{{ $transactions->previousPageUrl() }}" 
                           class="px-4 py-2 rounded-lg bg-white text-[#4D4C7D] hover:bg-[#FCEFEA] transition-colors shadow-sm">
                            <i class="fas fa-chevron-left"></i>
                        </a>
                    @endif
                    
                    @foreach(range(1, $transactions->lastPage()) as $page)
                        @if($page == $transactions->currentPage())
                            <span class="px-4 py-2 rounded-lg bg-[#FF6F61] text-white font-bold">
                                {{ $page }}
                            </span>
                        @else
                            <a href="{{ $transactions->url($page) }}" 
                               class="px-4 py-2 rounded-lg bg-white text-[#4D4C7D] hover:bg-[#FCEFEA] transition-colors shadow-sm">
                                {{ $page }}
                            </a>
                        @endif
                    @endforeach
                    
                    @if($transactions->hasMorePages())
                        <a href="{{ $transactions->nextPageUrl() }}" 
                           class="px-4 py-2 rounded-lg bg-white text-[#4D4C7D] hover:bg-[#FCEFEA] transition-colors shadow-sm">
                            <i class="fas fa-chevron-right"></i>
                        </a>
                    @else
                        <span class="px-4 py-2 rounded-lg bg-[#FCEFEA] text-[#8E7AB5] cursor-not-allowed">
                            <i class="fas fa-chevron-right"></i>
                        </span>
                    @endif
                </div>
            </div>
        </div>
        @endif
    </div>
    @else
    <!-- Empty State -->
    <div class="text-center py-16">
        <div class="w-40 h-40 mx-auto mb-6">
            <div class="relative w-full h-full">
                <div class="absolute inset-0 bg-gradient-to-br from-[#F9DCC4] to-[#FCEFEA] rounded-full animate-pulse"></div>
                <div class="absolute inset-10 bg-white rounded-full flex items-center justify-center">
                    <i class="fas fa-receipt text-[#8E7AB5] text-5xl"></i>
                </div>
            </div>
        </div>
        
        <h3 class="text-2xl font-bold text-[#4D4C7D] mb-3">No Orders Yet</h3>
        <p class="text-[#8E7AB5] mb-8 max-w-md mx-auto">
            You haven't made any purchases yet. Start shopping to see your orders here!
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

<!-- Upload Payment Proof Modal -->
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
                    <input type="hidden" id="transaction-id" name="transaction_id">
                    
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