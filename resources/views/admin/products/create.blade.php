@extends('layouts.admin')

@section('title', 'Add New Product')

@section('content')
<div class="row">
    <div class="col-lg-8">
        <div class="card border-0 shadow-sm">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h4 class="fw-bold mb-0">
                        <i class="fas fa-plus-circle me-2"></i>Add New Product
                    </h4>
                    <a href="{{ route('admin.products.index') }}" class="btn btn-outline-secondary">
                        <i class="fas fa-arrow-left me-2"></i>Back to List
                    </a>
                </div>
                
                <form action="#" method="POST" enctype="multipart/form-data">
                    @csrf
                    
                    <!-- Basic Information -->
                    <div class="mb-4">
                        <h6 class="fw-bold mb-3 text-primary">Basic Information</h6>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label required">Product Name</label>
                                <input type="text" class="form-control" name="name" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">SKU (Optional)</label>
                                <input type="text" class="form-control" name="sku">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label required">Category</label>
                                <select class="form-select" name="category_id" required>
                                    <option value="">Select Category</option>
                                    <option value="1">Electronics</option>
                                    <option value="2">Fashion</option>
                                    <option value="3">Home & Garden</option>
                                    <option value="4">Books</option>
                                    <option value="5">Sports</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Brand</label>
                                <input type="text" class="form-control" name="brand">
                            </div>
                        </div>
                    </div>
                    
                    <!-- Pricing -->
                    <div class="mb-4">
                        <h6 class="fw-bold mb-3 text-primary">Pricing</h6>
                        <div class="row g-3">
                            <div class="col-md-4">
                                <label class="form-label required">Regular Price</label>
                                <div class="input-group">
                                    <span class="input-group-text">Rp</span>
                                    <input type="number" class="form-control" name="price" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Sale Price</label>
                                <div class="input-group">
                                    <span class="input-group-text">Rp</span>
                                    <input type="number" class="form-control" name="sale_price">
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
                        <h6 class="fw-bold mb-3 text-primary">Inventory</h6>
                        <div class="row g-3">
                            <div class="col-md-4">
                                <label class="form-label required">Stock Quantity</label>
                                <input type="number" class="form-control" name="stock_quantity" value="0" required>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Low Stock Threshold</label>
                                <input type="number" class="form-control" name="low_stock_threshold" value="5">
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Stock Status</label>
                                <select class="form-select" name="stock_status">
                                    <option value="in_stock">In Stock</option>
                                    <option value="out_of_stock">Out of Stock</option>
                                    <option value="backorder">On Backorder</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Images -->
                    <div class="mb-4">
                        <h6 class="fw-bold mb-3 text-primary">Product Images</h6>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label">Main Image</label>
                                <div class="border rounded p-4 text-center">
                                    <i class="fas fa-cloud-upload-alt fa-3x text-muted mb-3"></i>
                                    <p class="mb-2">Drag & drop or click to upload</p>
                                    <input type="file" class="form-control" name="main_image" accept="image/*">
                                    <small class="text-muted">Recommended: 800x800px, JPG/PNG</small>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Gallery Images</label>
                                <div class="border rounded p-4 text-center">
                                    <i class="fas fa-images fa-3x text-muted mb-3"></i>
                                    <p class="mb-2">Upload multiple images</p>
                                    <input type="file" class="form-control" name="gallery_images[]" multiple accept="image/*">
                                    <small class="text-muted">You can select multiple files</small>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Description -->
                    <div class="mb-4">
                        <h6 class="fw-bold mb-3 text-primary">Description</h6>
                        <div class="mb-3">
                            <label class="form-label">Short Description</label>
                            <textarea class="form-control" name="short_description" rows="3" 
                                      placeholder="Brief description shown in product listings"></textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Full Description</label>
                            <textarea class="form-control" name="description" rows="6" 
                                      placeholder="Detailed product description"></textarea>
                        </div>
                    </div>
                    
                    <!-- Attributes -->
                    <div class="mb-4">
                        <h6 class="fw-bold mb-3 text-primary">Attributes</h6>
                        <div id="attributes-container">
                            <div class="row g-2 mb-2">
                                <div class="col-md-4">
                                    <input type="text" class="form-control" placeholder="Attribute name" name="attributes[0][name]">
                                </div>
                                <div class="col-md-6">
                                    <input type="text" class="form-control" placeholder="Values (comma separated)" name="attributes[0][values]">
                                </div>
                                <div class="col-md-2">
                                    <button type="button" class="btn btn-danger w-100" onclick="removeAttribute(this)">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <button type="button" class="btn btn-outline-primary btn-sm" onclick="addAttribute()">
                            <i class="fas fa-plus me-2"></i>Add Attribute
                        </button>
                    </div>
                    
                    <!-- SEO -->
                    <div class="mb-4">
                        <h6 class="fw-bold mb-3 text-primary">SEO Settings</h6>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label">SEO Title</label>
                                <input type="text" class="form-control" name="seo_title">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Meta Keywords</label>
                                <input type="text" class="form-control" name="meta_keywords" 
                                       placeholder="keyword1, keyword2, keyword3">
                            </div>
                            <div class="col-12">
                                <label class="form-label">Meta Description</label>
                                <textarea class="form-control" name="meta_description" rows="2"></textarea>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Submit -->
                    <div class="d-flex justify-content-end gap-3">
                        <button type="reset" class="btn btn-outline-secondary">
                            <i class="fas fa-redo me-2"></i>Reset
                        </button>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save me-2"></i>Save Product
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
                <h6 class="fw-bold mb-3">Status</h6>
                <div class="form-check form-switch mb-3">
                    <input class="form-check-input" type="checkbox" name="status" id="status" checked>
                    <label class="form-check-label" for="status">
                        Product Active
                    </label>
                </div>
                <div class="form-check form-switch mb-3">
                    <input class="form-check-input" type="checkbox" name="featured" id="featured">
                    <label class="form-check-label" for="featured">
                        Featured Product
                    </label>
                </div>
                <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" name="in_stock" id="in_stock" checked>
                    <label class="form-check-label" for="in_stock">
                        In Stock
                    </label>
                </div>
            </div>
        </div>
        
        <!-- Organization -->
        <div class="card border-0 shadow-sm mb-4">
            <div class="card-body">
                <h6 class="fw-bold mb-3">Organization</h6>
                <div class="mb-3">
                    <label class="form-label">Tags</label>
                    <input type="text" class="form-control" name="tags" 
                           placeholder="Add tags (comma separated)">
                </div>
                <div class="mb-3">
                    <label class="form-label">Weight (kg)</label>
                    <input type="number" class="form-control" name="weight" step="0.01">
                </div>
                <div class="mb-3">
                    <label class="form-label">Dimensions (cm)</label>
                    <div class="row g-2">
                        <div class="col-4">
                            <input type="number" class="form-control" placeholder="Length" name="length">
                        </div>
                        <div class="col-4">
                            <input type="number" class="form-control" placeholder="Width" name="width">
                        </div>
                        <div class="col-4">
                            <input type="number" class="form-control" placeholder="Height" name="height">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Shipping -->
        <div class="card border-0 shadow-sm">
            <div class="card-body">
                <h6 class="fw-bold mb-3">Shipping</h6>
                <div class="form-check mb-2">
                    <input class="form-check-input" type="checkbox" name="free_shipping" id="free_shipping">
                    <label class="form-check-label" for="free_shipping">
                        Free Shipping
                    </label>
                </div>
                <div class="form-check mb-3">
                    <input class="form-check-input" type="checkbox" name="shipping_taxable" id="shipping_taxable" checked>
                    <label class="form-check-label" for="shipping_taxable">
                        Shipping Taxable
                    </label>
                </div>
                <div class="mb-3">
                    <label class="form-label">Shipping Class</label>
                    <select class="form-select" name="shipping_class_id">
                        <option value="">No Shipping Class</option>
                        <option value="1">Standard Shipping</option>
                        <option value="2">Express Shipping</option>
                        <option value="3">Overnight Shipping</option>
                    </select>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    let attributeCount = 1;
    
    function addAttribute() {
        const container = document.getElementById('attributes-container');
        const div = document.createElement('div');
        div.className = 'row g-2 mb-2';
        div.innerHTML = `
            <div class="col-md-4">
                <input type="text" class="form-control" placeholder="Attribute name" name="attributes[${attributeCount}][name]">
            </div>
            <div class="col-md-6">
                <input type="text" class="form-control" placeholder="Values (comma separated)" name="attributes[${attributeCount}][values]">
            </div>
            <div class="col-md-2">
                <button type="button" class="btn btn-danger w-100" onclick="removeAttribute(this)">
                    <i class="fas fa-times"></i>
                </button>
            </div>
        `;
        container.appendChild(div);
        attributeCount++;
    }
    
    function removeAttribute(button) {
        if (document.querySelectorAll('#attributes-container .row').length > 1) {
            button.closest('.row').remove();
        }
    }
    
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
                text: 'Please fill in all required fields.'
            });
        }
    });
</script>

<style>
    .form-label.required::after {
        content: ' *';
        color: #dc3545;
    }
    
    .form-switch .form-check-input {
        width: 3em;
        height: 1.5em;
    }
    
    .card {
        border-radius: 12px;
    }
    
    input[type="file"] {
        border: 1px dashed #dee2e6;
        padding: 0.5rem;
        background: #f8f9fa;
    }
    
    input[type="file"]:hover {
        border-color: #4361ee;
        background: rgba(67, 97, 238, 0.05);
    }
</style>
@endsection