@extends('layouts.admin')

@section('title', 'Product Details')

@section('content')
<div class="row">
    <div class="col-lg-8">
        <div class="card border-0 shadow-sm mb-4">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h4 class="fw-bold mb-0" style="color: var(--burgundy);">
                        <i class="fas fa-box me-2"></i>Product Details
                    </h4>
                    <div class="btn-group">
                        <a href="{{ route('admin.products.edit', 1) }}" class="btn btn-primary btn-sm">
                            <i class="fas fa-edit me-2"></i>Edit
                        </a>
                        <a href="{{ route('admin.products.index') }}" class="btn btn-outline-secondary btn-sm">
                            <i class="fas fa-arrow-left me-2"></i>Back
                        </a>
                    </div>
                </div>
                
                <div class="row">
                    <!-- Product Images -->
                    <div class="col-md-6 mb-4">
                        <div class="product-images">
                            <div class="main-image text-center mb-3">
                                <img src="https://images.unsplash.com/photo-1505740420928-5e560c06d30e?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80" 
                                     class="img-fluid rounded" style="max-height: 300px;">
                            </div>
                            <div class="thumbnail-images row g-2">
                                @for($i = 1; $i <= 4; $i++)
                                <div class="col-3">
                                    <img src="https://images.unsplash.com/photo-1505740420928-5e560c06d30e?ixlib=rb-4.0.3&auto=format&fit=crop&w=150&q=80" 
                                         class="img-fluid rounded border cursor-pointer" 
                                         style="border-color: var(--cherry-blossom) !important;">
                                </div>
                                @endfor
                            </div>
                        </div>
                    </div>
                    
                    <!-- Product Info -->
                    <div class="col-md-6 mb-4">
                        <div class="product-info">
                            <h3 class="fw-bold mb-2" style="color: var(--lapis-lazuli);">Premium Wireless Headphones</h3>
                            
                            <div class="d-flex align-items-center mb-3">
                                <div class="text-warning me-2">
                                    @for($i = 1; $i <= 5; $i++)
                                    <i class="fas fa-star"></i>
                                    @endfor
                                </div>
                                <span class="text-muted">4.5/5.0 (128 reviews)</span>
                            </div>
                            
                            <div class="mb-3">
                                <h2 class="fw-bold" style="color: var(--burgundy);">Rp 499,000</h2>
                                <small class="text-muted text-decoration-line-through">Rp 599,000</small>
                                <span class="badge bg-secondary ms-2">Save 16%</span>
                            </div>
                            
                            <div class="product-meta mb-4">
                                <div class="row">
                                    <div class="col-6 mb-2">
                                        <small class="text-muted d-block">SKU</small>
                                        <strong>PROD-1001</strong>
                                    </div>
                                    <div class="col-6 mb-2">
                                        <small class="text-muted d-block">Category</small>
                                        <strong>Electronics</strong>
                                    </div>
                                    <div class="col-6 mb-2">
                                        <small class="text-muted d-block">Brand</small>
                                        <strong>AudioTech</strong>
                                    </div>
                                    <div class="col-6 mb-2">
                                        <small class="text-muted d-block">Stock</small>
                                        <strong>50 units</strong>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="status-badges mb-4">
                                <span class="badge bg-success me-2">Active</span>
                                <span class="badge bg-primary me-2">Featured</span>
                                <span class="badge bg-secondary">New Arrival</span>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Product Description -->
                <div class="mb-4">
                    <h5 class="fw-bold mb-3" style="color: var(--lapis-lazuli);">Description</h5>
                    <p style="color: var(--lapis-lazuli);">
                        Experience premium sound quality with our wireless headphones. 
                        Features noise cancellation, 30-hour battery life, and comfortable design 
                        for extended use. Advanced noise cancellation technology provides 
                        crystal-clear audio perfect for music lovers, gamers, and professionals.
                    </p>
                </div>
                
                <!-- Specifications -->
                <div class="mb-4">
                    <h5 class="fw-bold mb-3" style="color: var(--lapis-lazuli);">Specifications</h5>
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <tbody>
                                <tr>
                                    <td class="fw-semibold" style="width: 200px; color: var(--lapis-lazuli);">Brand</td>
                                    <td>AudioTech</td>
                                </tr>
                                <tr>
                                    <td class="fw-semibold" style="color: var(--lapis-lazuli);">Model</td>
                                    <td>ATH-M50x</td>
                                </tr>
                                <tr>
                                    <td class="fw-semibold" style="color: var(--lapis-lazuli);">Connectivity</td>
                                    <td>Bluetooth 5.0, 3.5mm jack</td>
                                </tr>
                                <tr>
                                    <td class="fw-semibold" style="color: var(--lapis-lazuli);">Battery Life</td>
                                    <td>30 hours</td>
                                </tr>
                                <tr>
                                    <td class="fw-semibold" style="color: var(--lapis-lazuli);">Weight</td>
                                    <td>285 grams</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Sales Statistics -->
        <div class="card border-0 shadow-sm">
            <div class="card-body">
                <h5 class="fw-bold mb-4" style="color: var(--burgundy);">Sales Statistics</h5>
                
                <div class="row">
                    <div class="col-md-3 mb-3">
                        <div class="text-center p-3 rounded-3" style="background: var(--light-pink);">
                            <div class="fw-bold h4 mb-1" style="color: var(--burgundy);">156</div>
                            <small class="text-muted">Total Sales</small>
                        </div>
                    </div>
                    <div class="col-md-3 mb-3">
                        <div class="text-center p-3 rounded-3" style="background: var(--light-pink);">
                            <div class="fw-bold h4 mb-1" style="color: var(--burgundy);">Rp 77.8M</div>
                            <small class="text-muted">Total Revenue</small>
                        </div>
                    </div>
                    <div class="col-md-3 mb-3">
                        <div class="text-center p-3 rounded-3" style="background: var(--light-pink);">
                            <div class="fw-bold h4 mb-1" style="color: var(--burgundy);">1,248</div>
                            <small class="text-muted">Page Views</small>
                        </div>
                    </div>
                    <div class="col-md-3 mb-3">
                        <div class="text-center p-3 rounded-3" style="background: var(--light-pink);">
                            <div class="fw-bold h4 mb-1" style="color: var(--burgundy);">12.5%</div>
                            <small class="text-muted">Conversion Rate</small>
                        </div>
                    </div>
                </div>
                
                <div class="mt-4">
                    <h6 class="fw-bold mb-3" style="color: var(--lapis-lazuli);">Recent Orders</h6>
                    <div class="table-responsive">
                        <table class="table table-sm">
                            <thead>
                                <tr>
                                    <th>Order ID</th>
                                    <th>Customer</th>
                                    <th>Date</th>
                                    <th>Amount</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @for($i = 1; $i <= 5; $i++)
                                <tr>
                                    <td>#ORD{{ 1000 + $i }}</td>
                                    <td>Customer {{ $i }}</td>
                                    <td>{{ now()->subDays($i)->format('d/m/Y') }}</td>
                                    <td>Rp {{ number_format(rand(50000, 500000), 0, ',', '.') }}</td>
                                    <td>
                                        <span class="badge bg-success">Completed</span>
                                    </td>
                                </tr>
                                @endfor
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Sidebar -->
    <div class="col-lg-4">
        <!-- Actions Card -->
        <div class="card border-0 shadow-sm mb-4">
            <div class="card-body">
                <h6 class="fw-bold mb-3" style="color: var(--burgundy);">Quick Actions</h6>
                
                <div class="d-grid gap-2">
                    <button class="btn btn-primary" onclick="duplicateProduct()">
                        <i class="fas fa-copy me-2"></i>Duplicate Product
                    </button>
                    <button class="btn btn-outline-primary" onclick="updateStock()">
                        <i class="fas fa-boxes me-2"></i>Update Stock
                    </button>
                    <button class="btn btn-outline-secondary" onclick="viewOnSite()">
                        <i class="fas fa-external-link-alt me-2"></i>View on Website
                    </button>
                    <button class="btn btn-outline-danger" onclick="deleteProduct()">
                        <i class="fas fa-trash me-2"></i>Delete Product
                    </button>
                </div>
            </div>
        </div>
        
        <!-- Inventory Management -->
        <div class="card border-0 shadow-sm mb-4">
            <div class="card-body">
                <h6 class="fw-bold mb-3" style="color: var(--burgundy);">Inventory Management</h6>
                
                <div class="mb-3">
                    <label class="form-label">Current Stock</label>
                    <div class="d-flex align-items-center">
                        <div class="flex-grow-1">
                            <div class="progress" style="height: 10px;">
                                <div class="progress-bar" style="width: 70%; background-color: var(--silver-lake);"></div>
                            </div>
                        </div>
                        <div class="ms-3 fw-bold" style="color: var(--burgundy);">50 units</div>
                    </div>
                    <small class="text-muted">70% of initial stock remaining</small>
                </div>
                
                <div class="mb-3">
                    <label class="form-label">Low Stock Alert</label>
                    <div class="alert alert-warning py-2">
                        <i class="fas fa-exclamation-triangle me-2"></i>
                        Will trigger at 5 units remaining
                    </div>
                </div>
                
                <div class="row g-2">
                    <div class="col">
                        <button class="btn btn-outline-primary w-100 btn-sm" onclick="addStock(10)">
                            +10
                        </button>
                    </div>
                    <div class="col">
                        <button class="btn btn-outline-primary w-100 btn-sm" onclick="addStock(50)">
                            +50
                        </button>
                    </div>
                    <div class="col">
                        <button class="btn btn-outline-danger w-100 btn-sm" onclick="reduceStock(10)">
                            -10
                        </button>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- SEO Information -->
        <div class="card border-0 shadow-sm">
            <div class="card-body">
                <h6 class="fw-bold mb-3" style="color: var(--burgundy);">SEO Information</h6>
                
                <div class="mb-3">
                    <label class="form-label">SEO Title</label>
                    <p class="mb-0 small">Premium Wireless Headphones | BUNNYPOPS</p>
                </div>
                
                <div class="mb-3">
                    <label class="form-label">Slug</label>
                    <p class="mb-0 small">premium-wireless-headphones</p>
                </div>
                
                <div class="mb-3">
                    <label class="form-label">Meta Description</label>
                    <p class="mb-0 small">Premium wireless headphones with noise cancellation. 30-hour battery life. Free shipping available.</p>
                </div>
                
                <div class="mt-4">
                    <button class="btn btn-outline-secondary w-100 btn-sm" onclick="copySEODetails()">
                        <i class="fas fa-copy me-2"></i>Copy SEO Details
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function duplicateProduct() {
        Swal.fire({
            title: 'Duplicate Product?',
            text: "This will create a copy of this product. Are you sure?",
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: 'var(--burgundy)',
            cancelButtonColor: 'var(--silver-lake)',
            confirmButtonText: 'Yes, duplicate it!',
            background: 'var(--light-pink)',
            color: 'var(--burgundy)'
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire({
                    title: 'Duplicating...',
                    text: 'Creating product copy...',
                    timer: 1500,
                    showConfirmButton: false,
                    background: 'var(--light-pink)',
                    color: 'var(--burgundy)'
                }).then(() => {
                    Swal.fire(
                        'Duplicated!',
                        'Product has been duplicated successfully.',
                        'success'
                    );
                });
            }
        });
    }
    
    function updateStock() {
        Swal.fire({
            title: 'Update Stock',
            html: `
                <div class="mb-3">
                    <label class="form-label">Adjust Stock Quantity</label>
                    <input type="number" class="form-control" id="stockAdjustment" value="10">
                </div>
                <div class="mb-3">
                    <label class="form-label">Reason</label>
                    <select class="form-select" id="stockReason">
                        <option>Restock</option>
                        <option>Damage/Loss</option>
                        <option>Return to Supplier</option>
                        <option>Other</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label class="form-label">Notes</label>
                    <textarea class="form-control" id="stockNotes" rows="2"></textarea>
                </div>
            `,
            showCancelButton: true,
            confirmButtonText: 'Update Stock',
            confirmButtonColor: 'var(--burgundy)',
            cancelButtonColor: 'var(--silver-lake)',
            background: 'var(--light-pink)',
            color: 'var(--burgundy)',
            preConfirm: () => {
                const adjustment = document.getElementById('stockAdjustment').value;
                if (!adjustment) {
                    Swal.showValidationMessage('Please enter stock adjustment');
                }
                return {
                    adjustment: adjustment,
                    reason: document.getElementById('stockReason').value,
                    notes: document.getElementById('stockNotes').value
                };
            }
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire(
                    'Stock Updated!',
                    `Stock adjusted by ${result.value.adjustment} units.`,
                    'success'
                );
            }
        });
    }
    
    function addStock(amount) {
        Swal.fire({
            title: `Add ${amount} units?`,
            text: `This will increase stock by ${amount} units.`,
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: 'var(--burgundy)',
            cancelButtonColor: 'var(--silver-lake)',
            confirmButtonText: 'Yes, add stock',
            background: 'var(--light-pink)',
            color: 'var(--burgundy)'
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire(
                    'Stock Added!',
                    `${amount} units added to stock.`,
                    'success'
                );
            }
        });
    }
    
    function reduceStock(amount) {
        Swal.fire({
            title: `Reduce ${amount} units?`,
            text: `This will decrease stock by ${amount} units.`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: 'var(--burgundy)',
            cancelButtonColor: 'var(--silver-lake)',
            confirmButtonText: 'Yes, reduce stock',
            background: 'var(--light-pink)',
            color: 'var(--burgundy)'
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire(
                    'Stock Reduced!',
                    `${amount} units removed from stock.`,
                    'success'
                );
            }
        });
    }
    
    function viewOnSite() {
        window.open('/products/1', '_blank');
    }
    
    function deleteProduct() {
        Swal.fire({
            title: 'Delete Product?',
            text: "This action cannot be undone. The product will be permanently deleted.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: 'var(--silver-lake)',
            confirmButtonText: 'Yes, delete it!',
            background: 'var(--light-pink)',
            color: 'var(--burgundy)'
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire({
                    title: 'Deleting...',
                    text: 'Removing product from database...',
                    timer: 1500,
                    showConfirmButton: false,
                    background: 'var(--light-pink)',
                    color: 'var(--burgundy)'
                }).then(() => {
                    Swal.fire(
                        'Deleted!',
                        'Product has been deleted.',
                        'success'
                    ).then(() => {
                        window.location.href = '{{ route("admin.products.index") }}';
                    });
                });
            }
        });
    }
    
    function copySEODetails() {
        // Copy SEO details to clipboard
        const seoTitle = document.querySelector('.card-body p.small').textContent;
        navigator.clipboard.writeText(seoTitle).then(() => {
            Swal.fire({
                title: 'Copied!',
                text: 'SEO details copied to clipboard.',
                icon: 'success',
                timer: 1500,
                showConfirmButton: false,
                background: 'var(--light-pink)',
                color: 'var(--burgundy)'
            });
        });
    }
</script>

<style>
    .cursor-pointer {
        cursor: pointer;
        transition: all 0.3s ease;
    }
    
    .cursor-pointer:hover {
        transform: scale(1.05);
        border-color: var(--burgundy) !important;
    }
    
    .table-bordered {
        border-color: var(--cherry-blossom);
    }
    
    .table-bordered td {
        border-color: var(--cherry-blossom);
    }
    
    .progress {
        background-color: var(--light-blue);
        border-radius: 5px;
        overflow: hidden;
    }
    
    .alert-warning {
        background-color: rgba(242, 174, 188, 0.2);
        border-color: var(--cherry-blossom);
        color: var(--burgundy);
    }
    
    .btn-group .btn {
        border-radius: 6px;
    }
</style>
@endsection