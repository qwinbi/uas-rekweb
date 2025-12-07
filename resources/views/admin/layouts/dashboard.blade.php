@extends('layouts.admin')

@section('title', 'Admin Dashboard - BUNNYPOPS')

@section('admin-content')
<div class="mb-8">
    <h1 class="text-3xl font-bold text-[#4D4C7D]">Dashboard</h1>
    <p class="text-[#8E7AB5]">Welcome back, {{ auth()->user()->name }}!</p>
</div>

<!-- Stats Cards -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
    <!-- New Orders -->
    <div class="bg-white rounded-2xl shadow-lg p-6">
        <div class="flex items-center justify-between mb-4">
            <div>
                <div class="text-3xl font-bold text-[#4D4C7D]">{{ $newTransactions }}</div>
                <div class="text-sm text-[#8E7AB5]">New Orders</div>
            </div>
            <div class="w-12 h-12 bg-[#FF6F61] rounded-full flex items-center justify-center">
                <i class="fas fa-shopping-cart text-white text-xl"></i>
            </div>
        </div>
        <div class="text-sm text-[#4D4C7D]">
            <span class="text-green-600 font-bold">+12%</span> from last month
        </div>
    </div>

    <!-- Total Products -->
    <div class="bg-white rounded-2xl shadow-lg p-6">
        <div class="flex items-center justify-between mb-4">
            <div>
                <div class="text-3xl font-bold text-[#4D4C7D]">{{ $totalProducts }}</div>
                <div class="text-sm text-[#8E7AB5]">Total Products</div>
            </div>
            <div class="w-12 h-12 bg-[#8E7AB5] rounded-full flex items-center justify-center">
                <i class="fas fa-box text-white text-xl"></i>
            </div>
        </div>
        <div class="text-sm text-[#4D4C7D]">
            <a href="{{ route('admin.products.index') }}" class="text-[#FF6F61] hover:underline">
                Manage products →
            </a>
        </div>
    </div>

    <!-- Total Sales -->
    <div class="bg-white rounded-2xl shadow-lg p-6">
        <div class="flex items-center justify-between mb-4">
            <div>
                <div class="text-3xl font-bold text-[#4D4C7D]">{{ $totalTransactions }}</div>
                <div class="text-sm text-[#8E7AB5]">Total Transactions</div>
            </div>
            <div class="w-12 h-12 bg-[#4D4C7D] rounded-full flex items-center justify-center">
                <i class="fas fa-receipt text-white text-xl"></i>
            </div>
        </div>
        <div class="text-sm text-[#4D4C7D]">
            <a href="{{ route('admin.transactions.index') }}" class="text-[#FF6F61] hover:underline">
                View all →
            </a>
        </div>
    </div>

    <!-- Total Revenue -->
    <div class="bg-white rounded-2xl shadow-lg p-6">
        <div class="flex items-center justify-between mb-4">
            <div>
                <div class="text-3xl font-bold text-[#4D4C7D]">Rp {{ number_format($totalRevenue, 0, ',', '.') }}</div>
                <div class="text-sm text-[#8E7AB5]">Total Revenue</div>
            </div>
            <div class="w-12 h-12 bg-green-500 rounded-full flex items-center justify-center">
                <i class="fas fa-money-bill-wave text-white text-xl"></i>
            </div>
        </div>
        <div class="text-sm text-[#4D4C7D]">
            <span class="text-green-600 font-bold">+24%</span> from last month
        </div>
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
    <!-- Recent Orders -->
    <div class="bg-white rounded-2xl shadow-lg p-6">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-xl font-bold text-[#4D4C7D]">Recent Orders</h2>
            <a href="{{ route('admin.transactions.index') }}" class="text-[#8E7AB5] hover:text-[#FF6F61] text-sm">
                View all →
            </a>
        </div>
        
        <div class="space-y-4">
            @php
                $recentTransactions = \App\Models\Transaction::with('user')
                    ->latest()
                    ->take(5)
                    ->get();
            @endphp
            
            @forelse($recentTransactions as $transaction)
            <div class="flex items-center justify-between p-3 border border-[#F9DCC4] rounded-lg">
                <div>
                    <div class="font-bold text-[#4D4C7D]">{{ $transaction->invoice_number }}</div>
                    <div class="text-sm text-[#8E7AB5]">
                        {{ $transaction->user->name }} • {{ $transaction->created_at->diffForHumans() }}
                    </div>
                </div>
                <div class="text-right">
                    <div class="font-bold text-[#FF6F61]">Rp {{ number_format($transaction->total, 0, ',', '.') }}</div>
                    <div>
                        @if($transaction->status == 'completed')
                            <span class="text-xs text-green-600 font-bold">Completed</span>
                        @elseif($transaction->status == 'processing')
                            <span class="text-xs text-blue-600 font-bold">Processing</span>
                        @else
                            <span class="text-xs text-yellow-600 font-bold">Pending</span>
                        @endif
                    </div>
                </div>
            </div>
            @empty
            <div class="text-center py-8">
                <i class="fas fa-receipt text-4xl text-[#8E7AB5] mb-3"></i>
                <p class="text-[#4D4C7D]">No orders yet</p>
            </div>
            @endforelse
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="bg-white rounded-2xl shadow-lg p-6">
        <h2 class="text-xl font-bold text-[#4D4C7D] mb-6">Quick Actions</h2>
        
        <div class="grid grid-cols-2 gap-4">
            <a href="{{ route('admin.products.create') }}" 
               class="bg-[#FCEFEA] rounded-xl p-4 hover:bg-[#F9DCC4] transition-colors group">
                <div class="w-12 h-12 bg-[#FF6F61] rounded-lg flex items-center justify-center mb-3 group-hover:scale-110 transition-transform">
                    <i class="fas fa-plus text-white text-xl"></i>
                </div>
                <div class="font-bold text-[#4D4C7D]">Add Product</div>
                <div class="text-sm text-[#8E7AB5]">Create new product</div>
            </a>
            
            <a href="{{ route('admin.settings.logo') }}" 
               class="bg-[#FCEFEA] rounded-xl p-4 hover:bg-[#F9DCC4] transition-colors group">
                <div class="w-12 h-12 bg-[#8E7AB5] rounded-lg flex items-center justify-center mb-3 group-hover:scale-110 transition-transform">
                    <i class="fas fa-image text-white text-xl"></i>
                </div>
                <div class="font-bold text-[#4D4C7D]">Update Logo</div>
                <div class="text-sm text-[#8E7AB5]">Change website logo</div>
            </a>
            
            <a href="{{ route('admin.settings.qris') }}" 
               class="bg-[#FCEFEA] rounded-xl p-4 hover:bg-[#F9DCC4] transition-colors group">
                <div class="w-12 h-12 bg-[#4D4C7D] rounded-lg flex items-center justify-center mb-3 group-hover:scale-110 transition-transform">
                    <i class="fas fa-qrcode text-white text-xl"></i>
                </div>
                <div class="font-bold text-[#4D4C7D]">Payment Settings</div>
                <div class="text-sm text-[#8E7AB5]">Update QRIS & VA</div>
            </a>
            
            <a href="{{ route('admin.settings.about') }}" 
               class="bg-[#FCEFEA] rounded-xl p-4 hover:bg-[#F9DCC4] transition-colors group">
                <div class="w-12 h-12 bg-[#F9DCC4] rounded-lg flex items-center justify-center mb-3 group-hover:scale-110 transition-transform">
                    <i class="fas fa-info-circle text-[#4D4C7D] text-xl"></i>
                </div>
                <div class="font-bold text-[#4D4C7D]">About Page</div>
                <div class="text-sm text-[#8E7AB5]">Edit about content</div>
            </a>
        </div>
    </div>
</div>

<!-- Recent Products -->
<div class="mt-8 bg-white rounded-2xl shadow-lg p-6">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-xl font-bold text-[#4D4C7D]">Recent Products</h2>
        <a href="{{ route('admin.products.index') }}" class="text-[#8E7AB5] hover:text-[#FF6F61] text-sm">
            View all →
        </a>
    </div>
    
    <div class="overflow-x-auto">
        <table class="w-full">
            <thead>
                <tr class="bg-[#FCEFEA]">
                    <th class="text-left p-3 text-[#4D4C7D] font-bold">Product</th>
                    <th class="text-left p-3 text-[#4D4C7D] font-bold">Price</th>
                    <th class="text-left p-3 text-[#4D4C7D] font-bold">Stock</th>
                    <th class="text-left p-3 text-[#4D4C7D] font-bold">Status</th>
                    <th class="text-left p-3 text-[#4D4C7D] font-bold">Actions</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $recentProducts = \App\Models\Product::latest()->take(5)->get();
                @endphp
                
                @forelse($recentProducts as $product)
                <tr class="border-b border-[#F9DCC4] hover:bg-[#FCEFEA]/50">
                    <td class="p-3">
                        <div class="flex items-center">
                            <div class="w-10 h-10 bg-gradient-to-br from-[#F9DCC4] to-[#8E7AB5] rounded-lg flex items-center justify-center mr-3">
                                @if($product->photo)
                                    <img src="{{ asset('storage/products/' . $product->photo) }}" 
                                         alt="{{ $product->name }}" 
                                         class="w-full h-full object-cover rounded-lg">
                                @else
                                    <i class="fas fa-box text-white text-sm"></i>
                                @endif
                            </div>
                            <div>
                                <div class="font-bold text-[#4D4C7D]">{{ $product->name }}</div>
                                <div class="text-sm text-[#8E7AB5] truncate max-w-xs">{{ $product->description }}</div>
                            </div>
                        </div>
                    </td>
                    
                    <td class="p-3">
                        <div class="font-bold text-[#FF6F61]">
                            Rp {{ number_format($product->price, 0, ',', '.') }}
                        </div>
                    </td>
                    
                    <td class="p-3">
                        <div class="{{ $product->stock < 10 ? 'text-yellow-600' : 'text-green-600' }} font-bold">
                            {{ $product->stock }}
                        </div>
                    </td>
                    
                    <td class="p-3">
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
                    
                    <td class="p-3">
                        <div class="flex gap-2">
                            <a href="{{ route('admin.products.edit', $product->id) }}" 
                               class="w-8 h-8 bg-[#FCEFEA] text-[#4D4C7D] rounded-lg flex items-center justify-center hover:bg-[#F9DCC4] transition-colors">
                                <i class="fas fa-edit text-sm"></i>
                            </a>
                            <a href="{{ route('product.detail', $product->id) }}" 
                               target="_blank"
                               class="w-8 h-8 bg-[#FCEFEA] text-[#4D4C7D] rounded-lg flex items-center justify-center hover:bg-[#F9DCC4] transition-colors">
                                <i class="fas fa-eye text-sm"></i>
                            </a>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="p-8 text-center">
                        <i class="fas fa-box-open text-4xl text-[#8E7AB5] mb-3"></i>
                        <p class="text-[#4D4C7D]">No products yet</p>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<!-- System Status -->
<div class="mt-8 grid grid-cols-1 md:grid-cols-3 gap-6">
    <div class="bg-white rounded-2xl shadow-lg p-6">
        <h3 class="font-bold text-[#4D4C7D] mb-4">System Status</h3>
        <div class="space-y-3">
            <div class="flex items-center justify-between">
                <span class="text-[#4D4C7D]">Storage</span>
                <span class="text-green-600 font-bold">85%</span>
            </div>
            <div class="w-full h-2 bg-[#FCEFEA] rounded-full overflow-hidden">
                <div class="h-full bg-green-500 rounded-full" style="width: 85%"></div>
            </div>
            
            <div class="flex items-center justify-between">
                <span class="text-[#4D4C7D]">Memory</span>
                <span class="text-blue-600 font-bold">67%</span>
            </div>
            <div class="w-full h-2 bg-[#FCEFEA] rounded-full overflow-hidden">
                <div class="h-full bg-blue-500 rounded-full" style="width: 67%"></div>
            </div>
            
            <div class="flex items-center justify-between">
                <span class="text-[#4D4C7D]">CPU</span>
                <span class="text-purple-600 font-bold">42%</span>
            </div>
            <div class="w-full h-2 bg-[#FCEFEA] rounded-full overflow-hidden">
                <div class="h-full bg-purple-500 rounded-full" style="width: 42%"></div>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-2xl shadow-lg p-6 md:col-span-2">
        <h3 class="font-bold text-[#4D4C7D] mb-4">Activity Log</h3>
        <div class="space-y-4">
            <div class="flex items-center p-3 bg-[#FCEFEA] rounded-lg">
                <div class="w-8 h-8 bg-[#FF6F61] rounded-full flex items-center justify-center mr-3">
                    <i class="fas fa-user-cog text-white text-sm"></i>
                </div>
                <div class="flex-grow">
                    <div class="font-bold text-[#4D4C7D]">You logged in</div>
                    <div class="text-sm text-[#8E7AB5]">Just now</div>
                </div>
            </div>
            
            <div class="flex items-center p-3 bg-[#FCEFEA] rounded-lg">
                <div class="w-8 h-8 bg-[#8E7AB5] rounded-full flex items-center justify-center mr-3">
                    <i class="fas fa-box text-white text-sm"></i>
                </div>
                <div class="flex-grow">
                    <div class="font-bold text-[#4D4C7D]">New product added</div>
                    <div class="text-sm text-[#8E7AB5]">2 hours ago</div>
                </div>
            </div>
            
            <div class="flex items-center p-3 bg-[#FCEFEA] rounded-lg">
                <div class="w-8 h-8 bg-green-500 rounded-full flex items-center justify-center mr-3">
                    <i class="fas fa-check text-white text-sm"></i>
                </div>
                <div class="flex-grow">
                    <div class="font-bold text-[#4D4C7D]">Order #INV-20240101-0001 completed</div>
                    <div class="text-sm text-[#8E7AB5]">Yesterday</div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection