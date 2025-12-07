@extends('layouts.admin')

@section('title', 'Products Management')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="fw-bold">
        <i class="fas fa-box me-2"></i>Products Management
    </h1>
    <a href="{{ route('admin.products.create') }}" class="btn btn-primary">
        <i class="fas fa-plus me-2"></i>Add Product
    </a>
</div>

<!-- Filters -->
<div class="card border-0 shadow-sm mb-4">
    <div class="card-body">
        <div class="row g-3">
            <div class="col-md-3">
                <input type="text" class="form-control" placeholder="Search products...">
            </div>
            <div class="col-md-2">
                <select class="form-select">
                    <option>All Categories</option>
                    <option>Electronics</option>
                    <option>Fashion</option>
                    <option>Home & Garden</option>
                </select>
            </div>
            <div class="col-md-2">
                <select class="form-select">
                    <option>All Status</option>
                    <option>Active</option>
                    <option>Inactive</option>
                    <option>Out of Stock</option>
                </select>
            </div>
            <div class="col-md-2">
                <button class="btn btn-outline-primary w-100">
                    <i class="fas fa-filter me-2"></i>Filter
                </button>
            </div>
            <div class="col-md-3 text-end">
                <button class="btn btn-outline-success">
                    <i class="fas fa-file-export me-2"></i>Export
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Products Table -->
<div class="card border-0 shadow-sm">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead class="table-light">
                    <tr>
                        <th class="ps-4">
                            <input type="checkbox" class="form-check-input">
                        </th>
                        <th>Product</th>
                        <th>Category</th>
                        <th>Price</th>
                        <th>Stock</th>
                        <th>Status</th>
                        <th>Sales</th>
                        <th class="text-end pe-4">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @for($i = 1; $i <= 10; $i++)
                    <tr>
                        <td class="ps-4">
                            <input type="checkbox" class="form-check-input">
                        </td>
                        <td>
                            <div class="d-flex align-items-center">
                                <img src="https://images.unsplash.com/photo-1505740420928-5e560c06d30e?ixlib=rb-4.0.3&auto=format&fit=crop&w=50&q=80" 
                                     class="rounded me-3" width="50">
                                <div>
                                    <h6 class="fw-bold mb-0">Product Name {{ $i }}</h6>
                                    <small class="text-muted">SKU: PROD{{ 1000 + $i }}</small>
                                </div>
                            </div>
                        </td>
                        <td>
                            @php $categories = ['Electronics', 'Fashion', 'Home & Garden']; @endphp
                            <span class="badge bg-light text-dark">{{ $categories[array_rand($categories)] }}</span>
                        </td>
                        <td class="fw-bold">
                            Rp {{ number_format(rand(50000, 500000), 0, ',', '.') }}
                        </td>
                        <td>
                            @php $stock = rand(0, 50); @endphp
                            <div class="d-flex align-items-center">
                                <span class="me-2">{{ $stock }}</span>
                                @if($stock <= 5)
                                <span class="badge bg-danger">Low</span>
                                @elseif($stock == 0)
                                <span class="badge bg-secondary">Out</span>
                                @endif
                            </div>
                        </td>
                        <td>
                            @if(rand(0, 1))
                            <span class="badge bg-success">Active</span>
                            @else
                            <span class="badge bg-secondary">Inactive</span>
                            @endif
                        </td>
                        <td>
                            <div class="d-flex align-items-center">
                                <div class="progress flex-grow-1 me-2" style="height: 6px;">
                                    <div class="progress-bar bg-success" style="width: {{ rand(20, 90) }}%"></div>
                                </div>
                                <span>{{ rand(10, 100) }}</span>
                            </div>
                        </td>
                        <td class="text-end pe-4">
                            <div class="btn-group" role="group">
                                <a href="{{ route('admin.products.show', $i) }}" class="btn btn-sm btn-outline-info">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ route('admin.products.edit', $i) }}" class="btn btn-sm btn-outline-primary">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <button type="button" class="btn btn-sm btn-outline-danger" 
                                        onclick="confirmDelete({{ $i }})">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                    @endfor
                </tbody>
            </table>
        </div>
    </div>
    <div class="card-footer bg-white border-0">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <select class="form-select form-select-sm" style="width: auto;">
                    <option>10 per page</option>
                    <option>25 per page</option>
                    <option>50 per page</option>
                </select>
            </div>
            <nav>
                <ul class="pagination mb-0">
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
</div>

<!-- Bulk Actions -->
<div class="mt-3">
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <select class="form-select form-select-sm me-2" style="width: auto;">
                <option>Bulk Actions</option>
                <option>Activate Selected</option>
                <option>Deactivate Selected</option>
                <option>Delete Selected</option>
            </select>
            <button class="btn btn-sm btn-primary">Apply</button>
        </div>
        <div class="text-muted">
            Showing 1 to 10 of 586 products
        </div>
    </div>
</div>

<script>
    function confirmDelete(productId) {
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                // AJAX delete request would go here
                Swal.fire(
                    'Deleted!',
                    'Product has been deleted.',
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
    }
    
    .table tbody tr:hover {
        background-color: rgba(67, 97, 238, 0.05);
    }
    
    .progress {
        width: 80px;
    }
    
    .btn-group .btn {
        border-radius: 4px !important;
        margin-right: 4px;
    }
    
    .btn-group .btn:last-child {
        margin-right: 0;
    }
</style>
@endsection