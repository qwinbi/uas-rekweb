@extends('layouts.admin')

@section('title', 'Order Details')

@section('content')
<div class="row">
    <div class="col-lg-8">
        <!-- Order Details -->
        <div class="card border-0 shadow-sm mb-4">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <div>
                        <h4 class="fw-bold mb-1" style="color: var(--burgundy);">
                            Order #ORD1001
                        </h4>
                        <small class="text-muted">Placed on {{ now()->format('d F Y, H:i') }}</small>
                    </div>
                    <div class="btn-group">
                        <button class="btn btn-primary btn-sm" onclick="printOrder()">
                            <i class="fas fa-print me-2"></i>Print
                        </button>
                        <a href="{{ route('admin.transactions.index') }}" class="btn btn-outline-secondary btn-sm">
                            <i class="fas fa-arrow-left me-2"></i>Back
                        </a>
                    </div>
                </div>
                
                <!-- Order Status -->
                <div class="row mb-4">
                    <div class="col-md-8">
                        <div class="d-flex align-items-center">
                            <div class="status-badge me-3">
                                <span class="badge bg-success">Delivered</span>
                            </div>
                            <div>
                                <small class="text-muted d-block">Status History</small>
                                <div class="status-timeline">
                                    <span class="text-success">Pending → Processing → Shipped → Delivered</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 text-end">
                        <button class="btn btn-outline-primary btn-sm" onclick="updateOrderStatus()">
                            <i class="fas fa-edit me-2"></i>Update Status
                        </button>
                    </div>
                </div>
                
                <!-- Customer Information -->
                <div class="row mb-4">
                    <div class="col-md-6">
                        <h6 class="fw-bold mb-3" style="color: var(--lapis-lazuli);">
                            <i class="fas fa-user me-2"></i>Customer Information
                        </h6>
                        <div class="customer-info">
                            <p class="mb-1">
                                <strong>Name:</strong> John Doe
                            </p>
                            <p class="mb-1">
                                <strong>Email:</strong> john.doe@email.com
                            </p>
                            <p class="mb-1">
                                <strong>Phone:</strong> +62 812 3456 7890
                            </p>
                            <p class="mb-0">
                                <strong>Customer ID:</strong> CUST-001
                            </p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <h6 class="fw-bold mb-3" style="color: var(--lapis-lazuli);">
                            <i class="fas fa-map-marker-alt me-2"></i>Shipping Address
                        </h6>
                        <div class="shipping-info">
                            <p class="mb-0">
                                John Doe<br>
                                Jl. Sudirman No. 123<br>
                                Jakarta Pusat 10110<br>
                                Indonesia<br>
                                Phone: +62 812 3456 7890
                            </p>
                        </div>
                    </div>
                </div>
                
                <!-- Order Items -->
                <div class="mb-4">
                    <h6 class="fw-bold mb-3" style="color: var(--lapis-lazuli);">
                        <i class="fas fa-shopping-bag me-2"></i>Order Items
                    </h6>
                    
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead style="background: var(--light-pink);">
                                <tr>
                                    <th>Product</th>
                                    <th class="text-center">Quantity</th>
                                    <th class="text-end">Price</th>
                                    <th class="text-end">Subtotal</th>
                                </tr>
                            </thead>
                            <tbody>
                                @for($i = 1; $i <= 3; $i++)
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <img src="https://images.unsplash.com/photo-1505740420928-5e560c06d30e?ixlib=rb-4.0.3&auto=format&fit=crop&w=100&q=80" 
                                                 class="rounded me-3" width="50">
                                            <div>
                                                <div class="fw-bold">Product Name {{ $i }}</div>
                                                <small class="text-muted">SKU: PROD-{{ 1000 + $i }}</small>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="text-center">{{ $i }}</td>
                                    <td class="text-end">Rp {{ number_format(rand(50000, 200000), 0, ',', '.') }}</td>
                                    <td class="text-end fw-bold" style="color: var(--burgundy);">
                                        Rp {{ number_format(rand(50000, 200000) * $i, 0, ',', '.') }}
                                    </td>
                                </tr>
                                @endfor
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="3" class="text-end fw-bold">Subtotal</td>
                                    <td class="text-end fw-bold" style="color: var(--burgundy);">Rp 457,000</td>
                                </tr>
                                <tr>
                                    <td colspan="3" class="text-end fw-bold">Shipping</td>
                                    <td class="text-end fw-bold text-success">FREE</td>
                                </tr>
                                <tr>
                                    <td colspan="3" class="text-end fw-bold">Tax</td>
                                    <td class="text-end fw-bold" style="color: var(--burgundy);">Rp 22,850</td>
                                </tr>
                                <tr>
                                    <td colspan="3" class="text-end fw-bold">Discount</td>
                                    <td class="text-end fw-bold text-danger">-Rp 50,000</td>
                                </tr>
                                <tr>
                                    <td colspan="3" class="text-end fw-bold h5" style="color: var(--burgundy);">Total</td>
                                    <td class="text-end fw-bold h5" style="color: var(--burgundy);">Rp 429,850</td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
                
                <!-- Payment Information -->
                <div class="mb-4">
                    <h6 class="fw-bold mb-3" style="color: var(--lapis-lazuli);">
                        <i class="fas fa-credit-card me-2"></i>Payment Information
                    </h6>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="border rounded p-3">
                                <div class="row">
                                    <div class="col-6">
                                        <small class="text-muted d-block">Payment Method</small>
                                        <strong>QRIS</strong>
                                    </div>
                                    <div class="col-6">
                                        <small class="text-muted d-block">Payment Status</small>
                                        <span class="badge bg-success">Paid</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="border rounded p-3">
                                <div class="row">
                                    <div class="col-6">
                                        <small class="text-muted d-block">Transaction ID</small>
                                        <strong>TX{{ rand(100000, 999999) }}</strong>
                                    </div>
                                    <div class="col-6">
                                        <small class="text-muted d-block">Paid Date</small>
                                        <strong>{{ now()->format('d/m/Y H:i') }}</strong>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Shipping Information -->
                <div>
                    <h6 class="fw-bold mb-3" style="color: var(--lapis-lazuli);">
                        <i class="fas fa-truck me-2"></i>Shipping Information
                    </h6>
                    
                    <div class="border rounded p-3">
                        <div class="row">
                            <div class="col-md-4">
                                <small class="text-muted d-block">Shipping Method</small>
                                <strong>Standard Shipping</strong>
                            </div>
                            <div class="col-md-4">
                                <small class="text-muted d-block">Tracking Number</small>
                                <strong>TRK{{ rand(100000000, 999999999) }}</strong>
                            </div>
                            <div class="col-md-4">
                                <small class="text-muted d-block">Estimated Delivery</small>
                                <strong>{{ now()->addDays(3)->format('d M Y') }}</strong>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Order Notes -->
        <div class="card border-0 shadow-sm">
            <div class="card-body">
                <h6 class="fw-bold mb-3" style="color: var(--burgundy);">
                    <i class="fas fa-sticky-note me-2"></i>Order Notes
                </h6>
                
                <div class="order-notes">
                    <div class="note-item mb-3">
                        <div class="d-flex justify-content-between mb-1">
                            <small class="fw-semibold" style="color: var(--lapis-lazuli);">Customer Note</small>
                            <small class="text-muted">{{ now()->subDays(1)->format('d M Y, H:i') }}</small>
                        </div>
                        <p class="mb-0 small" style="color: var(--lapis-lazuli);">
                            Please deliver after 5 PM. Thank you!
                        </p>
                    </div>
                    
                    <div class="note-item">
                        <div class="d-flex justify-content-between mb-1">
                            <small class="fw-semibold" style="color: var(--lapis-lazuli);">Admin Note</small>
                            <small class="text-muted">{{ now()->subHours(3)->format('d M Y, H:i') }}</small>
                        </div>
                        <p class="mb-0 small" style="color: var(--lapis-lazuli);">
                            Customer requested signature required. Package insured.
                        </p>
                    </div>
                    
                    <div class="mt-4">
                        <textarea class="form-control" rows="3" placeholder="Add new note..."></textarea>
                        <button class="btn btn-primary btn-sm mt-2">
                            <i class="fas fa-plus me-2"></i>Add Note
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Sidebar -->
    <div class="col-lg-4">
        <!-- Order Actions -->
        <div class="card border-0 shadow-sm mb-4">
            <div class="card-body">
                <h6 class="fw-bold mb-3" style="color: var(--burgundy);">Order Actions</h6>
                
                <div class="d-grid gap-2">
                    <button class="btn btn-primary" onclick="resendInvoice()">
                        <i class="fas fa-envelope me-2"></i>Resend Invoice
                    </button>
                    <button class="btn btn-outline-primary" onclick="updateTracking()">
                        <i class="fas fa-truck me-2"></i>Update Tracking
                    </button>
                    <button class="btn btn-outline-secondary" onclick="refundOrder()">
                        <i class="fas fa-undo me-2"></i>Refund Order
                    </button>
                    <button class="btn btn-outline-danger" onclick="cancelOrder()">
                        <i class="fas fa-times me-2"></i>Cancel Order
                    </button>
                </div>
            </div>
        </div>
        
        <!-- Customer Details -->
        <div class="card border-0 shadow-sm mb-4">
            <div class="card-body">
                <h6 class="fw-bold mb-3" style="color: var(--burgundy);">Customer Details</h6>
                
                <div class="text-center mb-3">
                    <img src="https://i.pravatar.cc/150?img=50" 
                         class="rounded-circle mb-2" width="80" style="border: 3px solid var(--cherry-blossom);">
                    <h6 class="fw-bold mb-0">John Doe</h6>
                    <small class="text-muted">Member since {{ now()->subMonths(6)->format('M Y') }}</small>
                </div>
                
                <div class="list-group list-group-flush">
                    <div class="list-group-item border-0 px-0 d-flex justify-content-between">
                        <span>Total Orders</span>
                        <span class="fw-semibold">12</span>
                    </div>
                    <div class="list-group-item border-0 px-0 d-flex justify-content-between">
                        <span>Total Spent</span>
                        <span class="fw-semibold">Rp 4.8M</span>
                    </div>
                    <div class="list-group-item border-0 px-0 d-flex justify-content-between">
                        <span>Last Order</span>
                        <span class="fw-semibold">3 days ago</span>
                    </div>
                </div>
                
                <div class="mt-3">
                    <a href="#" class="btn btn-outline-primary btn-sm w-100">
                        <i class="fas fa-eye me-2"></i>View Full Profile
                    </a>
                </div>
            </div>
        </div>
        
        <!-- Order Timeline -->
        <div class="card border-0 shadow-sm">
            <div class="card-body">
                <h6 class="fw-bold mb-3" style="color: var(--burgundy);">Order Timeline</h6>
                
                <div class="timeline">
                    @foreach([
                        ['icon' => 'fas fa-shopping-cart', 'title' => 'Order Placed', 'time' => now()->subDays(5)->format('d M, H:i'), 'active' => true],
                        ['icon' => 'fas fa-money-bill-wave', 'title' => 'Payment Confirmed', 'time' => now()->subDays(5)->format('d M, H:i'), 'active' => true],
                        ['icon' => 'fas fa-cog', 'title' => 'Processing', 'time' => now()->subDays(4)->format('d M, H:i'), 'active' => true],
                        ['icon' => 'fas fa-truck', 'title' => 'Shipped', 'time' => now()->subDays(3)->format('d M, H:i'), 'active' => true],
                        ['icon' => 'fas fa-check-circle', 'title' => 'Delivered', 'time' => now()->subDays(1)->format('d M, H:i'), 'active' => true]
                    ] as $event)
                    <div class="timeline-item {{ $event['active'] ? 'active' : '' }}">
                        <div class="timeline-icon">
                            <i class="{{ $event['icon'] }}"></i>
                        </div>
                        <div class="timeline-content">
                            <div class="fw-semibold">{{ $event['title'] }}</div>
                            <small class="text-muted">{{ $event['time'] }}</small>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function printOrder() {
        window.print();
    }
    
    function updateOrderStatus() {
        Swal.fire({
            title: 'Update Order Status',
            html: `
                <div class="mb-3">
                    <label class="form-label">Select Status</label>
                    <select class="form-select" id="orderStatus">
                        <option value="pending">Pending</option>
                        <option value="processing">Processing</option>
                        <option value="shipped">Shipped</option>
                        <option value="delivered" selected>Delivered</option>
                        <option value="cancelled">Cancelled</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label class="form-label">Notify Customer</label>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="notifyCustomer" checked>
                        <label class="form-check-label" for="notifyCustomer">
                            Send email notification
                        </label>
                    </div>
                </div>
                <div class="mb-3">
                    <label class="form-label">Notes</label>
                    <textarea class="form-control" id="statusNotes" rows="3" 
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
                const status = document.getElementById('orderStatus').value;
                return {
                    status: status,
                    notify: document.getElementById('notifyCustomer').checked,
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
                        `Order status updated to ${result.value.status}.`,
                        'success'
                    );
                });
            }
        });
    }
    
    function resendInvoice() {
        Swal.fire({
            title: 'Resend Invoice?',
            text: 'Send invoice email to customer?',
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: 'var(--burgundy)',
            cancelButtonColor: 'var(--silver-lake)',
            confirmButtonText: 'Send Invoice',
            background: 'var(--light-pink)',
            color: 'var(--burgundy)'
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire({
                    title: 'Sending...',
                    text: 'Sending invoice email...',
                    timer: 1500,
                    showConfirmButton: false,
                    background: 'var(--light-pink)',
                    color: 'var(--burgundy)'
                }).then(() => {
                    Swal.fire(
                        'Sent!',
                        'Invoice has been sent to customer.',
                        'success'
                    );
                });
            }
        });
    }
    
    function updateTracking() {
        Swal.fire({
            title: 'Update Tracking',
            html: `
                <div class="mb-3">
                    <label class="form-label">Tracking Number</label>
                    <input type="text" class="form-control" id="trackingNumber" 
                           value="TRK${Math.floor(100000000 + Math.random() * 900000000)}">
                </div>
                <div class="mb-3">
                    <label class="form-label">Shipping Carrier</label>
                    <select class="form-select" id="shippingCarrier">
                        <option>JNE</option>
                        <option>J&T</option>
                        <option>SiCepat</option>
                        <option>POS Indonesia</option>
                        <option>Ninja Express</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label class="form-label">Notify Customer</label>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="notifyTracking" checked>
                        <label class="form-check-label" for="notifyTracking">
                            Send tracking information
                        </label>
                    </div>
                </div>
            `,
            showCancelButton: true,
            confirmButtonText: 'Update Tracking',
            confirmButtonColor: 'var(--burgundy)',
            cancelButtonColor: 'var(--silver-lake)',
            background: 'var(--light-pink)',
            color: 'var(--burgundy)'
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire(
                    'Updated!',
                    'Tracking information has been updated.',
                    'success'
                );
            }
        });
    }
    
    function refundOrder() {
        Swal.fire({
            title: 'Refund Order',
            html: `
                <div class="mb-3">
                    <label class="form-label">Refund Amount</label>
                    <div class="input-group">
                        <span class="input-group-text">Rp</span>
                        <input type="number" class="form-control" id="refundAmount" value="429850">
                    </div>
                </div>
                <div class="mb-3">
                    <label class="form-label">Refund Reason</label>
                    <select class="form-select" id="refundReason">
                        <option>Customer Request</option>
                        <option>Damaged Product</option>
                        <option>Wrong Item Sent</option>
                        <option>Late Delivery</option>
                        <option>Other</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label class="form-label">Notes</label>
                    <textarea class="form-control" id="refundNotes" rows="3"></textarea>
                </div>
            `,
            showCancelButton: true,
            confirmButtonText: 'Process Refund',
            confirmButtonColor: 'var(--burgundy)',
            cancelButtonColor: 'var(--silver-lake)',
            background: 'var(--light-pink)',
            color: 'var(--burgundy)'
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire({
                    title: 'Processing Refund...',
                    text: 'Please wait while we process the refund...',
                    timer: 2000,
                    showConfirmButton: false,
                    background: 'var(--light-pink)',
                    color: 'var(--burgundy)'
                }).then(() => {
                    Swal.fire(
                        'Refunded!',
                        'Refund has been processed successfully.',
                        'success'
                    );
                });
            }
        });
    }
    
    function cancelOrder() {
        Swal.fire({
            title: 'Cancel Order?',
            text: "This action cannot be undone. Are you sure you want to cancel this order?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: 'var(--silver-lake)',
            confirmButtonText: 'Yes, cancel order',
            background: 'var(--light-pink)',
            color: 'var(--burgundy)'
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire(
                    'Cancelled!',
                    'Order has been cancelled.',
                    'success'
                );
            }
        });
    }
</script>

<style>
    .table-bordered {
        border-color: var(--cherry-blossom);
    }
    
    .table-bordered th,
    .table-bordered td {
        border-color: var(--cherry-blossom);
    }
    
    .timeline {
        position: relative;
        padding-left: 30px;
    }
    
    .timeline::before {
        content: '';
        position: absolute;
        left: 15px;
        top: 0;
        bottom: 0;
        width: 2px;
        background-color: var(--cherry-blossom);
    }
    
    .timeline-item {
        position: relative;
        margin-bottom: 20px;
    }
    
    .timeline-icon {
        position: absolute;
        left: -30px;
        top: 0;
        width: 30px;
        height: 30px;
        border-radius: 50%;
        background-color: white;
        border: 2px solid var(--cherry-blossom);
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--burgundy);
    }
    
    .timeline-item.active .timeline-icon {
        background-color: var(--cherry-blossom);
        color: white;
    }
    
    .timeline-content {
        padding-left: 10px;
    }
    
    .btn-group .btn {
        border-radius: 6px;
    }
    
    .badge.bg-success {
        background-color: var(--silver-lake) !important;
    }
    
    .text-success {
        color: var(--silver-lake) !important;
    }
    
    .text-danger {
        color: var(--cherry-blossom) !important;
    }
</style>
@endsection