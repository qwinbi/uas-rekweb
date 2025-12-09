@extends('layouts.admin')

@section('title', 'Edit Product')

@section('content')
<div class="row">
    <div class="col-lg-8">
        <div class="card border-0 shadow-sm">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h4 class="fw-bold mb-0" style="color: var(--burgundy);">
                        <i class="fas fa-edit me-2"></i>Edit Product
                    </h4>
                    <a href="{{ route('admin.products.index') }}" class="btn btn-outline-secondary">
                        <i class="fas fa-arrow-left me-2"></i>Back to List
                    </a>
                </div>
                
                <form action="#" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    
                    <!-- Basic Information -->
                    <div class="mb-4">
                        <h6 class="fw-bold mb-3" style="color: var(--lapis-lazuli);">Basic Information</h6>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label required">Product Name</label>
                                <input type="text" class="form-control" name="name" value="Premium Wireless Headphones" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">SKU</label>
                                <input type="text" class="form-control" name="sku" value="PROD-1001" readonly>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label required">Category</label>
                                <select class="form-select" name="category_id" required>
                                    <option value="1" selected>Electronics</option>
                                    <option value="2">Fashion</option>
                                    <option value="3">Home & Garden</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Brand</label>
                                <input type="text" class="form-control" name="brand" value="AudioTech">
                            </div>
                        </div>
                    </div>
                    
                    <!-- Pricing -->
                    <div class="mb-4">
                        <h6 class="fw-bold mb-3" style="color: var(--lapis-lazuli);">Pricing</h6>
                        <div class="row g-3">
                            <div class="col-md-4">
                                <label class="form-label required">Regular Price</label>
                                <div class="input-group">
                                    <span class="input-group-text">Rp</span>
                                    <input type="number" class="form-control" name="price" value="599000" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Sale Price</label>
                                <div class="input-group">
                                    <span class="input-group-text">Rp</span>
                                    <input type="number" class="form-control" name="sale_price" value="499000">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Tax Rate (%)</label>
                                <input type="number" class="form-control" name="tax_rate" value="10" step="0.1">
                            </div>
                        </div>
                    </div>
                    
                    <!-- Inventory -->
                    <div class="mb-4">
                        <h6 class="fw-bold mb-3" style="color: var(--lapis-lazuli);">Inventory</h6>
                        <div class="row g-3">
                            <div class="col-md-4">
                                <label class="form-label required">Stock Quantity</label>
                                <input type="number" class="form-control" name="stock_quantity" value="50" required>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Low Stock Threshold</label>
                                <input type="number" class="form-control" name="low_stock_threshold" value="5">
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Stock Status</label>
                                <select class="form-select" name="stock_status">
                                    <option value="in_stock" selected>In Stock</option>
                                    <option value="out_of_stock">Out of Stock</option>
                                    <option value="backorder">On Backorder</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Images -->
                    <div class="mb-4">
                        <h6 class="fw-bold mb-3" style="color: var(--lapis-lazuli);">Product Images</h6>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label">Main Image</label>
                                <div class="border rounded p-3">
                                    <div class="text-center mb-3">
                                        <img src="https://images.unsplash.com/photo-1505740420928-5e560c06d30e?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80" 
                                             class="img-fluid rounded" style="max-height: 150px;">
                                    </div>
                                    <input type="file" class="form-control" name="main_image" accept="image/*">
                                    <small class="text-muted">Upload new image to replace current</small>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Gallery Images</label>
                                <div class="border rounded p-3">
                                    <div class="row g-2 mb-3">
                                        @for($i = 1; $i <= 4; $i++)
                                        <div class="col-6">
                                            <div class="position-relative">
                                                <img src="https://images.unsplash.com/photo-1505740420928-5e560c06d30e?ixlib=rb-4.0.3&auto=format&fit=crop&w=150&q=80" 
                                                     class="img-fluid rounded border" style="height: 80px; object-fit: cover;">
                                                <button type="button" class="btn btn-sm btn-danger position-absolute top-0 end-0" 
                                                        style="transform: translate(50%, -50%);">
                                                    <i class="fas fa-times"></i>
                                                </button>
                                            </div>
                                        </div>
                                        @endfor
                                    </div>
                                    <input type="file" class="form-control" name="gallery_images[]" multiple accept="image/*">
                                    <small class="text-muted">Add more images to gallery</small>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Description -->
                    <div class="mb-4">
                        <h6 class="fw-bold mb-3" style="color: var(--lapis-lazuli);">Description</h6>
                        <div class="mb-3">
                            <label class="form-label">Short Description</label>
                            <textarea class="form-control" name="short_description" rows="2">Premium wireless headphones with noise cancellation and 30-hour battery life.</textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Full Description</label>
                            <textarea class="form-control" name="description" rows="6">Experience premium sound quality with our wireless headphones. Features noise cancellation, 30-hour battery life, and comfortable design for extended use. Advanced noise cancellation technology provides crystal-clear audio perfect for music lovers, gamers, and professionals.</textarea>
                        </div>
                    </div>
                    
                    <!-- Specifications -->
                    <div class="mb-4">
                        <h6 class="fw-bold mb-3" style="color: var(--lapis-lazuli);">Specifications</h6>
                        <div id="specsContainer">
                            @foreach([
                                ['name' => 'Brand', 'value' => 'AudioTech'],
                                ['name' => 'Model', 'value' => 'ATH-M50x'],
                                ['name' => 'Connectivity', 'value' => 'Bluetooth 5.0'],
                                ['name' => 'Battery Life', 'value' => '30 hours']
                            ] as $index => $spec)
                            <div class="row g-2 mb-2">
                                <div class="col-md-5">
                                    <input type="text" class="form-control" name="specs[{{ $index }}][name]" 
                                           value="{{ $spec['name'] }}" placeholder="Specification name">
                                </div>
                                <div class="col-md-6">
                                    <input type="text" class="form-control" name="specs[{{ $index }}][value]" 
                                           value="{{ $spec['value'] }}" placeholder="Specification value">
                                </div>
                                <div class="col-md-1">
                                    @if($index > 0)
                                    <button type="button" class="btn btn-danger w-100" onclick="removeSpec(this)">
                                        <i class="fas fa-times"></i>
                                    </button>
                                    @endif
                                </div>
                            </div>
                            @endforeach
                        </div>
                        <button type="button" class="btn btn-outline-primary btn-sm mt-2" onclick="addSpec()">
                            <i class="fas fa-plus me-2"></i>Add Specification
                        </button>
                    </div>
                    
                    <!-- Submit -->
                    <div class="d-flex justify-content-end gap-3">
                        <a href="{{ route('admin.products.index') }}" class="btn btn-outline-secondary">
                            Cancel
                        </a>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save me-2"></i>Update Product
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
    <!-- Sidebar -->
    <div class="col-lg-4">
        <!-- Status Card -->
        <div class="card border-0 shadow-sm mb-4">
            <div class="card-body">
                <h6 class="fw-bold mb-3" style="color: var(--burgundy);">Status & Visibility</h6>
                <div class="form-check form-switch mb-3">
                    <input class="form-check-input" type="checkbox" name="status" id="status" checked>
                    <label class="form-check-label" for="status">
                        Product Active
                    </label>
                </div>
                <div class="form-check form-switch mb-3">
                    <input class="form-check-input" type="checkbox" name="featured" id="featured" checked>
                    <label class="form-check-label" for="featured">
                        Featured Product
                    </label>
                </div>
                <div class="form-check form-switch mb-3">
                    <input class="form-check-input" type="checkbox" name="in_stock" id="inStock" checked>
                    <label class="form-check-label" for="inStock">
                        In Stock
                    </label>
                </div>
                <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" name="new_arrival" id="newArrival">
                    <label class="form-check-label" for="newArrival">
                        Mark as New Arrival
                    </label>
                </div>
            </div>
        </div>
        
        <!-- Product Statistics -->
        <div class="card border-0 shadow-sm mb-4">
            <div class="card-body">
                <h6 class="fw-bold mb-3" style="color: var(--burgundy);">Product Statistics</h6>
                <div class="list-group list-group-flush">
                    <div class="list-group-item border-0 px-0 d-flex justify-content-between">
                        <span>Views</span>
                        <span class="fw-semibold">1,248</span>
                    </div>
                    <div class="list-group-item border-0 px-0 d-flex justify-content-between">
                        <span>Sales</span>
                        <span class="fw-semibold">156</span>
                    </div>
                    <div class="list-group-item border-0 px-0 d-flex justify-content-between">
                        <span>Revenue</span>
                        <span class="fw-semibold">Rp 77,844,000</span>
                    </div>
                    <div class="list-group-item border-0 px-0 d-flex justify-content-between">
                        <span>Rating</span>
                        <span class="fw-semibold">4.5/5.0</span>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- SEO Settings -->
        <div class="card border-0 shadow-sm">
            <div class="card-body">
                <h6 class="fw-bold mb-3" style="color: var(--burgundy);">SEO Settings</h6>
                <div class="mb-3">
                    <label class="form-label">SEO Title</label>
                    <input type="text" class="form-control" name="seo_title" 
                           value="Premium Wireless Headphones | BUNNYPOPS">
                </div>
                <div class="mb-3">
                    <label class="form-label">Slug</label>
                    <input type="text" class="form-control" name="slug" 
                           value="premium-wireless-headphones">
                </div>
                <div class="mb-3">
                    <label class="form-label">Meta Description</label>
                    <textarea class="form-control" name="meta_description" rows="3">Premium wireless headphones with noise cancellation. 30-hour battery life. Free shipping available.</textarea>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    let specCount = 4;
    
    function addSpec() {
        const container = document.getElementById('specsContainer');
        const div = document.createElement('div');
        div.className = 'row g-2 mb-2';
        div.innerHTML = `
            <div class="col-md-5">
                <input type="text" class="form-control" name="specs[${specCount}][name]" 
                       placeholder="Specification name">
            </div>
            <div class="col-md-6">
                <input type="text" class="form-control" name="specs[${specCount}][value]" 
                       placeholder="Specification value">
            </div>
            <div class="col-md-1">
                <button type="button" class="btn btn-danger w-100" onclick="removeSpec(this)">
                    <i class="fas fa-times"></i>
                </button>
            </div>
        `;
        container.appendChild(div);
        specCount++;
    }
    
    function removeSpec(button) {
        button.closest('.row').remove();
    }
    
    // Remove gallery image
    document.querySelectorAll('.btn-danger.position-absolute').forEach(btn => {
        btn.addEventListener('click', function() {
            const imageContainer = this.closest('.position-relative');
            
            Swal.fire({
                title: 'Remove Image?',
                text: "Are you sure you want to remove this image from gallery?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: 'var(--burgundy)',
                cancelButtonColor: 'var(--silver-lake)',
                confirmButtonText: 'Yes, remove it!',
                background: 'var(--light-pink)',
                color: 'var(--burgundy)'
            }).then((result) => {
                if (result.isConfirmed) {
                    imageContainer.style.opacity = '0';
                    setTimeout(() => {
                        imageContainer.remove();
                        Swal.fire(
                            'Removed!',
                            'Image has been removed from gallery.',
                            'success'
                        );
                    }, 300);
                }
            });
        });
    });
    
    // Form validation
    document.querySelector('form').addEventListener('submit', function(e) {
        const requiredFields = this.querySelectorAll('[required]');
        let valid = true;
        
        requiredFields.forEach(field => {
            if (!field.value.trim()) {
                valid = false;
                field.classList.add('is-invalid');
            } else {
                field.classList.remove('is-invalid');
            }
        });
        
        if (!valid) {
            e.preventDefault();
            Swal.fire({
                icon: 'error',
                title: 'Validation Error',
                text: 'Please fill in all required fields.',
                background: 'var(--light-pink)',
                color: 'var(--burgundy)'
            });
        }
    });
</script>

<style>
    .form-label.required::after {
        content: ' *';
        color: var(--burgundy);
    }
    
    .form-switch .form-check-input {
        width: 3em;
        height: 1.5em;
    }
    
    .form-switch .form-check-input:checked {
        background-color: var(--burgundy);
        border-color: var(--burgundy);
    }
    
    .position-relative .btn-danger {
        width: 24px;
        height: 24px;
        padding: 0;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 0.75rem;
    }
    
    .list-group-item {
        color: var(--lapis-lazuli);
    }
</style>
@endsection