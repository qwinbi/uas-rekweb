@extends('layouts.app')

@section('title', 'My Orders')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card border-0 shadow-sm mb-4">
            <div class="card-body p-4">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h2 class="fw-bold mb-0">
                        <i class="fas fa-history me-2"></i>My Orders
                    </h2>
                    <div class="text-muted">
                        Total: <span class="fw-bold text-primary">12 Orders</span>
                    </div>
                </div>
                
                <!-- Filters -->
                <div class="row g-3 mb-4">
                    <div class="col-md-3">
                        <select class="form-select">
                            <option>All Status</option>
                            <option>Pending</option>
                            <option>Processing</option>
                            <option>Shipped</option>
                            <option>Delivered</option>
                            <option>Cancelled</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <select class="form-select">
                            <option>Last 30 days</option>
                            <option>Last 3 months</option>
                            <option>Last 6 months</option>
                            <option>Last year</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Search orders...">
                            <button class="btn btn-primary">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </div>
                </div>
                
                <!-- Orders Table -->
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead class="table-light">
                            <tr>
                                <th>Order ID</th>
                                <th>Date</th>
                                <th>Items</th>
                                <th>Total</th>
                                <th>Status</th>
                                <th class="text-end">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @for($i = 1; $i <= 8; $i++)
                            <tr>
                                <td>
                                    <div class="fw-bold">#ORD{{ 1000 + $i }}</div>
                                    <small class="text-muted">3 items</small>
                                </td>
                                <td>
                                    <div>{{ now()->subDays($i)->format('d M Y') }}</div>
                                    <small class="text-muted">{{ now()->subDays($i)->format('H:i') }}</small>
                                </td>
                                <td>
                                    <div class="d-flex">
                                        @for($j = 1; $j <= min($i, 3); $j++)
                                        <img src="https://images.unsplash.com/photo-1505740420928-5e560c06d30e?ixlib=rb-4.0.3&auto=format&fit=crop&w=50&q=80" 
                                             class="rounded border me-1" width="40">
                                        @endfor
                                        @if($i > 3)
                                        <div class="more-items">
                                            +{{ $i - 3 }}
                                        </div>
                                        @endif
                                    </div>
                                </td>
                                <td class="fw-bold">
                                    Rp {{ number_format(rand(50000, 500000), 0, ',', '.') }}
                                </td>
                                <td>
                                    @php
                                        $statuses = ['pending', 'processing', 'shipped', 'delivered', 'cancelled'];
                                        $status = $statuses[array_rand($statuses)];
                                        $colors = [
                                            'pending' => 'warning',
                                            'processing' => 'info',
                                            'shipped' => 'primary',
                                            'delivered' => 'success',
                                            'cancelled' => 'danger'
                                        ];
                                    @endphp
                                    <span class="badge bg-{{ $colors[$status] }}">
                                        {{ ucfirst($status) }}
                                    </span>
                                </td>
                                <td class="text-end">
                                    <div class="btn-group" role="group">
                                        <a href="{{ route('transactions.show', $i) }}" 
                                           class="btn btn-sm btn-outline-primary">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        @if($status == 'delivered')
                                        <button class="btn btn-sm btn-outline-success" 
                                                onclick="reviewOrder({{ $i }})">
                                            <i class="fas fa-star"></i>
                                        </button>
                                        @endif
                                        @if($status == 'pending')
                                        <button class="btn btn-sm btn-outline-danger" 
                                                onclick="cancelOrder({{ $i }})">
                                            <i class="fas fa-times"></i>
                                        </button>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                            @endfor
                        </tbody>
                    </table>
                </div>
                
                <!-- Pagination -->
                <nav class="mt-4">
                    <ul class="pagination justify-content-center">
                        <li class="page-item disabled">
                            <a class="page-link" href="#" tabindex="-1">
                                <i class="fas fa-chevron-left"></i>
                            </a>
                        </li>
                        <li class="page-item active"><a class="page-link" href="#">1</a></li>
                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                        <li class="page-item">
                            <a class="page-link" href="#">
                                <i class="fas fa-chevron-right"></i>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
        
        <!-- Order Statistics -->
        <div class="row">
            @foreach([
                ['icon' => 'fas fa-clock', 'title' => 'Pending', 'count' => 2, 'color' => 'warning'],
                ['icon' => 'fas fa-cog', 'title' => 'Processing', 'count' => 1, 'color' => 'info'],
                ['icon' => 'fas fa-truck', 'title' => 'Shipped', 'count' => 3, 'color' => 'primary'],
                ['icon' => 'fas fa-check-circle', 'title' => 'Delivered', 'count' => 5, 'color' => 'success']
            ] as $stat)
            <div class="col-lg-3 col-md-6 mb-4">
                <div class="card border-0 shadow-sm">
                    <div class="card-body text-center p-4">
                        <div class="icon-wrapper mb-3">
                            <i class="{{ $stat['icon'] }} fa-2x text-{{ $stat['color'] }}"></i>
                        </div>
                        <h3 class="fw-bold mb-2">{{ $stat['count'] }}</h3>
                        <p class="text-muted mb-0">{{ $stat['title'] }} Orders</p>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>

<script>
    function reviewOrder(orderId) {
        Swal.fire({
            title: 'Review Order',
            html: `
                <div class="text-center mb-3">
                    <div class="rating mb-3">
                        ${Array(5).fill().map((_, i) => `
                            <i class="fas fa-star text-warning" style="font-size: 2rem; cursor: pointer;" 
                               onclick="setRating(${i + 1})" id="star-${i + 1}"></i>
                        `).join('')}
                    </div>
                    <textarea id="reviewText" class="form-control" rows="3" 
                              placeholder="Share your experience..."></textarea>
                </div>
            `,
            showCancelButton: true,
            confirmButtonText: 'Submit Review',
            preConfirm: () => {
                const rating = document.querySelectorAll('.fa-star.active').length;
                const review = document.getElementById('reviewText').value;
                
                if (rating === 0) {
                    Swal.showValidationMessage('Please select a rating');
                    return false;
                }
                
                return { rating, review };
            }
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire(
                    'Thank You!',
                    'Your review has been submitted.',
                    'success'
                );
            }
        });
    }
    
    function setRating(rating) {
        // Reset all stars
        document.querySelectorAll('.fa-star').forEach((star, index) => {
            star.classList.remove('active');
            if (index < rating) {
                star.classList.add('active');
            }
        });
    }
    
    function cancelOrder(orderId) {
        Swal.fire({
            title: 'Cancel Order?',
            text: "Are you sure you want to cancel this order?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Yes, cancel it!'
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire(
                    'Cancelled!',
                    'Your order has been cancelled.',
                    'success'
                );
            }
        });
    }
</script>

<style>
    .table thead th {
        border-bottom: 2px solid #dee2e6;
        font-weight: 600;
        text-transform: uppercase;
        font-size: 0.85rem;
        color: #6c757d;
    }
    
    .table tbody tr {
        transition: all 0.2s ease;
        vertical-align: middle;
    }
    
    .table tbody tr:hover {
        background-color: rgba(67, 97, 238, 0.05);
    }
    
    .more-items {
        width: 40px;
        height: 40px;
        background: #e9ecef;
        border-radius: 4px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 0.85rem;
        font-weight: 600;
        color: #6c757d;
    }
    
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
    
    .btn-group .btn {
        border-radius: 4px !important;
        margin-right: 4px;
    }
    
    .btn-group .btn:last-child {
        margin-right: 0;
    }
    
    .rating .fa-star {
        transition: all 0.2s ease;
    }
    
    .rating .fa-star:hover {
        transform: scale(1.2);
    }
    
    .rating .fa-star.active {
        color: #ffc107;
        text-shadow: 0 0 10px rgba(255, 193, 7, 0.5);
    }
</style>
@endsection