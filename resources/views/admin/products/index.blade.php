@extends('layouts.admin')

@section('title', 'Product Management - BUNNYPOPS')

@section('admin-content')
<div class="mb-8">
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
        <div>
            <h1 class="text-2xl md:text-3xl font-bold text-[#4D4C7D]">Product Management</h1>
            <p class="text-[#8E7AB5]">Manage your product catalog</p>
        </div>
        <a href="{{ route('admin.products.create') }}" 
           class="bg-gradient-to-r from-[#FF6F61] to-[#8E7AB5] text-white px-6 py-3 rounded-lg font-bold hover:opacity-90 transition-all shadow-lg hover:shadow-xl flex items-center">
            <i class="fas fa-plus mr-2"></i>
            Add New Product
        </a>
    </div>
</div>

<!-- Stats -->
<div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
    <div class="bg-white rounded-2xl shadow-lg p-6">
        <div class="text-3xl font-bold text-[#4D4C7D]">{{ $products->total() }}</div>
        <div class="text-[#8E7AB5]">Total Products</div>
    </div>
    <div class="bg-white rounded-2xl shadow-lg p-6">
        <div class="text-3xl font-bold text-green-600">
            {{ \App\Models\Product::where('stock', '>', 10)->count() }}
        </div>
        <div class="text-[#8E7AB5]">In Stock</div>
    </div>
    <div class="bg-white rounded-2xl shadow-lg p-6">
        <div class="text-3xl font-bold text-yellow-600">
            {{ \App\Models\Product::where('stock', '>', 0)->where('stock', '<=', 10)->count() }}
        </div>
        <div class="text-[#8E7AB5]">Low Stock</div>
    </div>
    <div class="bg-white rounded-2xl shadow-lg p-6">
        <div class="text-3xl font-bold text-red-600">
            {{ \App\Models\Product::where('stock', 0)->count() }}
        </div>
        <div class="text-[#8E7AB5]">Out of Stock</div>
    </div>
</div>

<!-- Filters & Search -->
<div class="bg-white rounded-2xl shadow-lg p-6 mb-8">
    <div class="flex flex-col md:flex-row gap-4">
        <!-- Search -->
        <div class="flex-grow">
            <div class="relative">
                <input type="text" 
                       placeholder="Search products..." 
                       class="w-full pl-10 pr-4 py-3 rounded-lg border-2 border-[#F9DCC4] focus:border-[#FF6F61] focus:outline-none">
                <i class="fas fa-search absolute left-3 top-1/2 transform -translate-y-1/2 text-[#8E7AB5]"></i>
            </div>
        </div>
        
        <!-- Filters -->
        <div class="flex gap-3">
            <select class="px-4 py-3 rounded-lg border-2 border-[#F9DCC4] focus:border-[#FF6F61] focus:outline-none text-[#4D4C7D]">
                <option>All Categories</option>
                <option>Apparel</option>
                <option>Home Decor</option>
                <option>Gifts</option>
                <option>Bunny Items</option>
            </select>
            
            <select class="px-4 py-3 rounded-lg border-2 border-[#F9DCC4] focus:border-[#FF6F61] focus:outline-none text-[#4D4C7D]">
                <option>All Stock Status</option>
                <option>In Stock</option>
                <option>Low Stock</option>
                <option>Out of Stock</option>
            </select>
            
            <button class="bg-[#FCEFEA] text-[#4D4C7D] px-6 py-3 rounded-lg font-bold hover:bg-[#F9DCC4] transition-colors">
                <i class="fas fa-filter mr-2"></i>
                Filter
            </button>
        </div>
    </div>
</div>

<!-- Products Table -->
<div class="bg-white rounded-2xl shadow-lg overflow-hidden">
    @if($products->count() > 0)
    <div class="overflow-x-auto">
        <table class="w-full">
            <thead>
                <tr class="bg-[#FCEFEA]">
                    <th class="text-left p-4 text-[#4D4C7D] font-bold">Product</th>
                    <th class="text-left p-4 text-[#4D4C7D] font-bold">Price</th>
                    <th class="text-left p-4 text-[#4D4C7D] font-bold">Stock</th>
                    <th class="text-left p-4 text-[#4D4C7D] font-bold">Status</th>
                    <th class="text-left p-4 text-[#4D4C7D] font-bold">Created</th>
                    <th class="text-left p-4 text-[#4D4C7D] font-bold">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($products as $product)
                <tr class="border-b border-[#F9DCC4] hover:bg-[#FCEFEA]/50 transition-colors">
                    <td class="p-4">
                        <div class="flex items-center">
                            <div class="w-16 h-16 bg-gradient-to-br from-[#F9DCC4] to-[#8E7AB5] rounded-lg flex items-center justify-center mr-4 flex-shrink-0">
                                @if($product->photo)
                                    <img src="{{ asset('storage/products/' . $product->photo) }}" 
                                         alt="{{ $product->name }}" 
                                         class="w-full h-full object-cover rounded-lg">
                                @else
                                    <i class="fas fa-box text-white text-xl"></i>
                                @endif
                            </div>
                            <div>
                                <div class="font-bold text-[#4D4C7D]">{{ $product->name }}</div>
                                <div class="text-sm text-[#8E7AB5] line-clamp-2 max-w-xs">
                                    {{ $product->description ?: 'No description' }}
                                </div>
                            </div>
                        </div>
                    </td>
                    
                    <td class="p-4">
                        <div class="font-bold text-[#FF6F61]">
                            Rp {{ number_format($product->price, 0, ',', '.') }}
                        </div>
                    </td>
                    
                    <td class="p-4">
                        <div class="{{ $product->stock < 10 ? 'text-yellow-600' : 'text-green-600' }} font-bold">
                            {{ $product->stock }}
                        </div>
                    </td>
                    
                    <td class="p-4">
                        @if($product->stock > 10)
                            <span class="px-3 py-1 rounded-full bg-green-100 text-green-800 text-xs font-bold">
                                In Stock
                            </span>
                        @elseif($product->stock > 0)
                            <span class="px-3 py-1 rounded-full bg-yellow-100 text-yellow-800 text-xs font-bold">
                                Low Stock
                            </span>
                        @else
                            <span class="px-3 py-1 rounded-full bg-red-100 text-red-800 text-xs font-bold">
                                Out of Stock
                            </span>
                        @endif
                    </td>
                    
                    <td class="p-4 text-[#4D4C7D]">
                        {{ $product->created_at->format('M d, Y') }}
                    </td>
                    
                    <td class="p-4">
                        <div class="flex gap-2">
                            <a href="{{ route('admin.products.edit', $product->id) }}" 
                               class="w-10 h-10 bg-[#FCEFEA] text-[#4D4C7D] rounded-lg flex items-center justify-center hover:bg-[#F9DCC4] transition-colors">
                                <i class="fas fa-edit"></i>
                            </a>
                            
                            <a href="{{ route('product.detail', $product->id) }}" 
                               target="_blank"
                               class="w-10 h-10 bg-[#FCEFEA] text-[#4D4C7D] rounded-lg flex items-center justify-center hover:bg-[#F9DCC4] transition-colors">
                                <i class="fas fa-eye"></i>
                            </a>
                            
                            <form action="{{ route('admin.products.destroy', $product->id) }}" 
                                  method="POST" 
                                  onsubmit="return confirm('Are you sure you want to delete this product?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" 
                                        class="w-10 h-10 bg-red-50 text-red-600 rounded-lg flex items-center justify-center hover:bg-red-100 transition-colors">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    @if($products->hasPages())
    <div class="p-6 border-t border-[#F9DCC4]">
        <div class="flex justify-between items-center">
            <div class="text-[#4D4C7D]">
                Showing {{ $products->firstItem() }} to {{ $products->lastItem() }} of {{ $products->total() }} products
            </div>
            
            <div class="flex gap-2">
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
            </div>
        </div>
    </div>
    @endif
    
    @else
    <!-- Empty State -->
    <div class="p-12 text-center">
        <div class="w-32 h-32 mx-auto mb-6 bg-gradient-to-br from-[#F9DCC4] to-[#FCEFEA] rounded-full flex items-center justify-center">
            <i class="fas fa-box-open text-[#8E7AB5] text-5xl"></i>
        </div>
        <h3 class="text-2xl font-bold text-[#4D4C7D] mb-3">No Products Yet</h3>
        <p class="text-[#8E7AB5] mb-8 max-w-md mx-auto">
            You haven't added any products yet. Start by adding your first product to the catalog.
        </p>
        <a href="{{ route('admin.products.create') }}" 
           class="inline-flex items-center bg-gradient-to-r from-[#FF6F61] to-[#8E7AB5] text-white px-8 py-3 rounded-xl font-bold hover:opacity-90 transition-all shadow-lg hover:shadow-xl">
            <i class="fas fa-plus mr-3"></i>
            Add Your First Product
        </a>
    </div>
    @endif
</div>

<!-- Bulk Actions -->
<div class="mt-8 bg-white rounded-2xl shadow-lg p-6">
    <h3 class="font-bold text-[#4D4C7D] mb-4">Bulk Actions</h3>
    <div class="flex flex-wrap gap-3">
        <button class="bg-[#FCEFEA] text-[#4D4C7D] px-6 py-2 rounded-lg font-bold hover:bg-[#F9DCC4] transition-colors">
            <i class="fas fa-file-export mr-2"></i>
            Export Products
        </button>
        
        <button class="bg-[#FCEFEA] text-[#4D4C7D] px-6 py-2 rounded-lg font-bold hover:bg-[#F9DCC4] transition-colors">
            <i class="fas fa-file-import mr-2"></i>
            Import Products
        </button>
        
        <button class="bg-[#FCEFEA] text-[#4D4C7D] px-6 py-2 rounded-lg font-bold hover:bg-[#F9DCC4] transition-colors">
            <i class="fas fa-copy mr-2"></i>
            Duplicate Selected
        </button>
        
        <button class="bg-red-50 text-red-600 px-6 py-2 rounded-lg font-bold hover:bg-red-100 transition-colors">
            <i class="fas fa-trash mr-2"></i>
            Delete Selected
        </button>
    </div>
</div>

<script>
    // Select all checkbox
    document.getElementById('select-all')?.addEventListener('change', function() {
        const checkboxes = document.querySelectorAll('.product-checkbox');
        checkboxes.forEach(checkbox => {
            checkbox.checked = this.checked;
        });
    });
    
    // Bulk actions confirmation
    document.querySelectorAll('.bulk-action-btn').forEach(button => {
        button.addEventListener('click', function() {
            const selectedProducts = document.querySelectorAll('.product-checkbox:checked');
            if (selectedProducts.length === 0) {
                alert('Please select at least one product');
                return false;
            }
            
            if (this.classList.contains('delete')) {
                return confirm(`Are you sure you want to delete ${selectedProducts.length} selected products?`);
            }
            
            return true;
        });
    });
</script>

<style>
    .line-clamp-2 {
        overflow: hidden;
        display: -webkit-box;
        -webkit-box-orient: vertical;
        -webkit-line-clamp: 2;
    }
</style>
@endsection