@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="fw-bold">
        <i class="fas fa-tachometer-alt me-2"></i>Dashboard
    </h1>
    <div class="text-muted">
        <i class="fas fa-calendar-alt me-1"></i>
        {{ now()->format('d F Y') }}
    </div>
</div>

<!-- Stats Cards -->
<div class="row mb-4">
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="stat-card primary rounded-3">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h2 class="fw-bold mb-0">1,248</h2>
                    <p class="mb-0">Total Orders</p>
                </div>
                <div class="icon">
                    <i class="fas fa-shopping-cart"></i>
                </div>
            </div>
            <div class="mt-3">
                <span class="small">
                    <i class="fas fa-arrow-up me-1"></i>
                    12.5% from last month
                </span>
            </div>
        </div>
    </div>
    
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="stat-card success rounded-3">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h2 class="fw-bold mb-0">Rp 256M</h2>
                    <p class="mb-0">Total Revenue</p>
                </div>
                <div class="icon">
                    <i class="fas fa-dollar-sign"></i>
                </div>
            </div>
            <div class="mt-3">
                <span class="small">
                    <i class="fas fa-arrow-up me-1"></i>
                    18.2% from last month
                </span>
            </div>
        </div>
    </div>
    
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="stat-card warning rounded-3">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h2 class="fw-bold mb-0">586</h2>
                    <p class="mb-0">Total Products</p>
                </div>
                <div class="icon">
                    <i class="fas fa-box"></i>
                </div>
            </div>
            <div class="mt-3">
                <span class="small">
                    <i class="fas fa-arrow-up me-1"></i>
                    5 new this week
                </span>
            </div>
        </div>
    </div>
    
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="stat-card danger rounded-3">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h2 class="fw-bold mb-0">3,824</h2>
                    <p class="mb-0">Total Customers</p>
                </div>
                <div class="icon">
                    <i class="fas fa-users"></i>
                </div>
            </div>
            <div class="mt-3">
                <span class="small">
                    <i class="fas fa-arrow-up me-1"></i>
                    24 new today
                </span>
            </div>
        </div>
    </div>
</div>

<!-- Charts & Recent Activities -->
<div class="row">
    <!-- Revenue Chart -->
    <div class="col-lg-8 mb-4">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h5 class="fw-bold mb-0">Revenue Overview</h5>
                    <select class="form-select form-select-sm" style="width: auto;">
                        <option>Last 7 Days</option>
                        <option selected>Last 30 Days</option>
                        <option>Last 90 Days</option>
                    </select>
                </div>
                <div class="chart-container" style="height: 300px;">
                    <!-- Chart would be implemented with Chart.js -->
                    <div class="text-center text-muted py-5">
                        <i class="fas fa-chart-line fa-3x mb-3"></i>
                        <p>Revenue chart would be displayed here</p>
                        <p class="small">Using Chart.js or similar library</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Recent Orders -->
    <div class="col-lg-4 mb-4">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body">
                <h5 class="fw-bold mb-4">Recent Orders</h5>
                <div class="list-group list-group-flush">
                    @for($i = 1; $i <= 5; $i++)
                    <div class="list-group-item border-0 px-0 py-3">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="fw-bold mb-1">Order #ORD{{ 1000 + $i }}</h6>
                                <small class="text-muted">Customer {{ $i }}</small>
                            </div>
                            <div class="text-end">
                                <span class="badge bg-success">Completed</span>
                                <div class="fw-bold mt-1">Rp {{ number_format(rand(50000, 500000), 0, ',', '.') }}</div>
                            </div>
                        </div>
                    </div>
                    @endfor
                </div>
                <div class="text-center mt-3">
                    <a href="{{ route('admin.transactions.index') }}" class="btn btn-outline-primary btn-sm">
                        View All Orders
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Products & Quick Stats -->
<div class="row">
    <!-- Low Stock Products -->
    <div class="col-lg-6 mb-4">
        <div class="card border-0 shadow-sm">
            <div class="card-body">
                <h5 class="fw-bold mb-4">Low Stock Products</h5>
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Product</th>
                                <th>Stock</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @for($i = 1; $i <= 5; $i++)
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <img src="https://images.unsplash.com/photo-1505740420928-5e560c06d30e?ixlib=rb-4.0.3&auto=format&fit=crop&w=50&q=80" 
                                             class="rounded me-2" width="40">
                                        <span>Product Name {{ $i }}</span>
                                    </div>
                                </td>
                                <td>{{ rand(1, 10) }}</td>
                                <td>
                                    @php $stock = rand(1, 10); @endphp
                                    @if($stock <= 3)
                                    <span class="badge bg-danger">Critical</span>
                                    @elseif($stock <= 5)
                                    <span class="badge bg-warning">Low</span>
                                    @endif
                                </td>
                                <td>
                                    <button class="btn btn-sm btn-outline-primary">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                </td>
                            </tr>
                            @endfor
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Quick Stats -->
    <div class="col-lg-6 mb-4">
        <div class="card border-0 shadow-sm">
            <div class="card-body">
                <h5 class="fw-bold mb-4">Quick Stats</h5>
                <div class="row">
                    @for($i = 1; $i <= 4; $i++)
                    <div class="col-6 mb-4">
                        <div class="text-center p-3 border rounded-3">
                            @php
                                $stats = [
                                    ['icon' => 'fas fa-clock', 'title' => 'Pending', 'value' => rand(5, 20), 'color' => 'warning'],
                                    ['icon' => 'fas fa-check-circle', 'title' => 'Completed', 'value' => rand(100, 200), 'color' => 'success'],
                                    ['icon' => 'fas fa-truck', 'title' => 'Shipping', 'value' => rand(10, 30), 'color' => 'info'],
                                    ['icon' => 'fas fa-times-circle', 'title' => 'Cancelled', 'value' => rand(1, 10), 'color' => 'danger'],
                                ];
                            @endphp
                            <div class="icon-wrapper mb-2">
                                <i class="{{ $stats[$i-1]['icon'] }} fa-2x text-{{ $stats[$i-1]['color'] }}"></i>
                            </div>
                            <h3 class="fw-bold mb-1">{{ $stats[$i-1]['value'] }}</h3>
                            <small class="text-muted">{{ $stats[$i-1]['title'] }} Orders</small>
                        </div>
                    </div>
                    @endfor
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .stat-card {
        padding: 1.5rem;
        color: white;
        margin-bottom: 1.5rem;
    }
    
    .stat-card .icon {
        font-size: 2.5rem;
        opacity: 0.8;
    }
    
    .stat-card.primary { background: linear-gradient(135deg, #4361ee, #3a0ca3); }
    .stat-card.success { background: linear-gradient(135deg, #4caf50, #2e7d32); }
    .stat-card.warning { background: linear-gradient(135deg, #ff9800, #ef6c00); }
    .stat-card.danger { background: linear-gradient(135deg, #f44336, #c62828); }
    
    .icon-wrapper {
        width: 60px;
        height: 60px;
        background: rgba(67, 97, 238, 0.1);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto;
    }
    
    table.table-hover tbody tr:hover {
        background-color: rgba(67, 97, 238, 0.05);
    }
</style>
@endsection