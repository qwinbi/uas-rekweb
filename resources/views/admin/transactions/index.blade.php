@extends('layouts.admin')

@section('title', 'Transactions Management')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card border-0 shadow-sm mb-4">
            <div class="card-body p-4">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h2 class="fw-bold mb-0" style="color: var(--burgundy);">
                        <i class="fas fa-exchange-alt me-2"></i>Transactions
                    </h2>
                    <div class="text-muted">
                        Total: <span class="fw-bold" style="color: var(--burgundy);">1,248 Orders</span>
                    </div>
                </div>
                
                <!-- Filters & Search -->
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
                            <option>Today</option>
                            <option>Last 7 days</option>
                            <option selected>Last 30 days</option>
                            <option>Last 90 days</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Search orders by ID, customer, or email...">
                            <button class="btn btn-primary">
                                <i class="fas fa-search"></i>
                            </button>
                            <button class="btn btn-outline-primary" type="button" data-bs-toggle="collapse" 
                                    data-bs-target="#advancedFilters">
                                <i class="fas fa-filter"></i>
                            </button>
                        </div>
                    </div>
                </div>
                
                <!-- Advanced Filters -->
                <div class="collapse mb-4" id="advancedFilters">
                    <div class="card card-body border-0" style="background: var(--light-pink);">
                        <div class="row g-3">
                            <div class="col-md-3">
                                <label class="form-label">Payment Method</label>
                                <select class="form-select">
                                    <option>All Methods</option>
                                    <option>QRIS</option>
                                    <option>Bank Transfer</option>
                                    <option>Credit Card</option>
                                    <option>E-Wallet</option>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label class="form-label">Min Amount</label>
                                <input type="number" class="form-control" placeholder="Rp 0">
                            </div>
                            <div class="col-md-3">
                                <label class="form-label">Max Amount</label>
                                <input type="number" class="form-control" placeholder="Rp 10,000,000">
                            </div>
                            <div class="col-md-3">
                                <label class="form-label">&nbsp;</label>
                                <button class="btn btn-primary w-100">Apply Filters</button>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Transactions Table -->
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead class="table-light">
                            <tr>
                                <th>
                                    <input type="checkbox" class="form-check-input">
                                </th>
                                <th>Order ID</th>
                                <th>Customer</th>
                                <th>Date</th>
                                <th>Amount</th>
                                <th>Payment</th>
                                <th>Status</th>
                                <th class="text-end">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @for($i = 1; $i <= 10; $i++)
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
                                $paymentMethods = ['QRIS', 'Bank Transfer', 'Credit Card', 'E-Wallet'];
                                $payment = $paymentMethods[array_rand($paymentMethods)];
                            @endphp
                            <tr>
                                <td>
                                    <input type="checkbox" class="form-check-input">
                                </td>
                                <td>
                                    <div class="fw-bold">#ORD{{ 1000 + $i }}</div>
                                    <small class="text-muted">3 items</small>
                                </td>
                                <td>
                                    <div class="fw-bold">Customer {{ $i }}</div>
                                    <small class="text-muted">customer{{ $i }}@email.com</small>
                                </td>
                                <td>
                                    <div>{{ now()->subDays($i)->format('d M Y') }}</div>
                                    <small class="text-muted">{{ now()->subDays($i)->format('H:i') }}</small>
                                </td>
                                <td class="fw-bold" style="color: var(--burgundy);">
                                    Rp {{ number_format(rand(50000, 500000), 0, ',', '.') }}
                                </td>
                                <td>
                                    <span class="badge" style="background: var(--light-blue); color: var(--lapis-lazuli);">
                                        {{ $payment }}
                                    </span>
                                </td>
                                <td>
                                    <span class="badge bg-{{ $colors[$status] }}">
                                        {{ ucfirst($status) }}
                                    </span>
                                </td>
                                <td class="text-end">
                                    <div class="btn-group" role="group">
                                        <a href="{{ route('admin.transactions.show', $i) }}" 
                                           class="btn btn-sm btn-outline-primary">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <button class="btn btn-sm btn-outline-secondary" 
                                                onclick="updateStatus({{ $i }})">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <button class="btn btn-sm btn-outline-danger" 
                                                onclick="deleteOrder({{ $i }})">
                                            <i class="fas fa-trash"></i>
                                        </button>
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
                        <li class="page-item active">
                            <a class="page-link" href="#" style="background-color: var(--burgundy); border-color: var(--burgundy);">1</a>
                        </li>
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
        
        <!-- Statistics Cards -->
        <div class="row">
            @foreach([
                ['icon' => 'fas fa-clock', 'title' => 'Pending', 'count' => 24, 'color' => 'warning', 'amount' => 'Rp 8.4M'],
                ['icon' => 'fas fa-cog', 'title' => 'Processing', 'count' => 18, 'color' => 'info', 'amount' => 'Rp 6.2M'],
                ['icon' => 'fas fa-truck', 'title' => 'Shipped', 'count' => 42, 'color' => 'primary', 'amount' => 'Rp 15.8M'],
                ['icon' => 'fas fa-check-circle', 'title' => 'Delivered', 'count' => 156, 'color' => 'success', 'amount' => 'Rp 58.3M']
            ] as $stat)
            <div class="col-lg-3 col-md-6 mb-4">
                <div class="card border-0 shadow-sm">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="icon-wrapper me-3" style="background: rgba(var(--{{ $stat['color'] }}-rgb, 0.1));">
                                <i class="{{ $stat['icon'] }} fa-2x" style="color: var(--{{ $stat['color'] }});"></i>
                            </div>
                            <div>
                                <h3 class="fw-bold mb-0" style="color: var(--burgundy);">{{ $stat['count'] }}</h3>
                                <small class="text-muted">{{ $stat['title'] }}</small>
                                <div class="fw-semibold small" style="color: var(--lapis-lazuli);">{{ $stat['amount'] }}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        
        <!-- Bulk Actions -->
        <div class="card border-0 shadow-sm">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <select class="form-select form-select-sm me-2" style="width: auto;">
                            <option>Bulk Actions</option>
                            <option>Mark as Processing</option>
                            <option>Mark as Shipped</option>
                            <option>Mark as Delivered</option>
                            <option>Export Selected</option>
                            <option>Delete Selected</option>
                        </select>
                        <button class="btn btn-sm btn-primary">Apply</button>
                    </div>
                    <div class="text-muted">
                        Showing 1 to 10 of 1,248 transactions
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // Update order status
    function updateStatus(orderId) {
        Swal.fire({
            title: 'Update Order Status',
            html: `
                <div class="mb-3">
                    <label class="form-label">Select Status</label>
                    <select class="form-select" id="newStatus">
                        <option value="pending">Pending</option>
                        <option value="processing">Processing</option>
                        <option value="shipped">Shipped</option>
                        <option value="delivered">Delivered</option>
                        <option value="cancelled">Cancelled</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label class="form-label">Notes (Optional)</label>
                    <textarea class="form-control" id="statusNotes" rows="2" 
                              placeholder="Add notes about status change..."></textarea>
                </div>
            `,
            showCancelButton: true,
            confirmButtonText: 'Update Status',
            confirmButtonColor: 'var(--burgundy)',
            cancelButtonColor: 'var(--silver-lake)',
            background: 'var(--light-pink)',
            color: 'var(--burgundy)',
            preConfirm: () => {
                const status = document.getElementById('newStatus').value;
                return {
                    status: status,
                    notes: document.getElementById('statusNotes').value
                };
            }
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire({
                    title: 'Updating...',
                    text: 'Updating order status...',
                    timer: 1500,
                    showConfirmButton: false,
                    background: 'var(--light-pink)',
                    color: 'var(--burgundy)'
                }).then(() => {
                    Swal.fire(
                        'Updated!',
                        `Order #${orderId} status updated to ${result.value.status}.`,
                        'success'
                    );
                });
            }
        });
    }
    
    // Delete order
    function deleteOrder(orderId) {
        Swal.fire({
            title: 'Delete Order?',
            text: "This action cannot be undone. The order will be permanently deleted.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: 'var(--silver-lake)',
            confirmButtonText: 'Yes, delete it!',
            background: 'var(--light-pink)',
            color: 'var(--burgundy)'
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire(
                    'Deleted!',
                    `Order #${orderId} has been deleted.`,
                    'success'
                );
            }
        });
    }
    
    // Select all checkboxes
    document.querySelector('thead input[type="checkbox"]').addEventListener('change', function() {
        const checkboxes = document.querySelectorAll('tbody input[type="checkbox"]');
        checkboxes.forEach(checkbox => {
            checkbox.checked = this.checked;
        });
    });
    
    // Export data
    document.querySelector('.btn-sm.btn-primary').addEventListener('click', function() {
        const selectedCount = document.querySelectorAll('tbody input[type="checkbox"]:checked').length;
        
        if (selectedCount > 0) {
            Swal.fire({
                title: 'Export Selected',
                text: `Export ${selectedCount} selected transactions?`,
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: 'var(--burgundy)',
                cancelButtonColor: 'var(--silver-lake)',
                confirmButtonText: 'Export',
                background: 'var(--light-pink)',
                color: 'var(--burgundy)'
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire({
                        title: 'Exporting...',
                        text: 'Generating export file...',
                        timer: 2000,
                        showConfirmButton: false,
                        background: 'var(--light-pink)',
                        color: 'var(--burgundy)'
                    }).then(() => {
                        Swal.fire(
                            'Exported!',
                            'Transaction data has been exported successfully.',
                            'success'
                        );
                    });
                }
            });
        } else {
            Swal.fire({
                title: 'No Selection',
                text: 'Please select at least one transaction to export.',
                icon: 'warning',
                confirmButtonColor: 'var(--burgundy)',
                background: 'var(--light-pink)',
                color: 'var(--burgundy)'
            });
        }
    });
</script>

<style>
    .table thead th {
        border-bottom: 2px solid var(--cherry-blossom);
        font-weight: 600;
        text-transform: uppercase;
        font-size: 0.85rem;
        color: var(--lapis-lazuli);
    }
    
    .table tbody tr {
        transition: all 0.2s ease;
        vertical-align: middle;
    }
    
    .table tbody tr:hover {
        background-color: rgba(242, 174, 188, 0.05);
    }
    
    .icon-wrapper {
        width: 50px;
        height: 50px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    
    .btn-group .btn {
        border-radius: 4px !important;
        margin-right: 4px;
    }
    
    .btn-group .btn:last-child {
        margin-right: 0;
    }
    
    .form-check-input:checked {
        background-color: var(--burgundy);
        border-color: var(--burgundy);
    }
</style>
@endsection